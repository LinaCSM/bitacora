@extends('app')
@section('content')
<div class="container">
	<div class="col-md-10 col-md-offset-1">
	<div class="row">
		<h3>CARGAS MASIVAS</h3>
		<br>
		<div class="panel panel-default">
			<div class="panel-body">
			<div class="form-group">
				<div class="col-md-12"><br>
					<table class="table table-hover table-bordered">
						<tr>
							<td>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group">
											<span class="glyphiconB glyphicon-ok"></span><h3>Programas Formación</h3>
											<a class="btnB btnB-primary btnB--outline" data-toggle="modal" data-target="#miventana" >Carga masiva</a>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group">
											<span class="glyphiconB glyphicon-ok"></span><h3>Fichas</h3>
											<a class="btnB btnB-primary btnB--outline" data-toggle="modal" data-target="#miventana1" >Carga masiva</a>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group">
											<span class="glyphiconB glyphicon-ok"></span><h3>Instructores</h3>
											<a class="btnB btnB-primary btnB--outline" data-toggle="modal" data-target="#miventana2" >Carga masiva</a>
										</div>
									</div>
								</div>
							</td>
							<td>
								<div class="panel panel-default">
									<div class="panel-body">
										<div class="form-group">
											<span class="glyphiconB glyphicon-ok"></span><h3>Aprendices</h3>
											<a class="btnB btnB-primary btnB--outline" data-toggle="modal" data-target="#miventana3" >Carga masiva</a>
										</div>
									</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	 </tr>	
</table>
</div>
		@include('Masivos/MasivoItems')
</div>
</div>
@endsection

