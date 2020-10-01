<?php

namespace App\Observers;

use Illuminate\Support\Facades\App;
use App\ScheduledMessage;

class ScheduledMessageObserver
{
    /**
     * Handle the scheduledMessage "creating" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function creating(ScheduledMessage $scheduledMessage)
    {
        //
    }

    /**
     * Handle the scheduledMessage "created" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function created(ScheduledMessage $scheduledMessage)
    {
        ScheduledMessage::withoutEvents(function () use ($scheduledMessage) {
            $scheduledMessage->sanitizeBody();
        });
    }
    /**
     * Handle the scheduledMessage "updated" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function updated(ScheduledMessage $scheduledMessage)
    {
        ScheduledMessage::withoutEvents(function () use ($scheduledMessage) {
            $scheduledMessage->sanitizeBody();
        });
    }

    /**
     * Handle the scheduledMessage "deleted" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function deleted(ScheduledMessage $scheduledMessage)
    {
        //
    }

    /**
     * Handle the scheduledMessage "restored" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function restored(ScheduledMessage $scheduledMessage)
    {
        //
    }

    /**
     * Handle the scheduledMessage "force deleted" event.
     *
     * @param  \App\ScheduledMessage  $scheduledMessage
     * @return void
     */
    public function forceDeleted(ScheduledMessage $scheduledMessage)
    {
        //
    }
}
