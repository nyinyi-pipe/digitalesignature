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
        Schema::create('document_nonuser', function (Blueprint $table) {
            $table->primary(['document_id','nonuser_id']);
            $table->foreignUuid('document_id');
            $table->foreignUuid('nonuser_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_nonuser');
    }
};
