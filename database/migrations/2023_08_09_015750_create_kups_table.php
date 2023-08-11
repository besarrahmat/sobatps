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
		Schema::create('kups', function (Blueprint $table) {
			$table->id();
			$table->string('kups_name');
			$table->string('kups_sk_num');
			$table->string('business_type');
			$table->string('comodity');
			$table->string('kups_chief');
			$table->string('kups_contact')->nullable();
			$table->bigInteger('ps_id')->unsigned();

			$table->foreign('ps_id')->references('id')->on('ps')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('kups');
	}
};
