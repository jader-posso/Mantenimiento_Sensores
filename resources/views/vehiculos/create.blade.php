<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehículo — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#030853;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);display:grid;grid-template-columns:240px 1fr;min-height:100vh;}

        /* Sidebar */
        aside{background:var(--dark);border-right:1px solid var(--border);padding:2rem 1.5rem;display:flex;flex-direction:column;gap:2rem;}
        .sidebar-brand{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.05em;}
        .sidebar-brand b{color:var(--accent);}
        nav.sidebar-nav{display:flex;flex-direction:column;gap:.25rem;}
        .nav-item{display:flex;align-items:center;gap:.75rem;padding:.65rem .85rem;border-radius:4px;font-size:.875rem;color:var(--muted);text-decoration:none;transition:background .2s,color .2s;}
        .nav-item:hover,.nav-item.active{background:rgba(3,8,83,.15);color:var(--white);}
        .nav-item.active{border-left:2px solid var(--accent);padding-left:.6rem;}
        .nav-icon{font-size:1rem;width:20px;text-align:center;}
        .sidebar-footer{margin-top:auto;}
        .user-chip{background:var(--card);border:1px solid var(--border);padding:.75rem;border-radius:4px;font-size:.8rem;}
        .user-chip .name{font-weight:600;}
        .user-chip .role{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.1em;}
        .logout-btn{background:none;border:none;color:var(--muted);font-family:var(--font-body);font-size:.85rem;cursor:pointer;padding:.65rem .85rem;width:100%;text-align:left;display:flex;align-items:center;gap:.75rem;border-radius:4px;transition:background .2s,color .2s;}
        .logout-btn:hover{background:rgba(230,57,70,.08);color:#e63946;}

        /* Main */
        main{padding:2.5rem;overflow-y:auto;}
        .page-top{margin-bottom:2.5rem;}
        .page-title{font-family:var(--font-display);font-size:2.2rem;letter-spacing:.03em;line-height:1;}
        .page-title span{color:var(--accent);}
        .page-sub{font-family:var(--font-mono);font-size:.7rem;color:var(--muted);margin-top:.25rem;}

        /* Form card */
        .form-card{background:var(--card);border:1px solid var(--border);border-radius:4px;padding:2rem;max-width:700px;}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
        .form-group{display:flex;flex-direction:column;gap:.5rem;}
        .form-group.full{grid-column:1/-1;}
        label{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;}
        input,select{width:100%;background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.85rem 1rem;font-family:var(--font-body);font-size:.95rem;border-radius:2px;outline:none;transition:border-color .2s;}
        input:focus,select:focus{border-color:var(--accent);}
        input::placeholder{color:var(--muted);}
        select option{background:var(--dark);}

        .form-actions{display:flex;gap:1rem;margin-top:2rem;}
        .btn-submit{background:var(--accent);color:#fff;border:none;padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;transition:opacity .2s;}
        .btn-submit:hover{opacity:.85;}
        .btn-cancel{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;text-decoration:none;display:flex;align-items:center;transition:border-color .2s,color .2s;}
        .btn-cancel:hover{border-color:var(--white);color:var(--white);}

        .alert-error{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);padding:.75rem 1rem;border-radius:2px;font-size:.85rem;color:#e63946;margin-bottom:1.5rem;}
    </style>
</head>
<body>

<aside>
    <div class="sidebar-brand">Auto <b>Sen</b></div>

    <nav class="sidebar-nav">
        <a href="/dashboard"        class="nav-item active"><span class="nav-icon">🏠</span> Dashboard</a>
        <a href="/vehiculos"        class="nav-item"><span class="nav-icon">🚗</span> Mis Vehículos</a>
        <a href="/vehiculos/create" class="nav-item"><span class="nav-icon">➕</span> Agregar Vehículo</a>
        <a href="/sensores"         class="nav-item"><span class="nav-icon">📡</span> Sensores</a>
        <a href="/alertas"          class="nav-item"><span class="nav-icon">🔔</span> Alertas</a>
        <a href="/historial"        class="nav-item"><span class="nav-icon">📊</span> Historial</a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="name">{{ Auth::user()->Nombre_cliente }} {{ Auth::user()->Apellido_cliente }}</div>
            <div class="role">{{ Auth::user()->Correo }}</div>
        </div>
        <form method="POST" action="/logout" style="margin-top:.5rem;">
            @csrf
            <button type="submit" class="logout-btn"><span>🚪</span> Cerrar sesión</button>
        </form>
    </div>
</aside>

<main>
    <div class="page-top">
        <h1 class="page-title">AGREGAR <span>VEHÍCULO</span></h1>
        <p class="page-sub">Completa los datos de tu vehículo</p>
    </div>

    @if($errors->any())
        <div class="alert-error">⚠ {{ $errors->first() }}</div>
    @endif

    <div class="form-card">
        <form method="POST" action="/vehiculos">
            @csrf
            <div class="form-grid">

                <div class="form-group full">
                    <label>Nombre del vehículo</label>
                    <input type="text" name="Nombre_vehiculo" placeholder="Ej: Mi Toyota" required value="{{ old('Nombre_vehiculo') }}">
                </div>

                <div class="form-group">
                    <label>Marca</label>
                    <input type="text" name="Marca" placeholder="Ej: Toyota" required value="{{ old('Marca') }}">
                </div>

                <div class="form-group">
                    <label>Modelo (año)</label>
                    <input type="text" name="Modelo" placeholder="Ej: 2020" required value="{{ old('Modelo') }}">
                </div>

                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="Color" placeholder="Ej: Rojo" required value="{{ old('Color') }}">
                </div>

                <div class="form-group">
                    <label>Placa</label>
                    <input type="text" name="Placa" placeholder="Ej: ABC123" required value="{{ old('Placa') }}">
                </div>

                <div class="form-group full">
                    <label>Tipo de placa</label>
                    <select name="Tipo_placa" required>
                        <option value="" disabled selected>Selecciona un tipo</option>
                        <option value="Particular"  {{ old('Tipo_placa') == 'Particular'  ? 'selected' : '' }}>Particular</option>
                        <option value="Público"     {{ old('Tipo_placa') == 'Público'     ? 'selected' : '' }}>Público</option>
                       
                    </select>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">GUARDAR VEHÍCULO</button>
                <a href="/dashboard" class="btn-cancel">CANCELAR</a>
            </div>
        </form>
    </div>
</main>

</body>
</html>