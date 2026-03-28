<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Google\Cloud\TextToSpeech\V1\Client\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesizeSpeechRequest;

class GenerateRetroactiveAudio extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:generate-audio {--force : Override existing audio files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Text-To-Speech audio for existing news articles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $force = $this->option('force');
        $this->info('Starting audio generation for news articles...');

        $credentialsPath = storage_path('app/google-credentials.json');
        if (!file_exists($credentialsPath)) {
            $this->error('Google Cloud credentials file not found at: ' . $credentialsPath);
            $this->line('Please place your google-credentials.json file in the storage/app/ directory first.');
            return Command::FAILURE;
        }

        $newsQuery = News::query();
        if (!$force) {
            $newsQuery->whereNull('audio')->orWhere('audio', '');
        }

        $articles = $newsQuery->get();
        if ($articles->isEmpty()) {
            $this->info('No articles found that need audio generation.');
            return Command::SUCCESS;
        }

        $this->info('Found ' . $articles->count() . ' articles to process.');
        $bar = $this->output->createProgressBar($articles->count());
        $bar->start();

        foreach ($articles as $news) {
            try {
                $textToSpeechContent = $news->title . ".\n\n" . strip_tags($news->content);
                $textToSpeechContent = Str::limit($textToSpeechContent, 4000, '');

                $textToSpeechClient = new TextToSpeechClient([
                    'credentials' => $credentialsPath
                ]);
                
                $input = (new SynthesisInput())
                    ->setText($textToSpeechContent);
                
                $voice = (new VoiceSelectionParams())
                    ->setLanguageCode('km-KH')
                    ->setName('km-KH-Standard-A');
                
                $audioConfig = (new AudioConfig())
                    ->setAudioEncoding(AudioEncoding::MP3);
                
                $synthRequest = new SynthesizeSpeechRequest([
                    'input' => $input,
                    'voice' => $voice,
                    'audio_config' => $audioConfig
                ]);

                $response = $textToSpeechClient->synthesizeSpeech($synthRequest);
                $audioContent = $response->getAudioContent();
                
                // Ensure old audio is removed if overriding
                if ($force && $news->audio) {
                    Storage::delete('public/audio/' . $news->audio);
                }

                $audioFileName = 'audio_' . time() . '_' . uniqid() . '.mp3';
                Storage::put('public/audio/' . $audioFileName, $audioContent);
                
                $news->update(['audio' => $audioFileName]);
                
                $textToSpeechClient->close();
            } catch (\Exception $e) {
                $this->error("\nFailed to generate audio for Article ID {$news->id}: " . $e->getMessage());
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newline();
        $this->info('Audio generation completed!');
        return Command::SUCCESS;
    }
}
