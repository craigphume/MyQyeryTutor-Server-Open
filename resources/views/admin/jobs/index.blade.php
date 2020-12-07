@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header"><h4>Pending Jobs</h4></div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th style="width: 20%">Code</th>
                    <th style="width: 10%">Count</th>
                    <th style="width: 15%">Modify</th>
                </tr>
                </thead>

                <tbody>
{{--                @isset($classrooms)--}}
{{--                    @foreach($classrooms as $classroom)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $classroom->name }}</td>--}}
{{--                            <td>{{ $classroom->code }}</td>--}}
{{--                            <td>{{ count($classroom->students) }}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{ route('classroom.show', $classroom->id) }}" class="btn btn-success">Show</a>--}}
{{--                                <a href="{{ route('classroom.edit', $classroom->id) }}" class="btn btn-primary">Edit</a>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                @endisset--}}
{{--                @empty($classrooms)--}}
{{--                    <tr>--}}
{{--                        <td>No Classrooms Yet</td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                @endempty--}}
                </tbody>
            </table>


{{--            @isset($classrooms)--}}
{{--                {{ $classrooms->links() }}--}}
{{--            @endisset--}}

        </div>

        <div class="card-footer">
            <div class="float-right">
{{--                <a href="{{ route('classroom.create') }}" class="btn btn-success">New Classroom</a>--}}
                {{--            <a href="{{route('classroom')}}" class="btn btn-secondary">Back</a>--}}

            </div>
        </div>
    </div>
@endsection

