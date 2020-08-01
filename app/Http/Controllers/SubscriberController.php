<?php

namespace App\Http\Controllers;

use App\Message;
use App\Subscriber;
use App\Tag;
use Illuminate\Http\Request;
use App\Filters\MessageFilters;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('admin.subscribers.index', [
            'subscribers' => Subscriber::latest()->paginate(25),
        ]);
    }

    public function new()
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
            'locationTags' => Tag::locations()->get(),
            'topicTags' => Tag::topics()->get(),
        ]);
    }

    public function create(Request $request)
    {
        // Force the existence of the `subscribed` checkbox
        $request->merge(['subscribed' => $request->has('subscribed')]);
        $locale = App::getLocale();

        $sub = Subscriber::create($request->validate([
            'number' => 'required|max:255|unique:subscribers',
            'subscribed' => 'boolean',
            'locale' => $locale,
        ]));

        $sub->tags()->sync(Tag::subscriberDefaults()->get());

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

    public function updateTags(Request $request)
    {
        $subscriber = Auth::guard('subscriber')->user();
        $subscriber->tags()->sync($request->input('tags'));
        return response()->json($subscriber->tagIds());
    }

    public function enable()
    {
        $subscriber = Auth::guard('subscriber')->user();
        $subscriber->subscribed = true;
        $subscriber->save();
        return redirect()->route('subscriber.home');
    }

    public function disable()
    {
        $subscriber = Auth::guard('subscriber')->user();
        $subscriber->subscribed = false;
        $subscriber->save();
        return redirect()->route('subscriber.home');
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();

        return redirect()
            ->route('subscribers.admin.index')
            ->with('status', 'Subscriber deleted.');
    }

    public function pledge(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'hide_from_pledge_board' => 'boolean',
        ]);

        $subscriber = Auth::guard('subscriber')->user();

        $subscriber->name = $request->input('name');
        $subscriber->pledged = true;
        $subscriber->hide_from_pledge_board =
            $request->input('hide_from_pledge_board') ? false : true;

        $subscriber->save();

        return redirect()->route('subscriber.home')->with('status', 'Thanks for your pledge!');
    }
}
