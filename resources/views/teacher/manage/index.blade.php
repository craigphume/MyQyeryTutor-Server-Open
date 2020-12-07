@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header"><h4>Manage Your Teachers</h4></div>

    <div class="card-body">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th style="width: 20%">Email</th>
                <th style="width: 10%">Status</th>
                <th style="width: 10%">Verified</th>
                <th style="width: 20%">Modify</th>
            </tr>
            </thead>

            <tbody>
            @isset($teachers)
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->disabled ? 'Disabled' : 'Enabled' }}</td>
                        <td>{{ $teacher->email_verified_at ? 'Verified' : 'Unverified' }}</td>
                        <td>
{{--                            green blue yellow red--}}
                            @if($teacher->id !== Auth::user()->id)
                            <a href="{{ route('manage.disable', $teacher->id) }}" class="btn btn-warning">{{ (!$teacher->disabled) ? 'Disable' : 'Enable' }}</a>
                            <a href="#" data-toggle="modal" data-target="#modalDelete" id="delete" class="btn btn-danger">Delete</a>
                            @else
                                <a title="To manage your profile, click here" href="{{ route('profile') }}" class="btn btn-success">Edit Profile</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @endisset

            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <div class="float-right">
            <a href="{{ route('manage.invite') }}" class="btn btn-success">Invite New Teacher</a>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>

        </div>
    </div>

</div>


<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align-last: center">You are trying to delete a teacher</h4>
            </div>

            <div class="modal-body">
                <h5>Delete {{ $teacher->name }}</h5>
                <p>Deleting a teacher is permanent</p>
                <form action="{{ route('manage.delete', $teacher->id) }}" method="post">
                    <input class="btn btn-danger" type="submit" value="Delete" />
                    @method('delete')
                    @csrf
                    <a href="" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        $( document ).on( "click", "#delete", function() {
            $('#deleteTeacher').modal('show');
        });
    </script>
@endsection

