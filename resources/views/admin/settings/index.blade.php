@extends('layouts.app')

@section('content')
    <form action="{{ route('admin.setSysMsg')}}" method="post">
    <div class="card mb-3">
        <div class="card-header"><h4>System Messages</h4></div>



            <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


                @csrf

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="sysmsg">System Message</label>
                        <input id="sysmsg"
                               name="sysmsg"
                               placeholder="System maintenance at midnight"
                               class="form-control @error('sysmsg') is-invalid @enderror"
                               value="{{ $sysmsg ?? old('sysmsg') }}"
                               type="text"
                               required>
                        @error('sysmsg')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-2">
                        <label for="expiryDate">Expiry Date</label>
                        <input id="expiryDate"
                               name="expiryDate"
                               class="form-control @error('expiryDate') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') ?? old('expiryDate') }}"
                               type="date"
                               required>
                        @error('expiryDate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-2">
                        <label for="expiryTime">Expiry Time</label>
                        <input id="expiryTime"
                               name="expiryTime"
                               class="form-control @error('expiryTime') is-invalid @enderror"
                               value="{{ \Carbon\Carbon::now()->format('H:i') ?? old('expiryTime') }}"
                               type="time"
                               required>
                        @error('expiryTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                </div>



        </div>

        <div class="card-footer">
            <div class="float-right">

                <input type="submit" class="btn btn-success" value="Save">
                <a href="#" class="btn btn-danger">Delete</a>
                {{--            <a href="{{route('classroom')}}" class="btn btn-secondary">Back</a>--}}

            </div>
        </div>
    </div>
        </form>
@endsection
