<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');
            $table->boolean('message_default')->default(false);
            $table->boolean('subscriber_default')->default(false);
            $table->timestamps();
        });

        Schema::create('scheduled_message_tag', function (Blueprint $table) {
            $table->unsignedInteger('scheduled_message_id');
            $table->foreign('scheduled_message_id')->references('id')->on('scheduled_messages')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('subscriber_tag', function (Blueprint $table) {
            $table->unsignedInteger('subscriber_id');
            $table->foreign('subscriber_id')->references('id')->on('subscribers')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scheduled_message_tag', function (Blueprint $table) {
            $table->dropForeign(['scheduled_message_tag_scheduled_message_id_foreign']);
            $table->dropForeign(['scheduled_message_tag_tag_id_foreign']);
        });
        Schema::dropIfExists('scheduled_message_tag');
        Schema::table('subscriber_tag', function (Blueprint $table) {
            $table->dropForeign(['subscriber_tag_subscriber_id_foreign']);
            $table->dropForeign(['subscriber_tag_tag_id_foreign']);
        });
        Schema::dropIfExists('subscriber_tag');
        Schema::dropIfExists('tags');
    }
}
