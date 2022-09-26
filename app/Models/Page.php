<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tonysm\RichTextLaravel\Models\Traits\HasRichText;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Page extends Model implements HasMedia
{
    use HasFactory;
    use HasRichText;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $richTextFields = [
        'content',
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')->singleFile()->useFallbackUrl(config('config.default-thumbnail'));
    }

    public function getThumbnailUrlAttribute(){
        return $this->getFirstMediaUrl('thumbnail');
    }

}
