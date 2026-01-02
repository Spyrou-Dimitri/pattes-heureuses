<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProcessUploadedImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public string $full_path_to_original,
                                public string $new_original_file_name)
    {

    }

    public function handle(): void
    {
        $image = Image::read(
            Storage::get($this->full_path_to_original)
        );

        $sizes = config('animalavatars.sizes');
        $jpeg_compression = config('animalavatars.jpeg_compression');
        $variant_pattern = config('animalavatars.variant_pattern');
        $image_type = config('animalavatars.image_type');

        foreach ($sizes as $size) {
            $variant = clone $image;
            $variant
                ->scale($size['width']);

            $path = sprintf($variant_pattern, $size['width'], $size['height']);
            Storage::put($path . '/' . $this->new_original_file_name, $variant->encodeByExtension($image_type, $jpeg_compression));
        }
    }
}
