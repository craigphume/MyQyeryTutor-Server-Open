@extends('layouts.app')

@section('content')
    @include('admin.includes.quickstats')

<div class="card mb-3">
    <div class="card-header">Current Schools</div>

    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Contact Person</th>
                <th>Email</th>
                <th>Expiry</th>
                <th>Disabled</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach($schools as $school)
                <tr {!! (!is_null($school->disabled)) ? 'style="color: red"' : '' !!}>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->contact }}</td>
                    <td>{{ $school->email }}</td>
                    <td style="color: {{ ($school->expiry < \Carbon\Carbon::now()) ? 'red' : 'green' }}">{{ $school->expiry->format('d M Y')  }}</td>
                    <td>{{ $school->disabled ? $school->disabled->format('d M Y') : ''}}</td>

                    <td><a href="{{ route('admin.school.show', $school->id) }}" class="btn btn-primary">Show</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        <div class="float-right">
            <a href="{{ route('admin.school.create') }}" class="btn btn-success">Create New School</a>
        </div>
    </div>
</div>
@endsection
