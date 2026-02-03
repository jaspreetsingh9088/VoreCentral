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
        Schema::table('paidcontents', function (Blueprint $table) {
            $table->String("other_thumbnails")->nullable()->after("thumbnail");
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paidcontents', function (Blueprint $table) {
            $table->dropColumn("other_thumbnails");
            //
        });
    }
};
