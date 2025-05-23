<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('blocked', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users', 'id');
			$table->unsignedBigInteger('song_id')->nullable();
			$table->foreign('song_id')->references('id')->on('songs');
			$table->unsignedBigInteger('artist_id')->nullable();
			$table->foreign('artist_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('blocked');
	}
};
