<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $project->title }}{{ $content['title_suffix'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080a0e;
            --surface: #121620;
            --surface-2: #181d28;
            --text: #f7f5ef;
            --muted: #a8acb8;
            --line: #2a3140;
            --accent: #24d3ae;
            --accent-2: #f0b54a;
            --danger: #ff8f8f;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Inter", Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(36, 211, 174, 0.12), transparent 32%),
                linear-gradient(315deg, rgba(240, 181, 74, 0.1), transparent 30%),
                var(--bg);
        }

        a { color: inherit; text-decoration: none; }

        .wrap {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 24px 0;
        }

        .back {
            display: inline-flex;
            align-items: center;
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            border-radius: 6px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.04);
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 1.12fr) minmax(300px, 0.88fr);
            gap: 26px;
            align-items: stretch;
            padding: 34px 0 28px;
        }

        .hero-main,
        .panel,
        .diagram-card {
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            background: rgba(18, 22, 32, 0.82);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.24);
        }

        .hero-main {
            padding: clamp(24px, 4vw, 42px);
        }

        .eyebrow {
            width: fit-content;
            margin: 0 0 16px;
            padding: 8px 12px;
            border: 1px solid rgba(36, 211, 174, 0.28);
            border-radius: 999px;
            color: var(--accent);
            background: rgba(36, 211, 174, 0.08);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            max-width: 760px;
            font-size: clamp(38px, 6vw, 66px);
            line-height: 1.05;
            letter-spacing: 0;
        }

        .lead {
            max-width: 720px;
            margin: 22px 0 0;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.75;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 800;
        }

        .button.primary { color: #06120f; background: var(--accent); }
        .button.secondary { border-color: rgba(255, 255, 255, 0.18); color: var(--text); background: rgba(255, 255, 255, 0.04); }

        .status-panel {
            padding: 24px;
            display: grid;
            align-content: center;
            gap: 18px;
        }

        .metric {
            display: grid;
            gap: 8px;
        }

        .metric span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .metric strong {
            font-size: 26px;
            line-height: 1.2;
        }

        .bar {
            height: 12px;
            overflow: hidden;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.09);
        }

        .bar i {
            display: block;
            width: var(--progress);
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, var(--accent), var(--accent-2));
        }

        .stack {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .stack li {
            padding: 8px 11px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            color: #e7e4da;
            background: rgba(255, 255, 255, 0.045);
            font-size: 13px;
            font-weight: 700;
        }

        .content {
            display: grid;
            grid-template-columns: minmax(0, 0.95fr) minmax(320px, 1.05fr);
            gap: 22px;
            padding: 8px 0 72px;
        }

        .panel {
            padding: 24px;
        }

        .panel h2,
        .diagram-card h2 {
            margin: 0 0 16px;
            font-size: 24px;
            line-height: 1.2;
            letter-spacing: 0;
        }

        .panel p {
            margin: 0;
            color: var(--muted);
            line-height: 1.75;
        }

        .requirement-list {
            display: grid;
            gap: 10px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .requirement-list li {
            padding: 12px 14px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            color: #ebe8df;
            background: rgba(255, 255, 255, 0.04);
            font-weight: 600;
        }

        .diagram-card {
            grid-column: 1 / -1;
            padding: 24px;
        }

        .flow {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin: 0;
            padding: 0;
            list-style: none;
            counter-reset: step;
        }

        .flow li {
            position: relative;
            min-height: 96px;
            padding: 18px 16px 18px 52px;
            border: 1px solid rgba(36, 211, 174, 0.18);
            border-radius: 8px;
            color: #f6f3ea;
            background: linear-gradient(180deg, rgba(36, 211, 174, 0.08), rgba(255, 255, 255, 0.035));
            line-height: 1.45;
            font-weight: 700;
        }

        .flow li::before {
            counter-increment: step;
            content: counter(step);
            position: absolute;
            left: 14px;
            top: 16px;
            width: 26px;
            height: 26px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #06120f;
            background: var(--accent);
            font-size: 13px;
            font-weight: 800;
        }

        @media (max-width: 860px) {
            .hero,
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .wrap { width: min(100% - 32px, 1120px); }
            .topbar { align-items: flex-start; flex-direction: column; }
            .button { width: 100%; }
        }
    </style>
</head>
<body>
    <header class="wrap topbar">
        <a class="back" href="{{ url('/') }}">{{ $content['back_label'] }}</a>
        <span class="eyebrow">{{ $content['page_badge'] }}</span>
    </header>

    <main class="wrap">
        <section class="hero">
            <div class="hero-main">
                <p class="eyebrow">{{ $content['hero_eyebrow'] }}</p>
                <h1>{{ $project->title }}</h1>
                <p class="lead">{{ $project->description }}</p>

                <div class="actions">
                    @if ($project->github_url)
                        <a class="button primary" href="{{ $project->github_url }}" target="_blank" rel="noreferrer">{{ $content['github_button'] }}</a>
                    @endif

                    @if ($project->live_url)
                        <a class="button secondary" href="{{ $project->live_url }}" target="_blank" rel="noreferrer">{{ $content['live_button'] }}</a>
                    @endif

                    @if ($project->report_file)
                        <a class="button secondary" href="{{ asset('storage/'.$project->report_file) }}" target="_blank" rel="noreferrer">{{ $content['report_button'] }}</a>
                    @endif
                </div>
            </div>

            <aside class="status-panel panel">
                <div class="metric">
                    <span>{{ $content['status_label'] }}</span>
                    <strong>{{ $project->status }}</strong>
                </div>

                <div class="metric">
                    <span>{{ $content['percentage_label'] }}</span>
                    <strong>{{ $project->progress }}%</strong>
                    <div class="bar" aria-label="{{ $content['progress_aria_prefix'] }}{{ $project->progress }}{{ $content['progress_aria_suffix'] }}">
                        <i style="--progress: {{ $project->progress }}%"></i>
                    </div>
                </div>

                @if ($project->technologies)
                    <ul class="stack" aria-label="{{ $content['tech_stack_aria'] }}">
                        @foreach ($project->technologies as $technology)
                            <li>{{ $technology }}</li>
                        @endforeach
                    </ul>
                @endif
            </aside>
        </section>

        <section class="content">
            <article class="panel">
                <h2>{{ $content['analysis_heading'] }}</h2>
                <p>{{ $project->problem_analysis ?: $content['analysis_empty'] }}</p>
            </article>

            <article class="panel">
                <h2>{{ $content['requirements_heading'] }}</h2>
                @if ($project->system_requirements)
                    <ul class="requirement-list">
                        @foreach ($project->system_requirements as $requirement)
                            <li>{{ $requirement }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ $content['requirements_empty'] }}</p>
                @endif
            </article>

            <article class="panel">
                <h2>{{ $content['architecture_heading'] }}</h2>
                <p>{{ $project->architecture ?: $content['architecture_empty'] }}</p>
            </article>

            <article class="panel">
                <h2>{{ $content['implementation_heading'] }}</h2>
                <p>{{ $content['implementation_text'] }}</p>
            </article>

            <article class="diagram-card">
                <h2>{{ $content['diagram_heading'] }}</h2>
                @if ($project->diagram_steps)
                    <ol class="flow">
                        @foreach ($project->diagram_steps as $step)
                            <li>{{ $step }}</li>
                        @endforeach
                    </ol>
                @else
                    <p>{{ $content['diagram_empty'] }}</p>
                @endif
            </article>
        </section>
    </main>
</body>
</html>
