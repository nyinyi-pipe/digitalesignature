<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            // $table->json('nonuser_id')->nullable();
            $table->longText('doc_name');
            $table->json('doc_docs');
            $table->string('folder');
            $table->string('doc_type');
            $table->string('doc_key')->nullable();
            $table->integer('doc_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
