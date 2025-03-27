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
        Schema::table('attributes', function (Blueprint $table) {
            $table->renameColumn('name', 'key');
            $table->string('vi_translation')->after('key');
            $table->string('description', 500)->nullable()->after('vi_translation');
            $table->unsignedBigInteger('group_id')->nullable()->after('description');
            $table->string('product_type')->after('group_id');
            $table->unique(['key', 'product_type']);
            $table->unique(['vi_translation', 'product_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->renameColumn('key', 'name');
            $table->dropColumn('vi_translation');
            $table->dropColumn('description');
            $table->dropColumn('group_id');
            $table->dropColumn('product_type');
            $table->dropUnique(['key', 'product_type']);
            $table->dropUnique(['vi_translation', 'product_type']);
        });
    }
};
