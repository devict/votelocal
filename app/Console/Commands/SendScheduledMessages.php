<?php

namespace App\Console\Commands;

use App\Subscriber;
use App\ScheduledMessage;
use Illuminate\Console\Command;
use App\Services\Sms\Contracts\Sms;
use Illuminate\Support\Facades\Log;

class SendScheduledMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-scheduled-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all messages scheduled for this time, should be run every minute.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Sms $sms)
    {
        $scheduled_messages = ScheduledMessage::readyToSend()->get();

        if ($scheduled_messages->count()) {
            $subscribers = Subscriber::where('subscribed', true)->get();

            if ($subscribers->count()) {
                Log::info('Sending ' . $scheduled_messages->count() . ' scheduled messages to ' . $subscribers->count() . ' subscribers.');

                foreach ($subscribers as $subscriber) {
                    foreach ($scheduled_messages as $message) {
                        $body = $message->body_en;
                        switch ($subscriber->locale) {
                        case 'es':
                            if ($message->body_es && $message->body_es != '') {
                                $body = $message->body_es;
                            }
                            break;
                        }
                        $sms->send(
                            $subscriber->number,
                            $body,
                            ['scheduled_message_id' => $message->id]
                        );

                        // Mark it as sent
                        $message->sent = true;
                        $message->save();
                    }
                }
            }
        }
    }
}
