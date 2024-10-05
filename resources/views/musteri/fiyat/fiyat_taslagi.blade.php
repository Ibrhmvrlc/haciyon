<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fiyat Güncelleme Yazısı</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .container { width: 100%; }
        .title { text-align: center; font-size: 20px; font-weight: bold; margin-top: 20px; }
        .content { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <div class="logo">BURAYA LOGO</div>
            <div class="header">Fiyat Güncelleme Bildirimi</div>
        </div>
        
        <div class="content">
            <p>Sayın Yetkili, <strong>XX.XX.XXXX</strong> tarihinden itibaren {{ $fiyatlar->first()->santiye->santiye }} şantiyeniz için geçerli olacak güncel beton fiyatlarımız aşağıdaki gibidir.</p>
            <p>Fiyatları uygun karşılacayağınızı umarız.</p>
            <p>İyi Çalışmalar.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Beton Sınıfı</th>
                        <th>Fiyat</th>
                        <th>PB</th>
                        <th>Katkı Farkı</th>
                        <th>Özel Farkı</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fiyatlar as $fiyat)
                    <tr>
                        <td>{{ $fiyat->beton_sinifi }}</td>
                        <td>{{ $fiyat->fiyat }}</td>
                        <td>{{ $fiyat->pb }}</td>
                        <td>{{ $fiyat->katki_farki }}</td>
                        <td>{{ $fiyat->ozel_farki }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Artış:</strong> {{ $fiyatlar->first()->artis }} TL</p>
            <p><strong>Azalış:</strong> {{ $fiyatlar->first()->azalis }} TL</p>
        </div>
    </div>
</body>
</html>
