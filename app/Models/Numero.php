<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    // Define the relationship with the Article model
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_numero');
    }
}
