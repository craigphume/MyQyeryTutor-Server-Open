@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-header"><h4>"{{$school->name}}" Details{{ ($school->disabled) ? '- DISABLED' : '' }}</h4></div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <h5>Name: </h5>
                    <p class="ml-3">{{ $school->name }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <h5>Contact Person: </h5>
                    <p class="ml-3">{{ $school->contact }}</p>
                </div>
                <div class="col-sm">
                    <h5>Contact Email: </h5>
                    <p class="ml-3">{{ $school->email }}</p>
                </div>
                <div class="col-sm">
                    <h5>Contact Phone: </h5>
                    <p class="ml-3">{{ $school->phone }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <h5>Contact Address: </h5>
                    <p class="ml-3">{{ $school->address }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-sm">
                    <h5>Subscription Expiry: </h5>
                    <p class="ml-3">{{ $school->expiry->format('d M Y') }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="{{route('admin.school.edit', $school->id)}}" class="btn btn-primary">Edit</a>
                <a href="{{route('admin.school.disable', $school->id)}}" class="btn btn-warning">{{ (!$school->disabled) ? 'Disable' : 'Enable' }}</a>
{{--                <a href="#" data-toggle="modal" data-target="#modalDelete" id="delete" class="btn btn-danger">Delete</a>--}}
{{--                <a href="#deleteModalSchool" class="btn btn-danger" data-toggle="modal">Delete</a>--}}
                <button id="deleteSchoolButton" type="button" class="btn btn-danger">Delete</button>

                <a href="{{route('admin.home')}}" class="btn btn-secondary">Back</a>
            </div>
        </div>

    </div>


    <div class="card mb-3">
        <div class="card-header"><h4>Teachers</h4></div>

        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th style="width: 10%">Status</th>
                    <th>Verified</th>
                    <th style="width: 25%">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($school->user as $teacher)
                    <tr>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->disabled ? 'Disabled' : 'Enabled' }}</td>

                        <td>{{ ($teacher->email_verified_at) ? $teacher->email_verified_at->format('d M Y') : 'Not Verified'}}</td>
                        <td>
                            <a href="{{ route('admin.teacher.show', $teacher->id) }}" class="btn btn-primary">Show</a>
                            <a href="{{ route('admin.teacher.disable', $teacher->id) }}" class="btn btn-warning">{{ (!$teacher->disabled) ? 'Disable' : 'Enable' }}</a>
{{--                            <a href="" data-toggle="modal" data-target="#modalDelete" id="deleteTeacher" class="btn btn-danger">Delete</a>--}}
{{--                            <a href="#" id="deleteTeacherButton" class="btn btn-danger" data-toggle="modal">Delete</a>--}}
                            <button id="deleteTeacherButton" onclick="deleteTeacher({{ $teacher }})" type="button" class="btn btn-danger">Delete</button>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="{{ route('admin.teacher.showInvite', $school->id) }}" class="btn btn-success">Invite Teacher</a>
            </div>
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-header"><h4>Subscriptions</h4></div>

        <div class="card-body">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Time Remaining</th>
                    <th>Invoice Number</th>
{{--                    <th>Actions</th>--}}
                </tr>
                </thead>

                <tbody>
                    @foreach($school->subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->startdate->format('d M Y') }}</td>
                        <td>{{ $subscription->enddate->format('d M Y') }}</td>
                        <td>
                            {{ (\Carbon\Carbon::now()->diffInDays($subscription->enddate, false) <= 0)
                            ? '0'
                            : \Carbon\Carbon::now()->diffInDays($subscription->enddate, false)}}
                        </td>
                        <td>{{ $subscription->number }}</td>
{{--                        <td><a href="#" class="btn btn-success">Edit</a></td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">
            <div class="float-right">
                <a href="{{ route('admin.subscription.create', $school->id) }}" class="btn btn-success">New Subscription</a>
            </div>
        </div>
    </div>

        <div id="deleteModalTeacher" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="col-12 modal-title text-center" >You are trying to delete a teacher</h4>
                    </div>

                    <div class="modal-body">
                        <div id="deleteTeacherBody">

                        </div>
                    </div>

                </div>
            </div>
        </div>

    <div id="deleteModalSchool" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="col-12 modal-title text-center">You are trying to delete a school</h4>
                </div>

                <div class="modal-body">
                    <h5 class="text-center">Delete {{ $school->name }}</h5>
                    <p class="text-center">Deleting a school is permanent</p>
                    <form action="{{ route('admin.school.delete', $school->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <div class="float-right">
                            <input class="btn btn-danger" type="submit" value="Delete" />
                            <a href="" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function deleteTeacher(teacher) {
            var routePath = "{{ route('admin.teacher.delete', ":teacherID") }}";
            routePath = routePath.replace(':teacherID', teacher.id);
            $('#deleteTeacherBody').html(
                '<h5 class="text-center">Delete ' + teacher.name + '</h5>' +
                '<p class="text-center">Deleting a teacher is permanent</p>' +
                '<form action="' + routePath + '" method="post">' +
                '@method('delete')' +
                '@csrf' +
                '<div class="float-right">' +
                    '<input class="btn btn-danger" type="submit" value="Delete" />' +
                    '<button type="button" class="btn btn-secondary ml-1" data-dismiss="modal">Cancel</a>' +
                '</div>' +
                '</form>');

            $('#deleteModalTeacher').modal('show');
        }
        // $( document ).on( "click", "#deleteTeacherButton", function() {
        //     $('#deleteModalTeacher').modal('show');
        // });
        $( document ).on( "click", "#deleteSchoolButton", function() {
            $('#deleteModalSchool').modal('show');
        });
    </script>
@endsection
