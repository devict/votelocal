<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPledgeColumnsToSubscribers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->boolean('pledged')->default(false);
            $table->string('referrer_id');
            $table->string('referred_by')->nullable();
            $table->boolean('hide_from_pledge_board')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('pledged');
            $table->dropColumn('referrer_id');
            $table->dropColumn('referred_by');
            $table->dropColumn('hide_from_pledge_board');
        });
    }
}
