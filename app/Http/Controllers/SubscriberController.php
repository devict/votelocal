<?php

namespace App\Http\Controllers;

use App\Message;
use App\Subscriber;
use App\Tag;
use Illuminate\Http\Request;
use App\Filters\MessageFilters;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('admin.subscribers.index', [
            'subscribers' => Subscriber::latest()->paginate(25),
        ]);
    }

    public function adminNew()
    {
        return view('admin.subscribers.new', [
            'subscriber' => new Subscriber(['subscribed' => true]),
        ]);
    }

    public function home()
    {
        $subscriber = Auth::guard('subscriber')->user();
        return view('subscriber.home', [
            'subscriber' => $subscriber,
            'locationTags' => Tag::locations(),
            'topicTags' => Tag::topics(),
        ]);
    }

    public function create(Request $request)
    {
        // Force the existence of the `subscribed` checkbox
        $request->merge(['subscribed' => $request->has('subscribed')]);
        Subscriber::create($request->validate([
            'number' => 'required|max:255|unique:subscribers',
            'subscribed' => 'boolean',
        ]));

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber created.');
    }

    public function edit(Subscriber $subscriber, MessageFilters $filters)
    {
        return view('admin.subscribers.edit', [
            'subscriber' => $subscriber,
            'messages' => $subscriber->messages()->filter($filters)->get(),
            'filters' => $filters,
            'types' => [
                '' => 'Incoming & Outgoing',
                Message::INCOMING => 'Outgoing', // Relative to subscriber
                Message::OUTGOING => 'Incoming', // Relative to subscriber
            ],
        ]);
    }

    public function update(Request $request, Subscriber $subscriber)
    {
        // Force the existence of the `subscribed` checkbox
        $request->merge(['subscribed' => $request->has('subscribed')]);
        $subscriber->update($request->validate([
            'number' => 'sometimes|required|max:255|unique:subscribers,number,'.$subscriber->id,
            'subscribed' => 'boolean',
        ]));

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber updated.');
    }

    public function updateTags(Request $request, Subscriber $subscriber)
    {
        $subscriber->tags()->sync($request->input('tags'));
        return response()->json($subscriber->tagIds());
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber deleted.');
    }
}
