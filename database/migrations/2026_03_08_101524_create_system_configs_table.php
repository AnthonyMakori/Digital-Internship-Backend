<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('system_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('max_intern_duration')->default(6);
            $table->integer('max_applications_per_student')->default(5);
            $table->integer('logbook_reminder_days')->default(3);
            $table->integer('auto_close_vacancy_days')->default(30);
            $table->boolean('require_cover_letter')->default(true);
            $table->boolean('require_cv')->default(true);
            $table->boolean('allow_multiple_attachments')->default(false);
            $table->boolean('enable_email_notifications')->default(true);
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('system_configs');
    }
};