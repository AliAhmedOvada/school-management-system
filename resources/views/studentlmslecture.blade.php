@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Lms Detail</h1>
        <table class="table table-sm table-dark">
            <thead>
                <tr>
                    <th scope="col">Lectures Assigned To Student</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select class="form-control" onchange="if (this.value) window.location.href = this.value;">
                            @foreach ($lectures->lectures as $lecture)
                                <option value="{{ route('lectureDetails', ['id' => $lecture->id]) }}" style="cursor: pointer; color: rgb(78, 169, 197); font-weight: bold;">
                                    {{ $lecture->lecture_name }}
                                </option>
                            @endforeach
                        </select>

                    </td>

                </tr>

            </tbody>
        </table>

    </div>
@endsection
