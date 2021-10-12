<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

use App\Models\SkillCategory;

class SkillsController extends Controller
{
    private $skillsModel;
    private $skillsCategoryModel;
    public function __construct(Skill $skill , SkillCategory $skillCategory)
    {
         $this->skillsModel = $skill;
         $this->skillsCategoryModel = $skillCategory;
    }

    public function index()
    {
        $skills = $this->skillsModel::with('category')->get();
        $categories = $this->skillsCategoryModel::get();
        return view('aPanel.skills.skillList', compact(['skills', 'categories']));
    }

    public function create()
    {

        $categories = $this->skillsCategoryModel::get();
        return view('apanel.skills.addSkill' , compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'number' => 'required|min:1',
            'skillCategoryId' => 'required|exists:skill_categories,id'
        ]);
        
        $this->skillsModel::create([
            'name' => $request->name,
            'number' => $request->number,
            'skillCategoryId' => $request->skillCategoryId,
        ]);

        session()->flash('done', 'Skill Was Added');
        return redirect(route('admin.skills'));
    }

    public function delete($skillId)
    {
        $skill = $this->skillsModel::find($skillId);
        if ($skill) {
            $skill->delete();
            session()->flash('done' , 'skill was deleted');
            return redirect(route('admin.skills'));
        }
        return redirect(route('admin.404'));
    }



}
