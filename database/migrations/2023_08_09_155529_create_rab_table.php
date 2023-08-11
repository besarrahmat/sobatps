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
		Schema::create('rab', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('usulan_id')->unsigned();
			$table->string('goods');
			$table->integer('amount')->unsigned();
			$table->string('unit')->nullable();
			$table->bigInteger('price')->unsigned();
			$table->bigInteger('total')->unsigned();

			$table->foreign('usulan_id')->references('id')->on('usulan')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('rab');
	}
};
