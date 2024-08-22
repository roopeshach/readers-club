<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        // Fetch all publishers
        $publishers = Publisher::paginate(10);
        return view('publishers.index', compact('publishers'));
    }

    public function create()
    {
        // Only admins can create publishers
        $this->authorize('create', Publisher::class);
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        
        $publisher = new Publisher($request->all());
        $publisher->save();
        

        return redirect()->route('publishers.index')->with('success', 'Publisher created successfully.');
    }

    public function edit(Publisher $publisher)
    {
        // Only admins can edit publishers
        $this->authorize('update', $publisher);
        return view('publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        // Remove _token and _method from the data
        $data = $request->except(['_token', '_method']);

        // Update the publisher with the validated data
        $publisher->update($data);

        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher)
    {
        // Only admins can delete publishers
        $this->authorize('delete', $publisher);

        // Delete the publisher
        $publisher->delete();
        return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
