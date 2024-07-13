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
        @foreach ($pompacilar as $pompaci)
        <!-- Pompaciya Ait Programlar -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$pompaci->ad_soyad}} &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-rounded btn-primary">
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
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicModal">Basic modal</button>
<!-- Modal -->
<div class="modal fade" id="basicModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
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
                        <input class='form-control' placeholder='Metraj Giriniz' type='text' name='metraj'/>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group'>
                        <label class='control-label'>Döküm Şekli</label>
                        <select class='form-control' name='category'>
                            <option value='' disabled selected>Seçiniz</option>
                            <option value='pompali'>Pompalı</option>
                            <option value='mikserli'>Mikserli</option>
                            <option value='santralalti'>Santral Altı</option>
                        </select>
                    </div>
                </div>

                <div class='col-md-12'>
                    <div class='form-group' id='pompaci-group' style='display:none;'>
                        <label class='control-label'>Pompa ve Operatörü</label>
                        <select class='form-control' name='pompaci'>
                            <option value='' selected disabled>Lütfen seçiniz...</option>
                            <option value='pompacibir'>P1 38lik - Ahmet Kaya</option>
                            <option value='pompaciiki'>P2 38lik - Şaban Kaya</option>
                            <option value='pompaciuc'>P3  47lik - Lütfü Taş</option>
                        </select>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection