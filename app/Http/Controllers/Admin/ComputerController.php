<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Computer;
use App\Models\Monitor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("admin.computers.index");
    }


    public function load_monitors()
    {

        $free_monitors = Monitor::select()->where("computer_id", null)->get();

        return response()->json(['free_monitors' => $free_monitors]);


    }

    public function create_monitors(Request $request)
    {

        if ($request) {
            Monitor::create([
                "marca" => $request->marca,
                "modelo" => $request->modelo,
                "cod_patrimonial" => $request->cod_patrimonial,
                "descripcion" => $request->descripcion

            ]);
        }

        $free_monitors = Monitor::select()->where("computer_id", null)->get();

        return response()->json(['free_monitors' => $free_monitors]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $computer = Computer::select("id","procesador","placa","case","grafica","ram","descripcion")->get();

        return DataTables::of($computer)

            ->addColumn('acciones', function ($computer) {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning editButton" data-id="'.$computer->id . '" data-toggle ="modal" data-target="#modal_categories_edit"> Editar </a>'. "&nbsp" .'<a href="javascript:void(0)" class="btn btn-sm btn-danger delButton" data-id="'.$computer->id.'">Eliminar</a>';
            })

            ->rawColumns(['acciones'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //OBTENERMOS DE UN ARRAY  "select_monitors[]"
         $selectMonitors = $request->input('select_monitors');

         return $selectMonitors;

        //  $computer = Computer::create([

        //     "procesador" => $request->input('procesador'),
        //     "placa" => $request->input('placa'),
        //     "case" => $request->input('case'),
        //     "grafica" => $request->input('grafica'),
        //     "ram" => $request->input('ram'),
        //     "descripcion" => $request->input('descripcion')

        //  ]);



        // foreach ($selectMonitors as $key => $value) {
        //     echo $key ."-". $value;
        // }

        // die();

       // return $request->all();

        //return $request->select_monitors;

        // foreach ($selectMonitors as $key => $value) {
        //     echo $key ."-". $value;
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function show(Computer $computer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function edit(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Computer $computer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computer  $computer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
