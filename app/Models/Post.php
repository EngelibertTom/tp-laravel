<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'author_id',
    ];

    protected $guarded = [];
}
