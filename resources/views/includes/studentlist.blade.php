<div class="card mb-3">
    <div class="card-header">Your Schools Students</div>

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
                <th>Email</th>
                <th style="width: 10%">Completion</th>
                <th style="width: 10%">View</th>
            </tr>
            </thead>

            <tbody>
            @isset($students)
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>10/20</td>
                        <td>
                            <a href="/class/{{ $student->id }}" class="btn btn-success">Show</a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            @empty($students)
                <tr>
                    <td>No Students Yet</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endempty
            </tbody>

        </table>

    </div>

{{--    <div class="card-footer">--}}
{{--        <div class="float-right">--}}
{{--            <a href="{{ route('classroom') }}" class="btn btn-success">New Class</a>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
