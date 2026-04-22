<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIM Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        .sidebar { height: 100vh; width: 250px; position: fixed; background: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { padding: 15px 25px; text-decoration: none; color: #bdc3c7; display: block; transition: 0.3s; }
        .sidebar a:hover { background: #34495e; color: white; }
        .main-content { margin-left: 250px; padding: 30px; }
        .card-stat { border: none; border-radius: 15px; transition: 0.3s; }
        .card-stat:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center mb-4">SIM Inventaris</h4>
    <a href="#">Dashboard</a>
    <a href="{{ route('barang.index') }}" class="{{ request()->is('barang*') ? 'bg-primary text-white' : '' }}">Data Barang</a>
   <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
    <i class="fas fa-tags"></i> <span>Kategori</span>
</a>
    <a href="#">Laporan</a>
    <hr>
    <form action="{{ route('logout') }}" method="POST" class="px-4 mt-3">
        @csrf
        <button class="btn btn-danger w-100 rounded-pill btn-sm">Logout</button>
    </form>
</div>

<div class="main-content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded-4 mb-4 px-3">
        <span class="navbar-brand mb-0 h1">Halo, {{ Auth::user()->name }}</span>
    </nav>

    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>