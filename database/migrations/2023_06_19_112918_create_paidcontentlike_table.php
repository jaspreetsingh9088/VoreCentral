<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
         Schema::create('paidcontentlike', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('paidcontent_id');
    $table->unsignedBigInteger('user_id');

    $table->timestamps();

    $table->foreign('paidcontent_id')
        ->references('id')->on('paidcontents')
        ->onDelete('cascade');

    $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
});

    }

    public function down()
    {
        Schema::dropIfExists('paidcontentdislike');
    }
};
