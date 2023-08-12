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
		Schema::create('additionals', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('usulan_id')->unsigned();
			$table->bigInteger('file_type')->unsigned();
			$table->string('file')->nullable();
			$table->date('tanggal')->nullable();
			$table->string('deskripsi')->nullable();
			$table->boolean('approval')->nullable();
			$table->string('note')->nullable();

			$table->foreign('usulan_id')->references('id')->on('usulan')->onDelete('cascade');
			$table->foreign('file_type')->references('id')->on('master_additionals')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('additionals');
	}
};
