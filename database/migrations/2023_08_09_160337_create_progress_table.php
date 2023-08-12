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
		Schema::create('progress', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('usulan_id')->unsigned();
			$table->date('date');
			$table->string('activity');
			$table->string('documentation');
			$table->boolean('approval')->default(0);

			$table->foreign('usulan_id')->references('id')->on('usulan')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('progress');
	}
};
