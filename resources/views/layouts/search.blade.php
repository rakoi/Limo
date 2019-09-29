@extends('layouts.layout')
@section('content')
	
	<div class="Panel panel-default">
		<div class="panel panel-header">
			<a href="/Search">People</a>
			<a href="/Search/posts" class="pull-right" style="padding-right: 180px">Posts</a>
		</div>
		@yield('results')
		<!-- panel body -->
	</div>

@endsection