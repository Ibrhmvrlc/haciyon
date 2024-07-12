@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-2">Beton Programı Yap</h4>
                <p class="mb-0">Aşağıdaki takvim arayüzünden günlük, haftalık ya da aylık şekilde program yapabilirsiniz. <br/> 
                    (Dikkat: Sistem mobil cihazlarda henüz kullanılmamaktadır!)</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Ana Menü</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Günlük Program Yap</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="row">
        <!-- Pompaci bir -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pompacı Bir</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Saat</th>
                                    <th>Müşteri Adı/Ünvanı</th>
                                    <th>Şantiye</th>
                                    <th>Beton Sınıfı</th>
                                    <th>Beton Metrajı</th>
                                    <th>Yapı Elemanı</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <th>{{$event->baslangic_saati}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>

         <!-- Pompaci iki -->
         <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Pompacı Iki</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th>Saat</th>
                                    <th>Müşteri Adı/Ünvanı</th>
                                    <th>Şantiye</th>
                                    <th>Beton Sınıfı</th>
                                    <th>Beton Metrajı</th>
                                    <th>Yapı Elemanı</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                <tr>
                                    <th>{{$event->baslangic_saati}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>

      

    </div>

</div>


@endsection