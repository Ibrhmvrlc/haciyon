@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-2">Beton Programı Yap</h4>
                <p class="mb-0">
                    Pompalı, mikserli ya da santral altı program ekleyebilirsiniz. 
                    Tarih, varsayılan olarak bulunduğunuz günden bir sonraki güne ayarlıdır.
                    Tarih seçme kısmından tarihi değiştirebilirsiniz.
                </p>
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
        <!-- Hangi tarihin programı -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 id="date-heading" style="text-align: center;">{{$formatli_tarih}}</h5>
                    <div style="text-align: center;">
                      <div class="date-picker-container">
                        <div class="date-picker-buttons">
                          <a href="xxxxxxx">&lt;</a>
                          <input type="date" id="date" name="date" style="border: 0;">
                          <a href="{{route('program.tarih.ileri', $tarih)}}">&gt;</a>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            
            <style>
                .date-picker-container {
                  display: flex;
                  justify-content: center;
                }
                
                .date-picker-buttons {
                  display: flex;
                  align-items: center;
                }
                
                .date-picker-buttons button {
                  padding: 5px 10px;
                  cursor: pointer;
                }
                
                .date-picker-buttons input[type="date"] {
                  padding: 5px 10px;
                }
              </style>
            
        </div>

        <!-- Herhangi bir hata bildirimi alanı -->
        @if ($errors->any())
            <div class="col-lg-12">
                <div class="card alert alert-danger">
                    <div class="card-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif


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
                                @if (($event->dokum_sekli == 'MİKSERLİ'))
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
                                @if (($event->dokum_sekli == 'SANTRAL ALTI'))
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

    </div>
</div>

@foreach ($pompacilar as $pompaci)
<!-- Modal Pompali {{$pompaci->id}}.Pompa -->
<div class="modal fade" id="pompaModal{{$pompaci->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('program.olustur.pompali', $pompaci->id) }}" method="post">
                @csrf
                <input type="hidden" name="tarihPompa{{$pompaci->id}}" id="tarihIDPompa{{$pompaci->id}}" value="">
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
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' placeholder='Ünvan Giriniz' type='time' name='start' step="3600"/>
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
            <form action="{{ route('program.olustur.mikserli')}}" method="post">
                @csrf
                <input type="hidden" name="tarihMikser" id="tarihIDMikser" value="">
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

<!-- Modal Santral Alti -->
<div class="modal fade" id="santralAltiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('program.olustur.santralalti')}}" method="POST">
                @csrf
                <input type="hidden" name="tarihSantralalti" id="tarihIDSantralalti" value="">
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
@endsection