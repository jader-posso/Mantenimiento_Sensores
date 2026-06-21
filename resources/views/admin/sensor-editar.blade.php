<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Sensor — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#e63946;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);min-height:100vh;padding:3rem;}
        .box{background:var(--card);border:1px solid var(--border);border-radius:4px;padding:2rem;max-width:500px;margin:0 auto;}
        h1{font-family:var(--font-display);font-size:2rem;letter-spacing:.03em;margin-bottom:2rem;}
        h1 span{color:var(--accent);}
        .form-group{display:flex;flex-direction:column;gap:.5rem;margin-bottom:1.25rem;}
        label{font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;}
        input{background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.85rem 1rem;font-family:var(--font-body);font-size:.95rem;border-radius:2px;outline:none;transition:border-color .2s;width:100%;}
        input:focus{border-color:var(--accent);}
        .actions{display:flex;gap:1rem;margin-top:1.5rem;}
        .btn-save{background:var(--accent);color:#fff;border:none;padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;}
        .btn-back{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.85rem 2rem;font-family:var(--font-display);font-size:1.1rem;letter-spacing:.1em;text-decoration:none;border-radius:2px;display:flex;align-items:center;}
        .btn-back:hover{color:var(--white);border-color:var(--white);}
    </style>
</head>
<body>
<div class="box">
    <h1>EDITAR <span>SENSOR</span></h1>
    <form method="POST" action="/admin/sensor/{{ $sensor->Id_sensor }}/actualizar">
        @csrf
        <div class="form-group">
            <label>Nombre sensor</label>
            <input type="text" name="Nombre_sensor" value="{{ $sensor->Nombre_sensor }}" required>
        </div>
        <div class="form-group">
            <label>Tipo sensor</label>
            <input type="text" name="Tipo_sensor" value="{{ $sensor->Tipo_sensor }}" required>
        </div>
        <div class="form-group">
            <label>Tipo de daño</label>
            <input type="text" name="Tipo_daño" value="{{ $sensor->Tipo_daño }}" required>
        </div>
        <div class="form-group">
            <label>Nivel (0-100)</label>
            <input type="number" name="Nivel" min="0" max="100" value="{{ $sensor->Nivel }}">
        </div>
        <div class="actions">
            <button type="submit" class="btn-save">GUARDAR</button>
            <a href="/admin" class="btn-back">CANCELAR</a>
        </div>
    </form>
</div>
</body>
</html>