@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Students</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class Name</th>
                    {{-- <th>Lecture Assigned</th> --}}
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>
                            @foreach ($student->classes as $class)
                                {{ $class->class_name }}
                                <br>
                            @endforeach
                        </td>
                        {{-- <td>
                            @if ($student->classes->where('lecture_id', '!=', null)->count() > 0)
                                <select name="lecture_id" class="form-control">
                                    @foreach ($student->classes as $class)
                                        @if (isset($class->lecture_id))
                                            <option value="{{ $class->lecture_id }}">{{ $class->lecture_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif


                        </td> --}}
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
