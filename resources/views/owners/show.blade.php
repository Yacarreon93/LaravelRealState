@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Owner</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Something is wrong<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $owner->name }}" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ $owner->email }}" disabled>
							</div>
						</div>
						<div class="form-group">
                            <label class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input type="tel" class="form-control" name="phone" value="{{ $owner->phone }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="address" value="{{ $owner->address }}" disabled>
                            </div>
                        </div>
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-right">
                                <a class="btn btn-default" href="{{ url('/owners') }}" role="button">
                                    Go Back
                                </a>
                                <a class="btn btn-primary" href="{{ route('owners.edit', $owner->id) }}" role="button">
                                    Edit
                                </a>
                            </div>
						</div>
					</form>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('owners.trash', $owner->id) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
							<div class="col-md-6 col-md-offset-4 text-right">
                                <button type="submit" class="btn btn-danger">
									Delete
								</button>
							</div>
						</div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
