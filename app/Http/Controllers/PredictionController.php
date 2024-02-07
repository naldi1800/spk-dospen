<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PredictionController extends Controller
{
    public $page = "prediction";
    private $exept = ['_token'];
    public function index()
    {
        $page = $this->page;
        // $data = Position::all();
        return view("admin.prediction.index", compact(['page',]));
    }
}
