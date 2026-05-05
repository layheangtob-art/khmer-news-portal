<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CambTextToSpeechService
{
    public function isConfigured(): bool
    {
        return (bool) config('services.camb.api_key');
    }

    public function synthesizeTitleToFile(string $title): ?string
    {
        if (! $this->isConfigured()) {
            return null;
        }

        $text = $this->prepareText($title);
        if (mb_strlen($text) < 3) {
            return null;
        }

        if (mb_strlen($text) > 3000) {
            $text = mb_substr($text, 0, 3000);
        }

        $url = rtrim((string) config('services.camb.api_url', 'https://client.camb.ai/apis'), '/').'/tts-stream';

        try {
            $response = Http::withHeaders([
                'x-api-key' => (string) config('services.camb.api_key'),
                'Content-Type' => 'application/json',
                'Accept' => 'audio/mpeg',
            ])
                ->connectTimeout(30)
                ->timeout((int) config('services.camb.timeout', 120))
                ->post($url, [
                    'text' => $text,
                    'language' => (string) config('services.camb.language'),
                    'voice_id' => (int) config('services.camb.voice_id'),
                    'speech_model' => (string) config('services.camb.speech_model'),
                    'output_configuration' => [
                        'format' => (string) config('services.camb.format', 'mp3'),
                    ],
                ]);

            if (! $response->successful()) {
                Log::warning('Camb TTS request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return null;
            }

            $body = $response->body();
            if ($body === '' || $body === false) {
                return null;
            }

            $fileName = 'title_tts_'.time().'_'.Str::lower(Str::random(8)).'.mp3';
            Storage::put('public/audio/'.$fileName, $body);

            return $fileName;
        } catch (\Throwable $e) {
            Log::error('Camb TTS exception', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function prepareText(string $title): string
    {
        $plain = html_entity_decode(strip_tags($title), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $plain = preg_replace('/\s+/u', ' ', (string) $plain);

        return trim((string) $plain);
    }
}
