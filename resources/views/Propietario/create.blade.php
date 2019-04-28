@extends('layouts.layout')
@section('content')
<div class="row">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error !!</strong> Todos los campos son requeridos.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Nuevo Propietario</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
                    
						<form method="POST" action="{{ route('propietario.store') }}"  role="form">
							{{ csrf_field() }}

							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
										<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre">
									</div>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Apellidos</label>
										<input type="text" name="apellido" id="apellido" class="form-control input-sm" placeholder="Apellido">
									</div>
								</div>

							</div>

                            <div class="row">
                            
								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Cedula</label>
										<input type="text" name="cedula" id="cedula" class="form-control input-sm" placeholder="Cedula">
									</div>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-8 col-form-label">Fecha de nacimiento</label>
										<input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control input-sm" placeholder="Fecha de nacimiento">

									</div>
								</div>
							</div>


							<div class="row">
						
								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
										<input type="text" name="email" id="email" class="form-control input-sm" placeholder="Email">
									</div>
								</div>

								<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Dirección</label>
										<input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="Direccion">
									</div>
								</div>
							</div>
				
							<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">	
									<div class="form-group">
										<label for="staticEmail" class="col-sm-2 col-form-label">Telefono</label>
										<input type="text" name="telefono" id="telefono" class="form-control input-sm" placeholder="Telefono">
									</div>
								</div>
							</div>
						
							<div class="row">

								<div class="col-xs-6 col-sm-6 col-md-6">
									<input type="submit"  value="Guardar" class="btn btn-success btn-block">
								</div>	

								<div class="col-xs-6 col-sm-6 col-md-6">
								
									<a href="{{ route('home') }}" class="btn btn-info btn-block" >Atrás</a>
								</div>

							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
	@endsection