<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión — SensorGuard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../../css/vehiculoscss/login.css">
</head>
<body>
<style>
     
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0c;--dark:#111116;--card:#16161e;--border:#2a2a38;--accent:#1a237e;--white:#f0eff4;--muted:#7a7a96;--font-display:'Bebas Neue',sans-serif;--font-body:'DM Sans',sans-serif;--font-mono:'JetBrains Mono',monospace;}
        body{background:var(--black);color:var(--white);font-family:var(--font-body);min-height:100vh;display:grid;grid-template-columns:1fr 1fr;}
        body::before{content:'';position:fixed;inset:0;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");pointer-events:none;z-index:9999;opacity:.35;}

        .login-panel{display:flex;flex-direction:column;justify-content:center;padding:3rem 4rem;position:relative;}
        .back-link{position:absolute;top:2rem;left:3rem;font-family:var(--font-mono);font-size:.75rem;color:var(--muted);text-decoration:none;display:flex;align-items:center;gap:.5rem;transition:color .2s;}
        .back-link:hover{color:var(--accent);}

        .login-brand{margin-bottom:3rem;}
        .brand-logo{display:flex;align-items:center;gap:.75rem;margin-bottom:.5rem;}
        .logo-icon{width:38px;height:38px;background:var(--accent);clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);display:flex;align-items:center;justify-content:center;font-family:var(--font-mono);font-size:.7rem;font-weight:700;color:#fff;}
        .brand-name{font-family:var(--font-display);font-size:1.6rem;letter-spacing:.05em;}
        .brand-name b{color:var(--accent);}

        h1{font-family:var(--font-display);font-size:3rem;letter-spacing:.03em;margin-bottom:.5rem;line-height:1;}
        .subtitle{font-size:.9rem;color:var(--muted);}

        .form-group{margin-bottom:1.25rem;}
        label{display:block;font-family:var(--font-mono);font-size:.7rem;color:var(--muted);letter-spacing:.12em;text-transform:uppercase;margin-bottom:.5rem;}
        input{width:100%;background:var(--dark);border:1px solid var(--border);color:var(--white);padding:.85rem 1rem;font-family:var(--font-body);font-size:.95rem;border-radius:2px;outline:none;transition:border-color .2s;}
        input:focus{border-color:var(--accent);}
        input::placeholder{color:var(--muted);}

        .btn-submit{width:100%;background:var(--accent);border:none;color:#fff;padding:1rem;font-family:var(--font-display);font-size:1.2rem;letter-spacing:.1em;cursor:pointer;border-radius:2px;margin-top:1.5rem;transition:background .2s,transform .15s;}
        .btn-submit:hover{background:#030853;;transform:translateY(-1px);}

        .divider{text-align:center;margin:1.5rem 0;position:relative;}
        .divider::before{content:'';position:absolute;top:50%;left:0;right:0;height:1px;background:var(--border);}
        .divider span{background:var(--card);position:relative;padding:0 1rem;font-family:var(--font-mono);font-size:.7rem;color:var(--muted);}

        .register-link{text-align:center;font-size:.875rem;color:var(--muted);}
        .register-link a{color:var(--accent);text-decoration:none;font-weight:600;}
        .register-link a:hover{text-decoration:underline;}

        .admin-link{display:block;text-align:center;margin-top:1.5rem;font-family:var(--font-mono);font-size:.7rem;color:var(--muted);text-decoration:none;opacity:.7;transition:opacity .2s,color .2s;}
        .admin-link:hover{opacity:1;color:var(--accent);}

        /* Right Panel */
        .visual-panel{background:var(--dark);border-left:1px solid var(--border);display:flex;flex-direction:column;justify-content:center;align-items:center;padding:3rem;position:relative;overflow:hidden;}
        .visual-panel::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,#030853 0%,transparent 60%);}
        .vp-tag{font-family:var(--font-mono);font-size:.7rem;color:var(--accent);letter-spacing:.2em;text-transform:uppercase;margin-bottom:1.5rem;text-align:center;}
        .vp-title{font-family:var(--font-display);font-size:clamp(3rem,4vw,5rem);text-align:center;line-height:.95;letter-spacing:.03em;margin-bottom:2rem;}
        .vp-title .outline{-webkit-text-stroke:1px var(--white);color:transparent;}
        .features{display:flex;flex-direction:column;gap:1rem;width:100%;max-width:340px;}
        .feature{display:flex;align-items:center;gap:1rem;background:var(--card);border:1px solid var(--border);padding:1rem 1.25rem;border-radius:4px;}
        .feat-icon{font-size:1.3rem;flex-shrink:0;}
        .feat-text{font-size:.85rem;color:var(--muted);}
        .feat-text strong{color:var(--white);}

        @media(max-width:768px){
            body{grid-template-columns:1fr;}
            .visual-panel{display:none;}
            .login-panel{padding:5rem 1.5rem 2rem;}
        }
    
</style>
<div class="login-panel">
    <a href="/" class="back-link">← Volver al inicio</a>

    <div class="login-brand">
        <div class="brand-logo">
            <div class="logo-icon">AS</div>
            <span class="brand-name">Auto<b>Sen</b></span>
        </div>
    </div>

    <h1>BIENVENIDO<br>DE VUELTA</h1>
    <p class="subtitle" style="margin-bottom:2.5rem;">Ingresa tus credenciales para continuar</p>

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" name="correo" placeholder="tu@correo.com" required value="{{old('correo') }}">
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="contrasena" placeholder="••••••••" required>
        </div>

        @if($errors->any())
            <div style="background:rgba(9, 6, 99, 0.1);border:1px solid rgba(14, 10, 108, 0.3);padding:.75rem 1rem;border-radius:2px;font-size:.85rem;color:var(--accent);margin-bottom:1rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <button type="submit" class="btn-submit">INICIAR SESIÓN</button>
    </form>

    <div class="divider"><span>o</span></div>
    <p class="register-link">¿No tienes cuenta? <a href="/register">Regístrate gratis</a></p>

    <a href="/admin/login" class="admin-link">Acceso administrador →</a>
</div>

<div class="visual-panel">
    <p class="vp-tag">// Panel de control</p>
    <h2 class="vp-title">MONITOREA<br><span class="outline">TODO</span><br>EN UN LUGAR</h2>
    <div class="features">
        <div class="feature">
            <span class="feat-icon">📡</span>
            <p class="feat-text"><strong>Sensores en tiempo real</strong><br>Temperatura, presión, voltaje y más</p>
        </div>
        <div class="feature">
            <span class="feat-icon">🚨</span>
            <p class="feat-text"><strong>Alertas instantáneas</strong><br>Notificación inmediata ante fallas</p>
        </div>
        <div class="feature">
            <span class="feat-icon">🚗</span>
            <p class="feat-text"><strong>Múltiples vehículos</strong><br>Gestiona toda tu flota</p>
        </div>
    </div>
</div>

</body>
</html>