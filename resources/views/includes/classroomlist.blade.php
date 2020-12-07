<div class="card mb-3">
    <div class="card-header">Your Schools Classrooms
        @isset($classrooms)
        <div class="float-right">
            <small>showing {{$classrooms->count()}} newest</small>
        </div>
        @endisset
    </div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th style="width: 30%">Name</th>
                <th>Creator</th>
                <th style="width: 20%">Code</th>
                <th style="width: 10%">Count</th>
                <th style="width: 15%">Modify</th>
            </tr>
            </thead>

            <tbody>
                @isset($classrooms)
                    @foreach($classrooms as $classroom)
                    <tr>
                        <td>{{ $classroom->name }}</td>
                        <td>{{ $classroom->user->name }}</td>
                        <td>{{ $classroom->code }}</td>
                        <td>{{ count($classroom->students) }}</td>
                        <td>
                            <a href="{{ route('classroom.show', $classroom->id) }}" class="btn btn-success">Show</a>
                            <a href="{{ route('classroom.edit', $classroom->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                @endisset
                @empty($classrooms)
                    <tr>
                        <td>No Classrooms Yet</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endempty
            </tbody>

        </table>

    </div>

    <div class="card-footer">
        <div class="float-right">
            <a href="{{ route('classroom.create') }}" class="btn btn-success">New Classroom</a>
            <a href="{{ route('classroom') }}" class="btn btn-primary">All Classrooms</a>
        </div>
    </div>
</div>
