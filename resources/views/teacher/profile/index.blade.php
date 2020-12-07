@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('profile.update')}}">
    @csrf
    <div class="card mb-3">
        <div class="card-header"><h4>Your Teacher Profile</h4></div>

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
                           value="{{ Auth::user()->name ?? old('name') }}"
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
                           value="{{ Auth::user()->email ?? old('email') }}"
                           type="text"
                           required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="timezone">Timezone</label>
                    <select name="timezone"
                            id="timezone"
                            class="form-control">
                        @foreach (timezone_identifiers_list() as $timezone)
                            <option value="{{ $timezone }}"
                                {{ $timezone == old('timezone', Auth::user()->timezone) ? ' selected' : '' }}>
                                {{ $timezone }}
                            </option>
                        @endforeach
                    </select>
                </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <button name="submit" type="submit" class="btn btn-primary">Update My Profile</button>

                <a href="{{route('password.update', ['email' => Auth::user()->email])}}" class="btn btn-success">Change Password</a>

                <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>

            </div>
        </div>

    </div>
</form>
@endsection
