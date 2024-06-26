<?php

namespace App\Http\Controllers;

use App\Helpers\NaiveBayes;
use App\Models\Department;
use App\Models\History;
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
        
        $datadosen = Teacher::all();
        $data = History::with('department', 'pem_i', 'pem_ii', 'pen_i', 'pen_ii')->get();
        return view("admin.title.index", compact(['data', 'page', 'datadosen']));
    }

    public function data()
    {
        $page = $this->page;
        $data = Title::with('department', 'pem_i', 'pem_ii', 'pen_i', 'pen_ii')->get();
        return view("admin.title.data", compact(['data', 'page']));
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
        session()->flash('alert', ['success', 'Berhasil menambahkan data judul skripsi']);
        return redirect(to: "/title");
    }

    public function update($id)
    {
        $page = $this->page;
        $data = History::find($id);
        $teacher = Teacher::all();
        $dataSkill = Skill::all();
        $department = Department::all();
        return view("admin.title.update", compact(['page', 'data', 'teacher', 'dataSkill', 'department']));
    }

    public function set_penguji_otomatis($id)
    {
        // $page = $this->page;
        $data = History::find($id);
        $dataskill = $data->skill;
        $posterior = NaiveBayes::NAIVE($dataskill);

        $pembimbing = [$data->pem_i->id, $data->pem_ii->id];
        $dosen_penguji['q1'] = array_keys($posterior['q1']);
        $dosen_penguji['q2'] = array_keys($posterior['q2']);
        $penguji = array();

        for ($i = 0; $i < count($dosen_penguji['q1']); $i++) {
            $curent = $dosen_penguji['q1'][$i];
            if (!in_array($curent, $pembimbing)) {
                array_push($penguji, $dosen_penguji['q1'][$i]);
                break;
            }
        }
        for ($i = 0; $i < count($dosen_penguji['q2']); $i++) {
            $curent = $dosen_penguji['q2'][$i];
            if (!in_array($curent, $pembimbing) && !in_array($curent, $penguji)) {
                array_push($penguji, $curent);
                break;
            }
        }
        $gelar[0] = Teacher::find($penguji[0])->position_id;
        $gelar[1] = Teacher::find($penguji[1])->position_id;

        if ($gelar[1] < $gelar[0]) {
            $temp = $penguji[1];
            $penguji[1] = $penguji[0];
            $penguji[0] = $temp;
        }

        $data->update([
            'penguji_i' => $penguji[0],
            'penguji_ii' => $penguji[1]
        ]);


        // return "Penguji otomatis" . $id;
        return redirect(to: "/title");
    }
    public function set_penguji_manual(Request $request, $id)
    {
        $data = History::find($id);
        $r = $request->all();

        
        $penguji = [$r['pen1'], $r['pen2']];

        $gelar[0] = Teacher::find($penguji[0])->position_id;
        $gelar[1] = Teacher::find($penguji[1])->position_id;

        if ($gelar[1] < $gelar[0]) {
            $temp = $penguji[1];
            $penguji[1] = $penguji[0];
            $penguji[0] = $temp;
        }
        // dd($penguji);
        $data->update([
            'penguji_i' => $penguji[0],
            'penguji_ii' => $penguji[1]
        ]);
        // return "Penguji manual";
        return redirect(to: "/title");

    }

    public function update_proposal($id)
    {
        $data = History::find($id);
        $data->timestamps = false;
        $data->update(
            [
                'tanggal_proposal' => now()
            ]
        );
        $data->timestamps = true;
        session()->flash('alert', ['success', 'Berhasil mengubah data tanggal proposal']);
        return redirect(to: "/title");
    }
    public function update_skripsi($id)
    {
        $data = History::find($id);
        $data->timestamps = false;
        $data->update(
            [
                'tanggal_skripsi' => now()
            ]
        );
        $data->timestamps = true;
        session()->flash('alert', ['success', 'Berhasil mengubah data tanggal skripsi']);
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
        History::find($id)->update($data);
        session()->flash('alert', ['success', 'Berhasil mengubah data judul skripsi']);
        return redirect(to: "/title");
    }

    public function delete($id)
    {
        $data = History::find($id);
        $data->delete();
        session()->flash('alert', ['success', 'Berhasil menghapus data judul skripsi']);
        return redirect(to: "/title");
    }
}
