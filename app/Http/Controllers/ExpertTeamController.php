<?php

namespace App\Http\Controllers;

use App\Models\ExpertTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertTeamController extends Controller
{
    /**
     * Display a listing of the expert team members.
     */
    public function index()
    {
        $experts = ExpertTeam::all();
        return view('expert-team.index', compact('experts'));
    }

    /**
     * Show the form for creating a new expert team member.
     */
    public function create()
    {
        return view('expert-team.create');
    }

    /**
     * Store a newly created expert team member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('expert-team', 'public');
            $data['image'] = $imagePath;
        }

        ExpertTeam::create($data);

        return redirect()->route('expert-team.index')
            ->with('success', 'Expert team member created successfully.');
    }

    /**
     * Display the specified expert team member.
     */
    public function show(ExpertTeam $expertTeam)
    {
        return view('expert-team.show', compact('expertTeam'));
    }

    /**
     * Show the form for editing the specified expert team member.
     */
    public function edit(ExpertTeam $expertTeam)
    {
        return view('expert-team.edit', compact('expertTeam'));
    }

    /**
     * Update the specified expert team member in storage.
     */
    public function update(Request $request, ExpertTeam $expertTeam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($expertTeam->image) {
                Storage::disk('public')->delete($expertTeam->image);
            }
            
            $imagePath = $request->file('image')->store('expert-team', 'public');
            $data['image'] = $imagePath;
        }

        $expertTeam->update($data);

        return redirect()->route('expert-team.index')
            ->with('success', 'Expert team member updated successfully.');
    }

    /**
     * Remove the specified expert team member from storage.
     */
    public function destroy(ExpertTeam $expertTeam)
    {
        // Delete image if exists
        if ($expertTeam->image) {
            Storage::disk('public')->delete($expertTeam->image);
        }
        
        $expertTeam->delete();

        return redirect()->route('expert-team.index')
            ->with('success', 'Expert team member deleted successfully.');
    }
} 