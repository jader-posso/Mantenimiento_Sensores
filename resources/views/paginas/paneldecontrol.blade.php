<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel — SensorGuard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --black:#0a0a0c; --dark:#111116; --card:#16161e; --border:#2a2a38;
            --accent:#01016a; --gold:#f4a261; --teal:#2ec4b6;
            --white:#f0eff4; --muted:#7a7a96;
            --font-display:'Bebas Neue',sans-serif;
            --font-body:'DM Sans',sans-serif;
            --font-mono:'JetBrains Mono',monospace;
            --sidebar:280px;
        }
        html,body{height:100%; overflow:hidden;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);display:flex;}

        /* ══════════════════════════════════════
           SIDEBAR IZQUIERDO
        ══════════════════════════════════════ */
        .sidebar{
            width:var(--sidebar); min-width:var(--sidebar);
            background:var(--dark); border-right:1px solid var(--border);
            display:flex; flex-direction:column; height:100vh;
            position:relative; overflow-y:auto; overflow-x:hidden;
        }

        /* logo top */
        .sidebar-logo{
            padding:1.75rem 1.5rem 1.25rem;
            border-bottom:1px solid var(--border);
            display:flex; align-items:center; gap:.75rem;
            flex-shrink:0;
        }
        .logo-hex{
            width:36px; height:36px; background:var(--accent);
            clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);
            display:flex; align-items:center; justify-content:center;
            font-family:var(--font-mono); font-size:.65rem; font-weight:700; color:#fff;
            animation:logoPulse 3s ease-in-out infinite;
            flex-shrink:0;
        }
        @keyframes logoPulse{0%,100%{box-shadow:0 0 0 0 rgba(230,57,70,.4)}50%{box-shadow:0 0 0 10px rgba(230,57,70,0)}}
        .logo-text{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.04em;}
        .logo-text b{color:var(--accent);}

        /* ── CLIENTE CARD ── */
        .client-card{
            margin:1.25rem 1rem;
            background:var(--card); border:1px solid var(--border);
            border-left:3px solid var(--accent);
            border-radius:6px; padding:1.25rem;
            flex-shrink:0;
        }
        .client-avatar{
            width:52px; height:52px; border-radius:50%;
            background:linear-gradient(135deg,var(--accent),var(--gold));
            display:flex; align-items:center; justify-content:center;
            font-family:var(--font-display); font-size:1.4rem; color:#fff;
            margin-bottom:.9rem;
        }
        .client-name{font-weight:700; font-size:.95rem; margin-bottom:.2rem;}
        .client-email{font-family:var(--font-mono);font-size:.62rem;color:var(--muted);margin-bottom:.75rem;word-break:break-all;}
        .client-badge{
            display:inline-flex; align-items:center; gap:.35rem;
            background:rgba(46,196,182,.1); border:1px solid rgba(46,196,182,.25);
            color:var(--teal); font-family:var(--font-mono); font-size:.62rem;
            letter-spacing:.1em; text-transform:uppercase; padding:.2rem .6rem; border-radius:99px;
        }
        .badge-dot{width:5px;height:5px;border-radius:50%;background:var(--teal);animation:blink 2s ease-in-out infinite;}
        @keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}

        .client-meta{margin-top:.9rem;display:flex;flex-direction:column;gap:.4rem;}
        .meta-row{display:flex;justify-content:space-between;align-items:center;}
        .meta-label{font-family:var(--font-mono);font-size:.6rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;}
        .meta-value{font-size:.75rem;font-weight:600;}

        /* ── NAV SECTIONS ── */
        .nav-section{padding:.75rem 1rem 0; flex-shrink:0;}
        .nav-section-title{
            font-family:var(--font-mono); font-size:.6rem; color:var(--muted);
            letter-spacing:.15em; text-transform:uppercase;
            padding:0 .5rem .5rem; display:flex; align-items:center; gap:.5rem;
        }
        .nav-section-title::after{content:'';flex:1;height:1px;background:var(--border);}

        .nav-item{
            display:flex; align-items:center; gap:.75rem;
            padding:.6rem .75rem; border-radius:4px; cursor:pointer;
            font-size:.875rem; color:var(--muted);
            transition:background .2s, color .2s;
            user-select:none; border:none; background:none;
            width:100%; text-align:left;
        }
        .nav-item:hover{background:rgba(255,255,255,.04);color:var(--white);}
        .nav-item.active{background:rgba(230,57,70,.1);color:var(--white);border-left:2px solid var(--accent);padding-left:.6rem;}
        .nav-icon{font-size:1rem;width:20px;text-align:center;flex-shrink:0;}
        .nav-label{flex:1;}
        .nav-arrow{font-size:.65rem;transition:transform .25s;}
        .nav-item.open .nav-arrow{transform:rotate(90deg);}

        /* sensor submenu */
        .sensor-submenu{
            max-height:0; overflow:hidden;
            transition:max-height .35s ease;
            padding-left:2.75rem;
        }
        .sensor-submenu.open{max-height:600px;}
        .sub-item{
            display:flex; align-items:center; gap:.6rem;
            padding:.45rem .5rem; border-radius:3px; cursor:pointer;
            font-size:.8rem; color:var(--muted);
            transition:background .15s, color .15s;
            border:none; background:none; width:100%; text-align:left;
        }
        .sub-item:hover{background:rgba(255,255,255,.04);color:var(--white);}
        .sub-item.active{color:var(--white);}
        .sub-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}

        /* sidebar footer */
        .sidebar-footer{margin-top:auto;padding:1rem;border-top:1px solid var(--border);flex-shrink:0;}
        .logout-btn{
            display:flex; align-items:center; gap:.75rem; width:100%;
            padding:.65rem .75rem; border-radius:4px; border:none;
            background:none; color:var(--muted); font-family:var(--font-body);
            font-size:.875rem; cursor:pointer; transition:background .2s,color .2s;
        }
        .logout-btn:hover{background:rgba(230,57,70,.08);color:var(--accent);}

        /* ══════════════════════════════════════
           MAIN CONTENT (right)
        ══════════════════════════════════════ */
        .main-area{flex:1;display:flex;flex-direction:column;height:100vh;overflow:hidden;}

        /* top bar */
        .topbar{
            height:56px; flex-shrink:0;
            background:var(--dark); border-bottom:1px solid var(--border);
            display:flex; align-items:center; justify-content:space-between;
            padding:0 2rem;
        }
        .topbar-title{
            font-family:var(--font-mono); font-size:.72rem; color:var(--muted);
            letter-spacing:.15em; text-transform:uppercase;
            display:flex; align-items:center; gap:.5rem;
        }
        .topbar-title::before{content:'//';color:var(--accent);}
        .topbar-right{display:flex;align-items:center;gap:1rem;}
        .live-badge{
            display:flex; align-items:center; gap:.4rem;
            font-family:var(--font-mono); font-size:.65rem; color:var(--teal);
            letter-spacing:.1em;
        }
        .live-dot{width:6px;height:6px;border-radius:50%;background:var(--teal);animation:blink 1.5s ease-in-out infinite;}

        /* content area */
        .content-area{flex:1;overflow-y:auto;padding:2rem;}

        /* ── panels ── */
        .panel{display:none;animation:fadeSlide .3s ease;}
        .panel.active{display:block;}
        @keyframes fadeSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}

        /* ── INICIO panel ── */
        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;}
        .stat-card{
            background:var(--card); border:1px solid var(--border);
            padding:1.25rem; border-radius:6px; position:relative; overflow:hidden;
        }
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;}
        .stat-card.c-total::before{background:var(--muted);}
        .stat-card.c-ok::before{background:var(--teal);}
        .stat-card.c-warn::before{background:var(--gold);}
        .stat-card.c-err::before{background:var(--accent);}
        .sc-label{font-family:var(--font-mono);font-size:.6rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.4rem;}
        .sc-num{font-family:var(--font-display);font-size:2.8rem;line-height:1;}
        .sc-num.ok{color:var(--teal);}
        .sc-num.warn{color:var(--gold);}
        .sc-num.err{color:var(--accent);}

        .section-hd{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;}
        .section-hd h2{font-family:var(--font-display);font-size:1.5rem;letter-spacing:.04em;}
        .btn-xs{
            background:var(--accent);color:#fff;border:none;
            padding:.35rem .9rem;border-radius:2px;
            font-family:var(--font-mono);font-size:.65rem;letter-spacing:.1em;
            cursor:pointer; text-decoration:none; transition:background .2s;
        }
        .btn-xs:hover{background:#c1121f;}

        .vehicles-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1rem;}
        .vehicle-card{
            background:var(--card);border:1px solid var(--border);
            padding:1.25rem;border-radius:6px;transition:border-color .25s;
        }
        .vehicle-card:hover{border-color:rgba(230,57,70,.35);}
        .vc-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:.75rem;}
        .vc-name{font-weight:700;font-size:.95rem;}
        .vc-plate{
            font-family:var(--font-mono);font-size:.65rem;
            background:rgba(255,255,255,.05);padding:.2rem .5rem;border-radius:2px;color:var(--muted);
        }
        .vc-meta{font-size:.78rem;color:var(--muted);margin-bottom:.9rem;display:flex;gap:.75rem;flex-wrap:wrap;}
        .sensor-pills{display:flex;flex-direction:column;gap:.35rem;}
        .sensor-pill{
            display:flex;justify-content:space-between;align-items:center;
            font-family:var(--font-mono);font-size:.68rem;
            padding:.3rem .6rem;background:var(--dark);border-radius:3px;
        }
        .pill-status{padding:.12rem .45rem;border-radius:99px;font-size:.6rem;font-weight:700;letter-spacing:.06em;}
        .pill-ok{background:rgba(46,196,182,.12);color:var(--teal);}
        .pill-advertencia{background:rgba(244,162,97,.12);color:var(--gold);}
        .pill-falla{background:rgba(230,57,70,.12);color:var(--accent);}

        /* ── SENSOR detail panels ── */
        .sensor-detail-header{
            background:var(--card);border:1px solid var(--border);
            border-left:4px solid var(--accent);
            padding:1.5rem;border-radius:6px;margin-bottom:1.5rem;
        }
        .sdh-top{display:flex;align-items:center;gap:1rem;margin-bottom:.75rem;}
        .sdh-icon{width:48px;height:48px;background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.25);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;}
        .sdh-title{font-family:var(--font-display);font-size:1.8rem;letter-spacing:.04em;}
        .sdh-sub{font-size:.82rem;color:var(--muted);}
        .sdh-tags{display:flex;gap:.5rem;flex-wrap:wrap;}
        .tag{display:inline-flex;align-items:center;gap:.35rem;padding:.25rem .7rem;border-radius:99px;font-family:var(--font-mono);font-size:.65rem;letter-spacing:.08em;}
        .tag-tipo{background:rgba(244,162,97,.1);color:var(--gold);border:1px solid rgba(244,162,97,.2);}
        .tag-daño{background:rgba(230,57,70,.1);color:var(--accent);border:1px solid rgba(230,57,70,.2);}

        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem;}
        .info-card{background:var(--card);border:1px solid var(--border);padding:1.25rem;border-radius:6px;}
        .info-card h3{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.75rem;}
        .info-card p{font-size:.875rem;color:var(--white);line-height:1.65;}

        .alert-box{
            padding:1rem 1.25rem;border-radius:6px;margin-bottom:1rem;
            display:flex;align-items:flex-start;gap:.75rem;font-size:.85rem;line-height:1.5;
        }
        .alert-box.warn{background:rgba(244,162,97,.08);border:1px solid rgba(244,162,97,.2);color:var(--gold);}
        .alert-box.info{background:rgba(46,196,182,.07);border:1px solid rgba(46,196,182,.2);color:var(--teal);}
        .alert-box.danger{background:rgba(230,57,70,.08);border:1px solid rgba(230,57,70,.2);color:#ff8a8a;}
        .alert-icon{font-size:1.1rem;flex-shrink:0;margin-top:.05rem;}

        /* ── NOSOTROS panel ── */
        .nosotros-hero{
            background:var(--card);border:1px solid var(--border);
            border-left:4px solid var(--teal);
            padding:2rem;border-radius:6px;margin-bottom:1.5rem;
        }
        .nh-title{font-family:var(--font-display);font-size:2.5rem;letter-spacing:.04em;margin-bottom:.5rem;}
        .nh-sub{font-size:.9rem;color:var(--muted);line-height:1.65;max-width:600px;}
        .nosotros-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(230px,1fr));gap:1rem;margin-bottom:1.5rem;}
        .nos-card{background:var(--card);border:1px solid var(--border);padding:1.25rem;border-radius:6px;transition:border-color .25s;}
        .nos-card:hover{border-color:rgba(46,196,182,.35);}
        .nos-icon{font-size:1.6rem;margin-bottom:.75rem;}
        .nos-title{font-family:var(--font-display);font-size:1.2rem;letter-spacing:.04em;margin-bottom:.4rem;}
        .nos-desc{font-size:.8rem;color:var(--muted);line-height:1.6;}
        .team-row{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;}
        .team-card{background:var(--card);border:1px solid var(--border);padding:1.25rem;border-radius:6px;text-align:center;}
        .team-avatar{width:52px;height:52px;border-radius:50%;margin:0 auto .75rem;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.3rem;color:#fff;}
        .team-name{font-weight:700;font-size:.85rem;margin-bottom:.2rem;}
        .team-role{font-family:var(--font-mono);font-size:.62rem;color:var(--accent);letter-spacing:.1em;text-transform:uppercase;}

        /* empty state */
        .empty{text-align:center;padding:3rem;color:var(--muted);background:var(--card);border:1px dashed var(--border);border-radius:6px;}
        .empty-icon{font-size:2.5rem;margin-bottom:.75rem;}
        .empty a{color:var(--accent);text-decoration:none;}

        /* scrollbar */
        .content-area::-webkit-scrollbar,.sidebar::-webkit-scrollbar{width:4px;}
        .content-area::-webkit-scrollbar-thumb,.sidebar::-webkit-scrollbar-thumb{background:var(--border);border-radius:99px;}

        @media(max-width:768px){
            .sidebar{width:64px;min-width:64px;}
            .logo-text,.client-card,.nav-label,.nav-arrow,.sidebar-footer .logout-btn span:last-child{display:none;}
            .nav-item{justify-content:center;padding:.6rem;}
            .sidebar-logo{justify-content:center;padding:1rem .5rem;}
            .stats-grid{grid-template-columns:1fr 1fr;}
            .info-grid{grid-template-columns:1fr;}
        }
    </style>
</head>
<body>

<!-- ════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════ -->
<aside class="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="logo-hex">SG</div>
        <span class="logo-text">Sensor<b>Guard</b></span>
    </div>

    <!-- Datos del cliente -->
    <div class="client-card">
        <div class="client-avatar">
            {{ strtoupper(substr($cliente->nombre_cliente, 0, 1)) }}{{ strtoupper(substr($cliente->apellido_cliente, 0, 1)) }}
        </div>
        <div class="client-name">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</div>
        <div class="client-email">{{ $cliente->correo }}</div>
        <div class="client-badge"><span class="badge-dot"></span>Activo</div>
        <div class="client-meta">
            <div class="meta-row">
                <span class="meta-label">Vehículos</span>
                <span class="meta-value">{{ $vehiculos->count() }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Sensores</span>
                <span class="meta-value">{{ $totalSensores }}</span>
            </div>
            <div class="meta-row">
                <span class="meta-label">Alertas</span>
                <span class="meta-value" style="color:var(--accent)">{{ $sensoresFalla }}</span>
            </div>
        </div>
    </div>

    <!-- Nav: General -->
    <div class="nav-section">
        <div class="nav-section-title">General</div>
        <button class="nav-item active" onclick="showPanel('inicio', this)">
            <span class="nav-icon">🏠</span>
            <span class="nav-label">Inicio</span>
        </button>
    </div>

    <!-- Nav: Sensores con submenú desplegable -->
    <div class="nav-section">
        <div class="nav-section-title">Sensores</div>
        <button class="nav-item" id="sensorToggle" onclick="toggleSensors(this)">
            <span class="nav-icon">📡</span>
            <span class="nav-label">Sensores</span>
            <span class="nav-arrow">›</span>
        </button>
        <div class="sensor-submenu" id="sensorSubmenu">
            @php
                $sensoresData = [
                    ['nombre'=>'Motor', 'tipo'=>'Temperatura', 'daño'=>'Sobrecalentamiento', 'icon'=>'🔥', 'color'=>'#e63946'],
                    ['nombre'=>'Frenos (ABS)', 'tipo'=>'Seguridad', 'daño'=>'Falla de frenado', 'icon'=>'🛑', 'color'=>'#f4a261'],
                    ['nombre'=>'Sensor O₂', 'tipo'=>'Emisiones', 'daño'=>'Mezcla incorrecta', 'icon'=>'💨', 'color'=>'#2ec4b6'],
                    ['nombre'=>'Aceite', 'tipo'=>'Lubricación', 'daño'=>'Baja presión', 'icon'=>'🛢️', 'color'=>'#f4e261'],
                    ['nombre'=>'Velocidad', 'tipo'=>'Transmisión', 'daño'=>'Error velocímetro', 'icon'=>'⚡', 'color'=>'#a78bfa'],
                    ['nombre'=>'Batería', 'tipo'=>'Eléctrico', 'daño'=>'Carga baja', 'icon'=>'🔋', 'color'=>'#34d399'],
                    ['nombre'=>'MAP / Admisión', 'tipo'=>'Admisión', 'daño'=>'Pérdida de potencia', 'icon'=>'🌬️', 'color'=>'#60a5fa'],
                    ['nombre'=>'Cigüeñal', 'tipo'=>'Motor', 'daño'=>'Falla encendido', 'icon'=>'⚙️', 'color'=>'#fb923c'],
                ];
            @endphp
            @foreach($sensoresData as $i => $s)
            <button class="sub-item" onclick="showSensor({{ $i }}, this)">
                <span class="sub-dot" style="background:{{ $s['color'] }}"></span>
                {{ $s['nombre'] }}
            </button>
            @endforeach
        </div>
    </div>

    <!-- Nav: Info -->
    <div class="nav-section">
        <div class="nav-section-title">Empresa</div>
        <button class="nav-item" onclick="showPanel('nosotros', this)">
            <span class="nav-icon">🏢</span>
            <span class="nav-label">Nosotros</span>
        </button>
    </div>

    <!-- Footer logout -->
    <div class="sidebar-footer">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">
                <span>🚪</span><span>Cerrar sesión</span>
            </button>
        </form>
    </div>

</aside>

<!-- ════════════════════════════════════════
     MAIN AREA (right)
════════════════════════════════════════ -->
<div class="main-area">

    <!-- Top bar -->
    <div class="topbar">
        <span class="topbar-title" id="topbarTitle">Inicio — Dashboard</span>
        <div class="topbar-right">
            <div class="live-badge"><span class="live-dot"></span>EN VIVO</div>
        </div>
    </div>

    <!-- Content -->
    <div class="content-area">

        <!-- ── PANEL: INICIO ── -->
        <div class="panel active" id="panel-inicio">
            <div class="stats-grid">
                <div class="stat-card c-total">
                    <div class="sc-label">Vehículos</div>
                    <div class="sc-num">{{ $vehiculos->count() }}</div>
                </div>
                <div class="stat-card c-ok">
                    <div class="sc-label">Sensores OK</div>
                    <div class="sc-num ok">{{ $sensoresOk }}</div>
                </div>
                <div class="stat-card c-warn">
                    <div class="sc-label">Advertencias</div>
                    <div class="sc-num warn">{{ $sensoresAdvertencia }}</div>
                </div>
                <div class="stat-card c-err">
                    <div class="sc-label">Fallas</div>
                    <div class="sc-num err">{{ $sensoresFalla }}</div>
                </div>
            </div>

            <div class="section-hd">
                <h2>MIS VEHÍCULOS</h2>
                <a href="/vehiculos/create" class="btn-xs">+ AGREGAR</a>
            </div>

            @if($vehiculos->count() > 0)
            <div class="vehicles-grid">
                @foreach($vehiculos as $v)
                <div class="vehicle-card">
                    <div class="vc-head">
                        <div class="vc-name">{{ $v->nombre_vehiculo }}</div>
                        <span class="vc-plate">{{ $v->placa ?? 'S/P' }}</span>
                    </div>
                    <div class="vc-meta">
                        <span>🎨 {{ $v->color }}</span>
                        <span>🏷️ {{ $v->marca }}</span>
                        <span>📅 {{ \Carbon\Carbon::parse($v->modelo)->format('Y') }}</span>
                    </div>
                    @if($v->sensores->count() > 0)
                    <div class="sensor-pills">
                        @foreach($v->sensores->take(5) as $s)
                        <div class="sensor-pill">
                            <span>{{ $s->nombre_sensor }}</span>
                            <span class="pill-status pill-{{ $s->pivot->estado }}">{{ strtoupper($s->pivot->estado) }}</span>
                        </div>
                        @endforeach
                        @if($v->sensores->count() > 5)
                        <div style="font-family:var(--font-mono);font-size:.62rem;color:var(--muted);text-align:center;padding:.2rem">
                            +{{ $v->sensores->count()-5 }} más
                        </div>
                        @endif
                    </div>
                    @else
                    <p style="font-family:var(--font-mono);font-size:.68rem;color:var(--muted)">Sin sensores asignados</p>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <div class="empty">
                <div class="empty-icon">🚗</div>
                <p>Aún no tienes vehículos registrados.</p>
                <p><a href="/vehiculos/create">Agrega tu primer vehículo →</a></p>
            </div>
            @endif
        </div>

        <!-- ── PANELS: SENSORES (uno por cada tipo) ── -->
        @php
            $sensoresInfo = [
                ['nombre'=>'Motor', 'tipo'=>'Temperatura', 'daño'=>'Sobrecalentamiento', 'icon'=>'🔥', 'color'=>'#e63946',
                 'descripcion'=>'El sensor de temperatura del motor monitorea constantemente el nivel térmico del propulsor. Una temperatura óptima de operación se sitúa entre 80°C y 95°C. Valores superiores indican un problema de refrigeración.',
                 'funcion'=>'Envía señales eléctricas a la ECU para controlar el sistema de enfriamiento, el ventilador del radiador y la mezcla de combustible según la temperatura actual.',
                 'alertas'=>['Temperatura por encima de 105°C: revisar líquido refrigerante', 'Temperatura irregular: posible falla en termostato', 'Sensor desconectado: la ECU entra en modo de emergencia']],
                ['nombre'=>'Frenos (ABS)', 'tipo'=>'Seguridad', 'daño'=>'Falla de frenado', 'icon'=>'🛑', 'color'=>'#f4a261',
                 'descripcion'=>'El sensor ABS (Anti-lock Braking System) detecta la velocidad de rotación individual de cada rueda para evitar que se bloqueen durante el frenado brusco, manteniendo el control de dirección.',
                 'funcion'=>'Compara la velocidad de las 4 ruedas en tiempo real. Si detecta que una rueda se bloquea, modula la presión hidráulica de ese freno en milisegundos para restaurar la tracción.',
                 'alertas'=>['Luz ABS encendida en el tablero: sensor sucio o dañado', 'Vibración en pedal de freno: ABS activándose normalmente', 'Frenado prolongado sin ABS: sensor completamente inoperativo']],
                ['nombre'=>'Sensor O₂', 'tipo'=>'Emisiones', 'daño'=>'Mezcla incorrecta', 'icon'=>'💨', 'color'=>'#2ec4b6',
                 'descripcion'=>'El sensor de oxígeno (lambda) mide la cantidad de oxígeno en los gases de escape para determinar si la mezcla aire-combustible es correcta (estequiométrica, relación 14.7:1).',
                 'funcion'=>'Genera un voltaje variable (0.1V – 0.9V) que la ECU lee para ajustar la inyección de combustible en tiempo real, optimizando eficiencia y reduciendo emisiones.',
                 'alertas'=>['Código P0135 – calentador del sensor defectuoso', 'Mezcla rica (>0.9V constante): posible inyector atascado', 'Mezcla pobre (<0.1V constante): fuga de aire o sensor muerto']],
                ['nombre'=>'Aceite', 'tipo'=>'Lubricación', 'daño'=>'Baja presión', 'icon'=>'🛢️', 'color'=>'#f4e261',
                 'descripcion'=>'El sensor de presión de aceite vigila que el lubricante circule con la presión adecuada por todo el motor. La presión normal varía entre 25 y 65 PSI según las RPM del motor.',
                 'funcion'=>'Es un sensor de tipo resistivo: a mayor presión, menor resistencia eléctrica. La ECU convierte ese valor a PSI y lo muestra en el tablero o envía alertas.',
                 'alertas'=>['Luz de aceite encendida: detener el vehículo inmediatamente', 'Presión baja en ralentí: desgaste de la bomba de aceite', 'Presión inestable: posible contaminación del aceite']],
                ['nombre'=>'Velocidad', 'tipo'=>'Transmisión', 'daño'=>'Error velocímetro', 'icon'=>'⚡', 'color'=>'#a78bfa',
                 'descripcion'=>'El sensor de velocidad del vehículo (VSS) mide la rotación de la transmisión o la caja de cambios para calcular la velocidad real del vehículo y alimentar el velocímetro y la ECU.',
                 'funcion'=>'Genera pulsos eléctricos proporcionales a la velocidad de giro. La ECU cuenta los pulsos por segundo para calcular km/h y controlar el cambio automático de marchas.',
                 'alertas'=>['Velocímetro errático: sensor sucio con residuos metálicos', 'Código P0500: circuito del sensor abierto o cortocircuito', 'Transmisión automática no cambia: ECU sin referencia de velocidad']],
                ['nombre'=>'Batería', 'tipo'=>'Eléctrico', 'daño'=>'Carga baja', 'icon'=>'🔋', 'color'=>'#34d399',
                 'descripcion'=>'El sensor de estado de la batería (BSS) monitorea el voltaje, la corriente y la temperatura de la batería para determinar su estado de carga (SOC) y estado de salud (SOH).',
                 'funcion'=>'Comunica al alternador cuánta carga debe generar. En vehículos modernos gestiona el sistema Start-Stop y el frenado regenerativo para maximizar la vida útil de la batería.',
                 'alertas'=>['Voltaje < 12.2V: batería descargada, necesita recarga', 'Voltaje > 14.8V en marcha: posible regulador de voltaje dañado', 'Temperatura alta de batería: riesgo de daño por gases']],
                ['nombre'=>'MAP / Admisión', 'tipo'=>'Admisión', 'daño'=>'Pérdida de potencia', 'icon'=>'🌬️', 'color'=>'#60a5fa',
                 'descripcion'=>'El sensor MAP (Manifold Absolute Pressure) mide la presión del aire en el múltiple de admisión para que la ECU calcule la densidad del aire y ajuste la cantidad de combustible inyectado.',
                 'funcion'=>'A mayor presión en el múltiple (mayor carga del motor), la ECU inyecta más combustible. Es fundamental para motores turboalimentados donde la presión puede superar la atmosférica.',
                 'alertas'=>['Código P0105: circuito MAP fuera de rango', 'Motor sin potencia en aceleración: señal MAP errónea', 'Consumo elevado de combustible: ECU usando valores de emergencia']],
                ['nombre'=>'Cigüeñal', 'tipo'=>'Motor', 'daño'=>'Falla encendido', 'icon'=>'⚙️', 'color'=>'#fb923c',
                 'descripcion'=>'El sensor de posición del cigüeñal (CKP) es el sensor más crítico del motor. Determina la posición exacta y la velocidad de rotación del cigüeñal para sincronizar la inyección y el encendido.',
                 'funcion'=>'Genera pulsos magnéticos al detectar los dientes de la corona del cigüeñal. La ECU usa esa información para calcular las RPM del motor y el momento exacto de inyección y chispa.',
                 'alertas'=>['Motor no arranca: sin señal CKP la ECU no activa inyectores', 'Código P0335: circuito del sensor sin señal o intermitente', 'Tirones al acelerar: señal CKP débil o con interferencia']],
            ];
        @endphp

        @foreach($sensoresInfo as $i => $s)
        <div class="panel" id="panel-sensor-{{ $i }}">
            <!-- Header del sensor -->
            <div class="sensor-detail-header">
                <div class="sdh-top">
                    <div class="sdh-icon">{{ $s['icon'] }}</div>
                    <div>
                        <div class="sdh-title">{{ strtoupper($s['nombre']) }}</div>
                        <div class="sdh-sub">Información detallada del sensor</div>
                    </div>
                </div>
                <div class="sdh-tags">
                    <span class="tag tag-tipo">📂 Tipo: {{ $s['tipo'] }}</span>
                    <span class="tag tag-daño">⚠ Daño: {{ $s['daño'] }}</span>
                </div>
            </div>

            <!-- Info cards -->
            <div class="info-grid">
                <div class="info-card">
                    <h3>¿Qué es?</h3>
                    <p>{{ $s['descripcion'] }}</p>
                </div>
                <div class="info-card">
                    <h3>¿Cómo funciona?</h3>
                    <p>{{ $s['funcion'] }}</p>
                </div>
            </div>

            <!-- Alertas -->
            <div class="info-card" style="margin-bottom:1rem;">
                <h3>⚠ Alertas comunes</h3>
                <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.75rem;">
                    @foreach($s['alertas'] as $a)
                    <div class="alert-box {{ $loop->index === 0 ? 'danger' : ($loop->index === 1 ? 'warn' : 'info') }}">
                        <span class="alert-icon">{{ $loop->index === 0 ? '🚨' : ($loop->index === 1 ? '⚠️' : 'ℹ️') }}</span>
                        <span>{{ $a }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <!-- ── PANEL: NOSOTROS ── -->
        <div class="panel" id="panel-nosotros">
            <div class="nosotros-hero">
                <div class="nh-title">SOBRE SENSORGUARD</div>
                <p class="nh-sub">Somos un equipo de ingenieros y entusiastas del automóvil comprometidos con democratizar el diagnóstico vehicular avanzado. Desde Bogotá para el mundo, trabajamos para que ningún vehículo falle por falta de información.</p>
            </div>

            <div class="section-hd" style="margin-bottom:1rem;"><h2>NUESTROS VALORES</h2></div>
            <div class="nosotros-grid" style="margin-bottom:1.5rem;">
                <div class="nos-card"><div class="nos-icon">⚡</div><div class="nos-title">Precisión</div><p class="nos-desc">Cada lectura importa. Calibramos nuestros algoritmos continuamente para garantizar datos exactos y diagnósticos confiables.</p></div>
                <div class="nos-card"><div class="nos-icon">🔒</div><div class="nos-title">Seguridad</div><p class="nos-desc">Los datos de tus vehículos son tuyos. Usamos cifrado de extremo a extremo y no compartimos información con terceros.</p></div>
                <div class="nos-card"><div class="nos-icon">🌐</div><div class="nos-title">Accesibilidad</div><p class="nos-desc">Tecnología de diagnóstico que antes era exclusiva de talleres especializados, ahora en la palma de tu mano.</p></div>
                <div class="nos-card"><div class="nos-icon">🚀</div><div class="nos-title">Innovación</div><p class="nos-desc">Mejoramos constantemente nuestra plataforma con machine learning y análisis predictivo de última generación.</p></div>
            </div>

            <div class="section-hd" style="margin-bottom:1rem;"><h2>NUESTRO EQUIPO</h2></div>
            <div class="team-row">
                <div class="team-card"><div class="team-avatar" style="background:linear-gradient(135deg,#e63946,#f4a261)">CL</div><div class="team-name">Carlos López</div><div class="team-role">CEO & Fundador</div></div>
                <div class="team-card"><div class="team-avatar" style="background:linear-gradient(135deg,#2ec4b6,#0a9396)">AM</div><div class="team-name">Ana Martínez</div><div class="team-role">CTO</div></div>
                <div class="team-card"><div class="team-avatar" style="background:linear-gradient(135deg,#f4a261,#e07b39)">JR</div><div class="team-name">Juan Rodríguez</div><div class="team-role">Lead Engineer</div></div>
                <div class="team-card"><div class="team-avatar" style="background:linear-gradient(135deg,#6a4c93,#b5179e)">LG</div><div class="team-name">Laura Gómez</div><div class="team-role">UX Designer</div></div>
            </div>
        </div>

    </div><!-- /content-area -->
</div><!-- /main-area -->

<script>
    // ── Panel switching ──────────────────────────────────────
    function showPanel(name, triggerEl) {
        // hide all panels
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        // show target
        document.getElementById('panel-' + name).classList.add('active');
        // update nav highlight
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        if (triggerEl) triggerEl.classList.add('active');
        // update topbar
        const titles = {
            'inicio': 'Inicio — Dashboard',
            'nosotros': 'Empresa — Nosotros',
        };
        document.getElementById('topbarTitle').textContent = titles[name] || 'SensorGuard';
    }

    // ── Sensor submenu toggle ─────────────────────────────────
    function toggleSensors(btn) {
        const menu = document.getElementById('sensorSubmenu');
        const isOpen = menu.classList.contains('open');
        menu.classList.toggle('open');
        btn.classList.toggle('open');
        if (!isOpen) {
            // highlight the toggle button
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            btn.classList.add('active');
        }
    }

    // ── Show individual sensor panel ─────────────────────────
    function showSensor(index, subEl) {
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        document.getElementById('panel-sensor-' + index).classList.add('active');
        // highlight sub-item
        document.querySelectorAll('.sub-item').forEach(s => s.classList.remove('active'));
        subEl.classList.add('active');
        // highlight parent toggle
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        document.getElementById('sensorToggle').classList.add('active');
        // update topbar
        const names = ['Motor','Frenos (ABS)','Sensor O₂','Aceite','Velocidad','Batería','MAP / Admisión','Cigüeñal'];
        document.getElementById('topbarTitle').textContent = 'Sensores — ' + (names[index] || '');
    }
</script>
</body>
</html>
