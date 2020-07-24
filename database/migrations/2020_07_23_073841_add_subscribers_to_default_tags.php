<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Tag;
use App\Subscriber;

class AddSubscribersToDefaultTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::table('subscriber_tag')->count() == 0) {
            $defaultSubTags = Tag::subscriberDefaults()->get();
            foreach (Subscriber::all() as $sub) {
                $sub->tags()->sync($defaultSubTags);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // no-op
    }
}
