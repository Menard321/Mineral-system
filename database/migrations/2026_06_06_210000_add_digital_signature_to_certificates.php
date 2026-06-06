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
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('digital_signature', 512)->nullable()->after('qr_verification_code');
            $table->string('signing_authority')->nullable()->after('issued_by');
            $table->timestamp('signed_at')->nullable()->after('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn(['digital_signature', 'signing_authority', 'signed_at']);
        });
    }
};
