@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Class Details</h1>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <p>{{ $class->name }}</p>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <p>{{ $class->description }}</p>
        </div>
        <a href="{{ route('classes.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
