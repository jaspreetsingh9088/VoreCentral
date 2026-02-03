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
        Schema::table('admins', function (Blueprint $table) {
            $table->boolean('status')->after('password')->default(true);
            $table->foreignId('admin_id')->nullable()->after('status')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('role_id')->nullable()->after('status')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->dropForeign(['admin_id']);
            $table->dropColumn('admin_id');
            $table->dropColumn('status');
        });
    }
};
