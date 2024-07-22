@php
 use Carbon\Carbon; 
 $pompaliMetraj = 0;
 $mikserliMetraj = 0;
 $santralaltiMetraj = 0;
 $toplamMetraj = 0;
@endphp

<table class="table">
    <thead>
        <tr>
            <th style="text-align: center; vertical-align: middle;"><b>POMPA OPERATÖRLERİ</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>SAAT</b></th>
            <th style="vertical-align: middle;"><b>MÜŞTERİ ÜNVANI</b></th>
            <th style="vertical-align: middle;"><b>ŞANTİYE</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>BETON CİNSİ</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>METRAJ</b></th>
            <th style="text-align: center; vertical-align: middle;"><b>YAPI ELEMANI</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            @php
                $pompaci = $item['pompaci'];
                $events = $item['events'];
                $eventCount = $item['event_count'];
                $first = true;
            @endphp

            @foreach ($events as $event)
                <tr>
                    @if ($first)
                        <td rowspan="{{ $eventCount }}" style="text-align: center; vertical-align: middle;">
                            <b>{{ $pompaci->ad_soyad }}</b>
                        </td>
                        @php $first = false; @endphp
                    @endif
                    @php $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i'); @endphp
                    <td style="text-align: center; vertical-align: middle;">{{$saatKismi}}</td>
                    <td style="vertical-align: middle;">{{$event->musteri_adi}}</td>
                    <td style="vertical-align: middle;">{{$event->santiye}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$event->beton_cinsi}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$event->metraj}}  m³</td>
                    <td style="text-align: center; vertical-align: middle;">{{$event->yapi_elemani}}</td>
                </tr>
                @php
                    $pompaliMetraj += $event->metraj;
                @endphp
            @endforeach
            <tr>
                <td colspan="7"><!-- Karismamasi adina koyulmus serit --></td>
            </tr>
        @endforeach

        @if ($mikserliler->isNotEmpty())
            @php $firstMikserli = true; @endphp

            @foreach ($mikserliler as $program)
                <tr>
                    @if ($firstMikserli)
                        <td rowspan="{{ $mikserliler->count() }}" style="text-align: center; vertical-align: middle;">
                            <b>MİKSERLİLER</b>
                        </td>
                        @php $firstMikserli = false; @endphp
                    @endif
                    @php $saatKismi = Carbon::parse($program->baslangic_saati)->format('H:i'); @endphp
                    <td style="text-align: center; vertical-align: middle;">{{$saatKismi}}</td>
                    <td style="vertical-align: middle;">{{$program->musteri_adi}}</td>
                    <td style="vertical-align: middle;">{{$program->santiye}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->beton_cinsi}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->metraj}} m³</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->yapi_elemani}}</td>
                </tr>
                @php
                    $mikserliMetraj += $program->metraj;
                @endphp
            @endforeach
            <tr class="table-dark">
                <td colspan="7"><!-- Karismamasi adina koyulmus serit --></td>
            </tr>
        @endif

        @if ($santralaltilar->isNotEmpty())
            @php $firstSantralalti = true; @endphp

            @foreach ($santralaltilar as $program)
                <tr>
                    @if ($firstSantralalti)
                        <td rowspan="{{ $mikserliler->count() }}" style="text-align: center; vertical-align: middle;">
                            <b>SANTRAL ALTI</b>
                        </td>
                        @php $firstSantralalti = false; @endphp
                    @endif
                    @php $saatKismi = Carbon::parse($program->baslangic_saati)->format('H:i'); @endphp
                    <td style="text-align: center; vertical-align: middle;">{{$saatKismi}}</td>
                    <td style="vertical-align: middle;">{{$program->musteri_adi}}</td>
                    <td style="vertical-align: middle;">{{$program->santiye}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->beton_cinsi}}</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->metraj}} m³</td>
                    <td style="text-align: center; vertical-align: middle;">{{$program->yapi_elemani}}</td>
                </tr>
                @php
                    $santralaltiMetraj += $program->metraj;
                @endphp
            @endforeach
            <tr class="table-dark">
                <td colspan="7"><!-- Karismamasi adina koyulmus serit --></td>
            </tr>
        @endif

        @if ($santralaltilar->isNotEmpty())
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: right; vertical-align: middle;">TOPLAM SANTRAL ALTI :</td>
            <td colspan="2">{{$santralaltiMetraj}} m³</td>
        </tr>
        @endif

        @if ($mikserliler->isNotEmpty())
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: right; vertical-align: middle;">TOPLAM MİKSERLİ :</td>
            <td colspan="2">{{$mikserliMetraj}} m³</td>
        </tr>
        @endif

        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: right; vertical-align: middle;">TOPLAM POMPALI :</td>
            <td colspan="2">{{$pompaliMetraj}} m³</td>
        </tr>

        <tr>
            @php
                $toplamMetraj = $pompaliMetraj + $mikserliMetraj + $santralaltiMetraj;
            @endphp
            <td colspan="3"></td>
            <td colspan="2" style="text-align: right; vertical-align: middle;">TAŞKÖPRÜ TOPLAM :</td>
            <td colspan="2">{{$toplamMetraj}} m³</td>
        </tr>

    </tbody>
</table>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid black;
        padding: 4px; /* Reduced padding */
        text-align: left;
        font-size: 10px; /* Reduced font size */
    }
    th {
        background-color: #e0ffce;
    }
</style>