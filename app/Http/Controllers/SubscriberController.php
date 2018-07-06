<?php

namespace App\Http\Controllers;

use App\Message;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Filters\MessageFilters;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('admin.subscribers.index', [
            'subscribers' => Subscriber::orderBy('updated_at', 'desc')->get()
        ]);
    }

    public function new()
    {
        return view('admin.subscribers.new', [
            'subscriber' => new Subscriber(),
        ]);
    }

    public function messages(Subscriber $subscriber, MessageFilters $filters)
    {
        return view('admin.subscribers.messages', [
            'subscriber' => $subscriber,
            'messages'   => $subscriber->messages()->filter($filters)->get(),
            'filters'    => $filters,
            'types'      => [
                ''                => 'Any',
                Message::INCOMING => 'Incoming',
                Message::OUTGOING => 'Outgoing'
            ],
        ]);
    }

    public function create(Request $request)
    {
        // Force the existence of the `subscribed` checkbox
        $request->merge(['subscribed' => $request->has('subscribed')]);
        Subscriber::create($request->validate([
            'number'     => 'required|max:255|unique:subscribers',
            'subscribed' => 'boolean',
        ]));

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber created.');
    }

    public function edit(Subscriber $subscriber)
    {
        return view('admin.subscribers.edit', compact('subscriber'));
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        // Force the existence of the `subscribed` checkbox
        $request->merge(['subscribed' => $request->has('subscribed')]);
        $subscriber->update($request->validate([
            'number'     => 'required|max:255|unique:subscribers,number,' . $subscriber->id,
            'subscribed' => 'boolean',
        ]));

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber updated.');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber deleted.');
    }
}
