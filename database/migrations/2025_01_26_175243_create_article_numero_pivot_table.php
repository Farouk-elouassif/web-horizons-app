<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('article_numero', function (Blueprint $table) {
        $table->unsignedBigInteger('article_id');
        $table->unsignedBigInteger('numero_id');
        $table->timestamps();

        // Foreign keys
        $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        $table->foreign('numero_id')->references('Id_numero')->on('numeros')->onDelete('cascade');

        // Composite primary key
        $table->primary(['article_id', 'numero_id']);
    });
}

public function down()
{
    Schema::dropIfExists('article_numero');
}
};
