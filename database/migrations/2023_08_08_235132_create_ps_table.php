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
		Schema::create('ps', function (Blueprint $table) {
			$table->id();
			$table->string('ps_name');
			$table->string('ps_sk_num');
			$table->date('ps_date');
			$table->double('area');
			$table->string('ps_chief');
			$table->integer('kk_total');
			$table->string('ps_contact')->nullable();
			$table->string('area_function');
			$table->string('sk_file')->nullable();
			$table->string('rku_file')->nullable();
			$table->string('rkt_file')->nullable();
			$table->string('shp_file')->nullable();
			$table->bigInteger('ps_type_id')->unsigned();
			$table->string('region_code');
			$table->string('address');

			$table->foreign('ps_type_id')->references('id')->on('types');
			$table->foreign('region_code')->references('kode')->on('region');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ps');
	}
};
