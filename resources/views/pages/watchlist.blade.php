@extends('layouts.generalLayout')
@section('content')
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Are You Sure you want to Remove<span id="removemoviename"></span></h5>
	        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span> -->
	        </button>
	      </div>
	     <!--  <div class="modal-body">
	     
	      </div> -->
	      <div class="modal-footer">
	      <form method="POST" action="/watchlist/delete" class="form">
	      	{{csrf_field()}}
	      	<input type="id" hidden="true" name="removemovieid"  id="removemovieid">
	      	<button type="submit" class="btn btn-warning">Remove</button>
	      	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
	      </form>
	      
	        
	  
	       
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Update</span></h5>
	        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span> -->
	        </button>
	      </div>
	      <div class="modal-body">
	     	<form  method="POST" action="/watchlist/11/update">
	     			{{csrf_field()}}
	     	<label>Moviename:<span id="moviename"></span></label><br>
	     	<input type="hidden" name="id" id="id">
	     		<div class="form form-group">
	     		<label>Season</label>
					<input type="number" id="season" class="form-control" name="current_season">
	     		</div>
	     		<div class="form form-group">
	     		<label>Episode</label>
					<input type="number"  class="form-control" name="current_episode" id="episode"> 
	     		</div>
	     		 <button type="submit" class="btn btn-success">Update</button>
	        	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close" >Close</button>

	     	</form>
	      </div>
	      <div class="modal-footer">
	     
	  
	       
	      </div>
	    </div>
	  </div>
	</div>




<div class="row">
	      @if (Session::has('Updated'))
        <div class="alert alert-success" role="alert">
         	{{Session::get('Updated')}}
         </div>
      @endif



      @if (count($errors) > 0)
        <div class="alert alert-danger" role="alert">
          <strong>Errors:</strong>
          <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
	<form class="form-vertical" action="\watchlist/add" method="POST" >
	{{csrf_field()}}
		<div class="col-md-3 mb-4 form-group">
			<LABEL>MovieName</LABEL>
			<input required="true" type="text" class="form-control" name="moviename">
		</div>
		<div class="col-md-2 mb-4 form-group">
			<LABEL>Season</LABEL>
			<input type="number" required="true"  class="form-control" name="Season">
		</div>
		<div class="col-md-2 mb-4 form-group">
			<LABEL>Episode</LABEL>
			<input type="number" required="true"  class="form-control" name="Episode">
		</div>
		<div class="col-md-2 mb-4 form-group">
		<label></label>
		<input type="submit" required="true"  class="btn btn-success form-control" value="Add ">
		</div>
	</form>
</div>

<table class="table">
	<thead>
		<tr>
			<th>Series Name</th>
			<th>Season</th>
			<th>Episode</th>
			<th >Current</th>
		</tr>
	</thead>
	<tbody>
	
	@foreach($watchlist as $item)		
		<tr>

			<td>{{$item->series->series_name}}</td>
			<td>{{$item->current_season}}</td>
			<td>{{$item->current_episode}}</td>
			<td>Sn {{$item->series->current_season}} Ep {{$item->series->current_episode}}</td>
		<!-- 	{!!$item->id!!},{!!$item->series->series_name!!},{!!$item->current_season!!},{!!$item->current_episode!!} -->
			<td>
				<button class="btn btn-primary " 
					 onclick="removemovie({{$item->series->id}},'{!!$item->series->series_name!!}')"
					data-toggle="modal" data-target="#delete-modal">Delete
					<i class="glyphicon glyphicon-trash"></i>
				</button>
			</td>
			<td>
				<button class="btn btn-primary " 
					onclick="updatemovie({{$item->series->id}},'{!!$item->series->series_name!!}',{!!$item->current_season!!},{!!$item->current_episode!!})" 
					data-toggle="modal" data-target="#edit-modal">Edit
					<i class="glyphicon glyphicon-edit"></i>
				</button>
			</td>
			
		</tr>
	@endforeach
	</tbody>
</table>




@endsection
<script type="text/javascript">
	    function removemovie(id,removemoviename){
	     	 
	        document.getElementById('removemoviename').innerHTML=removemoviename;
	        document.getElementById('removemovieid').value=id;
	       
	    }
	    function updatemovie(id,moviename,season,episode){
	    	document.getElementById('id').value=id;
	    	document.getElementById('moviename').innerHTML=moviename;
	    	document.getElementById('season').value=season;
	        document.getElementById('episode').value=episode;
	        
	    }

	</script>