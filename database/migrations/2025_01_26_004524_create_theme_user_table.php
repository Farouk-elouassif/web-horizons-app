<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('theme_user', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('theme_id');
        $table->timestamps();

        // Foreign key constraints
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');

        // Ensure unique combinations of user_id and theme_id
        $table->unique(['user_id', 'theme_id']);
    });
}

public function down()
{
    Schema::dropIfExists('theme_user');
}
};
