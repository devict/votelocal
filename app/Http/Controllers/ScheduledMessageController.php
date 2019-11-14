<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\ScheduledMessage;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
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
        $scheduled_message->send_at = Carbon::now()->add(CarbonInterval::hours(1));

        return view('admin.scheduled_messages.new', [
            'scheduled_message' => $scheduled_message,
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body_en' => 'required|max:260',
            'body_es' => 'required|max:260',
            'send_at' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/scheduled_messages/new')
                ->withErrors($validator)
                ->withInput();
        }

        ScheduledMessage::create([
            'body_en' => $request->input('body_en'),
            'body_es' => $request->input('body_es'),
            'send_at' => new Carbon($request->input('send_at')),
        ]);

        return redirect('/admin/scheduled_messages')
            ->with('status', 'Message scheduled.');
    }

    public function edit(ScheduledMessage $scheduled_message, Request $request)
    {
        return view('admin.scheduled_messages.edit', [
            'scheduled_message' => $scheduled_message,
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
            'send_at' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/scheduled_messages/'.$scheduled_message->id)
                ->withErrors($validator);
        }

        $scheduled_message->body_en = $request->input('body_en');
        $scheduled_message->body_es = $request->input('body_es');
        $scheduled_message->send_at = new Carbon($request->input('send_at'));
        $scheduled_message->save();

        return redirect('/admin/scheduled_messages')
            ->with('status', 'Message updated.');
    }

    public function destroy(ScheduledMessage $scheduled_message, Request $request)
    {
        if ($scheduled_message->sent) {
            $errors = new MessageBag();
            $errors->add('cant_change_sent_message', 'Cannot change already sent message');

            return redirect('/admin/scheduled_messages')->withErrors($errors);
        }

        $scheduled_message->delete();
        session('status', 'Message deleted.');

        return redirect('/admin/scheduled_messages')
            ->with('status', 'Message deleted.');
    }
}
