@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Users</h1>
        @if (Session::has('success'))
            <div class="alert alert-success" id="success-message">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
            </thead>
            <tbody>
                @if (auth()->user()->isAdmin())
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->status === 'pending')
                                    <span class="text-danger">{{ $user->status }}</span>
                                @else
                                    <span class="text-success">{{ $user->status }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="form-select">
                                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @elseif (auth()->user()->isTeacher())
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->status }}</td>
                            <td>
                                <select name="status" onchange="this.form.submit()" class="form-select">
                                    <option value="active" {{ $teacher->status === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="pending" {{ $teacher->status === 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                @elseif (auth()->check() && auth()->user()->role_id == 3)
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->status }}</td>
                            <td>
                                <select name="status" onchange="this.form.submit()" class="form-select">
                                    <option value="active" {{ $student->status === 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="pending" {{ $student->status === 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').fadeOut('slow');
            }, 3000); // Adjust the time in milliseconds (e.g., 3000 = 3 seconds)
        });
    </script>
@endsection
