@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Lms Detail</h1>
        <table class="table table-sm table-dark">
            <thead>
                <tr>
                    <th scope="col">Lectures Name</th>
                    <th scope="col">Lectures Pdf</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($lectures as $lecture)
                        <td>{{ $lecture->lecture_name }}
                        </td>
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
                    @endforeach
                </tr>

            </tbody>
        </table>

    </div>
@endsection
