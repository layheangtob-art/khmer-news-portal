<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('media_url')) {
    /**
     * Resolve the public URL of a file stored on the "media" disk.
     *
     * The "media" disk is the local public disk during development and the
     * Laravel Cloud object storage bucket in production, so the same call
     * returns the correct URL in both environments.
     */
    function media_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $path = ltrim($path, '/');

        // Local files are served by MediaController. Do not use /storage/... on
        // Laravel Cloud: public/storage is a symlink, so missing files 404 at
        // the web server and never reach Laravel.
        if (config('filesystems.disks.media.driver') === 'local') {
            return url('media/'.$path);
        }

        return Storage::disk('media')->url($path);
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
