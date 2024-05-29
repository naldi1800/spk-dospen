<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\History;
use App\Models\History_Temp;
use App\Models\Skill;
use App\Models\Teacher;
use App\Models\Title;
use App\Helpers\NaiveBayes;
use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public $page = "prediction";
    private $exept = ['_token', 'name1', 'name2', 'nim1', 'nim2'];
    public function index()
    {
        $page = $this->page;
        $data = Title::all();
        $dataskill = Skill::all();
        $datadosen = Teacher::all();
        $department = Department::all();
        return view("admin.prediction.index", compact(['page', 'data', 'dataskill', 'datadosen', 'department']));
    }

    public function bayes(Request $request)
    {
        $data = $request->all();
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
        $dataskill_input = $skill;
        $data['skill'] = json_encode($skill);

        $data = array_diff_key($data, array_flip($this->exept));
        $saved = History_Temp::create($data);
        $page = $this->page;
        $data = Title::all();
        $dataskill = Skill::all();
        $datadosen = Teacher::all();
        $department = Department::all();
        $posterior = NaiveBayes::NAIVE($dataskill_input);
        return view("admin.prediction.bayes", compact(['page', 'data', 'dataskill', 'datadosen', 'department', 'request', 'posterior', 'saved']));
    }
    public function save(Request $request)
    {
        $data = $request->all();
        $history = History_Temp::find($data['id']);
        $history_temp = $history->getAttributes();
        // dd($data, $history_temp);
        $history_temp['pembimbing_i'] = $data['pem1'];
        $history_temp['pembimbing_ii'] = $data['pem2'];
        // $history_temp['penguji_i'] = $data['pen1'];
        // $history_temp['penguji_ii'] = $data['pen2'];
        History::create($history_temp);
        $history->delete();
        session()->flash('alert', ['success', 'Berhasil menambahkan data judul skripsi hasil algoritma']);
        return redirect(to: "/prediction");
    }
}
