<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Time Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body class="bg-primary">
    <div class="position-absolute top-50 start-50 translate-middle container d-flex justify-content-center rounded-4" style="padding-top: 20px">
        <div class="card shadow rounded-4">
            <div class="card-body rounded-4">
            <form action="{{ route('makePassword') }}" method="POST" enctype="multipart/form-data" class="m-5">
                <h1 class="text-center">Login</h1>
                @csrf
                <div class="form-row mb-1">
                    <div class="p-2">
                        <label for="password" class="mb-1">Create Password</label>
                        <input name="password" type="password" class="form-control" id="formGroupExampleInput" autofocus placeholder="Insert your password" value="{{ old('password') }}">
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row mb-4 d-grid p-2">
                    <button type="submit" class="btn btn-primary">Confirm Password</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</body>
</html>