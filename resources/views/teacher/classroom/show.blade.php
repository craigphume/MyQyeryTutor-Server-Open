@extends('layouts.app')

@section('content')
<div class="card mb-3">
    <div class="card-header"><h4>Classroom Details</h4></div>

    <div class="card-body">
        <div class="row">
            <div class="col-sm">
                <h5>Name: </h5>
                <p class="ml-3">{{ $classroom->name }}</p>
            </div>
            <div class="col-sm">
                <h5>Code: </h5>
                <p class="ml-3">{{ $classroom->code }}</p>
            </div>
            <div class="col-sm">
                <h5>Date Created: </h5>
                <p class="ml-3">{{ $classroom->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="float-right">
            <a href="{{route('classroom.edit', $classroom->id)}}" class="btn btn-primary">Edit</a>
            <a href="#" data-toggle="modal" data-target="#modalDelete" id="delete" class="btn btn-danger">Delete</a>
            <a href="{{route('classroom')}}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h4>Students</h4></div>

    <div class="card-body">
        @include('teacher.classroom.partials.studenttable')
    </div>

    <div class="card-footer">

    </div>
</div>

{{--<div class="card mb-3">--}}
{{--    <div class="card-header"><h4>Results</h4></div>--}}

{{--    <div class="card-body">--}}

{{--        <canvas id="barChart"></canvas>--}}

{{--    </div>--}}

{{--    <div class="card-footer">--}}

{{--    </div>--}}
{{--</div>--}}


<div class="card mb-3">
    <div class="card-header"><h4>Results</h4></div>

    <div class="card-body">


        <ul class="nav nav-tabs" id="resultsTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="home" aria-selected="true">Students</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="questions-tab" data-toggle="tab" href="#questions" role="tab" aria-controls="profile" aria-selected="false">Questions</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="students" role="tabpanel" aria-labelledby="home-tab">
                <div>
                    <canvas id="studentChart"></canvas>
                </div>
            </div>
            <div class="tab-pane fade" id="questions" role="tabpanel" aria-labelledby="profile-tab">
                <div class="wrapper"  style="overflow: scroll">
                    <div class="chartWrapper" style="width: 2600px">
                        <canvas id="questionChart" height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-footer">

    </div>
</div>




<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align-last: center">You are trying to delete a classroom</h4>
            </div>

            <div class="modal-body">
                <h5>Delete {{ $classroom->name }}</h5>
                <p>Deleting a classroom is permanent</p>
                <form action="{{ route('classroom.delete', $classroom->id) }}" method="post">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>


    <script>
        $( document ).on( "click", "#delete", function() {
            $('#deleteClassroom').modal('show');
        });
    </script>

    <script>
        $('#myTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>

    <script>
        var ctx = document.getElementById("studentChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($studentsResults['students'] as $k => $studentsResult)
                    {!! '"' . $k . '",' !!}
                    @endforeach
                ],
                datasets: [
                    {
                        label: 'Pass',
                        data: [
                            @foreach($studentsResults['students'] as $k => $studentsResult)
                            {!! '"' . $studentsResult['pass'] . '", ' !!}
                            @endforeach                        ],
                        backgroundColor: '#D6E9C6'
                    },
                    {
                        label: 'Not Passed',
                        data: [
                            @foreach($studentsResults['students'] as $k => $studentsResult)
                            {!! '"' . $studentsResult['fail'] . '", ' !!}
                            @endforeach
                        ],
                        backgroundColor: '#EBCCD1'
                    },
                    {
                        label: 'No Attempt',
                        data: [
                            @foreach($studentsResults['students'] as $k => $studentsResult)
                            {!! '"' . ( $studentsResults['questionCount'] - ($studentsResult['pass'] + $studentsResult['fail']) ) . '", ' !!}
                            @endforeach

                            ],
                        backgroundColor: '#FAEBCC'
                    },

                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            autoSkip: false
                        },
                    }],
                    yAxes: [{ stacked: true }]
                }
            }
        });

    </script>

    <script>
        var ctx = document.getElementById("questionChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($questionResults['questions'] as $k => $questionResult)
                    {!! '"' . $k . '",' !!}
                    @endforeach

                ],
                datasets: [
                    {
                        label: 'Pass',
                        data: [
                            @foreach($questionResults['questions'] as $k => $questionResult)
                            {!! '"' . $questionResult['pass'] . '", ' !!}
                            @endforeach
                        ],
                        backgroundColor: '#D6E9C6'
                    },
                    {
                        label: 'Not Passed',
                        data: [
                            @foreach($questionResults['questions'] as $k => $questionResult)
                            {!! '"' . $questionResult['fail'] . '", ' !!}
                            @endforeach
                        ],
                        backgroundColor: '#EBCCD1'
                    },
                    {
                        label: 'No Attempt',
                        data: [
                            @foreach($questionResults['questions'] as $k => $questionResult)
                            {!! '"' . ( $questionResults['studentCount'] - ($questionResult['pass'] + $questionResult['fail']) ) . '", ' !!}
                            @endforeach
                        ],
                        backgroundColor: '#FAEBCC'
                    },

                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            autoSkip: false
                        },
                    }],
                    yAxes: [{ stacked: true }]
                }
            }
        });
    </script>


@endsection
