<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#e63946;--teal:#2ec4b6;--gold:#f4a261;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);display:grid;grid-template-columns:240px 1fr;min-height:100vh;}

        aside{background:var(--dark);border-right:1px solid var(--border);padding:2rem 1.5rem;display:flex;flex-direction:column;gap:2rem;}
        .sidebar-brand{font-family:var(--font-display);font-size:1.4rem;letter-spacing:.05em;}
        .sidebar-brand b{color:var(--accent);}
        .sidebar-tag{font-family:var(--font-mono);font-size:.6rem;color:var(--accent);letter-spacing:.2em;text-transform:uppercase;margin-top:-.5rem;}
        nav.sidebar-nav{display:flex;flex-direction:column;gap:.25rem;}
        .nav-item{display:flex;align-items:center;gap:.75rem;padding:.65rem .85rem;border-radius:4px;font-size:.875rem;color:var(--muted);text-decoration:none;transition:background .2s,color .2s;}
        .nav-item:hover,.nav-item.active{background:rgba(230,57,70,.08);color:var(--white);}
        .nav-item.active{border-left:2px solid var(--accent);padding-left:.6rem;}
        .nav-icon{font-size:1rem;width:20px;text-align:center;}
        .sidebar-footer{margin-top:auto;}
        .user-chip{background:var(--card);border:1px solid var(--border);padding:.75rem;border-radius:4px;font-size:.8rem;}
        .user-chip .name{font-weight:600;}
        .user-chip .role{font-family:var(--font-mono);font-size:.65rem;color:var(--accent);letter-spacing:.1em;}
        .logout-btn{background:none;border:none;color:var(--muted);font-family:var(--font-body);font-size:.85rem;cursor:pointer;padding:.65rem .85rem;width:100%;text-align:left;display:flex;align-items:center;gap:.75rem;border-radius:4px;transition:background .2s,color .2s;}
        .logout-btn:hover{background:rgba(230,57,70,.08);color:var(--accent);}

        main{padding:2.5rem;overflow-y:auto;}
        .page-title{font-family:var(--font-display);font-size:2rem;letter-spacing:.03em;margin-bottom:2rem;}
        .page-title span{color:var(--accent);}

        .alert-ok{background:rgba(46,196,182,.1);border:1px solid rgba(46,196,182,.3);padding:.75rem 1rem;border-radius:2px;font-size:.85rem;color:var(--teal);margin-bottom:1.5rem;font-family:var(--font-mono);}

        /* Sección */
        .section-title{font-family:var(--font-display);font-size:1.3rem;letter-spacing:.05em;margin-bottom:1rem;padding-bottom:.5rem;border-bottom:1px solid var(--border);}
        .section-wrap{margin-bottom:3rem;}

        /* Tabla */
        .table-wrap{background:var(--card);border:1px solid var(--border);border-radius:4px;overflow:hidden;margin-bottom:1rem;}
        table{width:100%;border-collapse:collapse;}
        thead{background:var(--dark);}
        th{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;padding:.85rem 1rem;text-align:left;border-bottom:1px solid var(--border);}
        td{padding:.85rem 1rem;font-size:.875rem;border-bottom:1px solid var(--border);}
        tr:last-child td{border-bottom:none;}
        tr:hover td{background:rgba(255,255,255,.02);}
        .td-mono{font-family:var(--font-mono);font-size:.75rem;color:var(--muted);}

        /* Botones acción */
        .btn-edit{background:rgba(244,162,97,.1);border:1px solid rgba(244,162,97,.3);color:var(--gold);padding:.3rem .7rem;border-radius:2px;font-family:var(--font-mono);font-size:.65rem;text-decoration:none;cursor:pointer;transition:background .2s;}
        .btn-edit:hover{background:rgba(244,162,97,.2);}
        .btn-del{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);color:var(--accent);padding:.3rem .7rem;border-radius:2px;font-family:var(--font-mono);font-size:.65rem;cursor:pointer;border:1px solid rgba(230,57,70,.3);transition:background .2s;}
        .btn-del:hover{background:rgba(230,57,70,.2);}
        .actions{display:flex;gap:.5rem;align-items:center;}

        /* Form agregar sensor */
        .form-inline{background:var(--card);border:1px solid var(--border);border-radius:4px;padding:1.5rem;}
        .form-inline h3{font-family:var(--font-display);font-size:1.1rem;letter-spacing:.05em;margin-bottom:1rem;}
        .form-row{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem;margin-bottom:1rem;}
        .form-group{display:flex;flex-direction:column;gap:.4rem;}
        label{font-family:var(--font-mono);font-size:.6rem;color:var(--muted);letter-spacing:.1em;text-transform:uppercase;}
        input,select{background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.65rem .85rem;font-family:var(--font-body);font-size:.85rem;border-radius:2px;outline:none;transition:border-color .2s;}
        input:focus,select:focus{border-color:var(--accent);}
        .btn-add{background:var(--accent);color:#fff;border:none;padding:.65rem 1.5rem;font-family:var(--font-display);font-size:1rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;transition:opacity .2s;}
        .btn-add:hover{opacity:.85;}
    </style>
</head>
<body>

<aside>
    <div>
        <div class="sidebar-brand">Auto <b>Sen</b></div>
        <div class="sidebar-tag">// admin panel</div>
    </div>
    <nav class="sidebar-nav">
        <a href="/admin"    class="nav-item active"><span class="nav-icon">⚙️</span> Panel Admin</a>
        <a href="/dashboard" class="nav-item"><span class="nav-icon">🏠</span> Ver como cliente</a>
    </nav>
    <div class="sidebar-footer">
        <div class="user-chip">
<div class="name">{{ Auth::guard('admin')->user()->Nombre }}</div>
            <div class="role">ADMINISTRADOR</div>
        </div>
      <form method="POST" action="/admin/logout" style="margin-top:.5rem;">
    @csrf
    <button type="submit" class="logout-btn"><span>🚪</span> Cerrar sesión</button>
</form>
    </div>
</aside>

<main>
    <h1 class="page-title">PANEL DE <span>ADMINISTRACIÓN</span></h1>

    @if(session('ok'))
        <div class="alert-ok">✓ {{ session('ok') }}</div>
    @endif

    {{-- VEHÍCULOS --}}
    <div class="section-wrap">
        <h2 class="section-title">🚗 VEHÍCULOS REGISTRADOS</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Color</th>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehiculos as $v)
                    <tr>
                        <td><strong>{{ $v->Nombre_vehiculo }}</strong></td>
                        <td class="td-mono">{{ $v->Marca }}</td>
                        <td class="td-mono">{{ \Carbon\Carbon::parse($v->Modelo)->format('Y') }}</td>
                        <td class="td-mono">{{ $v->Color }}</td>
                        <td class="td-mono">{{ $v->Placa }}</td>
                        <td class="td-mono">{{ $v->Tipo_placa }}</td>
                        <td>
                            <div class="actions">
                                <a href="/admin/vehiculo/{{ $v->Id_vehiculo }}/editar" class="btn-edit">EDITAR</a>
                                <form method="POST" action="/admin/vehiculo/{{ $v->Id_vehiculo }}/eliminar">
                                    @csrf
                                    <button type="submit" class="btn-del" onclick="return confirm('¿Eliminar este vehículo?')">ELIMINAR</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:2rem;">No hay vehículos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SENSORES --}}
    <div class="section-wrap">
        <h2 class="section-title">📡 SENSORES</h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Tipo de daño</th>
                        <th>Nivel</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sensores as $s)
                    <tr>
                        <td><strong>{{ $s->Nombre_sensor }}</strong></td>
                        <td class="td-mono">{{ $s->Tipo_sensor }}</td>
                        <td class="td-mono">{{ $s->Tipo_daño }}</td>
                        <td class="td-mono">{{ $s->Nivel }}%</td>
                        <td>
                            <div class="actions">
                                <a href="/admin/sensor/{{ $s->Id_sensor }}/editar" class="btn-edit">EDITAR</a>
                                <form method="POST" action="/admin/sensor/{{ $s->Id_sensor }}/eliminar">
                                    @csrf
                                    <button type="submit" class="btn-del" onclick="return confirm('¿Eliminar este sensor?')">ELIMINAR</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem;">No hay sensores registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Agregar sensor --}}
        <div class="form-inline">
            <h3>➕ AGREGAR SENSOR</h3>
            <form method="POST" action="/admin/sensor/crear">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre sensor</label>
                        <input type="text" name="Nombre_sensor" placeholder="Ej: Sensor O2" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo sensor</label>
                        <input type="text" name="Tipo_sensor" placeholder="Ej: O2" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de daño</label>
                        <input type="text" name="Tipo_daño" placeholder="Ej: Falla en mezcla" required>
                    </div>
                    <div class="form-group">
                        <label>Nivel (0-100)</label>
                        <input type="number" name="Nivel" min="0" max="100" placeholder="0" value="0">
                    </div>
                </div>
                <button type="submit" class="btn-add">AGREGAR SENSOR</button>
            </form>
        </div>
    </div>
</main>

</body>
</html>