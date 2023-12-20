<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'imgUrl', 'published_at', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    protected static function newFactory()
    {
        return \Database\Factories\PostFactory::new();
    }
}
