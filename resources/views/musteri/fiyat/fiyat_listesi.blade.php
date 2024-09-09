@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
@endphp
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-1">Fiyat Güncelleme Listesi </h4>
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
                <li class="breadcrumb-item"><a href="xxxxxxx">xxxxxxxx</a></li>
                <li class="breadcrumb-item active"><a href="xxxxxx">xxxxxxxx</a></li>
            </ol>
            
        </div>
        <div class="col-sm-12 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{route('bildirim.yap')}}" class="btn btn-primary">Bildirim Yap</a>
        </div>
    </div>
    <div id="jsGrid"></div>
    <style>
        .jsgrid-grid-header {
            overflow-y: hidden; /* Dikey scroll'u gizlemek için */
        }

        .jsgrid-grid-body {
            overflow-y: hidden; /* Dikey scroll'u gizlemek için */
        }

        .number-center {
            text-align: center;
        }

        .jsgrid-cell {
            white-space: normal; /* Metinlerin hücre sınırlarına göre sarılmasını sağlar */
            word-wrap: break-word; /* Uzun kelimelerin hücre sınırlarına göre kırılmasını sağlar */
            overflow: hidden; /* Taşmayı gizler */
        }
        .jsgrid-delete-button{
            display: none;
        }
    </style>
    <!-- jQuery (jsGrid'in bağımlılığı) -->
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>

    <!-- jsGrid JS -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js')}}"></script>

    <script>
        var clients = @json($veriler);

        var betonSinifi = [
            { Name: "", Id: 0 },
            { Name: "C16", Id: 1 },
            { Name: "C20", Id: 2 },
            { Name: "C25", Id: 3 },
            { Name: "C30", Id: 4 },
            { Name: "C35", Id: 5 },
            { Name: "C40", Id: 6 },
            { Name: "C45", Id: 7 },
            { Name: "C50", Id: 8 }
        ];

        $("#jsGrid").jsGrid({
            width: "100%",
            height: "auto",

            inserting: false,
            deleting: false,
            editing: true,
            sorting: true,
            paging: true,
            deleteButton: false,
            noDataContent: "Kayıt bulunamadı.", // Scrollbar olmadan boş veri gösterme
            pageSize: 50, // Sayfa başına gösterilecek kayıt sayısı
            pageButtonCount: 5, // Görüntülenecek sayfa düğmesi sayısı

            data: clients,

            fields: [
                { name: "id", type: "number", width: 40, validate: "required", css: "wrap-text text-center", editing: false, readOnly: true, insertable: false },
                { name: "musteri", title: "Müşteri", type: "text", width: 100, validate: "required", css: "wrap-text", editing: false, readOnly: true, insertable: false  },
                { name: "santiye", title: "Şantiye" , type: "text", width: 60, css: "wrap-text text-center", editing: false, readOnly: true, insertable: false   },
                { name: "beton_sinifi", title: "Beton Sınıfı" , type: "select",  width: 40, items: betonSinifi, valueField: "Id", textField: "Name" },
                { name: "fiyat", title: "Fiyat" , type: "number", width: 40, css: "number-center" },
                { name: "katki_farki", title: "Katkı (+)" , type: "number", width: 40, css: "number-center" },
                { name: "artis", title: "Üst Sınıf (+)" , type: "number", width: 40, css: "number-center" },
                { name: "azalis", title: "Alt Sınıf (-)" , type: "number", width: 40, css: "number-center" },
                { name: "pb", title: "Pompa Fiyatı" , type: "number", width: 40, css: "number-center" },
                { type: "control", width: 40  }
            ],

            onItemUpdated: function(args) {
                $.ajax({
                    url: '/api/data/' + args.item.id,
                    type: 'PUT',
                    data: args.item,
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#jsGrid").jsGrid("loadData");
                    },
                    error: function(xhr) {
                        alert("Hata: " + xhr.responseJSON.message);
                    }
                });
            },
        });
    </script>
</div>
@endsection