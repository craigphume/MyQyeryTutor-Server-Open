@extends('layouts.app')

@section('content')

{{--    <div class="card mb-3">--}}
{{--        <div class="card-header">Your School</div>--}}

{{--        <div class="card-body">--}}
{{--            @if (session('status'))--}}
{{--                <div class="alert alert-success" role="alert">--}}
{{--                    {{ session('status') }}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <h1>Your Dashboard</h1>--}}

{{--        </div>--}}

{{--        <div class="card-footer">--}}
{{--            <div class="float-right">--}}
{{--                <a href="#" class="btn btn-success">Button</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


    @include('includes.classroomlist')


@endsection
