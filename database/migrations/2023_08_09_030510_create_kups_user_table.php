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
		Schema::create('kups_user', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('kups_id')->unsigned();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('kups_id')->references('id')->on('kups')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('kups_user');
	}
};
