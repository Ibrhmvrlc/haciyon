@php use Carbon\Carbon; @endphp
<table class="table">
    <thead>
        <tr>
            <th><b>POMPA OPERATÖRLERİ</b></th>
            <th><b>SAAT</b></th>
            <th><b>MÜŞTERİ ÜNVANI</b></th>
            <th><b>ŞANTİYE</b></th>
            <th><b>BETON CİNSİ</b></th>
            <th><b>METRAJ</b></th>
            <th><b>YAPI ELEMANI</b></th>
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
                        <td rowspan="{{ $eventCount }}" style="text-align: center; vertical-align: middle;">{{ $pompaci->ad_soyad }}</td>
                        @php $first = false; @endphp
                    @endif
                    @php $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i'); @endphp
                    <td>{{$saatKismi}}</td>
                    <td>{{$event->musteri_adi}}</td>
                    <td>{{$event->santiye}}</td>
                    <td>{{$event->beton_cinsi}}</td>
                    <td>{{$event->metraj}}  m<sup>3</sup></td>
                    <td>{{$event->yapi_elemani}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8"><!-- Karismamasi adina koyulmus serit --></td>
            </tr>
        @endforeach



        <tr>
            <td>MİKSERLİLER</td>
            <td></td>
            <td>NEBİOĞLU</td>
            <td>TAŞKÖPRÜ</td>
            <td>C45</td>
            <td>  24  m3</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>HATSAN</td>
            <td>HERSEK</td>
            <td>GRO</td>
            <td>  77  m3</td>
            <td></td>
        </tr>
        <tr class="table-dark">
            <td colspan="8"><!-- Karismamasi adina koyulmus serit --></td>
        </tr>
        <tr>
            <td>SANTRAL ALTI</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr class="table-dark">
            <td colspan="8"><!-- Karismamasi adina koyulmus serit --></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TOPLAM SANTRAL ALTI                      :</td>
            <td></td>
            <td>    m3</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TOPLAM MİKSERLİ SEVKİYAT              :</td>
            <td></td>
            <td>  101  m3</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TOPLAM POMPALI SEVKİYAT               :</td>
            <td></td>
            <td>  860  m3</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>TAŞKÖPRÜ TOPLAM          :</td>
            <td></td>
            <td>  961  m3</td>
            <td></td>
        </tr>
    </tbody>
</table>