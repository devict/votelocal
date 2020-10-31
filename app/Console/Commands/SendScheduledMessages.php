<?php

namespace App\Console\Commands;

use App\ScheduledMessage;
use App\Services\Sms\Contracts\Sms;
use App\Subscriber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Twitter;

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
        $subscribers = Subscriber::where('subscribed', true)->get();

        if ($scheduled_messages->isNotEmpty()) {
            foreach ($scheduled_messages as $message) {
                // Mark it as sent first to ensure no duplicate messages.
                $message->sent = true;
                $message->save();

                if ($message->target_sms) {
                    $locationTags = $message->locationTags()->get();
                    $topicTags = $message->topicTags()->get();

                    // Filter subscribers that have at least one of each matching.
                    $filteredSubscribers = $subscribers->filter(function ($sub) use ($locationTags, $topicTags) {
                        $locationTagMatches = $sub->locationTags->intersect($locationTags);
                        $topicTagMatches = $sub->topicTags->intersect($topicTags);

                        return $locationTagMatches->isNotEmpty() && $topicTagMatches->isNotEmpty();
                    });

                    // Send to filtered subscribers.
                    if ($filteredSubscribers->count()) {
                        Log::info('Sending message '.$message->id.' to '.$filteredSubscribers->count().' subscribers.');

                        foreach ($filteredSubscribers as $subscriber) {
                            $body = $message->body_en;
                            switch ($subscriber->locale) {
                            case 'es':
                                if ($message->body_es && $message->body_es != '') {
                                    $body = $message->body_es;
                                }
                                break;
                            }
                            try {
                                $sms->send(
                                    $subscriber->number,
                                    $body,
                                    ['scheduled_message_id' => $message->id]
                                );
                            } catch (\Exception $e) {
                                Log::info('Failed to send message '.$message->id.' to '.$subscriber->number.' ('.$subscriber->id.')');
                            }
                        }
                    }
                }

                if ($message->target_twitter) {
                    try {
                        Twitter::postTweet(['status' => $message->body_en, 'format' => 'json']);
                    } catch (\Exception $e) {
                        Log::info('Failed to send message to Twitter. Is the account configured correctly?');
                    }
                }
            }
        }

        return 0;
    }
}
