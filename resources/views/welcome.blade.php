<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>



    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <form action="{{ route('getValue') }}" method="post">
        @csrf
        Enter Number: <input type="text" name="value">
        <br>
        <button type="submit">Test</button>
    </form>

    @if (session('result') !== null)
        <h1>Result: {{ session('result') }}</h1>
    @endif
</body>

</html>
