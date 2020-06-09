<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Fjord\Crud\Models\Traits\TrackEdits;
use Spatie\MediaLibrary\HasMedia as HasMediaContract;
use Fjord\Crud\Models\Traits\HasMedia;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Fjord\Crud\Models\Traits\Translatable;

class FooBar extends Model implements HasMediaContract, TranslatableContract
{
    use TrackEdits, HasMedia, Translatable;

    /**
     * Setup Model:
     *
     * Enter all fillable columns. Translated columns must also be set fillable. 
     * Don't forget to also set them fillable in the coresponding translation-model!
     */

    
    /**
     * Fillable attributes
     *
     * @var array
     */
    protected $fillable = ['title', 'text'];
    public $translatedAttributes = ['title', 'text', 'slug'];
	protected $appends = ['image', 'translation'];
    protected $with = ['media', 'translations'];

    

        /**
     * Image attribute.
     *
     * @return \Fjord\Crud\Models\Media
     */
    public function getImageAttribute()
    {
        return $this->getMedia('image');
    }
    /**
     * Append the translation to each query.
     *
     * @return array
     */
    public function getTranslationAttribute()
    {
        return $this->getTranslationsArray();
    }

}
