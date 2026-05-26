<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $report->project_title }}{{ $content['title_suffix'] }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #111111;
            background: #ffffff;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.65;
        }

        .page {
            width: min(860px, calc(100% - 32px));
            margin: 0 auto;
            padding: 28px 0 48px;
        }

        .topbar {
            margin-bottom: 28px;
        }

        a {
            color: #111111;
        }

        .back {
            display: inline-block;
            padding: 8px 12px;
            border: 1px solid #111111;
            text-decoration: none;
            font-size: 14px;
        }

        h1,
        h2,
        h3,
        p {
            margin-top: 0;
        }

        h1 {
            margin-bottom: 14px;
            font-size: 32px;
            line-height: 1.2;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 22px;
            line-height: 1.3;
        }

        h3 {
            margin-bottom: 8px;
            font-size: 18px;
            line-height: 1.35;
        }

        section {
            padding: 22px 0;
            border-top: 1px solid #dddddd;
        }

        .lead {
            font-size: 16px;
        }

        ul {
            margin: 0;
            padding-left: 22px;
        }

        li + li {
            margin-top: 8px;
        }

        .tech-item + .tech-item,
        .diagram + .diagram {
            margin-top: 24px;
        }

        .tech-item strong {
            display: block;
        }

        figure {
            margin: 12px 0 0;
        }

        img {
            display: block;
            width: 100%;
            max-height: 760px;
            object-fit: contain;
            border: 1px solid #dddddd;
        }

        .pdf-action {
            padding-top: 30px;
            text-align: center;
        }

        .pdf-button {
            display: inline-block;
            padding: 10px 16px;
            border: 1px solid #111111;
            color: #ffffff;
            background: #111111;
            text-decoration: none;
            font-weight: 700;
        }

        @media print {
            .topbar,
            .pdf-action {
                display: none;
            }

            .page {
                width: 100%;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <nav class="topbar">
            <a class="back" href="{{ url('/') }}">{{ $content['back_label'] }}</a>
        </nav>

        <section>
            <h1>{{ $report->project_title }}</h1>
            <p class="lead">{{ $report->short_description }}</p>
        </section>

        <section>
            <h2>{{ $content['problem_heading'] }}</h2>
            <p>{{ $report->problem_analysis }}</p>
        </section>

        <section>
            <h2>{{ $content['features_heading'] }}</h2>
            <ul>
                @foreach ($report->system_features ?? [] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </section>

        <section>
            <h2>{{ $content['architecture_heading'] }}</h2>
            <p>{{ $report->architecture }}</p>
        </section>

        <section>
            <h2>{{ $content['technologies_heading'] }}</h2>
            @foreach ($report->tech_stack ?? [] as $technology)
                <article class="tech-item">
                    <strong>{{ is_array($technology) ? $technology['name'] : $technology }}</strong>
                    @if (is_array($technology) && isset($technology['description']))
                        <p>{{ $technology['description'] }}</p>
                    @endif
                </article>
            @endforeach
        </section>

        <section>
            <h2>{{ $content['diagrams_heading'] }}</h2>
            @foreach ($report->diagrams ?? [] as $diagram)
                @php
                    $diagramPath = '/' . implode('/', array_map('rawurlencode', explode('/', ltrim($diagram['image_path'], '/'))));
                @endphp

                <article class="diagram">
                    <h3>{{ $diagram['title'] }}</h3>
                    <p>{{ $diagram['description'] }}</p>
                    <figure>
                        <img src="{{ $diagramPath }}" alt="{{ $diagram['title'] }}">
                    </figure>
                </article>
            @endforeach
        </section>

        <section class="pdf-action">
            <a class="pdf-button" href="{{ route('reports.full-pdf') }}" target="_blank" rel="noreferrer">
                {{ $content['pdf_button_label'] }}
            </a>
        </section>
    </main>
</body>
</html>
