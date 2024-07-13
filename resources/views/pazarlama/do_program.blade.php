@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-2">Beton Programı Yap</h4>
                <p class="mb-0">Pompalı, mikserli ya da santral altı program ekleyebilirsiniz.</p>
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

        @foreach ($pompacilar as $pompaci)
        <!-- {{$pompaci->id}}.Pompaciya Ait Programlar -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$pompaci->ad_soyad}} &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-rounded btn-primary" 
                    data-toggle="modal" data-target="#pompaModal{{$pompaci->id}}">
                        <span class="btn-icon-left text-primary">
                            <i class="fa fa-plus color-primary"></i>
                        </span>Ekle
                    </button>
                    </h4>
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
                                @if ($event->pompaci_id == $pompaci->id)
                                <tr>
                                    <th>{{$event->baslangic_saati}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /# card -->
        </div>
        @endforeach
       

        <!-- Mikserli Programlar -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mikserliler &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-rounded btn-primary" 
                    data-toggle="modal" data-target="#mikserliModal">
                        <span class="btn-icon-left text-primary">
                            <i class="fa fa-plus color-primary"></i>
                        </span>Ekle
                    </button>
                    </h4>
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
                                @if (isset($event->pompaci_id) OR ($event->pompaci_id == 'POMPALI' AND $event->pompaci_id != 'MİKSERLİ'))
                                    @continue
                                @endif
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

        <!-- Santral Alti Programlar -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Santral Altı &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-rounded btn-primary" 
                    data-toggle="modal" data-target="#santralAltiModal">
                        <span class="btn-icon-left text-primary">
                            <i class="fa fa-plus color-primary"></i>
                        </span>Ekle
                    </button>
                    </h4>
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
                                @if (isset($event->pompaci_id) OR ($event->pompaci_id == 'POMPALI' AND $event->pompaci_id != 'SANTRAL ALTI'))
                                    @continue
                                @endif
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

@foreach ($pompacilar as $pompaci)
<!-- Modal Pompali {{$pompaci->id}}.Pompa -->
<div class="modal fade" id="pompaModal{{$pompaci->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('program.olustur.pompali', $pompaci->id) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$pompaci->ad_soyad}} Program ekle</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Müşteri Ünvanı</label>
                            <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title'/>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='beton-cinsi-group'>
                            <label class='control-label'>Beton Cinsi</label>
                            <select class='form-control' name='beton_cinsi'>
                                <option value='' selected disabled>Lütfen seçiniz...</option>
                                <option value='Gro'>C16</option>
                                <option value='C20'>C20</option>
                                <option value='C25'>C25</option>
                                <option value='C30'>C30</option>
                                <option value='C35'>C35</option>
                                <option value='C40'>C40</option>
                                <option value='C45'>C45</option>
                                <option value='C50'>C50</option>
                            </select>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Metraj</label>
                            <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Şantiye</label>
                            <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye'/>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='yapi-elemani-group'>
                            <label class='control-label'>Yapı Elemanı</label>
                            <select class='form-control' name='yapi_elemani'>
                                <option value='' selected disabled>Lütfen seçiniz...</option>
                                <option value='Yer'>Yer</option>
                                <option value='Saha'>Saha</option>
                                <option value='Temel'>Temel</option>
                                <option value='Perde'>Perde</option>
                                <option value='Kolon'>Kolon</option>
                                <option value='Kiriş'>Kiriş</option>
                                <option value='Tabliye'>Tabliye</option>
                                <option value='Diğer'>Diğer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Mikserli -->
<div class="modal fade" id="mikserliModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mikserli Program ekle</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Müşteri Ünvanı</label>
                        <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title'/>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group' id='beton-cinsi-group'>
                        <label class='control-label'>Beton Cinsi</label>
                        <select class='form-control' name='betoncinsi'>
                            <option value='' selected disabled>Lütfen seçiniz...</option>
                            <option value='Gro'>C16</option>
                            <option value='C20'>C20</option>
                            <option value='C25'>C25</option>
                            <option value='C30'>C30</option>
                            <option value='C35'>C35</option>
                            <option value='C40'>C40</option>
                            <option value='C45'>C45</option>
                            <option value='C50'>C50</option>
                        </select>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Metraj</label>
                        <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" />
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Şantiye</label>
                        <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye'/>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group' id='yapi-elemani-group'>
                        <label class='control-label'>Yapı Elemanı</label>
                        <select class='form-control' name='yapielemani'>
                            <option value='' selected disabled>Lütfen seçiniz...</option>
                            <option value='Yer'>Yer</option>
                            <option value='Saha'>Saha</option>
                            <option value='Temel'>Temel</option>
                            <option value='Perde'>Perde</option>
                            <option value='Kolon'>Kolon</option>
                            <option value='Kiriş'>Kiriş</option>
                            <option value='Tabliye'>Tabliye</option>
                            <option value='Diğer'>Diğer</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-success">Kaydet</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Santral Alti -->
<div class="modal fade" id="santralAltiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Santral Altı Program ekle</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Müşteri Ünvanı</label>
                        <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title'/>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group' id='beton-cinsi-group'>
                        <label class='control-label'>Beton Cinsi</label>
                        <select class='form-control' name='betoncinsi'>
                            <option value='' selected disabled>Lütfen seçiniz...</option>
                            <option value='Gro'>C16</option>
                            <option value='C20'>C20</option>
                            <option value='C25'>C25</option>
                            <option value='C30'>C30</option>
                            <option value='C35'>C35</option>
                            <option value='C40'>C40</option>
                            <option value='C45'>C45</option>
                            <option value='C50'>C50</option>
                        </select>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Metraj</label>
                        <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" />
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Şantiye</label>
                        <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye'/>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group' id='yapi-elemani-group'>
                        <label class='control-label'>Yapı Elemanı</label>
                        <select class='form-control' name='yapielemani'>
                            <option value='' selected disabled>Lütfen seçiniz...</option>
                            <option value='Yer'>Yer</option>
                            <option value='Saha'>Saha</option>
                            <option value='Temel'>Temel</option>
                            <option value='Perde'>Perde</option>
                            <option value='Kolon'>Kolon</option>
                            <option value='Kiriş'>Kiriş</option>
                            <option value='Tabliye'>Tabliye</option>
                            <option value='Diğer'>Diğer</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-success">Kaydet</button>
            </div>
        </div>
    </div>
</div>

@endsection