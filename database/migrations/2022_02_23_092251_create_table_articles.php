<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            // constrained->onDelete permet de supprimer en cascade tous les articles dont l'auteur est user_id
            // si celui ci venait à disparaitre de la bdd
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // cela nous évite de le programmer en php, c sql qui gèrera
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
