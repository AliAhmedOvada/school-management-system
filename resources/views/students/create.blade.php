@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control"  name="student_name">
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" class="form-control">
                        @foreach ($all_users as $user)
                        <option value="{{   $user->id  }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
