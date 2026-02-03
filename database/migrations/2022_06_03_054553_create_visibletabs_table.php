<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visibletabs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable()->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tab_id')->nullable()->references('id')->on('tabs')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('visible');
            $table->boolean('add_row');
            $table->boolean('update_row');
            $table->boolean('delete_row');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visibletabs');
    }
};
