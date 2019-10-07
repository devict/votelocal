<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class AddLocalesToScheduledMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scheduled_messages', function ($table) {
            $table->text('body_es')->nullable()->after('body');
            $table->renameColumn('body', 'body_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheduled_messages', function ($table) {
            $table->dropColumn('body_es');
            $table->renameColumn('body_en', 'body');
        });
    }
}
