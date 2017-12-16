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
                    Trashed Estates
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
                                    <th>Reference</th>
                                    <th>Label</th>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($estates as $estate)
                                    <tr>
                                        <th scope="row">{{ $estate->id }}</th>
                                        <td>{{ $estate->ref }}</td>
                                        <td>{{ $estate->label }}</td>
                                        <td>
                                            <form class="form-horizontal" role="form" method="POST" action="{{ route('estates.restore', $estate->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-default">
                                                        Restore
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td>
                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/estates', $estate->id) }}">
                                                {!! csrf_field() !!}
                                                <input type="hidden" name="_method" value="DELETE">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
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
                <a class="btn btn-default pull-right" href="{{ url('/estates') }}" role="button">
                    Go Back
                </a>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/js/pagination.js') }}"></script>
@endsection
