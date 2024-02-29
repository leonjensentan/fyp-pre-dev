@extends('employee-layout')

@section('content')


<div class="container-fluid">
	<div class="d-flex justify-content-center align-items-center vh-100">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body">

					<form action="{{route('login.post')}}" method="POST">
						@csrf

						@if($errors->any())
						<div class="col-12">
							@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
								{{$error}}
							</div>
							@endforeach
						</div>
						@endif

						@if(session()->has('error'))
						<div class="alert alert-danger" role="alert">
							{{session('error')}}
						</div>
						@endif

						@if(session()->has('success'))
						<div class="alert alert-success" role="alert">
							{{session('success')}}
						</div>
						@endif

						<div class="mb-3">
							<label for="email" class="form-label">Email:</label>
							<input type="text" class="form-control" id="email" name="email" placeholder="Email">
						</div>

						<div class="mb-3">
							<label for="employeeid" class="form-label">Password:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>

						<button type="submit" class="btn btn-primary mx-auto d-block">Login</button>


					</form>

				</div>
			</div>
		</div>
	</div>
</div>

@endsection