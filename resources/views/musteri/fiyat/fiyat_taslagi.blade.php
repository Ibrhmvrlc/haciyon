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
        .table { width: 75%; border-collapse: collapse; margin: auto; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left;}
    </style>
</head>
<body>
    <div class="container">
        <div class="title">
            <div class="logo">BURAYA LOGO</div>
            <div class="header-costumer-name">{{$musteri->first()->musteri_unvani}}</div>
            <div class="header-content">Fiyat Güncelleme Bildirimi</div>
        </div>
        
        <div class="content">
            <p>Sayın Yetkili, <strong>XX.XX.XXXX</strong> tarihinden itibaren {{ $fiyatlar->first()->santiye->santiye }} şantiyeniz için geçerli olacak güncel beton fiyatlarımız aşağıdaki gibidir.</p>
            <p>Fiyatları uygun karşılacayağınızı umarız.</p>
            <p>İyi Çalışmalar.</p>

            <table class="table">
                <thead>
                    <tr>
                        <th style="text-align: center;">Beton Sınıfı</th>
                        <th style="text-align: center;">Fiyat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fiyatlar as $fiyat)

                        @php
                            $betonSinifi = $fiyat->first()->betonSinifi; // İlk beton sınıfını değişkene al
                            $orijinalFiyat = $fiyat->fiyat; // Orijinal fiyatı kaydet
                        @endphp

                        @foreach ($urunler as $urun)
                        <tr>
                            <td style="text-align: center;">{{ $urun->adi }}</td>

                            @php
                                $urunFiyat = $orijinalFiyat; // Her ürün için başlangıç fiyatını tekrar başlat
                            @endphp

                            {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                            @if ($urun->id < $betonSinifi->id)
                                @if ($urun->id == 1)
                                <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->azalis)}}</td>
                                @elseif ($urun->id == 2)
                                <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->azalis)}}</td>
                                @elseif ($urun->id == 3)
                                <td style="text-align: center;">{{ $urunFiyat -= $fiyat->azalis}}</td>
                                @endif
                            @endif

                            {{-- Ana ürün için fiyatı sabit göster --}}
                            @if ($betonSinifi->adi == $urun->adi)
                                <td style="text-align: center;">{{ $fiyat->fiyat }}</td>
                            @endif

                            {{-- Üst sınıflar için fiyat artırma işlemi --}}
                            @if ($betonSinifi->id < $urun->id)
                                <td style="text-align: center;">{{ $fiyat->fiyat += $fiyat->artis}}</td>
                            @endif
                        </tr>
                        @endforeach
                    @endforeach

                </tbody>
            </table>

            <p><strong>Artış:</strong> {{ $fiyatlar->first()->artis }} TL</p>
            <p><strong>Azalış:</strong> {{ $fiyatlar->first()->azalis }} TL</p>
        </div>
    </div>
</body>
</html>
