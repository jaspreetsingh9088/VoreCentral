<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paidcontentdislike', function (Blueprint $table) {
            $table->id();

            // ALWAYS match foreign key type
            $table->unsignedBigInteger('paidcontent_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            // Foreign keys
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
