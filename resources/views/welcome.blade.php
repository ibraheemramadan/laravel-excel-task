<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Upload Excel File</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>

            <div class="container">

                <div class="card mt-5">

                    <div class="card-header">
                        Featured
                    </div>
                    <div class="card-body">


                        @if(session()->has('success'))
                            <p class="alert alert-info" role="alert">{{ session()->get('success') }}</p>
                        @endif

{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            This is a success alert—check it out!--}}
{{--                        </div>--}}

                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Import users file: </label>
                                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif

                            </div>

                            <button type="submit" class="btn btn-primary">Import users file</button>

                        </form>


                    </div>
                </div>

            </div>

    </body>
</html>
