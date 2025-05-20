<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rides_rental_dbs', function (Blueprint $table) {
            $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
        });
    }

    public function down()
    {
        Schema::table('rides_rental_dbs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}; 