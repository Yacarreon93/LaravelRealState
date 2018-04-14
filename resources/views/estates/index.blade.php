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
                        {{ isset($type_name) ? ucfirst($type_name) : 'Estates' }} List ({{ $estates->total() }})
                        <a class="btn btn-default pull-right" href="{{ url('/estates/create') }}" role="button">
                            Create New
                        </a>
                    </div>
                </div>
				<div class="panel-body">
                    <div class="table-responsive">
                        <div class="text-center">
                            {!! $estates->render() !!}
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ref</th>
                                    <th>Label</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estates as $estate)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ route('estates.show', $estate->id) }}">
                                                {{ $estate->id }}
                                            </a>
                                        </th>
                                        <td>{{ $estate->ref }}</td>
                                        <td>{{ $estate->label }}</td>
                                        <td>{{ $estate->address }}</td>
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
                <a class="btn btn-default pull-right" href="{{ url('/estates/trashed') }}" role="button">
                    Trashed Estates
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/pagination.js') }}"></script>
@endsection
