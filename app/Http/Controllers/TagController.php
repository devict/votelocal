<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Validator;

class TagController extends Controller
{
    public function index()
    {
        return view('admin.tags.index', [
            'tags' => Tag::all(),
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/tags/new')
                ->withErrors($validator)
                ->withInput();
        }

        Tag::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'subscriber_default' => $request->input('subscriber_default'),
            'message_default' => $request->input('message_default'),
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/tags/'.$tag->id)
                ->withErrors($validator)
                ->withInput();
        }

        $tag->name = $request->input('name');
        $tag->category = $request->input('category');
        $tag->subscriber_default = $request->input('subscriber_default');
        $tag->message_default = $request->input('message_default');

        return redirect('/admin/tags')
            ->with('status', 'Tag updated.');
    }
}
