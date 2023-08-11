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
		Schema::table('sk', function (Blueprint $table) {
			$table->date('tanggal_sk')->after('tahun_sk')->default(now());
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('sk', function (Blueprint $table) {
			$table->dropColumn('tanggal_sk');
		});
	}
};
