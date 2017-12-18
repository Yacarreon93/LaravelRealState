@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">New Estate</div>
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
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/estates') }}">
                        {!! csrf_field() !!}
						<div class="form-group">
							<label class="col-md-4 control-label">Reference</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ref" value="{{ old('ref') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Label</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="label" value="{{ old('label') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Address</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="address" value="{{ old('address') }}">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4 text-right">
								<a class="btn btn-default" href="{{ url('/estates') }}" role="button">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
									Create
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
