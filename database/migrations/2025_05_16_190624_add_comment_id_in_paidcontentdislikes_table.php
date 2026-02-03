<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    if (!Schema::hasTable('paidcontentdislikes')) {
        return;
    }

    if (!Schema::hasColumn('paidcontentdislikes', 'comment_id')) {
        Schema::table('paidcontentdislikes', function (Blueprint $table) {
            $table->integer('comment_id')->default(0)->after('paidcontentid');
        });
    }
}

public function down()
{
    if (!Schema::hasTable('paidcontentdislikes')) {
        return;
    }

    if (Schema::hasColumn('paidcontentdislikes', 'comment_id')) {
        Schema::table('paidcontentdislikes', function (Blueprint $table) {
            $table->dropColumn('comment_id');
        });
    }
}

};
