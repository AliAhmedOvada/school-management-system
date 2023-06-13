@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Lecture</h1>
        <form action="{{ route('lectures.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Lecture Name</label>
                <input type="text"  name="lecture_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="user" class="form-label">Class</label>
                <select name="class_id" class="form-control">
                    @foreach ($all_classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file">Files</label>
                <input type="file" id="file" name="file[]" class="form-control" multiple>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Create Lecture</button>
        </form>

    </div>

@endsection
