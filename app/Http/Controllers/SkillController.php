<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public $page = "skill";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        $data = Skill::all();
        return view("admin.skill.index", compact(['data', 'page']));
    }

    public function create()
    {
        $page = $this->page;
        return view("admin.skill.create", compact(['page']));
    }

    public function save(Request $r)
    {
        Skill::create($r->except($this->exept));
        return redirect(to: "/skill");
    }

    public function update($id)
    {
        $page = $this->page;
        $data = Skill::find($id);
        return view("admin.skill.update", compact(['page', 'data']));
    }

    public function edit($id, Request $r)
    {
        $data = Skill::find($id);
        $data->update($r->except($this->exept));
        return redirect(to: "/skill");
    }

    public function delete($id)
    {
        $data = Skill::find($id);
        $data->delete();
        return redirect(to: "/skill");
    }
}
