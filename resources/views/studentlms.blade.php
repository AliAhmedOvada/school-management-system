@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Lms Detail</h1>
        <table class="table table-sm table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Classess</th>
                    {{-- <th scope="col">Lecture Assigned</th> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    @foreach ($student_lms as $key => $student)
                        <td>{{ $student->student_name }}</td>
                        <td style="width: 532px;">
                            <select class="form-control" onchange="if (this.value) window.location.href = this.value;">
                                @foreach ($student->classes as $class)
                                    <option value="{{ route('showLectures', ['id' => $class->id]) }}"
                                        style="cursor: pointer; color: blue; font-weight: bold;">
                                        {{ $class->class_name }}
                                    </option>
                                @endforeach
                            </select>



                        </td>
                        {{-- <td>
                            @foreach ($student->classes as $class)
                                @foreach ($class->lectures as $lecture)

                                {{ $lecture->lecture_name }}
                                @endforeach
                            @endforeach
                        </td> --}}
                    @endforeach

                </tr>

            </tbody>
        </table>

    </div>
@endsection
