@extends('layouts.main')

@section('content')
<div class="container-fluid">
    
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

            controller: {
                updateItem: function(item) {
                    return $.ajax({
                        url: '/api/data/' + item.id,
                        type: 'PUT',
                        data: item,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Güncelleme başarılı olduğunda yapılacak işlemler
                            console.log("Update successful:", response);
                            var clients = response; // Veriyi yeniden yükle
                            $("#jsGrid").jsGrid("loadData", clients);
                        },
                        error: function(xhr, status, error) {
                            // Hata durumunda yapılacak işlemler
                            console.error("Update failed:", error);
                            var errorMessage = xhr.status + ': ' + xhr.statusText; // Örneğin: 500: Internal Server Error
                            alert("Güncelleme başarısız! Hata: " + errorMessage);
                        }
                    });
                }
            }

        });
    </script>
</div>
@endsection