<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public $page = "position";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        $data = Position::all();
        return view("admin.position.index", compact(['data', 'page']));
    }

    public function create()
    {
        $page = $this->page;
        $data = Position::all(['id', 'position_name']);
        return view("admin.position.create", compact(['page', 'data']));
    }

    public function save(Request $r)
    {
        Position::create($r->except($this->exept));
        return redirect(to: "/position");
    }

    public function update($id)
    {
        $page = $this->page;
        $dataposition = Position::all(['id', 'position_name']);
        $data = Position::find($id);
        return view("admin.position.update", compact(['page', 'data', 'dataposition']));
    }

    public function edit($id, Request $r)
    {
        $position = Position::find($id);
        // dd($position);
        $position->update($r->except($this->exept));
        return redirect(to: "/position");
    }

    public function delete($id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect(to: "/position");
    }
}
