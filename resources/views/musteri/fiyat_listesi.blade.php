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
    </style>
    <!-- jQuery (jsGrid'in bağımlılığı) -->
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>

    <!-- jsGrid JS -->
    <script src="{{asset('https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js')}}"></script>

    <script>
        var clients = [
            { "Müşteri": "Otto Clay", "Şantiye": "Karamürsel", "Beton Sınıfı": 1, "Address": "Ap #897-1459 Quam Avenue", "Married": false },
            { "Müşteri": "Connor Johnston", "Şantiye": "Altınova", "Beton Sınıfı": 2, "Address": "Ap #370-4647 Dis Av.", "Married": true },
            { "Müşteri": "Lacey Hess", "Şantiye": "Tavşanlı", "Beton Sınıfı": 3, "Address": "Ap #365-8835 Integer St.", "Married": false },
            { "Müşteri": "Timothy Henson", "Şantiye": "Çiftlikköy", "Beton Sınıfı": 1, "Address": "911-5143 Luctus Ave", "Married": true },
            { "Müşteri": "Ramona Benton", "Şantiye": "Hersek", "Beton Sınıfı": 5, "Address": "Ap #614-689 Vehicula Street", "Married": false }
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
     
            data: clients,
     
            fields: [
                { name: "Müşteri", type: "text", width: 75, validate: "required", css: "wrap-text" },
                { name: "Şantiye", type: "text", width: 75, css: "wrap-text" },
                { name: "Beton Sınıfı", type: "select",  width: 40, items: betonSinifi, valueField: "Id", textField: "Name" },
                { name: "Fiyat", type: "number", width: 40 },
                { name: "Brüt, Katkısız, Özel", type: "text", width: 40 },
                { name: "Pompa Fiyatı", type: "text", width: 40 },
                { type: "control", width: 40  }
            ]
        });
    </script>
</div>
@endsection