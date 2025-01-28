<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    public function articles(): BelongsToMany
{
    return $this->belongsToMany(Article::class, 'article_numero', 'numero_id', 'article_id');
}
}
