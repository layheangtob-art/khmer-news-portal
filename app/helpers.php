<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('media_url')) {
    /**
     * Resolve the public URL of a file stored on the "media" disk.
     *
     * Local deployments can use either /media/<path> or /storage/<path> because
     * the app creates a media symlink for compatibility. Cloud deployments keep
     * uploaded files on the configured bucket and return the object URL directly.
     */
    function media_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $path = ltrim($path, '/');

        if (blank($path)) {
            return null;
        }

        $disk = Storage::disk('media');
        $driver = config('filesystems.disks.media.driver');

        if ($driver === 'local') {
            $localUrl = url('media/'.$path);

            if (file_exists($disk->path($path)) || file_exists(public_path('media/'.$path))) {
                return $localUrl;
            }

            if (file_exists(storage_path('app/public/'.$path))) {
                return url('storage/'.$path);
            }

            return $localUrl;
        }

        if (method_exists($disk, 'url')) {
            return $disk->url($path);
        }

        return url('storage/'.$path);
    }
}

if (! function_exists('media_image')) {
    /**
     * Resolve the URL of an uploaded image, falling back to a placeholder.
     */
    function media_image(?string $filename, string $fallback = 'img/noimg.svg'): string
    {
        return $filename ? (string) media_url('images/'.$filename) : asset($fallback);
    }
}

if (! function_exists('store_public_media')) {
    /**
     * Store an uploaded file on the media disk with public visibility.
     */
    function store_public_media(string $directory, $file, string $name): string
    {
        Storage::disk('media')->putFileAs($directory, $file, $name, ['visibility' => 'public']);

        return $name;
    }
}
