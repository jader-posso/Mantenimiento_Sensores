<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#e63946;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);min-height:100vh;padding:3rem;}
        .box{background:var(--card);border:1px solid var(--border);border-radius:4px;padding:2rem;max-width:600px;margin:0 auto;}
        h1{font-family:var(--font-display);font-size:2rem;letter-spacing:.03em;margin-bottom:2rem;}
        h1 span{color:var(--accent);}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
        .form-group{display:flex;flex-direction:column;gap:.5rem;}
        .form-group.full{grid-column:1/-1;}
        label{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;}
        input,select{background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.85rem 1rem;font-family:var(--font-body);font-size:.95rem;border-radius:2px;outline:none;transition:border-color .2s;}
        input:focus,select:focus{border-color:var(--accent);}
        .actions{display:flex;gap:1rem;margin-top:2rem;}
        .btn-save{background:var(--accent);color:#fff;border:none;padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;}
        .btn-back{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;text-decoration:none;border-radius:2px;display:flex;align-items:center;}
        .btn-back:hover{color:var(--white);border-color:var(--white);}
    </style>
</head>
<body>
<div class="box">
    <h1>EDITAR <span>VEHÍCULO</span></h1>
    <form method="POST" action="/admin/vehiculo/{{ $vehiculo->Id_vehiculo }}/actualizar">
        @csrf
        <div class="form-grid">
            <div class="form-group full">
                <label>Nombre vehículo</label>
                <input type="text" name="Nombre_vehiculo" value="{{ $vehiculo->Nombre_vehiculo }}" required>
            </div>
            <div class="form-group">
                <label>Marca</label>
                <input type="text" name="Marca" value="{{ $vehiculo->Marca }}" required>
            </div>
            <div class="form-group">
                <label>Modelo (año)</label>
                <input type="text" name="Modelo" value="{{ \Carbon\Carbon::parse($vehiculo->Modelo)->format('Y') }}" required>
            </div>
            <div class="form-group">
                <label>Color</label>
                <input type="text" name="Color" value="{{ $vehiculo->Color }}" required>
            </div>
            <div class="form-group">
                <label>Placa</label>
                <input type="text" name="Placa" value="{{ $vehiculo->Placa }}" required>
            </div>
            <div class="form-group full">
                <label>Tipo de placa</label>
                <select name="Tipo_placa">
                    @foreach(['Particular','Público','Carga','Diplomático','Moto'] as $tipo)
                    <option value="{{ $tipo }}" {{ $vehiculo->Tipo_placa == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="actions">
            <button type="submit" class="btn-save">GUARDAR</button>
            <a href="/admin" class="btn-back">CANCELAR</a>
        </div>
    </form>
</div>
</body>
</html>