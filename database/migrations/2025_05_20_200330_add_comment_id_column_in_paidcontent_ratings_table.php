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
    if (!Schema::hasTable('paidcontent_ratings')) {
        return;
    }

    if (!Schema::hasColumn('paidcontent_ratings', 'comment_id')) {
        Schema::table('paidcontent_ratings', function (Blueprint $table) {
            $table->integer('comment_id')->default(0);
        });
    }
}

public function down()
{
    if (!Schema::hasTable('paidcontent_ratings')) {
        return;
    }

    if (Schema::hasColumn('paidcontent_ratings', 'comment_id')) {
        Schema::table('paidcontent_ratings', function (Blueprint $table) {
            $table->dropColumn('comment_id');
        });
    }
}

};
