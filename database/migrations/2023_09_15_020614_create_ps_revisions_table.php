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
        Schema::create('ps_revisions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ps_id')->unsigned();
            $table->string('file_type');
            $table->string('file');

            $table->foreign('ps_id')->references('id')->on('ps')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ps_revisions');
    }
};
