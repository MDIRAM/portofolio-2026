<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $content['meta_title'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #090a0f;
            --surface: #11131b;
            --surface-strong: #171a25;
            --accent: #9f45ff;
            --accent-2: #25e0b8;
            --text: #f7f3ff;
            --muted: #9b96a7;
            --line: #242633;
        }

        * {
            box-sizing: border-box;
        }

        html {
            background: var(--bg);
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Inter", Arial, sans-serif;
            background:
                radial-gradient(circle at 78% 20%, rgba(37, 224, 184, 0.12), transparent 28%),
                radial-gradient(circle at 18% 82%, rgba(159, 69, 255, 0.16), transparent 30%),
                linear-gradient(180deg, #0e0f16 0%, var(--bg) 100%),
                var(--bg);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: clamp(28px, 5vw, 72px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .hero {
            width: min(1120px, 100%);
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(310px, 486px);
            align-items: center;
            gap: clamp(42px, 8vw, 98px);
        }

        .eyebrow {
            width: fit-content;
            margin: 0 0 20px;
            padding: 8px 13px;
            border: 1px solid rgba(37, 224, 184, 0.22);
            border-radius: 999px;
            color: var(--accent-2);
            background: rgba(37, 224, 184, 0.08);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        h1 {
            max-width: 720px;
            margin: 0;
            color: var(--text);
            font-size: clamp(44px, 6.7vw, 74px);
            line-height: 1.07;
            font-weight: 800;
            letter-spacing: 0;
        }

        h1 span {
            color: var(--accent);
        }

        .summary {
            max-width: 560px;
            margin: 30px 0 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.7;
            letter-spacing: 0;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-top: 38px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0 22px;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease;
        }

        .button:hover {
            transform: translateY(-2px);
        }

        .button.primary {
            background: var(--accent);
            color: #ffffff;
            box-shadow: 0 18px 40px rgba(159, 69, 255, 0.22);
        }

        .button.secondary {
            border-color: rgba(255, 255, 255, 0.22);
            color: var(--text);
            background: rgba(255, 255, 255, 0.04);
        }

        .stack {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 34px 0 0;
            padding: 0;
            list-style: none;
        }

        .stack li {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            color: #d8d3e4;
            background: rgba(255, 255, 255, 0.04);
            font-size: 13px;
            font-weight: 600;
        }

        .visual {
            position: relative;
            min-height: 590px;
            display: grid;
            place-items: center;
        }

        .visual::before,
        .visual::after {
            content: "";
            position: absolute;
            top: 5%;
            width: 32%;
            height: 90%;
            border: 1px solid rgba(159, 69, 255, 0.22);
            background: rgba(159, 69, 255, 0.08);
        }

        .visual::before {
            left: 0;
        }

        .visual::after {
            right: 0;
        }

        .photo-card {
            position: relative;
            z-index: 1;
            width: calc(100% - 44px);
            aspect-ratio: 460 / 540;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            background: linear-gradient(145deg, #191b25, #0c0d12);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.42);
        }

        .photo-fallback {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: clamp(52px, 10vw, 92px);
            font-weight: 800;
            background:
                linear-gradient(135deg, rgba(159, 69, 255, 0.24), transparent 42%),
                linear-gradient(315deg, rgba(37, 224, 184, 0.2), transparent 46%),
                var(--surface);
        }

        .photo-card img {
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: center top;
        }

        .photo-card::after {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            background:
                linear-gradient(120deg, rgba(37, 224, 184, 0.14), transparent 38%),
                linear-gradient(260deg, rgba(159, 69, 255, 0.18), transparent 42%),
                linear-gradient(180deg, transparent 58%, rgba(9, 10, 15, 0.36));
        }

        .section {
            width: min(1120px, 100%);
            margin: 0 auto;
            padding: 0 clamp(28px, 5vw, 72px) clamp(56px, 8vw, 96px);
        }

        .section-header {
            max-width: 680px;
            margin-bottom: 28px;
        }

        .section h2 {
            margin: 0;
            color: var(--text);
            font-size: clamp(32px, 4.5vw, 52px);
            line-height: 1.1;
            letter-spacing: 0;
        }

        .section-text {
            margin: 16px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
        }

        .project-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .project-card {
            min-height: 220px;
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.045);
        }

        .project-card h3 {
            margin: 0;
            color: var(--text);
            font-size: 19px;
            line-height: 1.35;
        }

        .project-card p {
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
        }

        .project-card span {
            display: inline-flex;
            margin-top: 20px;
            color: var(--accent-2);
            font-size: 13px;
            font-weight: 700;
        }

        .project-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 20px;
        }

        .project-status {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 0 10px;
            border: 1px solid rgba(37, 224, 184, 0.24);
            border-radius: 999px;
            color: var(--accent-2);
            background: rgba(37, 224, 184, 0.08);
            font-size: 12px;
            font-weight: 800;
        }

        .project-progress {
            flex: 1;
            height: 8px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.08);
        }

        .project-progress i {
            display: block;
            width: var(--progress);
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--accent-2), var(--accent));
        }

        .project-link {
            display: inline-flex;
            margin-top: 18px;
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .project-link:hover {
            color: var(--accent-2);
        }

        .contact-layout {
            display: grid;
            grid-template-columns: minmax(0, 0.8fr) minmax(320px, 1.2fr);
            gap: 24px;
            align-items: start;
        }

        .contact-note {
            padding: 22px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.045);
        }

        .contact-note p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .contact-form {
            display: grid;
            gap: 14px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            color: var(--text);
            font-size: 14px;
            font-weight: 700;
        }

        .field input,
        .field textarea {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            outline: none;
            color: var(--text);
            background: rgba(255, 255, 255, 0.045);
            font: inherit;
        }

        .field input {
            min-height: 48px;
            padding: 0 14px;
        }

        .field textarea {
            min-height: 140px;
            resize: vertical;
            padding: 14px;
            line-height: 1.6;
        }

        .field input:focus,
        .field textarea:focus {
            border-color: rgba(37, 224, 184, 0.5);
        }

        .form-status {
            margin: 0 0 14px;
            padding: 12px 14px;
            border-radius: 8px;
            color: var(--accent-2);
            background: rgba(37, 224, 184, 0.08);
            font-size: 14px;
            font-weight: 700;
        }

        .form-error {
            color: #ff8f8f;
            font-size: 13px;
            line-height: 1.5;
        }

        @media (max-width: 920px) {
            .page {
                place-items: start center;
            }

            .hero {
                grid-template-columns: 1fr;
                gap: 44px;
            }

            .visual {
                width: min(520px, 100%);
                min-height: auto;
                margin: 0 auto;
                aspect-ratio: 520 / 590;
            }

            .project-grid,
            .contact-layout,
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .page {
                padding: 28px 20px 40px;
            }

            h1 {
                font-size: clamp(40px, 12vw, 54px);
            }

            .summary {
                margin-top: 24px;
                font-size: 15px;
            }

            .actions,
            .stack {
                margin-top: 26px;
            }

            .button {
                width: 100%;
            }

            .photo-card {
                width: calc(100% - 28px);
            }

            .section {
                padding: 0 20px 52px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="hero" aria-label="{{ $content['hero_eyebrow'] }}">
            <div class="intro">
                <p class="eyebrow">{{ $content['hero_eyebrow'] }}</p>
                @php($heroTitleParts = explode('Dika', $content['hero_title'], 2))
                <h1>
                    @if (count($heroTitleParts) === 2)
                        {{ $heroTitleParts[0] }}<span>Dika</span>{{ $heroTitleParts[1] }}
                    @else
                        {{ $content['hero_title'] }}
                    @endif
                </h1>
                <p class="summary">
                    {{ $content['hero_summary'] }}
                </p>

                <div class="actions">
                    <a class="button primary" href="#projects">{{ $content['hero_buttons']['projects'] }}</a>
                    <a class="button secondary" href="{{ route('reports.show') }}">{{ $content['hero_buttons']['report'] }}</a>
                    <a class="button secondary" href="#contact">{{ $content['hero_buttons']['contact'] }}</a>
                </div>

                <ul class="stack" aria-label="Technology stack">
                    @foreach ($content['stack_items'] as $stack)
                        <li>{{ $stack }}</li>
                    @endforeach
                </ul>

            </div>

            <div class="visual">
                <div class="photo-card">
                    <div class="photo-fallback" aria-hidden="true">&lt;/&gt;</div>
                    <img src="{{ \App\Models\SiteContent::mediaUrl($content['profile_photo'] ?? null, 'coverimg/dika.png') }}" alt="Foto profil Dika" onerror="this.hidden = true">
                </div>
            </div>
        </section>

        <section class="section portfolio" id="projects" aria-label="{{ $content['portfolio_eyebrow'] }}">
            <div class="section-header">
                <p class="eyebrow">{{ $content['portfolio_eyebrow'] }}</p>
                <h2>{{ $content['portfolio_title'] }}</h2>
                <p class="section-text">
                    {{ $content['portfolio_text'] }}
                </p>
            </div>

            <div class="project-grid">
                @forelse ($projects as $project)
                    <article class="project-card">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->description }}</p>

                        @if ($project->technologies)
                            <span>{{ implode(', ', $project->technologies) }}</span>
                        @endif

                        <div class="project-meta">
                            <b class="project-status">{{ $project->status }} {{ $project->progress }}%</b>
                            <div class="project-progress" aria-label="{{ $content['project_card_texts']['progress_aria_prefix'] }}{{ $project->progress }}{{ $content['project_card_texts']['progress_aria_suffix'] }}">
                                <i style="--progress: {{ $project->progress }}%"></i>
                            </div>
                        </div>

                        @if ($project->github_url)
                            <a class="project-link" href="{{ $project->github_url }}" target="_blank" rel="noreferrer">{{ $content['project_card_texts']['github_label'] }}</a>
                        @endif
                    </article>
                @empty
                    <article class="project-card">
                        <h3>{{ $content['project_card_texts']['empty_title'] }}</h3>
                        <p>{{ $content['project_card_texts']['empty_text'] }}</p>
                    </article>
                @endforelse
            </div>
        </section>

        <section class="section contact" id="contact" aria-label="{{ $content['contact_eyebrow'] }}">
            <div class="section-header">
                <p class="eyebrow">{{ $content['contact_eyebrow'] }}</p>
                <h2>{{ $content['contact_title'] }}</h2>
                <p class="section-text">
                    {{ $content['contact_text'] }}
                </p>
            </div>

            <div class="contact-layout">
                <div class="contact-note">
                    <p>
                        {{ $content['contact_note'] }}
                    </p>
                </div>

                <form class="contact-form" action="{{ route('contact.store') }}" method="POST">
                    @csrf

                    @if (session('contact_success'))
                        <p class="form-status">{{ session('contact_success') }}</p>
                    @endif

                    <div class="form-grid">
                        <div class="field">
                            <label for="name">{{ $content['contact_labels']['name'] }}</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="email">{{ $content['contact_labels']['email'] }}</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field full">
                            <label for="subject">{{ $content['contact_labels']['subject'] }}</label>
                            <input id="subject" name="subject" type="text" value="{{ old('subject') }}">
                            @error('subject')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field full">
                            <label for="message">{{ $content['contact_labels']['message'] }}</label>
                            <textarea id="message" name="message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="button primary" type="submit">{{ $content['contact_labels']['submit'] }}</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
