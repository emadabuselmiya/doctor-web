<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('email');
            $table->string('background')->nullable()->after('logo');
            $table->string('facebook')->nullable()->after('background');
            $table->string('instagram')->nullable()->after('facebook');
            $table->string('twitter')->nullable()->after('instagram');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('twitter');
            $table->dropColumn('logo');
            $table->dropColumn('background');

        });
    }
}
