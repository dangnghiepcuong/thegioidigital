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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('role_id')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
            $table->dropColumn('phone_number');
            $table->dropColumn('role_id');
        });
    }
};
