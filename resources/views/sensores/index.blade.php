<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#030853;--teal:#2ec4b6;--gold:#f4a261;--red:#e63946;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
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
        .page-top{margin-bottom:2.5rem;}
        .page-title{font-family:var(--font-display);font-size:2.2rem;letter-spacing:.03em;line-height:1;}
        .page-title span{color:var(--teal);}
        .page-sub{font-family:var(--font-mono);font-size:.7rem;color:var(--muted);margin-top:.25rem;}

        /* Sensor list */
        .sensor-list{display:flex;flex-direction:column;gap:1rem;}
        .sensor-card{background:var(--card);border:1px solid var(--border);padding:1.5rem;border-radius:4px;transition:border-color .25s;}
        .sensor-card:hover{border-color:rgba(46,196,182,.3);}
        .sensor-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem;}
        .sensor-info{}
        .sensor-name{font-family:var(--font-display);font-size:1.2rem;letter-spacing:.05em;}
        .sensor-tipo{font-family:var(--font-mono);font-size:.65rem;color:var(--teal);letter-spacing:.1em;text-transform:uppercase;margin-top:.2rem;}
        .sensor-nivel{font-family:var(--font-display);font-size:2rem;letter-spacing:.05em;}

        /* Barra de progreso */
        .bar-wrap{margin-bottom:.75rem;}
        .bar-labels{display:flex;justify-content:space-between;margin-bottom:.4rem;}
        .bar-label{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.08em;}
        .bar-track{background:var(--dark);border-radius:99px;height:8px;overflow:hidden;}
        .bar-fill{height:100%;border-radius:99px;transition:width 1s ease;}

        /* Estado / fallo */
        .sensor-estado{display:flex;align-items:center;gap:.5rem;margin-top:.75rem;padding:.5rem .75rem;border-radius:2px;font-family:var(--font-mono);font-size:.7rem;letter-spacing:.08em;}
        .estado-ok{background:rgba(46,196,182,.1);color:var(--teal);border:1px solid rgba(46,196,182,.2);}
        .estado-warn{background:rgba(244,162,97,.1);color:var(--gold);border:1px solid rgba(244,162,97,.2);}
        .estado-err{background:rgba(230,57,70,.1);color:var(--red);border:1px solid rgba(230,57,70,.2);}
        .estado-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
        .dot-ok{background:var(--teal);}
        .dot-warn{background:var(--gold);}
        .dot-err{background:var(--red);}
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
        <h1 class="page-title">MIS <span>SENSORES</span></h1>
        <p class="page-sub">Estado actual de los sensores del vehículo</p>
    </div>

    @if($sensores->count() > 0)
        <div class="sensor-list">
            @foreach($sensores as $s)

            @php
                $nivel = $s->Nivel ?? 0;

                // Color de la barra según nivel
                if ($nivel >= 70) {
                    $color     = '#e63946'; // rojo — falla
                    $clase     = 'estado-err';
                    $dotClase  = 'dot-err';
                    $estadoTxt = '⚠ FALLA DETECTADA — ' . $s->Tipo_daño;
                } elseif ($nivel >= 40) {
                    $color     = '#f4a261'; // naranja — advertencia
                    $clase     = 'estado-warn';
                    $dotClase  = 'dot-warn';
                    $estadoTxt = '⚡ ADVERTENCIA — Revisar ' . $s->Nombre_sensor;
                } else {
                    $color     = '#2ec4b6'; // verde — ok
                    $clase     = 'estado-ok';
                    $dotClase  = 'dot-ok';
                    $estadoTxt = '✓ FUNCIONANDO CORRECTAMENTE';
                }
            @endphp

            <div class="sensor-card">
                <div class="sensor-top">
                    <div class="sensor-info">
                        <div class="sensor-name">{{ $s->Nombre_sensor }}</div>
                        <div class="sensor-tipo">{{ $s->Tipo_sensor }}</div>
                    </div>
                    <div class="sensor-nivel" style="color:{{ $color }}">{{ $nivel }}%</div>
                </div>

                <div class="bar-wrap">
                    <div class="bar-labels">
                        <span class="bar-label">0%</span>
                        <span class="bar-label">50%</span>
                        <span class="bar-label">100%</span>
                    </div>
                    <div class="bar-track">
                        <div class="bar-fill" style="width:{{ $nivel }}%; background:{{ $color }};"></div>
                    </div>
                </div>

                <div class="sensor-estado {{ $clase }}">
                    <div class="estado-dot {{ $dotClase }}"></div>
                    {{ $estadoTxt }}
                </div>
            </div>

            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:3rem;color:var(--muted);background:var(--card);border:1px dashed var(--border);border-radius:4px;">
            <p style="font-size:2rem;margin-bottom:.75rem;">📡</p>
            <p>No hay sensores registrados.</p>
        </div>
    @endif
</main>

</body>
</html>