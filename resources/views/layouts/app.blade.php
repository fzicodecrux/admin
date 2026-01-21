<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>@yield('title')</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<style>

/* ===== GLOBAL BACKGROUND ===== */
body{
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* ===== NAVBAR ===== */
.navbar{
    background: linear-gradient(90deg,#1f2933,#111827);
}

/* ===== DASHBOARD CONTAINER ===== */
.dashboard-bg{
    background: linear-gradient(135deg,#f8fafc,#eef2f7);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,.06);
}

/* ===== CARD STYLE ===== */
.card{
    border: none;
    border-radius: 18px;
    transition: all .25s ease;
}

.card:hover{
    transform: translateY(-5px);
    box-shadow: 0 14px 30px rgba(0,0,0,.12);
}

/* ===== SUMMARY CARD ===== */
.card-summary{
    background: linear-gradient(135deg,#2f6f5e,#245a4a);
    color: white;
}

.card-summary small{
    opacity: .85;
}

/* ===== BUTTON ===== */
.btn-primary{
    background: linear-gradient(135deg,#2563eb,#1d4ed8);
    border: none;
}

.btn-success{
    background: linear-gradient(135deg,#16a34a,#15803d);
    border: none;
}
/* ===== PROJECT CARD ===== */

</style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container d-flex justify-content-between">

        <!-- LEFT SIDE -->
        <div class="d-flex align-items-center gap-3">

            {{-- TOMBOL BACK --}}
            @if(!request()->is('/'))
                <a href="{{ route('dashboard') }}"
                   class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i>
                </a>
            @endif

            {{-- LOGO / TITLE --}}
            <span class="navbar-brand mb-0 h1">
                💼 Proyek Keuangan
            </span>

        </div>

        <!-- RIGHT SIDE -->
        <span class="text-white">Dashboard</span>

    </div>
</nav>


<div class="container my-4">
    @yield('content')
</div>

</body>
</html>
