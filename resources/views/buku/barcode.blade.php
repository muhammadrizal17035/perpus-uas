<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Barcode - {{ $buku->judul }}</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: #eef0f8;
        }
        .label {
            position: relative;
            background: #fff;
            border: 2px dashed #c7cbe8;
            border-radius: 14px;
            padding: 28px 36px 22px;
            text-align: center;
            width: 320px;
        }
        .label::before {
            content: "";
            position: absolute;
            top: -2px; left: 20px; right: 20px;
            border-top: 2px solid #eef0f8;
        }
        .tag-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin: 0 auto 10px;
        }
        .label h3 {
            margin: 0 0 2px;
            font-size: 1.05rem;
            font-weight: 600;
            color: #1f2333;
        }
        .label p {
            margin: 0 0 16px;
            color: #8b8fa3;
            font-size: .8rem;
        }
        .barcode-box {
            background: #f8f9fd;
            border-radius: 10px;
            padding: 14px 10px 6px;
            margin-bottom: 18px;
        }
        .kode-pill {
            display: inline-block;
            margin-top: 4px;
            padding: 3px 14px;
            border-radius: 999px;
            background: #eef0fb;
            color: #4f46e5;
            font-size: .75rem;
            font-weight: 600;
            letter-spacing: .03em;
        }
        .btn-print {
            border: none;
            border-radius: 10px;
            padding: 10px 26px;
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
        @media print {
            body { background: #fff; }
            .label { border: 1px solid #ddd; }
            .btn-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="label">
        <div class="tag-icon"><i class="bi bi-book-half"></i></div>
        <h3>{{ $buku->judul }}</h3>
        <p>{{ $buku->penulis }}</p>

        <div class="barcode-box">
            <svg id="barcode"></svg>
            <div class="kode-pill">{{ $buku->kode_buku }}</div>
        </div>

        <button class="btn-print" onclick="window.print()">
            <i class="bi bi-printer-fill"></i> Cetak Label
        </button>
    </div>

    <script>
        JsBarcode("#barcode", "{{ $buku->kode_buku }}", {
            format: "CODE128",
            lineColor: "#1f2333",
            width: 2,
            height: 55,
            displayValue: false,
            margin: 0
        });
    </script>

</body>
</html>