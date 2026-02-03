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

    if (!Schema::hasColumn('paidcontentcomments', 'type')) {
        Schema::table('paidcontentcomments', function (Blueprint $table) {
            $table->string('type')->nullable()->after('comment_parent_id');
        });
    }
}

public function down()
{
    if (!Schema::hasTable('paidcontentcomments')) {
        return;
    }

    if (Schema::hasColumn('paidcontentcomments', 'type')) {
        Schema::table('paidcontentcomments', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}

};
