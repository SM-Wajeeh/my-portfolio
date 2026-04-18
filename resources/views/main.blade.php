<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WAJEEH — Developer Portfolio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Share+Tech+Mono&family=Barlow+Condensed:wght@300;400;700;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <link rel="icon" type="image/x-icon" href="https://t4.ftcdn.net/jpg/10/32/29/81/360_F_1032298154_UN8ZFwUyrEkaoSaYddsCkXANpkRCf98E.jpg">
</head>

<body>

    <!-- Custom Cursor -->
    <div id="cursor"></div>
    <div id="cursor-dot"></div>

    <!-- Code Rain Canvas -->
    <canvas id="bg-canvas"></canvas>

    <!-- NAV -->
    <nav>
        <a href="#" class="nav-brand">W<span>.</span>HAIDER</a>
        <ul class="nav-links">
            <li><a href="#about">About</a></li>
            <li><a href="#skills">Skills</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
        <div class="nav-status"></div>
    </nav>

    <!-- HERO -->
    <section id="hero">
        <div class="hero-eyebrow">Creative Developer · Tech Student · Bachelor</div>
        <h1 class="hero-title" id="heroTitle" data-text="WAJEEH">
            <span class="letter">W</span><span class="letter">A</span><span class="letter">J</span><span
                class="letter">E</span><span class="letter">E</span><span class="letter">H</span>
        </h1>
        <div class="hero-sub">Muhammad <span>Wajeeh</span> Haider</div>
        <div class="hero-cta">
            <a href="#projects" class="btn-electric">View Work</a>
            <a href="#contact" class="btn-ghost">Get In Touch</a>
        </div>
        <div class="hero-scroll-hint">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- ABOUT / BENTO GRID -->
    <section id="about" style="padding: 6rem 0;">
        <div class="container-fluid px-4">
            <div class="mb-5">
                <div class="section-label">// 01 — Identity</div>
                <h2 class="section-title">WHO I AM</h2>
            </div>

            <div class="bento-grid">
                <div class="bento-card span-5 card-identity tilt-card" style="transition-delay:.05s">
    <div class="big-number">01</div>
    <h3>Just a Guy Who Loves Code</h3>
    <p>I'm Muhammad Wajeeh Haider — a tech student obsessed with low-level stuff, clean code, and making cool content. Daytime? C++ mode: memory systems, game engines, building tools. Nighttime? Gaming content that mixes tech knowledge with fun. I don't just build things. I get weirdly obsessed with them.</p>
    <div style="margin-top:1rem; display:flex; gap:.5rem; flex-wrap:wrap;">
        <span class="stack-badge">C++</span>
        <span class="stack-badge">PHP / Laravel</span>
        <span class="stack-badge">C# / SQL</span>
        <span class="stack-badge">HTML / CSS / JS</span>
    </div>
</div>

                <div class="bento-card span-7 card-code tilt-card">
                    <div class="bg-orbs">
                        <div class="orb orb-1"></div>
                        <div class="orb orb-2"></div>
                        <div class="orb orb-3"></div>
                    </div>
                    <canvas id="iconCanvas" width="400" height="400"></canvas>
                </div>

                <!-- Stats -->
                {{-- <div class="bento-card span-3 card-stat tilt-card" style="transition-delay:.15s">
        <div class="stat-label">Projects Built</div>
        <div class="stat-value" id="count1">0</div>
      </div>
      <div class="bento-card span-3 card-stat tilt-card" style="transition-delay:.2s">
        <div class="stat-label">C++ Hours</div>
        <div class="stat-value" id="count2">0</div>
      </div> --}}

                <!-- About text -->
                <div class="bento-card span-8 card-about tilt-card" style="transition-delay:.1s; ">
                    <p class="about-text">
                        I'm<strong> Muhammad Wajeeh Haider </strong> — a tech student possessed by an obsession with low-level systems,
                        elegant architectures, and high-voltage creative content. By day, I breathe life into C++ —
                        engineering memory systems, game engines, and developer tools that don't just work, they
                        perform. By night, I switch domains to craft gaming content that translates raw technical depth
                        into pure entertainment.

                        Full-stack by necessity. Systems programmer by obsession.
                        I speak<strong> PHP, Laravel, C++, C#, HTML, CSS, JavaScript, MySQL, SQL </strong> — not as a résumé list, but as
                        my arsenal. Whether it's optimizing a database query to milliseconds, architecting a Laravel
                        backend, or squeezing cache efficiency from a game loop, I don't just build things. I obsess
                        over them until they sing.


                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════
     SKILLS — Dynamic from DB
════════════════════════════════════════════════════ -->
    <section id="skills" style="padding: 4rem 0;">
        <div class="container-fluid px-4">
            <div class="mb-5">
                <div class="section-label">// 02 — Arsenal</div>
                <h2 class="section-title">SKILLS</h2>
            </div>

            <div class="bento-grid">
                @forelse($skills as $skill)
                    <div class="bento-card span-4 card-skill tilt-card" style="--pct:{{ $skill->proficiency }}%;">
                        <div>
                            <div class="skill-icon">{{ $skill->icon }}</div>
                            <div class="skill-name">{{ $skill->name }}</div>
                            <div
                                style="font-family:var(--font-mono);font-size:.62rem;color:var(--dim);margin-top:.3rem;">
                                {{ $skill->description }}
                            </div>
                        </div>
                        <div>
                            <div style="display:flex;justify-content:space-between;margin-bottom:.4rem;">
                                <span
                                    style="font-family:var(--font-mono);font-size:.58rem;color:var(--dim);">Proficiency</span>
                                <span
                                    style="font-family:var(--font-mono);font-size:.58rem;color:var(--blue);">{{ $skill->proficiency }}%</span>
                            </div>
                            <div class="skill-bar-wrap">
                                <div class="skill-bar"></div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="color:var(--dim); font-family:var(--font-mono); font-size:.8rem;">
                        No skills added yet.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════════════
     PROJECTS — Dynamic from DB
════════════════════════════════════════════════════ -->
    <section id="projects" style="padding: 6rem 0;">
        <div class="container-fluid px-4">
            <div class="mb-5">
                <div class="section-label">// 03 — Work</div>
                <h2 class="section-title">PROJECTS</h2>
            </div>
            <div class="projects-grid">
                @forelse($projects as $project)
                    <div class="project-card tilt-card"
                        style="transition-delay:{{ $loop->index * 0.05 }}s;
             @if ($project->bg_image) background-image: linear-gradient(rgba(10,10,15,.85), rgba(10,10,15,.95)),
                                  url('{{ $project->bg_image }}'); @endif">
                        <div class="project-num">{{ $project->number }}</div>
                        <div class="project-tag">{{ $project->tag }}</div>
                        <div class="project-title">{{ $project->title }}</div>
                        <div class="project-desc">{{ $project->description }}</div>
                        <div class="project-stack">
                            @foreach ($project->stack_array as $badge)
                                <span class="stack-badge">{{ $badge }}</span>
                            @endforeach
                        </div>
                        <a href="{{ $project->link }}" class="project-link">View Project →</a>
                    </div>
                @empty
                    <p style="color:var(--dim); font-family:var(--font-mono); font-size:.8rem;">
                        No projects added yet.
                    </p>
                @endforelse
            </div>
        </div>
    </section>

   {{-- ═══════════════════════════════════════════════════
     CONTACT — Dynamic contact form
════════════════════════════════════════════════════ --}}
<section id="contact">
    <div class="container-fluid px-4 text-center">
        <div class="section-label" style="justify-content:center;display:flex">// 04 — Connect</div>
        <h2 class="contact-title">LET'S <span>BUILD</span><br>SOMETHING.</h2>
        <p class="about-text" style="max-width:480px;margin:0 auto;">Open to internships, collaborations, and
            projects that push boundaries.</p>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="contact-flash contact-flash--success">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="contact-flash contact-flash--error">
                ✗ {{ session('error') }}
            </div>
        @endif

        {{-- Contact Form --}}
        <form action="{{ route('contact.send') }}" method="POST" class="contact-form" id="contactForm">
            @csrf
            <div class="contact-form__row">
                <div class="contact-form__field">
                    <label for="contact_name">Name</label>
                    <input
                        type="text"
                        id="contact_name"
                        name="name"
                        placeholder="Your name"
                        value="{{ old('name') }}"
                        required
                    />
                    @error('name')
                        <span class="contact-form__error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="contact-form__field">
                    <label for="contact_email">Email</label>
                    <input
                        type="email"
                        id="contact_email"
                        name="email"
                        placeholder="your@email.com"
                        value="{{ old('email') }}"
                        required
                    />
                    @error('email')
                        <span class="contact-form__error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="contact-form__field">
                <label for="contact_subject">Subject</label>
                <input
                    type="text"
                    id="contact_subject"
                    name="subject"
                    placeholder="What's this about?"
                    value="{{ old('subject') }}"
                    required
                />
                @error('subject')
                    <span class="contact-form__error">{{ $message }}</span>
                @enderror
            </div>
            <div class="contact-form__field">
                <label for="contact_message">Message</label>
                <textarea
                    id="contact_message"
                    name="message"
                    rows="5"
                    placeholder="Tell me about your project..."
                    required
                >{{ old('message') }}</textarea>
                @error('message')
                    <span class="contact-form__error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn-electric contact-form__submit">
                <span class="btn-text">Send Message</span>
                <span class="btn-loader" style="display:none;">Sending…</span>
            </button>
        </form>

        <div class="contact-links">
            <a href="https://github.com/SM-Wajeeh/" class="btn-electric">GitHub</a>
            <a href="https://www.linkedin.com/in/syed-muhammad-76436a378/" class="btn-ghost">LinkedIn</a>
        </div>
    </div>
</section>
    <div class="divider" style="margin:0 2.5rem"></div>

    <footer>
        <span>© 2025 — Muhammad Wajeeh Haider</span>
        <span style="color:var(--blue);">Creative Developer · Tech Student</span>
        <span>Karachi, Pakistan</span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Your existing scripts below --}}
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
