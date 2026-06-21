<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse — Auto San</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="../../css/vehiculoscss/register.css">  
<style>
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
        :root{
            --black:#0a0a0c; --dark:#111116; --card:#16161e; --border:#2a2a38;
            --accent:#030853;; --gold:#f4a261; --teal:#2ec4b6;
            --white:#f0eff4; --muted:#7a7a96;
            --font-display:'Bebas Neue',sans-serif;
            --font-body:'DM Sans',sans-serif;
            --font-mono:'JetBrains Mono',monospace;
        }
        body {
            background:var(--black); color:var(--white);
            font-family:var(--font-body); min-height:100vh;
            display:grid; grid-template-columns:1fr 1fr;
        }
        body::before {
            content:''; position:fixed; inset:0;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events:none; z-index:9999; opacity:.35;
        }

        /* ── LEFT: Visual panel ── */
        .visual-panel {
            background:var(--dark); border-right:1px solid var(--border);
            display:flex; flex-direction:column; justify-content:center;
            align-items:center; padding:3rem; position:relative; overflow:hidden;
        }
        .visual-panel::before {
            content:''; position:absolute; inset:0;
            background:linear-gradient(135deg,rgba(230,57,70,.09) 0%,transparent 60%);
        }
        /* animated rings */
        .rings { position:absolute; top:50%; left:50%; transform:translate(-50%,-50%); }
        .ring {
            position:absolute; border-radius:50%;
            border:1px solid rgba(230,57,70,.12);
            transform:translate(-50%,-50%);
            animation:expand 6s ease-out infinite;
        }
        .ring:nth-child(1){ width:200px; height:200px; animation-delay:0s; }
        .ring:nth-child(2){ width:340px; height:340px; animation-delay:1.5s; }
        .ring:nth-child(3){ width:480px; height:480px; animation-delay:3s; }
        .ring:nth-child(4){ width:620px; height:620px; animation-delay:4.5s; }
        @keyframes expand {
            0%   { opacity:0; transform:translate(-50%,-50%) scale(.8); }
            30%  { opacity:1; }
            100% { opacity:0; transform:translate(-50%,-50%) scale(1.1); }
        }

        .vp-content { position:relative; z-index:2; text-align:center; }
        .vp-icon {
            width:70px; height:70px; background:var(--accent);
            clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);
            display:flex; align-items:center; justify-content:center;
            margin:0 auto 1.5rem; font-family:var(--font-display); font-size:1.4rem; color:#fff;
            animation:pulse 3s ease-in-out infinite;
        }
        @keyframes pulse {
            0%,100%{ box-shadow:0 0 0 0 rgba(230,57,70,.4); }
            50%    { box-shadow:0 0 0 16px rgba(230,57,70,0); }
        }
        .vp-title { font-family:var(--font-display); font-size:3rem; letter-spacing:.04em; line-height:.95; margin-bottom:1rem; }
        .vp-title .outline { -webkit-text-stroke:1px var(--white); color:transparent; }
        .vp-sub { font-size:.875rem; color:var(--muted); line-height:1.6; max-width:300px; margin:0 auto 2rem; }

        .perks { display:flex; flex-direction:column; gap:.75rem; width:100%; max-width:300px; }
        .perk {
            display:flex; align-items:center; gap:.875rem;
            background:rgba(255,255,255,.03); border:1px solid var(--border);
            padding:.75rem 1rem; border-radius:4px;
            animation:slideIn .5s ease both;
        }
        .perk:nth-child(1){ animation-delay:.1s; }
        .perk:nth-child(2){ animation-delay:.2s; }
        .perk:nth-child(3){ animation-delay:.3s; }
        @keyframes slideIn{ from{opacity:0;transform:translateX(-16px)} to{opacity:1;transform:none} }
        .perk-icon { font-size:1.1rem; flex-shrink:0; }
        .perk-text { font-size:.8rem; color:var(--muted); text-align:left; }
        .perk-text strong { color:var(--white); display:block; font-size:.85rem; }

        /* ── RIGHT: Form panel ── */
        .form-panel {
            display:flex; flex-direction:column; justify-content:center;
            padding:3rem 4rem; position:relative; overflow-y:auto;
        }
        .back-link {
            position:absolute; top:2rem; right:2rem;
            font-family:var(--font-mono); font-size:.72rem; color:var(--muted);
            text-decoration:none; display:flex; align-items:center; gap:.4rem;
            transition:color .2s;
        }
        .back-link:hover { color:var(--accent); }

        .form-brand { display:flex; align-items:center; gap:.75rem; margin-bottom:2.5rem; }
        .logo-icon {
            width:36px; height:36px; background:var(--accent);
            clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);
            display:flex; align-items:center; justify-content:center;
            font-family:var(--font-mono); font-size:.65rem; font-weight:700; color:#fff;
        }
        .brand-name { font-family:var(--font-display); font-size:1.5rem; letter-spacing:.05em; }
        .brand-name b { color:var(--accent); }

        h1 { font-family:var(--font-display); font-size:2.6rem; letter-spacing:.03em; line-height:1; margin-bottom:.4rem; }
        .subtitle { font-size:.875rem; color:var(--muted); margin-bottom:2rem; }

        /* form grid */
        .form-row { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
        .form-group { margin-bottom:1.1rem; }
        .form-group.full { grid-column:1/-1; }
        label {
            display:block; font-family:var(--font-mono); font-size:.65rem;
            color:var(--muted); letter-spacing:.14em; text-transform:uppercase; margin-bottom:.45rem;
        }
        input {
            width:100%; background:var(--dark); border:1px solid var(--border);
            color:var(--white); padding:.8rem 1rem; font-family:var(--font-body);
            font-size:.9rem; border-radius:2px; outline:none;
            transition:border-color .2s, box-shadow .2s;
        }
        input:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(230,57,70,.1); }
        input::placeholder { color:#3a3a52; }

        /* strength bar */
        .strength-wrap { margin-top:.4rem; }
        .strength-bar {
            height:3px; background:var(--border); border-radius:99px; overflow:hidden;
        }
        .strength-fill {
            height:100%; width:0%; border-radius:99px;
            transition:width .3s ease, background .3s ease;
        }
        .strength-label {
            font-family:var(--font-mono); font-size:.62rem; color:var(--muted);
            margin-top:.3rem; letter-spacing:.08em;
        }

        /* error */
        .alert-error {
            background:rgba(230,57,70,.08); border:1px solid rgba(230,57,70,.3);
            padding:.75rem 1rem; border-radius:2px;
            font-size:.82rem; color:#060e7c;; margin-bottom:1.25rem;
            display:flex; align-items:center; gap:.5rem;
        }

        .btn-submit {
            width:100%; background:var(--accent); border:none; color:#fff;
            padding:.95rem; font-family:var(--font-display); font-size:1.15rem;
            letter-spacing:.1em; cursor:pointer; border-radius:2px; margin-top:1.25rem;
            transition:background .2s, transform .15s;
            position:relative; overflow:hidden;
        }
        .btn-submit:hover { background:#000000;; transform:translateY(-1px); }
        .btn-submit::after {
            content:''; position:absolute; inset:0;
            background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent);
            transform:translateX(-100%); transition:transform .4s;
        }
        .btn-submit:hover::after { transform:translateX(100%); }

        .divider { text-align:center; margin:1.25rem 0; position:relative; }
        .divider::before { content:''; position:absolute; top:50%; left:0; right:0; height:1px; background:var(--border); }
        .divider span { background:var(--black); position:relative; padding:0 1rem; font-family:var(--font-mono); font-size:.68rem; color:var(--muted); }

        .login-link { text-align:center; font-size:.875rem; color:var(--muted); }
        .login-link a { color:var(--accent); text-decoration:none; font-weight:600; }
        .login-link a:hover { text-decoration:underline; }

        /* terms */
        .terms { font-family:var(--font-mono); font-size:.65rem; color:var(--muted); text-align:center; margin-top:.75rem; line-height:1.5; }
        .terms a { color:var(--accent); text-decoration:none; }

        @media(max-width:820px){
            body { grid-template-columns:1fr; }
            .visual-panel { display:none; }
            .form-panel { padding:4rem 1.5rem 2rem; }
            .form-row { grid-template-columns:1fr; }
        }

</style>
</head>
<body>

<!-- ── LEFT: visual ── -->
<div class="visual-panel">
    <div class="rings">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
    </div>
    <div class="vp-content">
        <div class="vp-icon">AS</div>
        <h2 class="vp-title">ÚNETE A<br><span class="outline">Auto</span><br>San</h2>
        <p class="vp-sub">Crea tu cuenta gratis y empieza a monitorear tus vehículos hoy mismo.</p>
        <div class="perks">
            <div class="perk">
                <span class="perk-icon">🚗</span>
                <div class="perk-text"><strong>Múltiples vehículos</strong>Gestiona toda tu flota desde un solo lugar</div>
            </div>
            <div class="perk">
                <span class="perk-icon">📡</span>
                <div class="perk-text"><strong>Sensores en tiempo real</strong>Temperatura, frenos, aceite y más</div>
            </div>
            <div class="perk">
                <span class="perk-icon">🚨</span>
                <div class="perk-text"><strong>Alertas instantáneas</strong>Detecta fallas antes de que ocurran</div>
            </div>
        </div>
    </div>
</div>

<!-- ── RIGHT: form ── -->
<div class="form-panel">
    <a href="/login" class="back-link">Ya tengo cuenta →</a>

    <div class="form-brand">
        <div class="logo-icon">AS</div>
        <span class="brand-name">Auto<b>San</b></span>
    </div>

    <h1>CREAR<br>CUENTA</h1>
    <p class="subtitle">Completa el formulario para comenzar</p>

    @if($errors->any())
    <div class="alert-error">
        <span>⚠</span> {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre_cliente" placeholder="Juan" required value="{{ old('nombre_cliente') }}">
            </div>
            <div class="form-group">
                <label>Apellido</label>
                <input type="text" name="apellido_cliente" placeholder="Pérez" required value="{{ old('apellido_cliente') }}">
            </div>
            <div class="form-group full">
                <label>Correo electrónico</label>
                <input type="email" name="correo" placeholder="juan@correo.com" required value="{{ old('correo') }}">
            </div>
            <div class="form-group full">
                <label>Contraseña</label>
                <input type="password" name="contrasena" id="passInput" placeholder="Mínimo 8 caracteres" required>
                <div class="strength-wrap">
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <div class="strength-label" id="strengthLabel">Escribe tu contraseña</div>
                </div>
            </div>
            <div class="form-group full">
                <label>Confirmar contraseña</label>
                <input type="password" name="contrasena_confirmation" placeholder="Repite la contraseña" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">CREAR MI CUENTA</button>
    </form>

    <div class="divider"><span>o</span></div>
    <p class="login-link">¿Ya tienes cuenta? <a href="/login">Iniciar sesión</a></p>
    <p class="terms">Al registrarte aceptas los <a href="#">Términos de uso</a> y la <a href="#">Política de privacidad</a></p>
</div>

<script>
    // Password strength meter
    const input = document.getElementById('passInput');
    const fill  = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');

    input.addEventListener('input', () => {
        const v = input.value;
        let score = 0;
        if (v.length >= 8)              score++;
        if (/[A-Z]/.test(v))            score++;
        if (/[0-9]/.test(v))            score++;
        if (/[^A-Za-z0-9]/.test(v))     score++;

        const levels = [
            { pct:'0%',   color:'transparent', text:'Escribe tu contraseña' },
            { pct:'25%',  color:'#e63946',      text:'Débil' },
            { pct:'50%',  color:'#f4a261',      text:'Regular' },
            { pct:'75%',  color:'#f4e261',      text:'Buena' },
            { pct:'100%', color:'#2ec4b6',      text:'Muy segura ✓' },
        ];
        const l = levels[score] || levels[0];
        fill.style.width      = l.pct;
        fill.style.background = l.color;
        label.textContent     = l.text;
        label.style.color     = l.color === 'transparent' ? 'var(--muted)' : l.color;
    });
</script>
</body>
</html>
