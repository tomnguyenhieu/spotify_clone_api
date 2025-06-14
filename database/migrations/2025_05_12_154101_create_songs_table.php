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
		Schema::create('songs', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description');
			$table->foreignId('author_id')->constrained('users', 'id');
			$table->foreignId('playlist_id')->constrained('playlists', 'id');
			$table->foreignId('category_id')->constrained('categories', 'id');
			$table->string('lyrics');
			$table->string('thumbnail');
			$table->bigInteger('total_played');
			$table->integer('status');
			$table->integer('price');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('songs');
	}
};
