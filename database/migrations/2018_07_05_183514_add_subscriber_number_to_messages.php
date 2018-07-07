<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddSubscriberNumberToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function ($table) {
            $column = $table->string('subscriber_number')->after('twilio_sid');
            if (config('database.default') === 'sqlite') {
                $column->default('');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function ($table) {
            $table->dropColumn('subscriber_number');
        });
    }
}
