<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('owner_type'); // USER / COMPANY / SAMPLE / TRADE
            $table->unsignedBigInteger('owner_id');
            $table->string('document_type');
            $table->string('file_path');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();

            $table->index(['owner_type', 'owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polymorphic_documents');
    }
};
