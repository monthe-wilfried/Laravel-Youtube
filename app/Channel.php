<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Channel extends BaseModel implements HasMedia
{
    //
    use InteractsWithMedia;

    public function user(){
        return $this->belongsTo(User::class);
    }

    // those the image conversions
    public function registerMediaConversions(Media $media = null): void
    {
        // TODO: Implement registerMediaConversions() method.
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }

    public function image(){
        if ($this->media->first()){
            return $this->getMedia('images')->first()->getUrl('thumb');
        }
        return null;
    }



}
