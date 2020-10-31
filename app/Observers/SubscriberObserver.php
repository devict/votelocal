<?php

namespace App\Observers;

use App\Subscriber;
use App\Tag;
use Illuminate\Support\Facades\App;

class SubscriberObserver
{
    /**
     * Handle the subscriber "creating" event.
     *
     * @return void
     */
    public function creating(Subscriber $subscriber)
    {
        $subscriber->locale = App::getLocale();
        $subscriber->referrer_id = Subscriber::newReferrerId();
    }

    /**
     * Handle the subscriber "created" event.
     *
     * @return void
     */
    public function created(Subscriber $subscriber)
    {
        $subscriber->tags()->sync(Tag::subscriberDefaults()->get());
    }

    /**
     * Handle the subscriber "updated" event.
     *
     * @return void
     */
    public function updated(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the subscriber "deleted" event.
     *
     * @return void
     */
    public function deleted(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the subscriber "restored" event.
     *
     * @return void
     */
    public function restored(Subscriber $subscriber)
    {
        //
    }

    /**
     * Handle the subscriber "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(Subscriber $subscriber)
    {
        //
    }
}
