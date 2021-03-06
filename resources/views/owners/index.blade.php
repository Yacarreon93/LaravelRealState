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
                    <div class="clearfix">
                        Owners List
                        <a class="btn btn-default pull-right" href="{{ url('/owners/create') }}" role="button">
                            Create New
                        </a>
                    </div>
                </div>
				<div class="panel-body">
                    <div class="table-responsive">
                        <div class="text-center">
                            {!! $owners->appends(['sort' => 'name'])->render() !!}
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
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
                                        <td>{{ $owner->address }}</td>
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
                <a class="btn btn-default pull-right" href="{{ url('/owners/trashed') }}" role="button">
                    Trashed Owners
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/pagination.js') }}"></script>
@endsection
