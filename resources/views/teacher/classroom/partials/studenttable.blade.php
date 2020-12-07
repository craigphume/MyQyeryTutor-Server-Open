<table class="table table-striped">
    <thead class="thead-dark">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Results</th>
        <th>Something</th>
    </tr>
    </thead>

    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->fullname() }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ count($student->results) }}</td>
            <td><a href="{{ route('student.show', $student->id) }}" class="btn btn-success">Show</a></td>
        </tr>
        @endforeach
        @empty($classroom->students())
        <tr>
            <td>No Students Yet</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endempty
    </tbody>
</table>

{{ $students->links() }}
