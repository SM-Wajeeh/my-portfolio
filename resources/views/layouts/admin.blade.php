<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel – W.HAIDER</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <style>
    :root { --accent: #00bfff; }
    body  { background: #0d0d0d; color: #e0e0e0; min-height: 100vh; }

    /* Sidebar */
    .sidebar {
      width: 220px; min-height: 100vh;
      background: #111; border-right: 1px solid #222;
      position: fixed; top: 0; left: 0;
      display: flex; flex-direction: column;
    }
    .sidebar-brand {
      padding: 1.4rem 1.2rem;
      font-family: 'Courier New', monospace;
      font-size: 1.1rem; font-weight: 700;
      color: var(--accent); letter-spacing: .05em;
      border-bottom: 1px solid #222;
    }
    .sidebar-brand span { color: #fff; }
    .sidebar nav a {
      display: flex; align-items: center; gap: .6rem;
      padding: .75rem 1.2rem;
      color: #aaa; text-decoration: none;
      font-size: .88rem; transition: all .15s;
    }
    .sidebar nav a:hover,
    .sidebar nav a.active { color: var(--accent); background: #191919; }
    .sidebar nav a i { font-size: 1rem; }
    .back-link {
      margin-top: auto; padding: 1rem 1.2rem;
      font-size: .78rem; color: #555;
      border-top: 1px solid #222;
    }
    .back-link a { color: #555; text-decoration: none; }
    .back-link a:hover { color: var(--accent); }

    /* Main content */
    .main-content { margin-left: 220px; padding: 2rem; }

    /* Cards & tables */
    .admin-card {
      background: #161616; border: 1px solid #252525;
      border-radius: 10px; padding: 1.5rem;
    }
    .table { --bs-table-bg: transparent; --bs-table-color: #ccc; }
    .table thead th { border-color: #2a2a2a; color: #777; font-size: .78rem; text-transform: uppercase; letter-spacing: .07em; }
    .table tbody td { border-color: #1e1e1e; vertical-align: middle; }
    .table tbody tr:hover td { background: #191919; }

    /* Buttons */
    .btn-accent  { background: var(--accent); color: #000; border: none; }
    .btn-accent:hover { background: #00aadd; color: #000; }
    .btn-outline-accent { border: 1px solid var(--accent); color: var(--accent); background: transparent; }
    .btn-outline-accent:hover { background: var(--accent); color: #000; }

    /* Form controls */
    .form-control, .form-select {
      background: #111; border: 1px solid #2a2a2a;
      color: #e0e0e0;
    }
    .form-control:focus, .form-select:focus {
      background: #111; color: #e0e0e0;
      border-color: var(--accent);
      box-shadow: 0 0 0 2px rgba(0,191,255,.15);
    }
    .form-label { color: #888; font-size: .83rem; }

    /* Alert */
    .alert-success { background: #0d2a1a; border-color: #1a5c37; color: #4ade80; }

    /* Badge */
    .badge-stack {
      background: rgba(0,191,255,.1); color: var(--accent);
      font-size: .7rem; padding: .25em .55em; border-radius: 4px;
    }

    /* Proficiency bar (mini) */
    .prof-bar { height: 4px; background: #222; border-radius: 2px; }
    .prof-bar-fill { height: 100%; background: var(--accent); border-radius: 2px; }

    @media (max-width: 768px) {
      .sidebar { display: none; }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-brand">W<span>.</span>HAIDER <span style="font-size:.65rem;color:#555;">Admin</span></div>
  <nav>
    <a href="{{ route('admin.skills.index') }}"
       class="{{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
      <i class="bi bi-lightning-charge"></i> Skills
    </a>
    <a href="{{ route('admin.projects.index') }}"
       class="{{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
      <i class="bi bi-layers"></i> Projects
    </a>
  </nav>
  <div class="back-link">
    <a href="/"><i class="bi bi-arrow-left me-1"></i>View Portfolio</a>
  </div>
</div>

<div class="main-content">
  @if(session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-3 py-2">
      <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
  @endif

  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
