@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Lecture</h1>
        <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="room_number">Room Number</label>
                <input type="number" id="room_number" name="room_number" value="{{  $lecture->room_number }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="user" class="form-label">Student</label>
                <select name="student_id" class="form-control">
                    @foreach ($all_students as $student)
                        <option value="{{ $student->id }} " {{ $student->id ? 'selected' : '' }}>
                            {{ $student->student_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user" class="form-label">Subject</label>
                <select name="subject_id" class="form-control">
                    @foreach ($all_subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $subject->id ? 'selected' : '' }}>{{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user" class="form-label">Class</label>
                <select name="class_id" class="form-control">
                    @foreach ($all_classes as $class)
                        <option value="{{ $class->id }}" {{ $class->id ? 'selected' : '' }}>{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file">File</label>
                <input type="file" id="file" name="file" class="form-control">
            </div>
            <br>
            <button type="submit" class="btn btn-success">Create Lecture</button>
        </form>

    </div>
@endsection
