/* ─── CODE RAIN ─── */
(function () {
  const canvas = document.getElementById('bg-canvas');
  const ctx = canvas.getContext('2d');

  const CHARS = 'アイウエオカキクケコサシスセソタチツテトナニヌネノABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789<>{}[]#$%&*+-=';
  const COL_W = 18;
  const FONT_SIZE = 13;
  const FPS = 1000 / 55;

  let W, H, cols, drops, speeds, glowDrops, lastTime = 0;

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
    cols      = Math.floor(W / COL_W);
    drops     = Array.from({ length: cols }, () => Math.random() * -(H / FONT_SIZE));
    speeds    = Array.from({ length: cols }, () => 0.28 + Math.random() * 0.32);
    glowDrops = Array.from({ length: Math.floor(cols * 0.08) }, () => ({
      col:   Math.floor(Math.random() * cols),
      y:     Math.random() * (H / FONT_SIZE),
      speed: 0.55 + Math.random() * 0.3,
    }));
  }

  function hexAlpha(hex, a) {
    return `rgba(${parseInt(hex.slice(1,3),16)},${parseInt(hex.slice(3,5),16)},${parseInt(hex.slice(5,7),16)},${a.toFixed(3)})`;
  }

  const BODY  = '#00e5ff';
  const HEAD  = '#ffffff';
  const TRAIL = 'rgba(0,0,0,0.12)';

  function draw(now) {
    requestAnimationFrame(draw);
    if (now - lastTime < FPS) return;
    lastTime = now;

    ctx.clearRect(0, 0, W, H);
    ctx.fillStyle = TRAIL;
    ctx.fillRect(0, 0, W, H);
    ctx.font = `${FONT_SIZE}px 'Share Tech Mono', monospace`;

    for (let i = 0; i < cols; i++) {
      const py = drops[i] * FONT_SIZE;
      if (py < 0) { drops[i] += speeds[i]; continue; }
      const alpha = 0.05 + (1 - Math.min(py / H, 1)) * 0.12;
      ctx.fillStyle = hexAlpha(BODY, alpha);
      ctx.fillText(CHARS[Math.floor(Math.random() * CHARS.length)], i * COL_W + 2, py);
      if (py > H && Math.random() > 0.972) {
        drops[i] = Math.random() * -15;
        speeds[i] = 0.28 + Math.random() * 0.32;
      }
      drops[i] += speeds[i];
    }

    for (const g of glowDrops) {
      const px = g.col * COL_W + 2;
      const py = g.y * FONT_SIZE;
      if (py > 0 && py < H) {
        ctx.fillStyle = py < FONT_SIZE ? HEAD : BODY;
        ctx.fillText(CHARS[Math.floor(Math.random() * CHARS.length)], px, py);
        for (let t = 1; t <= 6; t++) {
          const ty = py - t * FONT_SIZE;
          if (ty < 0) break;
          ctx.fillStyle = hexAlpha(BODY, (1 - t / 6) * 0.55);
          ctx.fillText(CHARS[Math.floor(Math.random() * CHARS.length)], px, ty);
        }
      }
      if (py > H && Math.random() > 0.94) {
        g.col   = Math.floor(Math.random() * cols);
        g.y     = Math.random() * -5;
        g.speed = 0.55 + Math.random() * 0.3;
      }
      g.y += g.speed;
    }
  }

  resize();
  window.addEventListener('resize', resize);
  requestAnimationFrame(draw);
})();

/* ─── CURSOR ─── */
(function () {
  const c   = document.getElementById('cursor');
  const dot = document.getElementById('cursor-dot');
  let mx = 0, my = 0;

  document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });

  // Dot is instant; ring follows with lerp
  function animCursor() {
    const cx = parseFloat(c.style.left) || mx;
    const cy = parseFloat(c.style.top)  || my;
    const nx = cx + (mx - cx) ;
    const ny = cy + (my - cy) ;
    c.style.left   = nx + 'px';
    c.style.top    = ny + 'px';
    dot.style.left = mx + 'px';
    dot.style.top  = my + 'px';
    requestAnimationFrame(animCursor);
  }
  animCursor();

  document.querySelectorAll('a, button, .bento-card, .project-card').forEach(el => {
    el.addEventListener('mouseenter', () => c.classList.add('hovering'));
    el.addEventListener('mouseleave', () => c.classList.remove('hovering'));
  });
})();

/* ─── MAGNETIC HERO LETTERS ─── */
(function () {
  const letters  = document.querySelectorAll('.hero-title .letter');
  const STRENGTH = 55;
  const RADIUS   = 160;

  document.addEventListener('mousemove', e => {
    letters.forEach(el => {
      const r    = el.getBoundingClientRect();
      const cx   = r.left + r.width  / 2;
      const cy   = r.top  + r.height / 2;
      const dx   = e.clientX - cx;
      const dy   = e.clientY - cy;
      const dist = Math.hypot(dx, dy);
      if (dist < RADIUS) {
        const factor = (1 - dist / RADIUS) * STRENGTH;
        const angle  = Math.atan2(dy, dx);
        const tx     = Math.cos(angle) * factor;
        const ty     = Math.sin(angle) * factor;
        el.style.transform = `translate(${tx * 0.6}px,${ty * 0.4}px) skewX(${tx * 0.15}deg) scaleX(${1 + Math.abs(tx) * 0.003})`;
        el.style.color     = `hsl(${195 + tx * 0.3},100%,${65 + Math.abs(ty) * 0.2}%)`;
      } else {
        el.style.transform = '';
        el.style.color     = '';
      }
    });
  });
})();

/* ─── SCROLL REVEAL ─── */
(function () {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (!entry.isIntersecting) return;
      setTimeout(() => entry.target.classList.add('visible'), i * 60);
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.bento-card, .project-card').forEach(el => observer.observe(el));
})();

/* ─── PARALLAX TILT ON SCROLL ─── */
(function () {
  let ticking = false;
  window.addEventListener('scroll', () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      const vpH = window.innerHeight;
      document.querySelectorAll('.tilt-card.visible').forEach(card => {
        const rect  = card.getBoundingClientRect();
        const delta = (rect.top + rect.height / 2 - vpH / 2) / (vpH / 2);
        card.style.transform = `translateY(${delta * -8}px) rotateX(${delta * 1.5}deg)`;
      });
      ticking = false;
    });
  });
})();

/* ─── SMOOTH SCROLL FOR NAV LINKS ─── */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });
});

/* ─── ICON SPHERE ─── */
(function () {
  const container = document.querySelector('.card-code');
  const canvas    = document.getElementById('iconCanvas');
  if (!container || !canvas) return;

  const ctx    = canvas.getContext('2d');
  const IS_MOB = window.innerWidth < 768;
  const RADIUS = IS_MOB ? 100 : 120;
  const ISIZE  = 32;
  const CONNECT_DIST = 0.6; // dot-product threshold for drawing a line

  const brands = [
    'javascript','typescript','html5','css3','github','tailwindcss','visualstudiocode',
    'sass','git','mysql','java','php','laravel','bootstrap'
  ];

  let points = [];
  let angleX = 0, angleY = 0;
  let velX = 0.0008, velY = 0.0018;
  let rafId, lastTime = 0;
  const FPS = 1000 / 40;

  Promise.all(
    brands.map(brand => new Promise(resolve => {
      const img = new Image();
      img.crossOrigin = 'anonymous';
      img.onload  = () => resolve(img);
      img.onerror = () => resolve(null);
      img.src = `https://unpkg.com/simple-icons@v11/icons/${brand}.svg`;
    }))
  ).then(images => {
    const valid = images.filter(Boolean);
    const n = valid.length;
    const PHI = Math.PI * (1 + Math.sqrt(5));
    points = valid.map((img, i) => {
      const t     = (i + 0.5) / n;
      const phi   = Math.acos(1 - 2 * t);
      const theta = PHI * i;
      return {
        x: Math.cos(theta) * Math.sin(phi),
        y: Math.sin(theta) * Math.sin(phi),
        z: Math.cos(phi),
        img,
      };
    });
    rafId = requestAnimationFrame(animate);
  });

  const projected = [];

  function animate(now) {
    rafId = requestAnimationFrame(animate);
    if (now - lastTime < FPS) return;
    lastTime = now;

    angleX += velX;
    angleY += velY;

    const cosX = Math.cos(angleX), sinX = Math.sin(angleX);
    const cosY = Math.cos(angleY), sinY = Math.sin(angleY);

    projected.length = 0;
    for (let i = 0; i < points.length; i++) {
      const p  = points[i];
      const x1 = p.x * cosY - p.z * sinY;
      const z1 = p.x * sinY + p.z * cosY;
      const y1 = p.y * cosX - z1 * sinX;
      const z2 = p.y * sinX + z1 * cosX;
      projected.push({ x: x1, y: y1, z: z2, img: p.img });
    }

    projected.sort((a, b) => a.z - b.z);

    const cx = canvas.width  / 2;
    const cy = canvas.height / 2;

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // ── Draw connection lines first (behind icons) ──
    for (let i = 0; i < projected.length; i++) {
      for (let j = i + 1; j < projected.length; j++) {
        const a = projected[i];
        const b = projected[j];

        // Dot product of unit vectors = cosine of angle between them
        const dot = a.x * b.x + a.y * b.y + a.z * b.z;
        if (dot < CONNECT_DIST) continue;

        // Both points visible (positive z = facing camera)
        const bothVisible = a.z > -0.2 && b.z > -0.2;
        if (!bothVisible) continue;

        const ax = a.x * RADIUS + cx;
        const ay = a.y * RADIUS + cy;
        const bx = b.x * RADIUS + cx;
        const by = b.y * RADIUS + cy;

        // Line fades with average depth and proximity
        const proximity = (dot - CONNECT_DIST) / (1 - CONNECT_DIST);
        const depthFade = ((a.z + b.z) / 2 + 1) / 2;
        const alpha = proximity * depthFade * 0.5;

        ctx.beginPath();
        ctx.moveTo(ax, ay);
        ctx.lineTo(bx, by);
        ctx.strokeStyle = `rgba(0, 229, 255, ${alpha.toFixed(3)})`;
        ctx.lineWidth = proximity * 0.8;
        ctx.stroke();
      }
    }

    // ── Draw icons on top ──
    for (let i = 0; i < projected.length; i++) {
      const p     = projected[i];
      const scale = (p.z + 1.5) / 2;
      const size  = ISIZE * scale;
      const x2d   = p.x * RADIUS + cx;
      const y2d   = p.y * RADIUS + cy;
      const alpha = Math.max(0.08, (p.z + 1) / 2);

      if (!p.img.complete || p.img.naturalWidth === 0) continue;

      ctx.save();
      ctx.globalAlpha = alpha;
      ctx.filter = 'brightness(0) invert(1)';
      ctx.drawImage(p.img, x2d - size / 2, y2d - size / 2, size, size);
      ctx.restore();
    }
  }

  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        if (!rafId) rafId = requestAnimationFrame(animate);
      } else {
        cancelAnimationFrame(rafId);
        rafId = null;
      }
    });
  });
  observer.observe(canvas);

  container.addEventListener('mousemove', e => {
    const r = container.getBoundingClientRect();
    velX = ((e.clientY - r.top)  / r.height - 0.5) * 0.006;
    velY = ((e.clientX - r.left) / r.width  - 0.5) * 0.006;
  });
  container.addEventListener('mouseleave', () => {
    velX = 0.0008;
    velY = 0.0018;
  });
})();
