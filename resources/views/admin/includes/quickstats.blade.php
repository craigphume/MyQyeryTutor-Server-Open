<div class="card mb-3">
    <div class="card-header">Monthly Quick Stats</div>

    <div class="card-body">
        <h4>Total Schools: {{ $totalSchools }}</h4>
        <h5>Monthly Stats</h5>
        <ul>

            <li>New Schools: {{ $newSchoolsCount }}</li>
            <li>New Classrooms: {{ $newClassroomsCount }}</li>
            <li>Total new results {{ $newResultsCount }}</li>
            <li>Total new verified teachers {{ $newTeachersVerifiedCount }}</li>
            <li>Total new invited teachers {{ $newTeachersInvitedCount }}</li>
        </ul>
    </div>

    <div class="card-footer">
        <div class="float-right">
            <a href="#" class="btn btn-primary">More Stats</a>
        </div>
    </div>
</div>
