@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Subjects</h1>
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">Add Subject</a>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->subject_name }}</td>
                        <td>{{ $subject->user->name }}</td>
                        <td>
                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display: inline-block;">
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
