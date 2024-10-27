@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
@endphp
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-1">Fiyat Güncelleme Modülü </h4>
                <span>
                    <b>Dikkat!</b> yapılan değişiklikler kalıcıdır. Sistemdeki tüm fiyat bilgileri değişir.
                </span>
                <br />
                <span>
                    Talebinizin bitimine <b><span id="countdown"></span></b> kaldı.
                </span>
            </div>
        </div>
        
        @php
            $permission = PermissionRequest::where('user_id', auth()->user()->id)->where('status', 'onaylandi')->get();
        @endphp
        <script>
            // PHP'den alınan tarihleri JavaScript'e geçir
            var endDate = new Date("{{ $permission->first()->expires_at }}").getTime();
            
            // Geri sayım işlevi
            var countdown = setInterval(function() {
                var now = new Date().getTime(); // Şu anki zaman
                var distance = endDate - now; // Hedef tarihe kalan zaman

                // Gün, saat, dakika, saniye hesaplama
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Geri sayımı HTML'e yazdırma
                document.getElementById("countdown").innerHTML = days + "g " + hours + "s " 
                + minutes + "dk " + seconds + "sn ";

                // Geri sayım bittiğinde mesaj göster
                if (distance < 0) {
                    clearInterval(countdown);
                    document.getElementById("countdown").innerHTML = "Süre doldu!";
                }
            }, 1000);
        </script>

        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Müşteri Fiyat Listesi</li>
            </ol>
            
        </div>
        <div class="col-sm-12 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{route('bildirim.musteri.turu')}}" class="btn btn-primary">Bildirim Yap</a>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h3>Müşteri Fiyat Listesi tabulator</h3>
        </div>
        <div class="card-body">
            <div id="example-table"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        var clients = @json($veriler);
        
        var betonSinifi = [
            { Name: "C16", Id: 1 },
            { Name: "C20", Id: 2 },
            { Name: "C25", Id: 3 },
            { Name: "C30", Id: 4 },
            { Name: "C35", Id: 5 },
            { Name: "C40", Id: 6 },
            { Name: "C45", Id: 7 },
            { Name: "C50", Id: 8 }
        ];

        // Beton sınıfı seçeneklerini çıkarıyoruz
        var betonSinifiOptions = betonSinifi.reduce((acc, item) => {
            acc[item.Id] = item.Name;
            return acc;
        }, {});

        // Tabloyu başlat
        var table = new Tabulator("#example-table", {
            data: clients,
            layout: "fitColumns",
            responsiveLayout: "collapse",
            addRowPos: "top",
            history: true,
            pagination: "local",
            paginationSize: 50,
            paginationCounter: "rows",
            movableColumns: true,
            initialSort: [{ column: "name", dir: "asc" }],
            columnDefaults: {
                tooltip: true,
                cellVerticalAlign: "top",
                cssClass: "wrap-text",
            },
            columns: [
                { title: "A/P", field: "aktif_mi", width: 58, hozAlign: "center", formatter: "tickCross", sorter: "boolean", editor: true },
                { title: "Ünvan", field: "musteri", width: 280 },
                { title: "Şantiye", field: "santiye", width: 165 },
                {
                    title: "Sınıf",
                    field: "beton_sinifi",
                    width: 64,
                    editor: "list",
                    editorParams: {
                        values: betonSinifiOptions,
                    },
                    formatter: function (cell) {
                        return betonSinifiOptions[cell.getValue()] || cell.getValue();
                    },
                    hozAlign: "center"
                },
                { title: "Fiyat", field: "fiyat", editor: "input", hozAlign: "center", width: 65 },
                { title: "Üst(+)", field: "artis", editor: "input", hozAlign: "center", width: 73 },
                { title: "Alt(-)", field: "azalis", editor: "input", hozAlign: "center", width: 69 },
                { title: "Brt-Ktz", field: "katki_farki", editor: "input", hozAlign: "center", width: 80 },
                { title: "PB", field: "pb", editor: "input", hozAlign: "center", width: 79 },
                { title: "PB Sınır", field: "pb_siniri", editor: "input", hozAlign: "center", width: 115 , cellEdited:function(cell){
                    var updatedData = cell.getRow().getData();
                
                $.ajax({
                    url: `{{ route('tabulator.updateData', ':id') }}`.replace(':id', updatedData.id),
                    type: 'post',
                    data: JSON.stringify(updatedData),
                    contentType: 'application/json',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log("Güncelleme başarılı:", response);
                        table.updateData([response.data]);  // Tabloyu güncel veriyle güncelle
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Bilinmeyen bir hata oluştu.';
                        alert("Hata: " + errorMessage);
                    }
                });
    },
},
            ],
            cellEdited: function(cell) {  // Hücre düzenlendiğinde güncelle
                var updatedData = cell.getRow().getData();
                
                $.ajax({
                    url: `{{ route('tabulator.updateData', ':id') }}`.replace(':id', updatedData.id),
                    type: 'PUT',
                    data: JSON.stringify(updatedData),
                    contentType: 'application/json',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log("Güncelleme başarılı:", response);
                        table.updateData([response.data]);  // Tabloyu güncel veriyle güncelle
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Bilinmeyen bir hata oluştu.';
                        alert("Hata: " + errorMessage);
                    }
                });
            }
        });
    });

    </script>   
</div>
@endsection