<?php

namespace App\Http\Controllers;
use App\propietario;
use App\mascota;
use DB;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //QUERYBUILDER
        $propietarios = DB::table('propietarios')->paginate(3);;

                // foreach ($propietarios as $propietario)
                // {
                //     //echo $propietario->nombre;
                // }
        return view('propietario.index',compact('propietarios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Propietario.create');
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
        $v = \Validator::make($request->all(), [
            
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula'    => 'required',
            'fechanacimiento' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'telefono' => 'required'

        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        //QUERYBUILDER
        DB::table('propietarios')->insert(
            ['nombre' => $request->nombre,
             'apellido' => $request->apellido,
             'cedula' => $request->cedula,
             'fechanacimiento' => $request->fechanacimiento,
             'email' => $request->email,
             'direccion' => $request->direccion,
             'telefono' => $request->telefono
             ]
        );
        return redirect()->route('propietario.index')->with('exito','El propietario fue registrado !!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          //QUERYBUILDER
          $propietario = DB::table('propietarios')->where('id', $id)->first();
          return view('propietario.show',compact('propietario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $propietario=Propietario::find($id);

        return view('propietario.edit',compact('propietario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('propietarios')
        ->where('id', $id)
        ->update( ['nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'cedula' => $request->cedula,
                'fechanacimiento' => $request->fechanacimiento,
                'email' => $request->email,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono
                ]
          );
    return redirect()->route('propietario.index')->with('success','Registro actualizado satisfactoriamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Borra todas las mascotas
        $propietario = Propietario::find($id);
        $propietario->mascotas()->delete(); // Borra todas las mascotas asociadas
        $propietario->delete(); // Borra el propietario
      
        //DB::table('propietarios')->where('id', $id)->delete();
        return redirect()->route('propietario.index')->with('success','Registro eliminado satisfactoriamente');
    }

    public function getMascotas($id)
    {
        $mascotas = DB::table('mascotas')->where('propietario_id',$id)->paginate(3);
        return view('mascota.index',compact('mascotas'));    
    }
}
