<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->get();
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:10',
            'name'        => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'sort_order'  => 'integer',
        ]);

        Skill::create($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill added!');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:10',
            'name'        => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
            'sort_order'  => 'integer',
        ]);

        $skill->update($data);
        return redirect()->route('admin.skills.index')->with('success', 'Skill updated!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Skill deleted!');
    }
}
