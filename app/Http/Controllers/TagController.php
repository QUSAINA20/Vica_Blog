<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {


        return view('tags.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',

        ]);

        Tag::create($validatedData);

        return redirect()->route('tags.index')->with('success', 'tag created successfully!');
    }

    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $tag->update([
            'title' => $request->input('title'),

        ]);

        return redirect()->route('tags.index')->with('success', 'tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {

        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'tag deleted successfully!');
    }
}
