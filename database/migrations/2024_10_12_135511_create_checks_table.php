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
        Schema::create('checks', static function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('name');
            $table->string('path');
            $table->string('method')->default('GET');

            $table->json('headers')->nullable();
            $table->json('parameters')->nullable();

            $table->text('body')->nullable();

            $table->foreignUlid('credential_id')->nullable()->index()->constrained('credentials')->cascadeOnDelete();
            $table->foreignUlid('service_id')->index()->constrained('services')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checks');
    }
};
