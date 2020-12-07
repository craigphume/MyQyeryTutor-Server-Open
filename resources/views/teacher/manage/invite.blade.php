@extends('layouts.app')

@section('content')
    <form method="post" action="#">
        @csrf
        <div class="card mb-3">
            <div class="card-header"><h4>Invite A Teacher To Your School</h4></div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name"
                           name="name"
                           placeholder="Name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}"
                           type="text"
                           required autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"
                           name="email"
                           placeholder="Email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           type="text"
                           required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <div class="float-right">
                    <button name="submit" type="submit" class="btn btn-primary">Invite Teacher</button>
                    <a href="{{route('manage')}}" class="btn btn-secondary">Cancel</a>

                </div>
            </div>

        </div>
    </form>
@endsection


