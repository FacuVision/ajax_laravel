<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Computer;
use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        //1) Realizamos las validaciones usando la clase Validator, indicando lo que llego por GET
        // Despues las validaciones con un array asociativo

        $validator = Validator::make($request->all(), [
            "marca" => "required",
            "modelo" => "required",
            "cod_patrimonial" => "required|numeric",
            "descripcion" => "required",
        ]);

        //En caso la validacion falle, entonces retornará una respuesta de tipo json
        //Mostrando los errores e indicando el tipo de error.
        //es sumamente importante colocar el codigo de error de la perticion

        // El código de respuesta HTTP 422 Unprocessable Entity se utiliza específicamente
        // para indicar que la solicitud del cliente fue válida en cuanto a su estructura
        // y autenticación, pero el servidor no pudo procesarla debido a errores en los datos
        // proporcionados. En el contexto de una solicitud de validación, es una forma adecuada
        // de comunicar que se encontraron errores de validación en los datos del formulario.

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        //Si las validaciones fueron correctas entoncesn proceder

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

        $computer = Computer::select("id", "procesador", "placa", "case", "grafica", "ram", "descripcion")->get();

        return DataTables::of($computer)

            ->addColumn('acciones', function ($computer) {
                return '<a href="javascript:void(0)" class="btn btn-sm btn-warning editButton" data-id="' . $computer->id . '" data-toggle ="modal" data-target="#edit_modalExterno"> Editar </a>' . "&nbsp" . '<a href="javascript:void(0)" class="btn btn-sm btn-danger delButton" data-id="' . $computer->id . '">Eliminar</a>';
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

        //return $request->all();


        $validator = Validator::make($request->all(), [
            "procesador" => "required",
            "placa" => "required",
            "case" => "required",
            "grafica" => "required",
            "ram" => "required",
            "descripcion_computer" => "required",
            "select_monitors" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }



        //OBTENERMOS DE UN ARRAY  "select_monitors[]"
        $selectMonitors = $request->input('select_monitors');

        //return $selectMonitors;

        $computer = Computer::create([

            "procesador" => $request->input('procesador'),
            "placa" => $request->input('placa'),
            "case" => $request->input('case'),
            "grafica" => $request->input('grafica'),
            "ram" => $request->input('ram'),
            "descripcion" => $request->input('descripcion_computer')
        ]);



        foreach ($selectMonitors as $key => $value) {

            $id_monitor = $value;

            $monitor = Monitor::find($id_monitor);
            $monitor->update([
                "computer_id" => $computer->id
            ]);
        }
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
    public function edit($id)
    {
        $computer = Computer::findOrFail($id);
        $selectedMonitors = $computer->monitors->pluck('id');

        /**
         * En este ejemplo, estamos buscando monitores donde la clave computer_id coincide
         * con el ID de la computadora que te interesa (los monitores asociados a esa computadora)
         * y también donde computer_id es NULL (los monitores sin asociar a ninguna computadora)
         */

        $free_monitors = Monitor::where('computer_id', $id) // Monitores asociados a la computadora
            ->orWhereNull('computer_id') // Monitores con foreign key NULL
            ->get();

        return response()->json(['computer' => $computer, 'selectedMonitors' => $selectedMonitors, 'free_monitors' => $free_monitors]);
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
