<?php

namespace App\ImageProviders;

use Swis\Filament\Backgrounds\Contracts\ProvidesImages;
use Swis\Filament\Backgrounds\Image;

class TailorImageProvider implements ProvidesImages
{
    private array $images = [
        'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1920&h=1080&fit=crop&q=sewing+machine',
        'https://images.unsplash.com/photo-1445205170230-053b83016050?w=1920&h=1080&fit=crop&q=tailor+sewing',
        'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1920&h=1080&fit=crop&q=seamstress+work',
        'https://images.unsplash.com/photo-1594736797933-d0401ba2fe65?w=1920&h=1080&fit=crop&q=fashion+sewing',
        'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1920&h=1080&fit=crop&q=sewer+working',
        'https://images.unsplash.com/photo-1582719471384-894fbb16e074?w=1920&h=1080&fit=crop&q=textile+sewing',
        'https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?w=1920&h=1080&fit=crop&q=tailor+shop',
        'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=1920&h=1080&fit=crop&q=sewing+fabric',
        'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=1920&h=1080&fit=crop&q=clothing+sewer',
        'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=1920&h=1080&fit=crop&q=professional+sewing'
    ];

    public static function make(): static
    {
        return app(static::class);
    }

    public function getImage(): Image
    {
        $index = floor(time() / 5) % count($this->images);
        
        return new Image(
            'url("' . $this->images[$index] . '")',
            'Afghan Tailor Professional'
        );
    }
}