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
    if (!Schema::hasTable('paidcontentcomments')) {
        return;
    }

    if (!Schema::hasColumn('paidcontentcomments', 'comment_parent_id')) {
        Schema::table('paidcontentcomments', function (Blueprint $table) {
            $table->integer('comment_parent_id')->default(0)->after('comment');
        });
    }
}

public function down()
{
    if (!Schema::hasTable('paidcontentcomments')) {
        return;
    }

    if (Schema::hasColumn('paidcontentcomments', 'comment_parent_id')) {
        Schema::table('paidcontentcomments', function (Blueprint $table) {
            $table->dropColumn('comment_parent_id');
        });
    }
}


};
