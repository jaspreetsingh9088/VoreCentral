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
    // if the table doesn't exist, do nothing
    if (!Schema::hasTable('usercontents')) {
        return;
    }

    Schema::table('usercontents', function (Blueprint $table) {
        $table->text('original_video_url')->nullable()->after('video_url');
    });
}

};
