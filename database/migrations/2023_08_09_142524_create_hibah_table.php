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
		Schema::create('hibah', function (Blueprint $table) {
			$table->id();
			$table->string('edited_name');
			$table->string('deleted_kups');
			$table->date('tanggal_sk');
			$table->string('file_sk');
			$table->boolean('approval')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('hibah');
	}
};
