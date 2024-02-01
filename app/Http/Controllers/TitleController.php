<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Skill;
use App\Models\Teacher;
use App\Models\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    public $page = "title";
    private $exept = ['_token', 'name1', 'name2', 'nim1', 'nim2'];
    public function index()
    {
        $page = $this->page;
        $data = Title::with('department', 'pem_i', 'pem_ii', 'pen_i', 'pen_ii')->get();
        return view("admin.title.index", compact(['data', 'page']));
    }

    public function create()
    {
        $page = $this->page;
        $teacher = Teacher::all();
        $dataSkill = Skill::all();
        $department = Department::all();
        return view("admin.title.create", compact(['page', 'teacher', 'dataSkill', 'department']));
    }

    public function save(Request $r)
    {
        // dd($r);
        $data = $r->all();
        $data['mahasiswa_i'] = $data['name1'] . "|" . $data['nim1'];
        $data['mahasiswa_ii'] = (is_null($data['name2'])) ? null : $data['name1'] . "|" . $data['nim1'];
        $skill = [];
        foreach ($data as $key => $value) {
            if (strpos($key, 'keahlian') === 0) {
                array_push($skill, $data['keahlian' . substr($key, 8)]);
            }
        }
        foreach ($data as $key => $value) {
            if (strpos($key, 'keahlian') === 0) {
                unset($data[$key]);
            }
        }
        $data['skill'] = json_encode($skill);

        $data = array_diff_key($data, array_flip($this->exept));
        // unset($data)
        // dd($data);
        Title::create($data);
        return redirect(to: "/title");
    }

    public function update($id)
    {
        $page = $this->page;
        $data = Title::find($id);
        $teacher = Teacher::all();
        $dataSkill = Skill::all();
        $department = Department::all();
        return view("admin.title.update", compact(['page', 'data', 'teacher', 'dataSkill', 'department']));
    }

    public function update_proposal($id)
    {
        $data = Title::find($id);
        $data->timestamps = false;
        $data->update(
            [
                'tanggal_proposal' => now()
            ]
        );
        $data->timestamps = true;
        return redirect(to: "/title");
    }
    public function update_skripsi($id)
    {
        $data = Title::find($id);
        $data->timestamps = false;
        $data->update(
            [
                'tanggal_skripsi' => now()
            ]
        );
        $data->timestamps = true;
        return redirect(to: "/title");
    }

    public function edit($id, Request $r)
    {
        $data = $r->all();
        $data['mahasiswa_i'] = $data['name1'] . "|" . $data['nim1'];
        $data['mahasiswa_ii'] = (is_null($data['name2'])) ? null : $data['name2'] . "|" . $data['nim2'];
        $skill = [];
        foreach ($data as $key => $value) {
            if (strpos($key, 'keahlian') === 0) {
                array_push($skill, $data['keahlian' . substr($key, 8)]);
            }
        }
        foreach ($data as $key => $value) {
            if (strpos($key, 'keahlian') === 0) {
                unset($data[$key]);
            }
        }
        $data['skill'] = json_encode($skill);

        $data = array_diff_key($data, array_flip($this->exept));
        Title::find($id)->update($data);
        return redirect(to: "/title");
    }

    public function delete($id)
    {
        $data = Title::find($id);
        $data->delete();
        return redirect(to: "/title");
    }
}