<?php

return [
    'image_type' => 'jpg',
    'sizes' => [
        'table' => ['width' => '128', 'height' => '128'],
        'small' => ['width' => '480', 'height' => '480'],
        'medium' => ['width' => '720', 'height' => '720'],
        'large' => ['width' => '930', 'height' => '930'],
    ],
    'jpeg_compression' => 80,
    'original_path' => 'upload_img/animals/originals',
    'variant_pattern' => 'upload_img/animals/variants/%sx%s'
];
