<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('term_taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('taxonomy');
            $table->text('description')->nullable();
            $table->text('parent')->nullable();
            $table->timestamps();

            $table->foreignId('term_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('term_taxonomies');
    }
};
