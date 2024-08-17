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
    </style>
    <!-- jQuery (jsGrid'in bağımlılığı) -->
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>

    <!-- jsGrid JS -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js')}}"></script>

    <script>
        var clients = [
            { 
                "Müşteri": "MUSTAFA ÇİMEN / ŞÜKÜR TİCARET", 
                "Şantiye": "KARAMÜRSEL", 
                "Beton Sınıfı": 4, 
                "Fiyat": 2400, 
                "Katkı (+)": 150, 
                "Üst Sınıf (+)": 150, 
                "Alt Sınıf (-)": 50, 
                "Pompa Fiyatı": 4000
            },
        ];
     
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

            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            noDataContent: "Kayıt bulunamadı.", // Scrollbar olmadan boş veri gösterme
            pageSize: 50, // Sayfa başına gösterilecek kayıt sayısı
            pageButtonCount: 5, // Görüntülenecek sayfa düğmesi sayısı
     
            autoload: true,
                controller: {
                    loadData: function() {
                        return $.ajax({
                            type: "GET",
                            url: "{{ route('aktif_musteri.get') }}",
                            dataType: "json"
                        });
                    },
                    insertItem: function(item) {
                        return $.ajax({
                            type: "POST",
                            url: "{{ route('aktif_musteri.store') }}",
                            data: item,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    },
                    updateItem: function(item) {
                        return $.ajax({
                            type: "PUT",
                            url: "{{ route('aktif_musteri.update', '') }}/" + item.id,
                            data: item,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    },
                    deleteItem: function(item) {
                        return $.ajax({
                            type: "DELETE",
                            url: "{{ route('aktif_musteri.destroy', '') }}/" + item.id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    }
                },
     
            fields: [
                { name: "Müşteri", type: "text", width: 75, validate: "required", css: "wrap-text" },
                { name: "Şantiye", type: "text", width: 75, css: "wrap-text" },
                { name: "Beton Sınıfı", type: "select",  width: 40, items: betonSinifi, valueField: "Id", textField: "Name" },
                { name: "Fiyat", type: "number", width: 40, css: "number-center" },
                { name: "Katkı (+)", type: "number", width: 40, css: "number-center" },
                { name: "Üst Sınıf (+)", type: "number", width: 40, css: "number-center" },
                { name: "Alt Sınıf (-)", type: "number", width: 40, css: "number-center" },
                { name: "Pompa Fiyatı", type: "number", width: 40, css: "number-center" },
                { type: "control", width: 40  }
            ]
        });
    </script>
</div>
@endsection