@extends('layouts.app')

@section('content')
<form action="{{ route($postRoute, $id)}}" method="post">
    @csrf

    <div class="card mb-3">

        <div class="card-header"><h4>{{ $title }}</h4></div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="form-group">
                <label for="name">School Name</label>
                <input id="name"
                       name="name"
                       placeholder="Name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ $school->name ?? old('name') }}"
                       type="text"
                       required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="contact">Contact Name</label>
                <input id="contact"
                       name="contact"
                       placeholder="Jane Doe"
                       class="form-control @error('contact') is-invalid @enderror"
                       value="{{ $school->contact ?? old('contact') }}"
                       type="text"
                       required>
                @error('contact')
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
                       value="{{ $school->email ?? old('email') }}"
                       type="email"
                       required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="contact">Address</label>
                <textarea id="address"
                       name="address"
                       placeholder="123 School St"
                       class="form-control @error('address') is-invalid @enderror"
{{--                       value="{{ $school->address ?? old('address') }}"--}}
                       type="text"
                       required>{{ $school->address ?? old('address') }}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input id="phone"
                       name="phone"
                       placeholder="07 333 34 444"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ $school->phone ?? old('phone') }}"
                       type="text"
                       required>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            @if(!$id)
            <div class="form-row">
                <div class="col-md-3">

                    <div class="form-group">
                        <label for="startdate">Start of Subscription Period</label>
                        <input id="startdate"
                               name="subscription[startdate]"
                               class="form-control @error('subscription[startdate]') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') ?? old('subscription[startdate]') }}"
                               type="date"
                               required>
                        @error('subscription[startdate]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="enddate">End of Subscription Period</label>
                        <input id="enddate"
                               name="subscription[enddate]"
                               class="form-control @error('subscription[enddate]') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::now()->addYear()->format('Y-m-d') ?? old('subscription[startdate]')}}"
                               type="date"
                               required>
                        @error('subscription[enddate]')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="card-footer">
            <div class="float-right">
                <input type="submit" class="btn btn-success" value="Save">
                <a href="{{ route('admin.home') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>
</form>
@endsection

