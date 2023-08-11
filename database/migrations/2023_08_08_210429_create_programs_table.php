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
		Schema::create('programs', function (Blueprint $table) {
			$table->id();
			$table->string('program');
			$table->integer('program_num');
			$table->date('start_date');
			$table->date('end_date');
			$table->date('kak_date');
			$table->string('kak_file')->nullable();
			$table->string('budget_allocation');
			$table->boolean('status')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('programs');
	}
};
