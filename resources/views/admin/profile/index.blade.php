@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('admin.profile.update')}}">
    @csrf
    <div class="card mb-3">
        <div class="card-header"><h4>Edit Profile</h4></div>

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
                           value="{{ Auth::guard('admin')->user()->name ?? old('name') }}"
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
                           value="{{ Auth::guard('admin')->user()->email ?? old('email') }}"
                           type="text"
                           required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="current_password">Current Password</label>
                        <input id="current_password"
                               name="current_password"
                               placeholder="Current Password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               type="password">
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password">New Password</label>
                        <input id="password"
                               name="password"
                               placeholder="Password"
                               class="form-control @error('password') is-invalid @enderror"
                               type="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input id="password_confirmation"
                               name="password_confirmation"
                               placeholder="Confirm Password"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               type="password">
                        @error('confirm_password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <button name="submit" type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>

    </div>
</form>
@endsection
