@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('admin.teacher.update', $teacher->id)}}">
    @csrf
    <div class="card mb-3">
        <div class="card-header"><h4>Edit Teacher Profile</h4></div>

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
                           value="{{ $teacher->name ?? old('name') }}"
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
                           value="{{ $teacher->email ?? old('email') }}"
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
                                {{ $timezone == old('timezone', $teacher->timezone) ? ' selected' : '' }}>
                                {{ $timezone }}
                            </option>
                        @endforeach
                    </select>
                </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <button name="submit" type="submit" class="btn btn-primary">Update Teacher Profile</button>
                <a href="{{ route('admin.teacher.reset.password', $teacher->id) }}" class="btn btn-success">Send Password Reset</a>

                @if(!$teacher->email_verified_at)
                <a href="{{ route('admin.teacher.reinvite', $teacher->id) }}" class="btn btn-warning">Resend Welcome Email</a>
                @endif

                <a href="{{ route('admin.school.show', $teacher->school_id) }}" class="btn btn-secondary">Back</a>

            </div>
        </div>

    </div>
</form>


@endsection
