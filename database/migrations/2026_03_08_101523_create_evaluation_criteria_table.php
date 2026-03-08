<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('evaluation_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('criterion');
            $table->integer('weight');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('evaluation_criteria');
    }
};