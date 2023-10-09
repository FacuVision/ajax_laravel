<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Computer;
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
        //
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
