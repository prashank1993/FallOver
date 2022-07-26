@extends('layouts.admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} 
</h4>
<div class="card">
    <div class="card-header card-header-primary">
        <h5 class="card-title">
            {{ $title }}
        </h5>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.services.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Service Name</label>*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($service) ? $service->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{(isset($service) && $service->status)?'selected':''}}>Active</option>
                    <option value="0" {{(isset($service) && !$service->status)?'selected':''}}>In Active</option>
                </select>
            </div>
            <br>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
</div>
@endsection
