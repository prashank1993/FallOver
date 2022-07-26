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
        <form action="{{ route("admin.category.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Category Name</label>*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($category) ? $category->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.user.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('parent') ? 'has-error' : '' }}">
                <label for="parent">Parent Category* </label>
                    {{-- <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label> --}}
                <select name="parent" id="parent" class="form-control">
                    <option value="">Select Parent Category</option>
                    @foreach($parents as $id => $parent)
                        <option value="{{ $parent->id }}" {{ ( isset($category) && $category->parent == $parent->id) ? 'selected' : '' }}>{{ $parent->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('parent'))
                    <p class="help-block">
                        {{ $errors->first('parent') }}
                    </p>
                @endif
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
