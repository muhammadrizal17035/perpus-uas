<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Cetak Semua Barcode Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef0f8;
            margin: 0;
            padding: 30px;
        }
        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1000px;
            margin: 0 auto 24px;
        }
        .toolbar h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1f2333;
            margin: 0;
        }
        .toolbar p {
            margin: 2px 0 0;
            font-size: .8rem;
            color: #8b8fa3;
        }
        .btn-print {
            border: none;
            border-radius: 10px;
            padding: 10px 24px;
            background: #4f46e5;
            color: #fff;
            cursor: pointer;
            font-size: .9rem;
            font-weight: 500;
            font-family: inherit;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-print:hover { background: #3730a3; }
        .grid {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }
        .label {
            background: #fff;
            border: 2px dashed #c7cbe8;
            border-radius: 12px;
            padding: 16px 14px 12px;
            text-align: center;
            break-inside: avoid;
        }
        .label h4 {
            margin: 0 0 1px;
            font-size: .82rem;
            font-weight: 600;
            color: #1f2333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .label p {
            margin: 0 0 8px;
            color: #8b8fa3;
            font-size: .7rem;
        }
        .barcode-box {
            background: #f8f9fd;
            border-radius: 8px;
            padding: 8px 6px 4px;
        }
        .kode-pill {
            display: inline-block;
            margin-top: 2px;
            padding: 2px 10px;
            border-radius: 999px;
            background: #eef0fb;
            color: #4f46e5;
            font-size: .65rem;
            font-weight: 600;
        }
        @media print {
            body { background: #fff; padding: 0; }
            .toolbar { display: none; }
            .label { border: 1px solid #ddd; }
        }
    </style>
</head>
<body>

    <div class="toolbar">
        <div>
            <h2>Cetak Label Barcode Buku</h2>
            <p>{{ $buku->count() }} buku siap dicetak</p>
        </div>
        <button class="btn-print" onclick="window.print()">
            <i class="bi bi-printer-fill"></i> Cetak Semua
        </button>
    </div>

    <div class="grid">
        @foreach($buku as $b)
        <div class="label">
            <h4>{{ $b->judul }}</h4>
            <p>{{ $b->penulis }}</p>
            <div class="barcode-box">
                <svg class="barcode" data-code="{{ $b->kode_buku }}"></svg>
                <div class="kode-pill">{{ $b->kode_buku }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        document.querySelectorAll('.barcode').forEach(function (el) {
            JsBarcode(el, el.getAttribute('data-code'), {
                format: "CODE128",
                lineColor: "#1f2333",
                width: 1.4,
                height: 36,
                displayValue: false,
                margin: 0
            });
        });
    </script>

</body>
</html>