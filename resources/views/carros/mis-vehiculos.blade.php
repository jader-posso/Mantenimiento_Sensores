<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Vehículos — AutoSen</title>
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
        .page-top{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:2.5rem;}
        .page-title{font-family:var(--font-display);font-size:2.2rem;letter-spacing:.03em;line-height:1;}
        .page-title span{color:var(--accent);}
        .page-sub{font-family:var(--font-mono);font-size:.7rem;color:var(--muted);margin-top:.25rem;}
        .btn-sm{background:var(--accent);color:#fff;border:none;padding:.45rem 1rem;border-radius:2px;font-family:var(--font-mono);font-size:.7rem;letter-spacing:.1em;cursor:pointer;text-decoration:none;transition:opacity .2s;}
        .btn-sm:hover{opacity:.85;}

        .table-wrap{background:var(--card);border:1px solid var(--border);border-radius:4px;overflow:hidden;}
        table{width:100%;border-collapse:collapse;}
        thead{background:var(--dark);}
        th{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;padding:1rem 1.25rem;text-align:left;border-bottom:1px solid var(--border);}
        td{padding:1rem 1.25rem;font-size:.875rem;border-bottom:1px solid var(--border);}
        tr:last-child td{border-bottom:none;}
        tr:hover td{background:rgba(255,255,255,.02);}
        .td-mono{font-family:var(--font-mono);font-size:.75rem;color:var(--muted);}
        .td-placa{font-family:var(--font-mono);font-size:.75rem;background:rgba(255,255,255,.05);padding:.2rem .5rem;border-radius:2px;display:inline-block;}
        .td-tipo{font-family:var(--font-mono);font-size:.65rem;color:var(--teal);letter-spacing:.08em;}

        .empty-state{text-align:center;padding:3rem;color:var(--muted);background:var(--card);border:1px dashed var(--border);border-radius:4px;}
        .empty-state a{color:var(--accent);text-decoration:none;}
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
        <div>
            <h1 class="page-title">MIS <span>VEHÍCULOS</span></h1>
            <p class="page-sub">{{ $vehiculos->count() }} vehículo(s) registrado(s)</p>
        </div>
        <a href="/vehiculos/create" class="btn-sm">+ AGREGAR</a>
    </div>

    @if($vehiculos->count() > 0)
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Vehículo</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Placa</th>
                        <th>Tipo placa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculos as $v)
                    <tr>
                        <td><strong>{{ $v->Nombre_vehiculo }}</strong></td>
                        <td class="td-mono">{{ $v->Marca }}</td>
                        <td class="td-mono">{{ \Carbon\Carbon::parse($v->Modelo)->format('Y') }}</td>
                        <td class="td-mono">{{ $v->Color }}</td>
                        <td><span class="td-placa">{{ $v->Placa }}</span></td>
                        <td><span class="td-tipo">{{ $v->Tipo_placa }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p style="font-size:2rem;margin-bottom:.75rem;">🚗</p>
            <p>Aún no tienes vehículos registrados.</p>
            <p style="margin-top:.5rem;"><a href="/vehiculos/create">Agrega tu primer vehículo →</a></p>
        </div>
    @endif
</main>

</body>
</html>