<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
    protected $primaryKey = 'Id_numero';
    protected $fillable = [
        'statut',
        'titre_numero',
        'date_publication'
    ];

    public $incrementing = true;
    protected $keyType = 'int';

    public function getRouteKeyName(){
        return 'Id_numero';
    }

    public function articles(): BelongsToMany{
        return $this->belongsToMany(Article::class, 'article_numero', 'numero_id', 'article_id');
    }
}
