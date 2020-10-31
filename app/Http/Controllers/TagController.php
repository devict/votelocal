<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tags.index', [
            'locationTags' => Tag::locations()->get(),
            'topicTags' => Tag::topics()->get(),
        ]);
    }

    public function new()
    {
        return view('admin.tags.new', [
            'tag' => new Tag(),
            'categories' => Tag::categoryOptions(),
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        Tag::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'subscriber_default' => $request->input('subscriber_default') === 'on',
            'message_default' => $request->input('message_default') === 'on',
        ]);

        return redirect('/admin/tags')
            ->with('status', 'Tag created.');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', [
            'tag' => $tag,
            'categories' => Tag::categoryOptions(),
        ]);
    }

    public function update(Tag $tag, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
        ]);

        $tag->name = $request->input('name');
        $tag->category = $request->input('category');
        $tag->subscriber_default = $request->input('subscriber_default') === 'on';
        $tag->message_default = $request->input('message_default') === 'on';

        $tag->save();

        return redirect('/admin/tags')
            ->with('status', 'Tag updated.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect('/admin/tags')->with('status', 'Tag deleted.');
    }
}
