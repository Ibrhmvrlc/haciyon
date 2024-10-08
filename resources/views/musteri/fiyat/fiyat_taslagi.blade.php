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
                        <th style="text-align: center;">Fiyat (m³/₺)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fiyatlar as $fiyat)

                        @php
                            $betonSinifi = $fiyat->betonSinifi; // İlk beton sınıfını değişkene al
                            $orijinalFiyat = $fiyat->fiyat; // Orijinal fiyatı kaydet
                        @endphp

                        @foreach ($urunler as $urun)
                        <tr>
                            <td style="text-align: center;">{{ $urun->adi }}</td>

                            @php
                                $urunFiyat = $orijinalFiyat; // Her ürün için başlangıç fiyatını tekrar başlat
                            @endphp

                            {{-- C16 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 1)
                            {{-- Alt sınıflar için fiyat azaltma işlemi yapilmaz --}}
                            @endif

                            {{-- C20 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 2)
                            {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->azalis}}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C25 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 3)
                            {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->azalis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= ($fiyat->azalis)}}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C30 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 4)
                                 {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->azalis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->azalis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->azalis}}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C35 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 5)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= ($fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></strong></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C40 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 6)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (6 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (5 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= (4 * $fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= (2 * $fiyat->artis) }}<small>+KDV</small></strong></td>
                                    @elseif ($urun->id == 5)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C45 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 7)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (9 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (8 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= (7 * $fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= (3 * $fiyat->artis) }}<small>+KDV</small></strong></td>
                                    @elseif ($urun->id == 5)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 6)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C50 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 8)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (12 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (11 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= (10 * $fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= (4 * $fiyat->artis) }}<small>+KDV</small></strong></td>
                                    @elseif ($urun->id == 5)
                                    <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 6)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 7)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C50 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 9)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (15 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (14 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= (13 * $fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= (5 * $fiyat->artis) }}<small>+KDV</small></strong></td>
                                    @elseif ($urun->id == 5)
                                    <td style="text-align: center;">{{ $urunFiyat -= (4 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 6)
                                    <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 7)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 8)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- C60 ANA FIYAT SINIFI OLARAK SECILMIS ISE --}} 
                            @if ($betonSinifi->id == 10)
                                {{-- Alt sınıflar için fiyat azaltma işlemi --}}
                                @if ($urun->id < $betonSinifi->id)
                                    @if ($urun->id == 1)
                                    <td style="text-align: center;">{{ $urunFiyat -= (18 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 2)
                                    <td style="text-align: center;">{{ $urunFiyat -= (17 * $fiyat->azalis + $fiyat->artis)}}<small>+KDV</small></td>
                                    @elseif ($urun->id == 3)
                                    <td style="text-align: center;">{{ $urunFiyat -= (16 * $fiyat->azalis + $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 4)
                                    <td style="text-align: center;"><strong>{{ $urunFiyat -= (6 * $fiyat->artis) }}<small>+KDV</small></strong></td>
                                    @elseif ($urun->id == 5)
                                    <td style="text-align: center;">{{ $urunFiyat -= (5 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 6)
                                    <td style="text-align: center;">{{ $urunFiyat -= (4 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 7)
                                    <td style="text-align: center;">{{ $urunFiyat -= (3 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 8)
                                    <td style="text-align: center;">{{ $urunFiyat -= (2 * $fiyat->artis) }}<small>+KDV</small></td>
                                    @elseif ($urun->id == 9)
                                    <td style="text-align: center;">{{ $urunFiyat -= $fiyat->artis }}<small>+KDV</small></td>
                                    @endif
                                @endif
                            @endif

                            {{-- Ana ürün için fiyatı sabit göster --}}
                            @if ($betonSinifi->id == $urun->id)
                                <td style="text-align: center;">
                                    @if ($betonSinifi->id != 4)
                                    {{ $fiyat->fiyat }}<small>+KDV</small>
                                    @else
                                    <strong>{{ $fiyat->fiyat }}<small>+KDV</small></strong>
                                    @endif
                                </td>
                            @endif

                            {{-- Üst sınıflar için fiyat artırma işlemi --}}
                            @if ($betonSinifi->id < $urun->id)
                                <td style="text-align: center;">{{ $fiyat->fiyat += $fiyat->artis}}<small>+KDV</small></td>
                            @endif
                        </tr>
                        @endforeach
                    @endforeach
                        <tr>
                            <td style="text-align: center;">Brüt, Katkısız</td>
                            <td style="text-align: center;">+{{ $fiyatlar->first()->katki_farki }} (<small>+KDV</small>)</td>
                        </tr>
                </tbody>
            </table>
            
            <ul>
                @if ($fiyatlar->first()->pb_siniri and $fiyatlar->first()->pb)
                <li>{{ $fiyatlar->first()->pb_siniri }} m³ altında olan dökümlerde {{ $fiyatlar->first()->pb }}<small>+KDV</small> Pompa bedeli uygulanır.</li>
                @endif
            </ul>

            <p><strong>Artış:</strong> {{ $fiyatlar->first()->artis }} TL</p>
            <p><strong>Azalış:</strong> {{ $fiyatlar->first()->azalis }} TL</p>
            <p><strong>Azalış:</strong> {{ $fiyatlar->first()->azalis }} TL</p>
        </div>
    </div>
</body>
</html>
