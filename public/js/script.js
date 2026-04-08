/* ─── CODE RAIN ─── */
(function () {
  const canvas = document.getElementById('bg-canvas');
  const ctx = canvas.getContext('2d');
  let W, H, drops = [];
  const CHARS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789<>{}[]#$%&*+-=';
  const COL_W = 20;
  let lastTime = 0;
  const INTERVAL = 60; // ms between frames

  function resize() {
    W = canvas.width = window.innerWidth;
    H = canvas.height = window.innerHeight;
    const cols = Math.floor(W / COL_W);
    drops = Array.from({ length: cols }, () => Math.random() * -H / 16);
  }

  function draw(now) {
    requestAnimationFrame(draw);
    if (now - lastTime < INTERVAL) return;
    lastTime = now;

    ctx.fillStyle = 'rgba(10,10,10,0.055)';
    ctx.fillRect(0, 0, W, H);
    ctx.font = "11px 'Share Tech Mono', monospace";

    for (let i = 0; i < drops.length; i++) {
      const ch = CHARS[Math.floor(Math.random() * CHARS.length)];
      const alpha = 0.06 + Math.random() * 0.06;
      ctx.fillStyle = `rgba(0,191,255,${alpha})`;
      ctx.fillText(ch, i * COL_W + 4, drops[i] * 16);
      if (drops[i] * 16 > H && Math.random() > 0.975) drops[i] = 0;
      drops[i] += 0.38;
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
  const ctx = canvas.getContext('2d');

  const RADIUS    = window.innerWidth < 768 ? 100 : 150;
  const ICON_SIZE = window.innerWidth < 768 ? 32  : 42;
  let rotation       = { x: 0,     y: 0 };
  let targetRotation = { x: 0.001, y: 0.001 };
  let points = [];
  let loaded = 0;
  const iconImages = [];

  const brands = [
    'javascript','react','nodedotjs','typescript','figma','nextdotjs','html5','css3',
    'python','mongodb','github','docker','tailwindcss','firebase','visualstudiocode',
    'sass','git','npm','graphql','mysql','cplusplus','java','php','laravel','vuedotjs',
    'bootstrap','linux','amazonwebservices','arduino','android'
  ];

  brands.forEach(brand => {
    const img = new Image();
    img.crossOrigin = 'anonymous';
    img.src = `https://unpkg.com/simple-icons@v11/icons/${brand}.svg`;
    img.onload = img.onerror = () => { if (++loaded === brands.length) init(); };
    iconImages.push(img);
  });

  function init() {
    const n = iconImages.length;
    for (let i = 0; i < n; i++) {
      const phi   = Math.acos(1 - 2 * (i + 0.5) / n);
      const theta = Math.PI * (1 + Math.sqrt(5)) * (i + 0.5);
      points.push({
        x: Math.cos(theta) * Math.sin(phi),
        y: Math.sin(theta) * Math.sin(phi),
        z: Math.cos(phi),
        img: iconImages[i]
      });
    }
    requestAnimationFrame(animate);
  }

  function animate() {
    requestAnimationFrame(animate);
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    rotation.x += (targetRotation.x - rotation.x) * 0.02;
    rotation.y += (targetRotation.y - rotation.y) * 0.02;

    const cosX = Math.cos(rotation.x), sinX = Math.sin(rotation.x);
    const cosY = Math.cos(rotation.y), sinY = Math.sin(rotation.y);

    points = points.map(p => {
      const x1 = p.x * cosY - p.z * sinY;
      const z1 = p.x * sinY + p.z * cosY;
      const y1 = p.y * cosX - z1 * sinX;
      const z2 = p.y * sinX + z1 * cosX;
      return { x: x1, y: y1, z: z2, img: p.img };
    });

    const cx = canvas.width  / 2;
    const cy = canvas.height / 2;
    const sorted = [...points].sort((a, b) => a.z - b.z);

    sorted.forEach(p => {
      const scale = (p.z + 1.5) / 2;
      const size  = ICON_SIZE * scale;
      const x2d   = p.x * RADIUS + cx;
      const y2d   = p.y * RADIUS + cy;
      ctx.globalAlpha = Math.max(0.1, (p.z + 1) / 2);
      if (p.img.complete && p.img.naturalWidth !== 0) {
        ctx.shadowBlur  = 20 * scale;
        ctx.shadowColor = 'rgba(255,255,255,0.25)';
        ctx.filter      = 'brightness(0) invert(1)';
        ctx.drawImage(p.img, x2d - size / 2, y2d - size / 2, size, size);
        ctx.filter      = 'none';
        ctx.shadowBlur  = 0;
      }
    });
    ctx.globalAlpha = 1;
  }

  container.addEventListener('mousemove', e => {
    const r = container.getBoundingClientRect();
    targetRotation.x = ((e.clientY - r.top)  / r.height - 0.5) * 0.05;
    targetRotation.y = ((e.clientX - r.left) / r.width  - 0.5) * 0.05;
  });
  container.addEventListener('mouseleave', () => {
    targetRotation = { x: 0.001, y: 0.001 };
  });
})();
