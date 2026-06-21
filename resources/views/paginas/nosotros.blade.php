<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros — AutoSen</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/vehiculoscss/nosotros.css">
</head>
<body>
<style>
    
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --black:#0a0a0c; --dark:#111116; --card:#16161e; --border:#2a2a38;
            --accent:#030853; --gold:#f4a261; --white:#f0eff4; --muted:#7a7a96;
            --font-display:'Bebas Neue',sans-serif; --font-body:'DM Sans',sans-serif; --font-mono:'JetBrains Mono',monospace;
        }
        html { scroll-behavior: smooth; }
        body { background:var(--black); color:var(--white); font-family:var(--font-body); overflow-x:hidden; }

        nav {
            position:fixed; top:0; left:0; right:0; z-index:100;
            display:flex; align-items:center; justify-content:space-between;
            padding:1.25rem 3rem;
            backdrop-filter:blur(16px);
            background:rgba(10,10,12,.7);
            border-bottom:1px solid var(--border);
        }
        .nav-logo { display:flex; align-items:center; gap:.75rem; text-decoration:none; }
        .logo-icon { width:38px; height:38px; background:var(--accent); clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%); display:flex; align-items:center; justify-content:center; font-size:.7rem; font-family:var(--font-mono); font-weight:700; color:#fff; }
        .nav-logo span { font-family:var(--font-display); font-size:1.6rem; letter-spacing:.05em; }
        .nav-logo span b { color:var(--accent); }
        .nav-links { display:flex; align-items:center; gap:.5rem; }
        .btn-ghost { background:transparent; border:1px solid var(--border); color:var(--white); padding:.55rem 1.4rem; border-radius:2px; font-family:var(--font-body); font-size:.875rem; font-weight:500; cursor:pointer; text-decoration:none; transition:border-color .2s,color .2s; }
        .btn-ghost:hover { border-color:var(--accent); color:var(--accent); }
        .btn-primary { background:var(--accent); border:1px solid var(--accent); color:#fff; padding:.55rem 1.4rem; border-radius:2px; font-family:var(--font-body); font-size:.875rem; font-weight:700; cursor:pointer; text-decoration:none; transition:background .2s; }
        .btn-primary:hover { background:#030853; }

        .page-header {
            padding: 9rem 3rem 5rem;
            position: relative;
            overflow: hidden;
        }
        .page-header::after {
            content:'';
            position:absolute; top:0; right:0; bottom:0;
            width:40%;
            background: linear-gradient(135deg, rgba(3, 8, 83, .08), transparent);
            clip-path: polygon(30% 0%, 100% 0%, 100% 100%, 0% 100%);
        }
        .page-tag { font-family:var(--font-mono); font-size:.7rem; color:var(--accent); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.75rem; }
        .page-title { font-family:var(--font-display); font-size:clamp(4rem,7vw,8rem); line-height:.9; letter-spacing:.02em; }
        .page-title .outline { -webkit-text-stroke:1.5px var(--white); color:transparent; }

        .section { padding:5rem 3rem; }
        .section-dark { background:var(--dark); }

        .about-grid { display:grid; grid-template-columns:1fr 1fr; gap:4rem; align-items:center; }
        .about-text h2 { font-family:var(--font-display); font-size:2.5rem; margin-bottom:1.25rem; letter-spacing:.03em; }
        .about-text p { color:var(--muted); line-height:1.75; margin-bottom:1rem; }

        .about-visual {
            background: var(--card);
            border:1px solid var(--border);
            border-left:3px solid var(--accent);
            padding:2rem;
            font-family:var(--font-mono);
            font-size:.8rem;
        }
        .code-line { margin-bottom:.5rem; }
        .c-key { color:#7dcfff; }
        .c-str { color:#9ece6a; }
        .c-num { color:var(--gold); }
        .c-comment { color:var(--muted); }

        .values-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; margin-top:3rem; }
        .value-card {
            background:var(--card); border:1px solid var(--border); padding:2rem;
            border-radius:4px; position:relative; overflow:hidden;
            transition:border-color .25s;
        }
        .value-card:hover { border-color:var(--accent); }
        .value-icon { font-size:2rem; margin-bottom:1rem; }
        .value-title { font-family:var(--font-display); font-size:1.4rem; letter-spacing:.04em; margin-bottom:.5rem; }
        .value-desc { font-size:.85rem; color:var(--muted); line-height:1.6; }

        .team-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:1.5rem; margin-top:3rem; }
        .team-card { background:var(--card); border:1px solid var(--border); padding:2rem; text-align:center; transition:border-color .25s; }
        .team-card:hover { border-color:var(--accent); }
        .avatar { width:72px; height:72px; border-radius:50%; background: linear-gradient(135deg, var(--accent), var(--gold)); margin:0 auto 1rem; display:flex; align-items:center; justify-content:center; font-family:var(--font-display); font-size:1.8rem; color:#fff; }
        .team-name { font-weight:700; font-size:.95rem; margin-bottom:.25rem; }
        .team-role { font-family:var(--font-mono); font-size:.7rem; color:var(--accent); letter-spacing:.10m; text-transform:uppercase; }

        .section-tag { font-family:var(--font-mono); font-size:.7rem; color:var(--accent); letter-spacing:.2em; text-transform:uppercase; margin-bottom:.75rem; display:flex; align-items:center; gap:.5rem; }
        .section-tag::before { content:'//'; opacity:.5; }
        .section-title { font-family:var(--font-display); font-size:clamp(2.5rem,4vw,4rem); line-height:1; letter-spacing:.02em; margin-bottom:0; }

        footer { background:var(--black); border-top:1px solid var(--border); padding:2rem 3rem; display:flex; justify-content:space-between; align-items:center; }
        footer p { font-family:var(--font-mono); font-size:.75rem; color:var(--muted); }

        .fade-in { opacity:0; transform:translateY(24px); transition:opacity .5s,transform .5s; }
        .fade-in.visible { opacity:1; transform:translateY(0); }

        @media (max-width:768px) {
            nav { padding:1rem 1.5rem; }
            .page-header,.section { padding:7rem 1.5rem 3rem; }
            .about-grid { grid-template-columns:1fr; }
        }

</style>
<nav>
    <a href="/" class="nav-logo">
        <div class="logo-icon">AS</div>
        <span>Auto<b>Sen</b></span>
    </a>
    <div class="nav-links">
        <a href="/nosotros" class="btn-ghost" style="border-color:var(--accent);color:var(--accent);">Nosotros</a>
        <a href="/login" class="btn-primary">Iniciar Sesión</a>
    </div>
</nav>

<div class="page-header">
    <p class="page-tag">// Quiénes somos</p>
    <h1 class="page-title">SOBRE<br><span class="outline">NOSOTROS</span></h1>
</div>

<section class="section">
    <div class="about-grid fade-in">
        <div class="about-text">
                        <h2>Ingeniería al servicio de tu vehículo</h2>
                        <p>Autosen nació de la necesidad de democratizar el diagnóstico vehicular avanzado. Somos un equipo de ingenieros y entusiastas del automóvil que creemos que la tecnología debe proteger tu inversión antes de que los problemas aparezcan.</p>
            <p>Nuestra plataforma conecta sensores físicos con inteligencia de datos, permitiendo a propietarios y técnicos tomar decisiones informadas en tiempo real.</p>
            <p>Desde Bogotá para todo el mundo, trabajamos cada día para que ningún vehículo falle por falta de información.</p>
        </div>
        <div class="about-visual">
            <div class="code-line"><span class="c-comment">// Autosen </span></div>
            <div class="code-line"><span class="c-key">const</span> empresa = {</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">nombre</span>: <span class="c-str">"Autosen"</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">fundada</span>: <span class="c-num">2026</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">sede</span>: <span class="c-str">"Bogotá, Colombia"</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">vehiculos</span>: <span class="c-num">+</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">sensores</span>: <span class="c-num">+</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">uptime</span>: <span class="c-str">"99.98%"</span>,</div>
            <div class="code-line">&nbsp;&nbsp;<span class="c-key">mision</span>: <span class="c-str">"Cero fallas inesperadas"</span></div>
            <div class="code-line">};</div>
        </div>
    </div>
</section>

<section class="section section-dark">
    <div class="section-tag fade-in">Nuestros valores</div>
    <h2 class="section-title fade-in">LO QUE<br>NOS MUEVE</h2>
    <div class="values-grid">
        <div class="value-card fade-in">
            <div class="value-icon">⚡</div>
            <h3 class="value-title">Precisión</h3>
            <p class="value-desc">Cada lectura importa. Calibramos nuestros algoritmos continuamente para garantizar datos exactos y diagnósticos confiables.</p>
        </div>
        <div class="value-card fade-in">
            <div class="value-icon">🔒</div>
            <h3 class="value-title">Seguridad</h3>
            <p class="value-desc">Los datos de tus vehículos son tuyos. Usamos cifrado de extremo a extremo y no compartimos información con terceros.</p>
        </div>
        <div class="value-card fade-in">
            <div class="value-icon">🌐</div>
            <h3 class="value-title">Accesibilidad</h3>
            <p class="value-desc">Tecnología de diagnóstico que antes era exclusiva de talleres especializados, ahora en la palma de tu mano.</p>
        </div>
        <div class="value-card fade-in">
            <div class="value-icon">🚀</div>
            <h3 class="value-title">Innovación</h3>
            <p class="value-desc">Mejoramos constantemente nuestra plataforma con machine learning y análisis predictivo de última generación.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-tag fade-in">Equipo</div>
    <h2 class="section-title fade-in">QUIÉNES<br>LO HACEN</h2>
    <div class="team-grid">
        <div class="team-card fade-in">
            <div class="avatar">CL</div>
            <div class="team-name">Miller Joel Moncaleano Manjarres</div>
            <div class="team-role">Product Owner</div>
        </div>
        <div class="team-card fade-in">
            <div class="avatar" style="background:linear-gradient(135deg,#2ec4b6,#0a9396)">AM</div>
            <div class="team-name">Jader alonso poso</div>
            <div class="team-role">Scrum Master y Developers</div>
        </div>
        <div class="team-card fade-in">
            <div class="avatar" style="background:linear-gradient(135deg,var(--gold),#e07b39)">JR</div>
            <div class="team-name">Michael Ferney Bravo</div>
            <div class="team-role">Developers</div>
        </div>
        
    </div>
</section>

<footer>
    <p>© {{ date('Y') }} AutoSen</p>
    <a href="/" style="font-family:var(--font-mono);font-size:.75rem;color:var(--accent);text-decoration:none;">← Volver al inicio</a>
</footer>

<script>
    const obs = new IntersectionObserver(entries => {
        entries.forEach((e,i) => { if(e.isIntersecting){ setTimeout(()=>e.target.classList.add('visible'),i*100); obs.unobserve(e.target); } });
    },{threshold:0.1});
    document.querySelectorAll('.fade-in').forEach(el=>obs.observe(el));
</script>
</body>
</html>
