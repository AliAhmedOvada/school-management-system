@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Class</h1>

        <form action="{{ route('classes.update', $class->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="class_name" class="form-control" id="name" value="{{ $class->class_name }}" required>
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" class="form-control">
                        @foreach ($username as $user)
                            <option value="{{   $user->id  }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
