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
        $mascotas = DB::table('mascotas')->paginate(3);;
        $propietarios = DB::table('propietarios')->paginate(3);

        return view('mascota.index',compact('mascotas','propietarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $propietarios = DB::table('propietarios')->paginate(3);
        return view('Mascota.create', compact('propietarios')   );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->all());
        // die();
        $v = \Validator::make($request->all(), [
            
            'nombre' => 'required',
            'edad' => 'numeric|required|min:1|max:99',
            'especie'    => 'required',
            'clasificacion' => 'required',
            'peso' => 'numeric|required|min:1|max:9999',
            'paisorigen' => 'required',
            'propietarioid'  => 'required'

        ]);
            
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        DB::table('mascotas')->insert(
            ['nombre' => $request->nombre,
             'edad' => $request->edad,
             'especie' => $request->especie,
             'clasificacion' => $request->clasificacion,
             'peso' => $request->peso,
             'paisorigen' => $request->paisorigen,
             'propietario_id'=>$request->propietarioid
             ]
        );
        $mascotas = DB::table('mascotas')->where('propietario_id',$request->propietarioid)->paginate(3);
        return redirect()->route('propietario.index',compact('mascotas'))->with('exito','La mascota fue registrada !!');
        
     
        //return view('mascota.index',compact('mascotas'));
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
        // return $mascota;
        // die();
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
