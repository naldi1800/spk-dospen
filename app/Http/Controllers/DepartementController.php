<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public $page = "departement";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        $data = Department::all();
        return view("admin.departement.index", compact(['data', 'page']));
    }

    public function create()
    {
        $page = $this->page;
        return view("admin.departement.create", compact(['page']));
    }

    public function save(Request $r)
    {
        Department::create($r->except($this->exept));
        session()->flash('alert', ['success', 'Berhasil menambahkan data Jurusan']);
        return redirect(to: "/departement");
    }

    public function update($id)
    {
        $page = $this->page;
        $data = Department::find($id);
        return view("admin.departement.update", compact(['page', 'data']));
    }

    public function edit($id, Request $r)
    {
        $data = Department::find($id);
        $data->update($r->except($this->exept));
        session()->flash('alert', ['success', 'Berhasil mengubah data Jurusan']);

        return redirect(to: "/departement");
    }

    public function delete($id)
    {
        $data = Department::find($id);
        session()->flash('alert', ['success', 'Berhasil menghapus data Jurusan']);
        $data->delete();
        return redirect(to: "/departement");
    }
}

