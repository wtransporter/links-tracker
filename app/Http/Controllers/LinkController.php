<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return inertia('Links', [
            'links' => auth()->user()->links->load('user')
        ]);
    }

    public function store(Request $request)
    {
        Link::create($request->only(['title', 'url', 'description'])+['user_id' => auth()->id()]);

        return redirect()->back()
                ->with('message', 'Link Created Successfully.');
    }

    public function update(Link $link, Request $request)
    {
        $link->update($request->only(['title', 'url']));

        return redirect()->back()
                ->with('message', 'Link Updated Successfully.');
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return redirect()->back()
                ->with('message', 'Link Deleted Successfully.');
    }
}
