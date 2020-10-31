<?php

namespace App\Http\Controllers;

use App\ScheduledMessage;
use App\Tag;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ScheduledMessageController extends Controller
{
    public function index()
    {
        return view('admin.scheduled_messages.index', [
            'scheduled_messages' => ScheduledMessage::latest()->paginate(25),
        ]);
    }

    public function new()
    {
        $scheduled_message = new ScheduledMessage();
        $scheduled_message->target_sms = true;
        $scheduled_message->target_twitter = true;
        $scheduled_message->send_at = Carbon::now()->add(CarbonInterval::hours(1));

        return view('admin.scheduled_messages.new', [
            'scheduled_message' => $scheduled_message,
            'locationTags' => Tag::locations()->get(),
            'topicTags' => Tag::topics()->get(),
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body_en' => 'required|max:260',
            'body_es' => 'required|max:260',
            'target_sms' => 'required_without:target_twitter',
            'target_twitter' => 'required_without:target_sms',
            'send_at' => 'required|date|after:now',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (! Tag::validateRequiredTags($request->input('tags'))) {
                $validator->errors()->add('tags[]', 'Must select one of each tag type.');
            }
        });

        if ($validator->fails()) {
            return redirect('/admin/scheduled_messages/new')
                ->withErrors($validator)
                ->withInput();
        }

        $message = ScheduledMessage::create([
            'body_en' => $request->input('body_en'),
            'body_es' => $request->input('body_es'),
            'target_sms' => $request->input('target_sms'),
            'target_twitter' => $request->input('target_twitter'),
            'send_at' => new Carbon($request->input('send_at')),
        ]);

        $message->tags()->attach($request->input('tags'));

        return redirect('/admin/scheduled_messages')
            ->with('status', 'Message scheduled.');
    }

    public function edit(ScheduledMessage $scheduled_message)
    {
        return view('admin.scheduled_messages.edit', [
            'scheduled_message' => $scheduled_message,
            'locationTags' => Tag::locations()->get(),
            'topicTags' => Tag::topics()->get(),
        ]);
    }

    public function update(ScheduledMessage $scheduled_message, Request $request)
    {
        if ($scheduled_message->sent) {
            $errors = new MessageBag();
            $errors->add('cant_change_sent_message', 'Cannot change already sent message');

            return redirect('/admin/scheduled_messages')->withErrors($errors);
        }

        $validator = Validator::make($request->all(), [
            'body_en' => 'required|max:260',
            'body_es' => 'required|max:260',
            'target_sms' => 'required_without:target_twitter',
            'target_twitter' => 'required_without:target_sms',
            'send_at' => 'required|date|after:now',
            'tags' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (! Tag::validateRequiredTags($request->input('tags'))) {
                $validator->errors()->add('tags[]', 'Must select one of each tag type.');
            }
        });

        if ($validator->fails()) {
            return redirect('/admin/scheduled_messages/'.$scheduled_message->id)
                ->withErrors($validator);
        }

        $scheduled_message->body_en = $request->input('body_en');
        $scheduled_message->body_es = $request->input('body_es');
        $scheduled_message->target_sms = $request->input('target_sms');
        $scheduled_message->target_twitter = $request->input('target_twitter');
        $scheduled_message->send_at = new Carbon($request->input('send_at'));
        $scheduled_message->tags()->sync($request->input('tags'));
        $scheduled_message->save();

        return redirect('/admin/scheduled_messages')
            ->with('status', 'Message updated.');
    }

    public function destroy(ScheduledMessage $scheduled_message)
    {
        if ($scheduled_message->sent) {
            $errors = new MessageBag();
            $errors->add('cant_change_sent_message', 'Cannot change already sent message');

            return redirect('/admin/scheduled_messages')->withErrors($errors);
        }

        $scheduled_message->delete();

        return redirect('/admin/scheduled_messages')->with('status', 'Message deleted.');
    }
}
