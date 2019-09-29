@extends('layouts.generalLayout')
@section('content')
<table class="table">
	<thead>
		<tr>
			<th>Series Name</th>
			<th>Season</th>
			<th>Episode</th>
			<th style="background-color: gray">Current</th>
		</tr>
	</thead>
	<tbody>
	
	@foreach($watchlist as $item)		
		<tr>

			<td>{{$item->series->series_name}}</td>
			<td>{{$item->current_season}}</td>
			<td>{{$item->current_episode}}</td>
			<td style="background-color:gray">Sn {{$item->series->current_season}} Ep {{$item->series->current_episode}}</td>
			@if(Auth::user()==$item->user)
			<td><a href="/watchlist/remove/{{$item->id}}" class="btn btn-primary">Remove</a> </td>
			@endif
			
		</tr>
	@endforeach
	</tbody>
</table>




@endsection