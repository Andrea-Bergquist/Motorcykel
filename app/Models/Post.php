<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author_id',
    ]; 

    protected $table = 'posts';
    
    public function images(): HasMany
    {
        return $this->hasMany(PostImage::class);
    }

    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn() => ceil(str($this->content)->stripTags()->wordCount() / 200) . ' min läsning'
        );
    }
}
