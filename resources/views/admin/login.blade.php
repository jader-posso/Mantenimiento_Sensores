<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#e63946;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);min-height:100vh;display:flex;align-items:center;justify-content:center;}
        .login-box{background:var(--card);border:1px solid var(--border);padding:2.5rem;border-radius:4px;width:100%;max-width:420px;}
        .login-tag{font-family:var(--font-mono);font-size:.65rem;color:var(--accent);letter-spacing:.2em;text-transform:uppercase;margin-bottom:1rem;}
        h1{font-family:var(--font-display);font-size:2.5rem;letter-spacing:.03em;margin-bottom:.25rem;}
        .subtitle{font-size:.85rem;color:var(--muted);margin-bottom:2rem;}
        .form-group{margin-bottom:1.25rem;}
        label{display:block;font-family:var(--font-mono);font-size:.65rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.5rem;}
        input{width:100%;background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.85rem 1rem;font-family:var(--font-body);font-size:.95rem;border-radius:2px;outline:none;transition:border-color .2s;}
        input:focus{border-color:var(--accent);}
        input::placeholder{color:var(--muted);}
        .btn-submit{width:100%;background:var(--accent);border:none;color:#fff;padding:1rem;font-family:var(--font-display);font-size:1.2rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;margin-top:1rem;transition:opacity .2s;}
        .btn-submit:hover{opacity:.85;}
        .alert-error{background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);padding:.75rem 1rem;border-radius:2px;font-size:.85rem;color:var(--accent);margin-bottom:1rem;}
        .back{display:block;text-align:center;margin-top:1.5rem;font-family:var(--font-mono);font-size:.7rem;color:var(--muted);text-decoration:none;}
        .back:hover{color:var(--white);}
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-tag">// Acceso restringido</div>
    <h1>PANEL<br>ADMIN</h1>
    <p class="subtitle">Solo personal autorizado</p>

    @if($errors->any())
        <div class="alert-error">⚠ {{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf
        <div class="form-group">
            <label>Correo</label>
            <input type="email" name="correo" placeholder="admin@autosen.com" required value="{{ old('correo') }}">
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="contrasena" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-submit">ENTRAR</button>
    </form>
    <a href="/" class="back">← Volver al inicio</a>
</div>
</body>
</html>