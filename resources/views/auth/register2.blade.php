<html>
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="row justify-content-around">

    <div class="col-3">

        <div class="col-12">
            <div class="card text-white mb-3">
                <div class="card-header bg-success text-white"><i class="bi bi-capsule-pill"></i>{{ env('APP_NAME') }} - Setup</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-text">Username</label>
                            @foreach($errors->get('username') as $error)
                                <br>
                                <label for="error" class="form-text text-danger">{{ $error }}</label>
                            @endforeach
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-text">Password</label>
                            @foreach($errors->get('password') as $error)
                                <br>
                                <label for="error" class="form-text text-danger">{{ $error }}</label>
                            @endforeach
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-text">Retype Password</label>
                            @foreach($errors->get('password_confirmation') as $error)
                                <br>
                                <label for="error" class="form-text text-danger">{{ $error }}</label>
                            @endforeach
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
