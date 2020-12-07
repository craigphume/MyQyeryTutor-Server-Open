@extends('layouts.app')

@section('content')
<form action="{{ route($postRoute , $id )}}" method="post">
    @csrf

    <div class="card mb-3">
        <div class="card-header"><h4>{{ $title }}</h4></div>

        <div class="card-body">
            <div class="form-group">
                <label for="classname">Class Name</label>
                <input type="text"
                       name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ $classroom->name ?? old('name') }}"
                       required autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>

            @isset($classroom->code)
            <div class="form-check">
                <input type="checkbox"
                       name="codecheck"
                       class="form-check-input"
                       value="{{ old('codecheck') ?? true}}"
                >
                <label class="form-check-label" for="codecheck">Regenerate Class Code: ({{ $classroom->code }})</label>
            </div>
            @endisset
        </div>

        <div class="card-footer">
            <div class="float-right">
                <input type="submit" value="Save" class="btn btn-primary">
                <a href="{{route('classroom')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection
