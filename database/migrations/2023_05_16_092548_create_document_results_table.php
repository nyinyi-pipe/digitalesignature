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
        Schema::create('document_results', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('document_id');
            $table->foreignUuid('nonuser_id');
            $table->integer('x');
            $table->integer('y');
            $table->string('type');
            $table->longText('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_results');
    }
};
