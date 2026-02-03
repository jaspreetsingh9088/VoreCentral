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
    if (!Schema::hasTable('gallerycomments')) {
        return;
    }

    if (!Schema::hasColumn('gallerycomments', 'comment_parent_id')) {
        Schema::table('gallerycomments', function (Blueprint $table) {
            $table->integer('comment_parent_id')->default(0);
        });
    }
}

public function down()
{
    if (!Schema::hasTable('gallerycomments')) {
        return;
    }

    if (Schema::hasColumn('gallerycomments', 'comment_parent_id')) {
        Schema::table('gallerycomments', function (Blueprint $table) {
            $table->dropColumn('comment_parent_id');
        });
    }
}


};
