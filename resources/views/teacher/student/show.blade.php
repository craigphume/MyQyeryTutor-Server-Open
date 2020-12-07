@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header"><h4>Student Details</h4></div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <h5>Name: </h5>
                    <p class="ml-3">{{ $student->fullname() }}</p>
                </div>
                <div class="col-sm">
                    <h5>Email: </h5>
                    <p class="ml-3">{{ $student->email }}</p>
                </div>
                <div class="col-sm">
                    <h5>Last Sync: </h5>
                    <p class="ml-3">{{ $student->updated_at->setTimeZone(Auth::user()->timezone)->format('h:m, d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
{{--                <a href="{{route('classroom.edit', $classroom->id)}}" class="btn btn-primary">Edit</a>--}}
{{--                <a href="#" data-toggle="modal" data-target="#modalDelete" id="delete" class="btn btn-danger">Delete</a>--}}
                <a href="{{route('classroom.show', $student->classroom->id)}}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header"><h4>Results</h4></div>

        <div class="card-body">
            <h4>Students Results</h4>

            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Topic</th>
                    <th>Question</th>
                    <th style="width: 40%">Query</th>
                    <th>Attempts</th>
                    <th>Passed</th>
                </tr>
                </thead>

                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result->topic }}</td>
                        <td>{{ $result->question }}</td>
                        <td title="{{ $result->query }}" >{{ $result->query }}</td>
                        <td>{{ $result->attempts }}</td>
                        <td style="{{ ($result->pass ? 'color: green' : 'color: orange') }}">{{ ($result->pass ? 'PASSED' : 'NOT PASSED')  }}</td>

                    </tr>
                @endforeach

                </tbody>
            </table>

            {{ $results->links() }}

        </div>

{{--        <div class="card-footer">--}}

{{--        </div>--}}
    </div>

@endsection
