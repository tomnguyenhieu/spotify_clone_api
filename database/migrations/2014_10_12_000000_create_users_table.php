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
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('email')->unique();
			$table->string('gender')->nullable();
			$table->date('birth')->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->string('avatar');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('users');
	}
};
