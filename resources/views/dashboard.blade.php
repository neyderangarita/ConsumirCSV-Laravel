@extends('app')

@section('content')
<br><br>
<div id="componente" class="row">
	
	<div class="col-sm-12">
		<h1 class="page-header text-center">Consumir CSV Spotify desde Laravel</center></h1>
	</div>

	<div class="col-sm-12 table-responsive">
		<table class="table table-hover table-striped table-bordered ">
			<thead class="thead-inverse">
				<tr>					
					<th class="text-center">Artista</th>
					<th class="text-center">Cantidad canciones</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="keep in keeps">
					<td width="100 %" >@{{ keep.artista }}</td>
					<td width="100 %" class="text-center"> <center>@{{ keep.cantidad }}</center></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endsection