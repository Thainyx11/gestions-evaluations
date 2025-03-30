<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cours', function (Blueprint $table) {
        $table->id();
        $table->string('intitule');
        $table->text('description')->nullable();
        $table->integer('coefficient');
        $table->integer('seuil_reussite')->default(10);
        $table->timestamps();
    });
}
};
