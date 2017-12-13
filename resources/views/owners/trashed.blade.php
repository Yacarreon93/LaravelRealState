@extends('app')

@section('content')
@if (Session::has('error'))
	<div class="alert alert-danger">
		<strong>Whoops!</strong> Something is wrong<br><br>
		{{ Session::get('error') }}
	</div>
@endif
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
                    Trashed Owners
                </div>
				<div class="panel-body">
                    <div class="table-responsive">
                        <div class="text-center">
                            {!! $owners->render() !!}
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($owners as $owner)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('owners.show', $owner->id) }}">
                                                {{ $owner->id }}
                                            </a>
                                        </th>
                                        <td>{{ $owner->name }}</td>
                                        <td>{{ $owner->email }}</td>
                                        <td>{{ $owner->phone }}</td>
                                        <td>
                                            <a class="btn btn-default" href="{{ route('owners.restore', $owner->id) }}" role="button">
                                                Restore
                                            </a>
                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/owners', $owner->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4 text-right">
                                                        <button type="submit" class="btn btn-danger">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="clearfix">
                <a class="btn btn-default pull-right" href="{{ url('/owners') }}" role="button">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/pagination.js') }}"></script>
@endsection
