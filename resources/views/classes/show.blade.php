@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Class Details</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Class Name</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Lecture Assigned</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <th>{{ $class->class_name }}</th>
                        <th scope="row">{{ $student->student_name }}</th>
                        <th>
                            <select class="form-control">
                                @foreach ($lectureIds as $lectureId)
                                    <option value="">{{ $lectureId }}</option>
                                @endforeach
                            </select>
                        </th>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
