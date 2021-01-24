<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('translations');
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('value');

            $table->string('language_iso_code', 3);
            $table->foreign('language_iso_code')->references('iso_code')->on('languages');

            $table->unsignedBigInteger('key_id');
            $table->foreign('key_id')->references('id')->on('keys')->onDelete('cascade');

            $table->unique(['key_id', 'language_iso_code']);

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
        Schema::dropIfExists('translations');
    }
}
