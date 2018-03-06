@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Estate</div>
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
					<form class="form-horizontal" role="form" method="POST" action="{{ route('estates.update', $estate->id) }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="PUT">
						<div class="form-group">
							<label class="col-md-4 control-label">Reference</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ref" value="{{ $estate->ref }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Label</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="label" value="{{ $estate->label }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Address</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="address" value="{{ $estate->address }}">
							</div>
						</div>
                        @if ($estate->owner)
						<div class="form-group">
							<label class="col-md-4 control-label">Owner</label>
							<div class="col-md-6">
                                <select name="fk_owner" class="form-control"></select>
							</div>
						</div>
                        @endif
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4 text-right">
								<a class="btn btn-default" href="{{ route('estates.show', $estate->id) }}" role="button">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
									Update
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

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        var ownerSelect = $('select[name="fk_owner"]')
        ownerSelect.select2({
            theme: 'bootstrap',
            ajax: {
                dataType: 'json',
                url: '{{ url("/owners/getSelectOptions") }}',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                }
            }
        })
        @if ($estate->owner && $estate->owner->id > 0)
        var option = $('<option selected>Loading...</option>').val({{ $estate->owner->id }})
        ownerSelect.append(option).trigger('change')
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '{{ url("/owners/getSelectOptions") }}',
            data: { id: {{ $estate->owner->id }} }
        }).then(function (data) {
            var owner = data && data[0]
            if (owner) {
                option.text(owner.text).val(owner.id);
                option.removeData();
                ownerSelect.trigger('change');
            }
        });
        @endif;
    })
</script>
@endsection
