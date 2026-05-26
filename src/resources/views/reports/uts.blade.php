<!DOCTYPE html>
<html lang="id">
@php($content = \App\Models\SiteContent::valuesForPage('reports.uts'))
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $content['meta_title'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080a0e;
            --surface: #121620;
            --text: #f7f5ef;
            --muted: #a8acb8;
            --line: #2a3140;
            --accent: #24d3ae;
            --accent-2: #f0b54a;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: "Inter", Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(36, 211, 174, 0.13), transparent 32%),
                linear-gradient(315deg, rgba(240, 181, 74, 0.1), transparent 30%),
                var(--bg);
        }

        a { color: inherit; text-decoration: none; }

        .wrap {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 24px 0;
        }

        .back,
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            color: var(--text);
            background: rgba(255, 255, 255, 0.045);
            font-size: 14px;
            font-weight: 800;
        }

        .back { color: var(--muted); }

        .button.primary {
            border-color: transparent;
            color: #06120f;
            background: var(--accent);
        }

        .hero {
            display: grid;
            grid-template-columns: minmax(0, 0.9fr) auto;
            gap: 24px;
            align-items: end;
            padding: 28px 0 22px;
        }

        .eyebrow {
            width: fit-content;
            margin: 0 0 14px;
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
            font-size: clamp(36px, 6vw, 62px);
            line-height: 1.07;
            letter-spacing: 0;
        }

        .lead {
            max-width: 740px;
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: flex-end;
        }

        .pdf-shell {
            min-height: 72vh;
            margin: 0 0 54px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 8px;
            background: var(--surface);
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.28);
        }

        iframe {
            display: block;
            width: 100%;
            height: 72vh;
            border: 0;
            background: #ffffff;
        }

        @media (max-width: 760px) {
            .topbar,
            .hero {
                grid-template-columns: 1fr;
                align-items: start;
            }

            .topbar,
            .actions {
                justify-content: flex-start;
            }

            .button,
            .back {
                width: 100%;
            }

            .pdf-shell,
            iframe {
                min-height: 68vh;
                height: 68vh;
            }
        }
    </style>
</head>
<body>
    <header class="wrap topbar">
        <a class="back" href="{{ url('/') }}">{{ $content['back_label'] }}</a>
        <span class="eyebrow">{{ $content['top_badge'] }}</span>
    </header>

    <main class="wrap">
        <section class="hero">
            <div>
                <p class="eyebrow">{{ $content['hero_eyebrow'] }}</p>
                <h1>{{ $content['hero_title'] }}</h1>
                <p class="lead">
                    {{ $content['hero_lead'] }}
                </p>
            </div>

            <div class="actions">
                <a class="button primary" href="{{ route('reports.uts.pdf') }}" target="_blank" rel="noreferrer">{{ $content['open_pdf_label'] }}</a>
            </div>
        </section>

        <section class="pdf-shell" aria-label="{{ $content['pdf_preview_label'] }}">
            <iframe src="{{ route('reports.uts.pdf') }}" title="{{ $content['pdf_preview_label'] }}"></iframe>
        </section>
    </main>
</body>
</html>
