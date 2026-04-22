<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card-login {
            border: none;
            border-radius: 25px; /* Ini yang bikin melengkung banget */
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 20px;
            border: 1px solid #eee;
        }
        .btn-login {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            background: #764ba2;
            border: none;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #5a3782;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card card-login p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Welcome</h3>
                        <p class="text-muted">Login ke sistem inventaris</p>
                    </div>

                    @if(session('Error'))
                        <div class="alert alert-danger rounded-3 text-sm">
                            {{ session('Error') }}
                        </div>
                    @endif

                    <form action="{{ route('login.proses') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@sekolah.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-login w-100 shadow-sm">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-4 text-white-50 small">
                &copy; 2026 SMK Bhina Karya Karanganyar
            </p>
        </div>
    </div>
</div>

</body>
</html>