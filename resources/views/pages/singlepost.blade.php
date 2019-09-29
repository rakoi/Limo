@extends('layouts.layout')
@section('content')


		<div class="panel-default">
			<div class="panel-body">
				 <img src="{{ asset('b.jpeg') }}" width="50" height="50">
				 <a href=""><b>{{$post->user->username }}</b></a>
				 <hr>
				 Movie Name:{{$post->moviename}}<br>
				 Rating : {{$post->rating}}
				 <img src="{{asset('/icons/rated.png') }}"><br>
				 {{$post->comment}}
			</div>

			<div class="panel-footer" >
				<a href=""><i class="glyphicon glyphicon-hand-up"></i></a>
				<a href=""><i class="glyphicon glyphicon-hand-down"></i></a>
				<a href=""> <i class="glyphicon glyphicon-comment"></i>
				 {{$post->comments->count()}}</a>
				 <i class="pull-right">{{$post->created_at->diffForHumans()}}</i><br>
			</div>


			<div id="app">

			<form action="/Comments/{{$post->id}}" method="POST">
				{{ csrf_field()}}
				<textarea class="form-control" v-bind="commentBox"  name="comment"></textarea><br>
				<input type="submit" class="btn btn-danger form-control" value="Comment" @click.prevent="postComment"></input>	
			</form>
			 	<div id="allcomments" v-for="comment in allcomments">
			 	<img src="{{ asset('b.jpeg') }}" width="50" height="50"> 
			 	<a href="profile/$comments->username" >@{{comment.username}}</a><br>
			 	@{{comment.comments}}<br>
					<div class="pull-right">
					 @{{comment.created_at}}
					</div>

			 <br>
			 </div>
			</div>
	
		</div>






<script >
	const vue=new Vue({
		el:'#app',
		data:{
				allcomments:{},
				commentBox:'',
				post:{!! $post->toJson()!!}

		},
		mounted(){
			this.getComments();
		
			},
		methods:{
			sayhello(){
				alert("Geng geg");
			},
			getComments(){
				axios.get(`/api/Comments/${this.post.id}/comments`,{

				}).then((response)=>{
					this.allcomments=response.data;
					
				}).catch(function(error){
					alert(error);
				})

			},
			postComment(){
				axios.post(`/api/Comments/${this.post.id}`,{
					//api_token:{!!Auth::user()->o!!}
					body:this.commentBox
				}).then((response)=>{

					this.allcomments.unshift(response.data);
					this.commentBox='';

				}).catch(function(error){
					alert(error);
				})
			}
		}
	});
</script>
 

@endsection

