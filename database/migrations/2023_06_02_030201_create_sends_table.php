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
        Schema::create('sends', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('document_id');
            $table->foreignUuid('requester_id');
            $table->foreignUuid('recipient_id');
            $table->longText('subject')->nullable();
            $table->longText('content')->nullable();
            $table->json('cc_mails')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sends');
    }
};
