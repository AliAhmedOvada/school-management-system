@extends('layouts.app')

@section('content')
    <div class="container">
        @if (auth()->user()->isAdmin() ||
                auth()->user()->isTeacher())
            <h1>Lectures</h1>
            <a href="{{ route('lectures.create') }}" class="btn btn-primary"
                style="background-color: cadetblue;
            border-color: black;">Add Lecture</a>
        @endif
        <table class="table table-striped table-dark mt-4 ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Lecture Name</th>
                    <th>Class</th>
                    <th>File</th>
                    @if (auth()->user()->isAdmin() ||
                            auth()->user()->isTeacher())
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($lectures as $lecture)
                    @if (auth()->user()->role_id == 3)
                        <tr>
                            <td>{{ $lecture->id }}</td>
                            <td>{{ $lecture->lecture_name }}</td>
                            <td>{{ $lecture->classModel->class_name }}</td>
                            <td>
                                @foreach ($lecture->files as $file)
                                    <?php
                                    $fileName = pathinfo($file->file_name, PATHINFO_FILENAME); // Extract the file name without the extension
                                    $fileName = preg_replace('/^[0-9]+_/', '', $fileName); // Remove the timestamp prefix
                                    ?>
                                    <a style="text-decoration: none; color:red"
                                        href="{{ Storage::url('lectures/' . $file->file_name) }}" target="_blank">
                                        <i class="fas fa-file-pdf"></i> <!-- Font Awesome icon for PDF file -->
                                        {{ ucfirst($fileName) }}
                                    </a>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @if (auth()->user()->isAdmin() ||
                                        auth()->user()->isTeacher())
                                    <a class="btn btn-outline-danger"
                                        href="{{ route('lectures.edit', $lecture->id) }}">Edit</a>
                                    <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-success "
                                            style="background-color: cadetblue;
                                        border-color: black;"
                                            type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @elseif (in_array(auth()->user()->role_id, [1, 2]))
                        <tr>
                            <td>{{ $lecture->id }}</td>
                            <td>{{ $lecture->lecture_name }}</td>
                            <td>{{ $lecture->classModel->class_name }}</td>
                            <td>
                                @foreach ($lecture->files as $file)
                                    <?php
                                    $fileName = pathinfo($file->file_name, PATHINFO_FILENAME); // Extract the file name without the extension
                                    $fileName = preg_replace('/^[0-9]+_/', '', $fileName); // Remove the timestamp prefix
                                    ?>
                                    <a style="text-decoration: none; color:red"
                                        href="{{ Storage::url('lectures/' . $file->file_name) }}" target="_blank">
                                        <i class="fas fa-file-pdf"></i> <!-- Font Awesome icon for PDF file -->
                                        {{ ucfirst($fileName) }}
                                    </a>
                                    <br>
                                @endforeach
                            </td>
                            <td>
                                @if (auth()->user()->isAdmin() ||
                                        auth()->user()->isTeacher())
                                    <a class="btn btn-outline-danger"
                                        style="background-color: cadetblue;
                                    border-color: black;"
                                        href="{{ route('lectures.edit', $lecture->id) }}">Edit</a>
                                    <form action="{{ route('lectures.destroy', $lecture->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-success"
                                            style="background-color: cadetblue;
                                        border-color: black;"
                                            type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
