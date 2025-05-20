<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 255)->primary(); // session ID (varchar(255))
            $table->unsignedBigInteger('user_id')->nullable(); // user_id (bigint(20) UNSIGNED)
            $table->string('ip_address', 45); // ip_address (varchar(45))
            $table->text('user_agent'); // user_agent (text)
            $table->longText('payload'); // payload (longtext)
            $table->unsignedInteger('last_activity'); // last_activity (int(10) UNSIGNED)

            // Set up the foreign key constraint for user_id (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
}
