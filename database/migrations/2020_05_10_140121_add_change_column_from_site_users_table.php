<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeColumnFromSiteUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_users', function (Blueprint $table) {
            $table->renameColumn('father_name', 'fatherName');
            $table->renameColumn('phonenumber', 'phoneNumber');
            $table->string('address')->nullable()->default(null)->after('phoneNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_users', function (Blueprint $table) {
            $table->renameColumn('fatherName', 'father_name');
            $table->renameColumn('phoneNumber', 'phonenumber');
            $table->removeColumn('address');
        });
    }
}
