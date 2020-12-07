@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.subscription.save', $school->id)}}" method="post">
        @csrf

        <div class="card mb-3">

            <div class="card-header"><h4>{{ 'New Subscription for "' . $school->name . '"' }}</h4></div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


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

