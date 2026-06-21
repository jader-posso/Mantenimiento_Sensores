<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — AutoSen</title>
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

        /* Botón bluetooth */
        .btn-bluetooth{display:flex;align-items:center;gap:.5rem;background:rgba(46,196,182,.1);border:1px solid rgba(46,196,182,.3);color:var(--teal);padding:.6rem 1.2rem;border-radius:4px;font-family:var(--font-mono);font-size:.75rem;letter-spacing:.1em;cursor:pointer;transition:background .2s,border-color .2s;}
        .btn-bluetooth:hover{background:rgba(46,196,182,.2);border-color:var(--teal);}
        .bt-dot{width:8px;height:8px;border-radius:50%;background:var(--teal);animation:pulse 1.5s infinite;}
        @keyframes pulse{0%,100%{opacity:1;}50%{opacity:.3;}}

        /* Stats */
        .stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2.5rem;}
        .stat-card{background:var(--card);border:1px solid var(--border);padding:1.5rem;border-radius:4px;position:relative;overflow:hidden;}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
        .stat-card.ok::before{background:var(--teal);}
        .stat-card.warn::before{background:var(--gold);}
        .stat-card.err::before{background:var(--red);}
        .stat-card.total::before{background:var(--muted);}
        .sc-label{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.5rem;}
        .sc-value{font-family:var(--font-display);font-size:3rem;line-height:1;}
        .sc-value.ok{color:var(--teal);}
        .sc-value.warn{color:var(--gold);}
        .sc-value.err{color:var(--red);}

        /* Info cards */
        .info-title{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.05em;margin-bottom:1.25rem;}
        .info-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;margin-bottom:2.5rem;}
        .info-card{background:var(--card);border:1px solid var(--border);padding:1.5rem;border-radius:4px;display:flex;gap:1rem;align-items:flex-start;transition:border-color .25s;}
        .info-card:hover{border-color:rgba(3,8,83,.5);}
        .info-icon{font-size:1.8rem;flex-shrink:0;}
        .info-body{}
        .info-name{font-weight:700;font-size:.95rem;margin-bottom:.3rem;}
        .info-desc{font-size:.8rem;color:var(--muted);line-height:1.5;}

        /* Cómo funciona */
        .steps-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;}
        .step-card{background:var(--card);border:1px solid var(--border);padding:1.5rem;border-radius:4px;position:relative;}
        .step-num{font-family:var(--font-display);font-size:3rem;color:rgba(3,8,83,.4);line-height:1;margin-bottom:.5rem;}
        .step-title{font-weight:700;font-size:.95rem;margin-bottom:.4rem;}
        .step-desc{font-size:.8rem;color:var(--muted);line-height:1.5;}
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
            <h1 class="greeting">Hola, <span>{{ $cliente->Nombre_cliente }}</span></h1>
            <p class="date">{{ now()->locale('es')->isoFormat('dddd, D [de] MMMM YYYY') }}</p>
        </div>
        <button class="btn-bluetooth">
            <div class="bt-dot"></div>
            🔵 CONECTAR BLUETOOTH
        </button>
    </div>

    <!-- Stats -->
    <div class="stats-row">
        <div class="stat-card total">
            <div class="sc-label">Vehículos</div>
            <div class="sc-value">{{ $vehiculos->count() }}</div>
        </div>
        <div class="stat-card ok">
            <div class="sc-label">Sensores OK</div>
            <div class="sc-value ok">{{ $sensoresOk }}</div>
        </div>
        <div class="stat-card warn">
            <div class="sc-label">Advertencias</div>
            <div class="sc-value warn">{{ $sensoresAdvertencia }}</div>
        </div>
        <div class="stat-card err">
            <div class="sc-label">Fallas</div>
            <div class="sc-value err">{{ $sensoresFalla }}</div>
        </div>
    </div>

    <!-- Qué hace la plataforma -->
    <p class="info-title">¿QUÉ PUEDES HACER?</p>
    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">🚗</div>
            <div class="info-body">
                <div class="info-name">Gestión de Vehículos</div>
                <div class="info-desc">Registra y administra todos tus vehículos en un solo lugar. Consulta su información en cualquier momento.</div>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon">📡</div>
            <div class="info-body">
                <div class="info-name">Monitoreo de Sensores</div>
                <div class="info-desc">Visualiza el estado de cada sensor en tiempo real. Detecta advertencias y fallas antes de que se agraven.</div>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon">🔵</div>
            <div class="info-body">
                <div class="info-name">Conexión Bluetooth</div>
                <div class="info-desc">Conecta tu dispositivo vía Bluetooth para sincronizar los datos del vehículo automáticamente.</div>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon">🚨</div>
            <div class="info-body">
                <div class="info-name">Alertas Inteligentes</div>
                <div class="info-desc">Recibe notificaciones inmediatas cuando un sensor detecta un comportamiento fuera de lo normal.</div>
            </div>
        </div>
    </div>

    <!-- Cómo funciona -->
    <p class="info-title">¿CÓMO FUNCIONA?</p>
    <div class="steps-grid">
        <div class="step-card">
            <div class="step-num">01</div>
            <div class="step-title">Registra tu vehículo</div>
            <div class="step-desc">Agrega los datos de tu carro: marca, modelo, placa y color desde el menú lateral.</div>
        </div>
        <div class="step-card">
            <div class="step-num">02</div>
            <div class="step-title">Conecta por Bluetooth</div>
            <div class="step-desc">Activa el Bluetooth y conecta el dispositivo OBD2 de tu vehículo para recibir datos en tiempo real.</div>
        </div>
        <div class="step-card">
            <div class="step-num">03</div>
            <div class="step-title">Monitorea sensores</div>
            <div class="step-desc">Revisa el estado de cada sensor desde la sección Sensores. La barra indica el nivel de funcionamiento.</div>
        </div>
        <div class="step-card">
            <div class="step-num">04</div>
            <div class="step-title">Actúa ante fallas</div>
            <div class="step-desc">Cuando un sensor supera el umbral de advertencia, sabrás exactamente qué tipo de daño revisar.</div>
        </div>
    </div>
</main>

</body>
</html>