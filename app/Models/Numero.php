<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Numero extends Model
{
    protected $primaryKey = 'id_numero';
    public function articles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_numero', 'numero_id', 'article_id');
    }

}
