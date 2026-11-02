<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    public function show(string $path): BinaryFileResponse|RedirectResponse|Response
    {
        if (! preg_match('/^(images|banners|audio)\/[A-Za-z0-9._-]+$/', $path)) {
            abort(404);
        }

        $disk = Storage::disk('media');
        $diskPath = $disk->path($path);

        if (! $disk->exists($path)) {
            $publicPath = storage_path('app/public/'.$path);

            if (file_exists($publicPath)) {
                return response()->file($publicPath, [
                    'Cache-Control' => 'public, max-age=31536000',
                ]);
            }

            if (str_starts_with($path, 'audio/')) {
                abort(404);
            }

            return redirect(asset('img/noimg.svg'));
        }

        if (config('filesystems.disks.media.driver') === 'local') {
            return response()->file($diskPath, [
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        return redirect()->away($disk->url($path));
    }
}
