<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\ScheduledMessage;
use App\Message;
use App\Subscriber;

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
    public function handle()
    {
        $scheduled_messages = ScheduledMessage::where('sent', false)
            ->where('send_at', '<=', Carbon::now())
            ->get();

        if ($scheduled_messages->count()) {
            $subscribers = Subscriber::where('subscribed', true)->get();

            if ($subscribers->count()) {
                Log::info('Sending ' . $scheduled_messages->count() . ' scheduled messages to ' . $subscribers->count() . ' subscribers.');

                $twilio = App::make('twilio');

                foreach ($subscribers as $subscriber) {
                    foreach ($scheduled_messages as $message) {
                        // Send the message
                        $twilioMessage = $twilio->messages->create($subscriber->number, [
                            'from' => env('TWILIO_FROM_NUMBER'),
                            'body' => $message->body,
                        ]);

                        // Mark it as sent
                        $message->sent = true;
                        $message->save();

                        // Log it in the database
                        Message::create([
                            'subscriber_id' => $subscriber->id,
                            'from'          => env('TWILIO_FROM_NUMBER'),
                            'to'            => $subscriber->number,
                            'body'          => $message->body,
                            'incoming'      => false,
                            'twilio_sid'    => $twilioMessage->sid,
                        ]);
                    }
                }
            }
        }
    }
}
