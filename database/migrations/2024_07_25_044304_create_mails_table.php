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
        // Schema::create('mails', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('reply_id');
        //     $table->text('subject');
        //     $table->text('content');
        //     $table->json('mail_cc')->nullable();
        //     $table->json('mail_bcc')->nullable();
        //     $table->unsignedBigInteger('mailable_id');
        //     $table->string('mailable_type');
        //     $table->unsignedBigInteger('user_id')->nullable();
        //     $table->unsignedBigInteger('candidate_id');
        //     $table->unsignedBigInteger('service_id')->nullable();
        //     $table->dateTime('send_at')->nullable();
        //     $table->string('status')->default('sent');
        //     $table->string('receiver')->nullable();

        //     $table->timestamps();

        //     $table->foreign('reply_id')
        //         ->references('id')
        //         ->on('mails')
        //         ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('mails');
    }
};
