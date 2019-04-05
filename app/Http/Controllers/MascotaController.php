<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mascota;
use DB;
class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //QUERYBUILDER
        $mascotas = DB::table('mascotas')->paginate(3);;

        foreach ($mascotas as $mascota)
        {
            //echo $mascota->nombre;
        }
        return view('mascota.index',compact('mascotas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Mascota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = \Validator::make($request->all(), [
            
            'nombre' => 'required',
            'edad' => 'numeric|required|min:1|max:99',
            'especie'    => 'required',
            'clasificacion' => 'required',
            'peso' => 'numeric|required|min:1|max:9999',
            'paisorigen' => 'required'

        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        //QUERYBUILDER
        DB::table('mascotas')->insert(
            ['nombre' => $request->nombre,
             'edad' => $request->edad,
             'especie' => $request->especie,
             'clasificacion' => $request->clasificacion,
             'peso' => $request->peso,
             'paisorigen' => $request->paisorigen
             ]
        );
        return redirect()->route('mascota.index')->with('exito','La mascota fue registrada !!');
        
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
        $mascota = DB::table('mascotas')->where('id', $id)->first();
        return view('mascota.show',compact('mascota'));
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
        $mascota=Mascota::find($id);
        return view('mascota.edit',compact('mascota'));
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
        //QUERYBUILDER
        DB::table('mascotas')
            ->where('id', $id)
            ->update( ['nombre' => $request->nombre,
                    'edad' => $request->edad,
                    'especie' => $request->especie,
                    'clasificacion' => $request->clasificacion,
                    'peso' => $request->peso,
                    'paisorigen' => $request->paisorigen
                    ]
              );
        return redirect()->route('mascota.index')->with('success','Registro actualizado satisfactoriamente');

    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('mascotas')->where('id', $id)->delete();
        return redirect()->route('mascota.index')->with('success','Registro eliminado satisfactoriamente');

    }
}
