<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Skill;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public $page = "teacher";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        $data = Teacher::with('position')->get();
        // dd($data);
        return view("admin.teacher.index", compact(['data', 'page']));
    }

    public function create()
    {
        $page = $this->page;
        $data = Position::all(['id', 'position_name']);
        $dataSkill = Skill::all();
        return view("admin.teacher.create", compact(['page', 'data', 'dataSkill']));
    }

    public function save(Request $r)
    {
        $data = $r->all();
        // dd($data);
        $title = [];
        $skill = [];

        $data['pembimbing'] = false;
        $data['penguji'] = false;

        foreach ($data as $key => $value) {
            if (strpos($key, 'pembimbing') === 0) {
                $data['pembimbing'] = true;
            }
            if (strpos($key, 'penguji') === 0) {
                $data['penguji'] = true;
            }
        }

        foreach ($data as $key => $value) {
            if (strpos($key, 'tingkat') === 0 && isset($data['skill' . substr($key, 7)])) {
                if (isset($title[$value])) {
                    $temp = $title[$value];
                    $title[$value] = [$data['skill' . substr($key, 7)]];
                    array_unshift($title[$value], $temp);
                } else {
                    $title[$value] = $data['skill' . substr($key, 7)];
                }
            }
            if (strpos($key, 'keahlian') === 0) {
                array_push($skill, $data['keahlian' . substr($key, 8)]);
            }
        }


        foreach ($data as $key => $value) {
            if (strpos($key, 'tingkat') === 0 || strpos($key, 'skill') === 0) {
                unset($data[$key]);
            }
            if (strpos($key, 'keahlian') === 0) {
                unset($data[$key]);
            }
            if (strpos($key, '_token') === 0) {
                unset($data[$key]);
            }
        }

        $data['title'] = json_encode($title);
        $data['skills'] = json_encode($skill);

        // dd($data);

        Teacher::create($data);
        session()->flash('alert', ['success', 'Berhasil menambahkan Dosen']);
        return redirect(to: "/teacher");
    }

    public function update($id)
    {
        $page = $this->page;
        $data = Teacher::find($id);
        $dataPosition = Position::all(['id', 'position_name']);
        $dataSkill = Skill::all();
        return view("admin.teacher.update", compact(['page', 'data', 'dataSkill', 'dataPosition']));
    }

    public function edit($id, Request $r)
    {
        $teacher = Teacher::find($id);
        $teacher->update($r->except($this->exept));
        session()->flash('alert', ['success', 'Berhasil mengubah data Dosen']);
        return redirect(to: "/teacher");
    }

    public function delete($id)
    {
        $teacher = Teacher::find($id);
        $teacher->delete();
        session()->flash('alert', ['success', 'Berhasil menghapus data Dosen']);
        return redirect(to: "/teacher");
    }


}
