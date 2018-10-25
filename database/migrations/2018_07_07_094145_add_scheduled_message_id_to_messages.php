<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddScheduledMessageIdToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function ($table) {
            $table->unsignedInteger('scheduled_message_id')->nullable();
            $table
                ->foreign('scheduled_message_id')
                ->references('id')
                ->on('scheduled_messages');
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
            $table->dropColumn('scheduled_message_id');
            if (config('database.default') !== 'sqlite') {
                $table->dropForeign(['scheduled_message_id']);
            }
        });
    }
}
