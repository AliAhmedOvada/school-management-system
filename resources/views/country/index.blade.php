@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                {{-- <th>Departments</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
            <tr>
                <td>{{ $country->id }}</td>
                <td>{{ $country->name }}</td>
                {{-- <td>
                    <ul>
                        @foreach ($country->departments as $department)
                        <li>{{ $department->name }}</li>
                        @endforeach
                    </ul>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $countries->links() }}
</div>
@endsection
