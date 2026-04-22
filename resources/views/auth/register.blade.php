<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIM Inventaris</title>
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
        .card-register {
            border: none;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .form-control {
            border-radius: 12px;
            padding: 10px 20px;
            border: 1px solid #eee;
        }
        .btn-register {
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            background: #764ba2;
            border: none;
            transition: 0.3s;
        }
        .btn-register:hover {
            background: #5a3782;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-register p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Join Us!</h3>
                        <p class="text-muted">Buat akun untuk mulai meminjam</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger rounded-4 border-0 small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register_proses') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@sekolah.com" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Minimal 5 karakter" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-register w-100 shadow-sm mb-3">
                            Create Account
                        </button>

                        <div class="text-center">
                            <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: #764ba2;">Login di sini</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>