<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HeadProgramController extends Controller
{
    public $page = "head-program";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        $searchTerm = 'Ketua Jurusan';
        $position = Position::where('position_name', 'like', '%' . $searchTerm . '%')->get();
        $id = [];
        foreach ($position as $p) {
            array_push($id, $p->id);
        }
        // dd($id);
        $data = Teacher::with('position')
            ->whereIn('position_id', $id)
            ->get();


        // dd($data);
        return view("admin.head-program.index", compact(['data', 'page']));
    }

    public function save($id, Request $r)
    {
        dd($r->all());
        $data = $r->all();
        User::create([
            'name' => $data['name'],
            'NIDN' => $data['NIDN'],
            'email' => $data['email'],
            'role' => 1,
            'password' => Hash::make($data['password']),
        ]);

        Teacher::find($id)->update([
            'login' => 1,
        ]);
        session()->flash('alert', ['success', 'Berhasil menambahkan data Ketua Jurusan']);

        return redirect(to: "/head-program");
    }

    public function delete($id, Request $r)
    {
        // dd($r->all());
        $data = $r->all();
        User::where('NIDN', $data['NIDN'])->first()->delete();

        Teacher::find($id)->update([
            'login' => 0,
        ]);
        session()->flash('alert', ['success', 'Berhasil menghapus data Ketua Jurusan']);
        return redirect(to: "/head-program");
    }
}
