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
		Schema::create('usulan', function (Blueprint $table) {
			$table->id();
			$table->string('applicant_name');
			$table->string('proposal_sp_num');
			$table->date('proposal_date');
			$table->bigInteger('budget');
			$table->boolean('status')->nullable();
			$table->string('proposal')->nullable();
			$table->string('longitude')->nullable();
			$table->string('latitude')->nullable();
			$table->bigInteger('program_id')->unsigned();
			$table->bigInteger('kups_id')->unsigned();
			$table->bigInteger('user_id')->unsigned();

			$table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
			$table->foreign('kups_id')->references('id')->on('kups')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('usulan');
	}
};
