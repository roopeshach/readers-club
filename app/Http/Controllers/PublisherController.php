<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index() {
        $publishers = Publisher::paginate(10);
        return view('publishers.index', compact('publishers'));
    }

    public function create() {
        return view('publishers.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'publisher_name' => 'required|unique:publishers',
            'publisher_location' => 'nullable|string',
        ]);

        Publisher::create($data);

        return redirect()->route('publishers.index')->with('success', 'Publisher added successfully.');
    }

    public function edit(Publisher $publisher) {
        return view('publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher) {
        $data = $request->validate([
            'publisher_name' => 'required|unique:publishers,publisher_name,' . $publisher->id,
            'publisher_location' => 'nullable|string',
        ]);

        $publisher->update($data);

        return redirect()->route('publishers.index')->with('success', 'Publisher updated successfully.');
    }

    public function destroy(Publisher $publisher) {
        $publisher->delete();

        return redirect()->route('publishers.index')->with('success', 'Publisher deleted successfully.');
    }
}
