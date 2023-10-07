<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        /*
         return Datatables::of() es una parte importante de cómo se utiliza el paquete DataTables en Laravel. Esta expresión se utiliza para configurar y devolver una respuesta JSON que contiene los datos que se mostrarán en una tabla DataTables en el lado del cliente.

         */

        $categories = Category::all();

        return DataTables::of($categories)
        ->addColumn('fecha_creacion', function ($category) {
            // Formatea la fecha como desees utilizando Carbon
            return $category->created_at->format('d/m/Y');
        })->addColumn('fecha_actualizacion', function ($category) {
            // Formatea la fecha como desees utilizando Carbon
            return $category->updated_at->format('d/m/Y');
        })->make(true);


        // return DataTables::of($categories)->toJson();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.categories.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Category::create([
            "name" => $request->name,
            "description" => $request->description
        ]);

        $request = null;


        //return response()->json(['message' => 'Datos recibidos con éxito']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
