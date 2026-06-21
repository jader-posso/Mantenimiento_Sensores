<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#030853;--gold:#f4a261;--teal:#2ec4b6;--red:#e63946;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);display:grid;grid-template-columns:240px 1fr;min-height:100vh;}

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

        main{padding:2.5rem;overflow-y:auto;}
        .page-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:2.5rem;}
        .greeting{font-family:var(--font-display);font-size:2.2rem;letter-spacing:.03em;line-height:1;}
        .greeting span{color:var(--teal);}
        .date{font-family:var(--font-mono);font-size:.7rem;color:var(--muted);margin-top:.25rem;}

        .badge-count{font-family:var(--font-mono);font-size:.65rem;background:var(--red);color:var(--white);border-radius:99px;padding:.1rem .5rem;margin-left:auto;}

        .section-title{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.05em;margin:2rem 0 1rem;padding-bottom:.5rem;border-bottom:1px solid var(--border);}
        .section-title:first-of-type{margin-top:0;}

        .alert-list{display:flex;flex-direction:column;gap:.75rem;}
        .alert-item{background:var(--card);border:1px solid var(--border);padding:1rem 1.25rem;border-radius:4px;display:flex;align-items:center;gap:1rem;}
        .alert-item.falla{border-left:3px solid var(--red);}
        .alert-item.advertencia{border-left:3px solid var(--gold);}
        .alert-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;}
        .dot-red{background:var(--red);}
        .dot-gold{background:var(--gold);}
        .alert-body{flex:1;}
        .alert-name{font-weight:600;font-size:.9rem;}
        .alert-desc{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);margin-top:.3rem;line-height:1.5;}
        .badge{font-family:var(--font-mono);font-size:.6rem;letter-spacing:.1em;padding:.25rem .6rem;border-radius:2px;white-space:nowrap;}
        .badge-red{background:rgba(230,57,70,.1);color:var(--red);border:1px solid rgba(230,57,70,.3);}
        .badge-gold{background:rgba(244,162,97,.1);color:var(--gold);border:1px solid rgba(244,162,97,.3);}

        .empty-state{background:var(--card);border:1px dashed var(--border);border-radius:4px;padding:2.5rem;text-align:center;color:var(--muted);font-size:.875rem;}
        .empty-state .icon{font-size:2rem;margin-bottom:.75rem;}
    </style>
</head>
<body>

<aside>
    <div class="sidebar-brand">Auto <b>Sen</b></div>
    <nav class="sidebar-nav">
        <a href="/dashboard"        class="nav-item"><span class="nav-icon">🏠</span> Dashboard</a>
        <a href="/vehiculos"        class="nav-item"><span class="nav-icon">🚗</span> Mis Vehículos</a>
        <a href="/vehiculos/create" class="nav-item"><span class="nav-icon">➕</span> Agregar Vehículo</a>
        <a href="/sensores"         class="nav-item"><span class="nav-icon">📡</span> Sensores</a>
        <a href="/alertas"          class="nav-item active"><span class="nav-icon">🔔</span> Alertas
            @if($alertas->count() > 0)
                <span class="badge-count">{{ $alertas->count() }}</span>
            @endif
        </a>
        <a href="/historial"        class="nav-item"><span class="nav-icon">📊</span> Historial</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-chip">
            <div class="name">{{ $cliente->Nombre_cliente }} {{ $cliente->Apellido_cliente }}</div>
            <div class="role">{{ $cliente->Correo }}</div>
        </div>
        <form method="POST" action="/logout" style="margin-top:.5rem;">
            @csrf
            <button type="submit" class="logout-btn"><span>🚪</span> Cerrar sesión</button>
        </form>
    </div>
</aside>

<main>
    <div class="page-top">
        <div>
            <h1 class="greeting">ALERTAS <span>ACTIVAS</span></h1>
            <p class="date">Generadas automáticamente por el sistema de monitoreo</p>
        </div>
    </div>

    <p class="section-title">❌ FALLAS CRÍTICAS ({{ $fallas->count() }})</p>
    @if($fallas->count() > 0)
        <div class="alert-list">
            @foreach($fallas as $alerta)
                <div class="alert-item falla">
                    <div class="alert-dot dot-red"></div>
                    <div class="alert-body">
                        <div class="alert-name">{{ $alerta->sensor->Nombre_sensor }} — {{ $alerta->vehiculo->Nombre_vehiculo }}</div>
                        <div class="alert-desc">{{ $alerta->Mensaje }} · {{ \Carbon\Carbon::parse($alerta->Fecha_alerta)->diffForHumans() }}</div>
                    </div>
                    <span class="badge badge-red">FALLA</span>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="icon">✅</div>
            No tienes fallas críticas activas.
        </div>
    @endif

    <p class="section-title">⚠️ ADVERTENCIAS ({{ $advertencias->count() }})</p>
    @if($advertencias->count() > 0)
        <div class="alert-list">
            @foreach($advertencias as $alerta)
                <div class="alert-item advertencia">
                    <div class="alert-dot dot-gold"></div>
                    <div class="alert-body">
                        <div class="alert-name">{{ $alerta->sensor->Nombre_sensor }} — {{ $alerta->vehiculo->Nombre_vehiculo }}</div>
                        <div class="alert-desc">{{ $alerta->Mensaje }} · {{ \Carbon\Carbon::parse($alerta->Fecha_alerta)->diffForHumans() }}</div>
                    </div>
                    <span class="badge badge-gold">ADVERTENCIA</span>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="icon">✅</div>
            No tienes advertencias activas.
        </div>
    @endif

</main>

</body>
</html>