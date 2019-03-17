@extends('layout')

@section('contenido')
<div class="container">
	@if(session()->get('danger'))
    <div class="alert alert-danger">
      {{ session()->get('danger') }}
    </div>
  @endif
	<form method="post" action="{{ route('login') }}">
		@csrf
	  <div class="form-group">
	    <label for="Email">Email address</label>
	    <input type="email" class="form-control" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter email">
	    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
	  </div>
	  <div class="form-group">
	    <label for="Password">Password</label>
	    <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
	  </div>
	  <div class="form-group form-check">
	    <input type="checkbox" class="form-check-input" id="exampleCheck1">
	    <label class="form-check-label" for="exampleCheck1">Check me out</label>
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>



@endsection
