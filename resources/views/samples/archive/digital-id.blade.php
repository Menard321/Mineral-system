<!DOCTYPE html>
<html>
<head>
    <title>Digital Identity Repository</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #e2e8f0;
            padding: 30px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #111827;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.4);
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            background: #22c55e;
            color: white;
            border-radius: 6px;
            font-size: 12px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
        }

        .section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #334155;
        }

        .qr {
            margin-top: 15px;
            padding: 15px;
            background: white;
            display: inline-block;
            border-radius: 10px;
        }

        a {
            color: #38bdf8;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="title">SAMPLE ARCHIVE</div>
    <p>Digital Identity Repository</p>

    <span class="badge">{{ $sample->status }}</span>

    <div class="section">
        <p><b>Digital ID:</b> {{ $sample->sample_id }}</p>
        <p><b>Mineral:</b> {{ $sample->mineral_type }}</p>
        <p><b>Category:</b> Raw Ore</p>
        <p><b>Weight:</b> {{ $sample->estimated_weight }} KG</p>
    </div>

    <div class="section">
        <h3>QR CODE</h3>

        <div class="qr">
            {!! $qrCode !!}
        </div>
    </div>

    <a href="{{ route('samples.verify', $sample->sample_id) }}">
        View QR Terminal →
    </a>

</div>

</body>
</html>