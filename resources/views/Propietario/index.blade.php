@extends('layouts.layout')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Lista Propietarios</h3></div>
          <div class="pull-right">
            <div class="btn-group">
              <a href="{{ route('propietario.create') }}" class="btn btn-info" >Añadir Propietario</a>
            </div>
          </div>
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
             <thead>
               <th>Nombres</th>
               <th>Apellidos</th>
               
               <th>Mascotas</th>
               <th>Detalle</th>
               <th>Editar</th>
               <th>Eliminar</th>
             </thead>
             <tbody>
              @if($propietarios->count())  
              @foreach($propietarios as $propietario)  
              <tr>
                  <td>
                      {{$propietario->nombre}}
                  </td>

                  <td>
                      {{$propietario->apellido}}
                  </td>

                  <td> 
                      <a href="{{action('PropietarioController@getMascotas', $propietario->id)}}" >
                         <span class="glyphicon glyphicon-heart"></span>
                      </a>
                  </td>

                  <td> 
                      <a href="{{action('PropietarioController@show', $propietario->id)}}" >
                        <span class="glyphicon glyphicon-eye-open"></span>
                      </a>
                  </td>

                  <td>
                      <a href="{{action('PropietarioController@edit', $propietario->id)}}" >
                      <span class="glyphicon glyphicon-edit"></span>
                      </a>
                  </td>
                  <td>
                    <form action="{{action('PropietarioController@destroy', $propietario->id)}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">

                        <button class="btn btn-danger btn-xs" type="submit">
                         <span class="glyphicon glyphicon-remove">   </span>
                        </button>
                  </td>
               </tr>
               @endforeach 
               @else
               <tr>
                <td colspan="8">No hay registros !!</td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>
      </div>
      {{ $propietarios->links() }}
    </div>
  </div>
</section>

@endsection