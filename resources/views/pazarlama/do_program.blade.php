@extends('layouts.main')

@section('content')
@php use Carbon\Carbon; @endphp
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
                <li class="breadcrumb-item"><a href="javascript:void(0)">Günlük Program</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Beton Programı Yap</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <!-- Hangi tarihin programı -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div style="text-align: center;">
                      <div class="date-picker-container">
                        <div class="date-picker-buttons">
                          <?php
                            $eski_tarih = Carbon::parse($tarih)->subDay(); 
                          ?>
                          <a href="{{route('program.tarih.geri', $eski_tarih->format('Y-m-d'))}}" style="display: block; margin-bottom: 10px;">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                              </svg>
                          </a>
                          &nbsp;
                          <h4 id="date-heading" style="text-align: center;">{{$formatli_tarih}}</h4>
                          &nbsp;
                          <?php
                            $ileri_tarih = Carbon::parse($tarih)->addDay(); 
                          ?>
                          <a href="{{route('program.tarih.ileri', $ileri_tarih->format('Y-m-d'))}}" style="display: block; margin-bottom: 10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                            </svg>
                          </a>
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
                    </div>
                    <div style="text-align: center:">
                        <h5 style="text-align: center;">Toplam {{$pompaliAdet+$mikserliAdet+$santralAltiAdet}} Program {{$toplamMKup}} m<sup>3</sup></h5>
                    </div>
                </div>
            </div>
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

        <!--**********************************
            PROGRAM GOSTERIM ALANI BASLANGICI
        ***********************************-->

        @foreach ($pompacilar as $pompaci)
        <!-- {{$pompaci->id}}.Pompaciya Ait Programlar -->
        <div class="col-lg-6">
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
                                @php
                                    $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                                    $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                                @endphp
                                @if ($tarihKismi == $tarih)
                                @if ($event->pompaci_id == $pompaci->id)
                                <tr>
                                    <th>{{$saatKismi}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                    <td style="width: 5px;"><a href="#" data-toggle="modal" data-target="#guncellePompaModal{{$pompaci->id}}"><span class="ti-settings"></span></a></td>
                                    <td style="width: 5px;"><a href="#badge" class="delete-button" data-id="{{ $event->id }}"><span class="ti-trash"></span></a></td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                              
                              

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Mikserli Programlar -->
        <div class="col-lg-6">
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
                                @php
                                $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                                $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                                @endphp
                                @if ($tarihKismi == $tarih)
                                @if (($event->dokum_sekli == 'MİKSERLİ'))
                                <tr>
                                    <th>{{$saatKismi}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                    <td style="width: 5px;"><a href="#" data-toggle="modal" data-target="#guncelleMikserModal"><span class="ti-settings"></span></a></td>
                                    <td style="width: 5px;"><a href="#badge" class="delete-button" data-id="{{ $event->id }}"><span class="ti-trash"></span></a></td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Santral Alti Programlar -->
        <div class="col-lg-6">
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
                                @php
                                $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                                $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                                @endphp
                                @if ($tarihKismi == $tarih)
                                @if (($event->dokum_sekli == 'SANTRAL ALTI'))
                                <tr>
                                    <th>{{$saatKismi}}</th>
                                    <td>{{$event->musteri_adi}}</td>
                                    <td><span class="badge badge-primary">{{$event->santiye}}</span></td>
                                    <td>{{$event->beton_cinsi}}</td>
                                    <td>{{$event->metraj}}</td>
                                    <td class="color-primary">{{$event->yapi_elemani}}</td>
                                    <td style="width: 5px;"><a href="#" data-toggle="modal" data-target="#guncelleSantralAltiModal"><span class="ti-settings"></span></a></td>
                                    <td style="width: 5px;"><a href="#badge" class="delete-button" data-id="{{ $event->id }}"><span class="ti-trash"></span></a></td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            PROGRAM GOSTERIM ALANI SONU
        ***********************************-->

        <!--**********************************
            PROGRAM OZET ALANI BASLANGICI
        ***********************************-->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-12 mb-4">
                                <div>
                                    <canvas id="myChart"></canvas>
                                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                    <script>
                                        const ctx = document.getElementById('myChart');
                                        var labels = [];
                                        var values = [];
                                        
                                        @foreach ($pompacilar as $pompaci)
                                            labels.push('{{ $pompaci->ad_soyad }}');
            
                                            var count = 0;
                                            @foreach ($events as $event)
                                                @if (Carbon::parse($event->baslangic_saati)->format('Y-m-d') == $tarih)
                                                    @if ($event->pompaci_id == $pompaci->id)
                                                        count++;
                                                    @endif
                                                @endif
                                            @endforeach
                                            values.push(count);
                                        @endforeach
            
                                        new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: labels,
                                            datasets: [{
                                            label: 'Programlar',
                                            data: values,
                                            borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false
                                        }
                                        });
                                        
                                    </script>
                                </div>
                                
                            </div>
                            <div class="col-lg-9 col-12 mb-2">
                              
                                <h5>Program Analizi ({{$toplamMKup}} m<sup>3</sup>, {{$pompaliAdet + $mikserliAdet + $santralAltiAdet}} adet)</h5>
                                <ul> 
                                    <li><b>{{$pompaliMetraj}}</b> m<sup>3</sup> <b>{{$pompaliAdet}}</b> Pompalı Program</li>
                                    @if ($mikserliMetraj AND $mikserliAdet)
                                    <li><b>{{$mikserliMetraj}}</b> m<sup>3</sup> <b>{{$mikserliAdet}}</b> Mikserli Program</li>
                                    @endif
                                    @if ($santralAltiMetraj AND $santralAltiAdet)
                                    <li><b>{{$santralAltiMetraj}}</b> m<sup>3</sup> <b>{{$santralAltiAdet}}</b> Santral Altı Program</li>
                                    @endif
                                    <br />
                                    <!-- IK MODULU ILE CALISACAK -->
                                    <li><b>xxxx</b> Pompa Operatörü</li>
                                    <li><b>xxxx</b> Mikser Operatörü</li>
                                    <li><b>xxxx</b> Laboratuvar Personeli</li>
                                    <!-- IK MODULU ILE CALISACAK SONU -->
                                </ul>

                                
                            </div>
                            <div class="col-lg-12 text-center">
                                <a href="{{route('excel.export', $tarih)}}" class="btn btn-rounded btn-success text-light mb-3">
                                    <span class="btn-icon-left text-success">
                                        <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                    </span>Excel
                                </a>

                                &nbsp;
                                &nbsp;

                                <a href="{{route('pdf.export', $tarih)}}" type="button" class="btn btn-rounded btn-warning text-light mb-3" >
                                    <span class="btn-icon-left text-warning">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    </span>PDF
                                </a>

                                &nbsp;
                                &nbsp;

                                <a href="{{route('pdf.email', $tarih)}}" class="btn btn-rounded btn-google text-light mb-3">
                                    <span class="btn-icon-left" style="color: #0078d4;">
                                        <i class="fa fa-envelope color-danger"></i>
                                    </span>Email
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--**********************************
            PROGRAM OZET ALANI SONU
        ***********************************-->

        <!--**********************************
            PROGRAM SILME ALANI
        ***********************************-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
        <script>
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Emin misiniz?',
                        text: "Bu işlemi geri alamazsınız!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Evet, sil!',
                        cancelButtonText: 'Hayır, iptal et'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Silme formunu oluşturup gönderebiliriz
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/program/items/${itemId}`;
                            
                            const csrfField = document.createElement('input');
                            csrfField.type = 'hidden';
                            csrfField.name = '_token';
                            csrfField.value = '{{ csrf_token() }}';
                            form.appendChild(csrfField);
                            
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            form.appendChild(methodField);

                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        </script>

        <!--**********************************
            PROGRAM SILME ALANI SONU
        ***********************************-->

    </div>
</div>


<!--**********************************
    PROGRAM OLUSTURMA MODALLARI
***********************************-->

@foreach ($pompacilar as $pompaci)
<!-- Modal Pompali {{$pompaci->id}}.Pompa -->
<div class="modal fade" id="pompaModal{{$pompaci->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('program.olustur.pompali',  ['id' => $pompaci->id, 'tarih' => $tarih]) }}" method="post">
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
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600"/>
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
            <form action="{{ route('program.olustur.mikserli', $tarih)}}" method="post">
                @csrf
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
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600"/>
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
            <form action="{{route('program.olustur.santralalti', $tarih)}}" method="POST">
                @csrf
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
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600"/>
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
<!--**********************************
    PROGRAM OLUSTURMA MODALLARI SONU
***********************************-->

<!--**********************************
    PROGRAM GUNCELLEME MODALLARI
***********************************-->

@foreach ($pompacilar as $pompaci)
@foreach ($events as $event)
@if ($event->pompaci_id == $pompaci->id)
<!-- POMPALI {{$event->id}}.id'li programi guncelleme alani -->
<div class="modal fade" id="guncellePompaModal{{$pompaci->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('programlar.guncelle', $event->id)}}" method="post"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$event->musteri_adi}} Programını Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Müşteri Ünvanı</label>
                            <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title' value="{{$event->musteri_adi}}"/>
                        </div>
                    </div>

                    @php
                    $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                    $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                    @endphp

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600" value="{{$saatKismi}}"/>
                            <input type="hidden" name="tarihKismi" value="{{$tarihKismi}}">
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='beton-cinsi-group'>
                            <label class='control-label'>Beton Cinsi</label>
                            <select class='form-control' name='beton_cinsi'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->beton_cinsi == 'Gro')
                                <option value='Gro' selected>C16</option>
                                @else
                                <option value='Gro'>C16</option>
                                @endif
                                @if ($event->beton_cinsi == 'C20')
                                <option value='C20' selected>C20</option>
                                @else
                                <option value='C20'>C20</option>
                                @endif
                                @if ($event->beton_cinsi == 'C25')
                                <option value='C25' selected>C25</option>
                                @else
                                <option value='C25'>C25</option>
                                @endif
                                @if ($event->beton_cinsi == 'C30')
                                <option value='C30' selected>C30</option>
                                @else
                                <option value='C30'>C30</option>
                                @endif
                                @if ($event->beton_cinsi == 'C35')
                                <option value='C35' selected>C35</option>
                                @else
                                <option value='C35'>C35</option>
                                @endif
                                @if ($event->beton_cinsi == 'C40')
                                <option value='C40' selected>C40</option>
                                @else
                                <option value='C40'>C40</option>
                                @endif
                                @if ($event->beton_cinsi == 'C45')
                                <option value='C45' selected>C45</option>
                                @else
                                <option value='C45'>C45</option>
                                @endif
                                @if ($event->beton_cinsi == 'C50')
                                <option value='C50' selected>C50</option>
                                @else
                                <option value='C50'>C50</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Metraj</label>
                            <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" value="{{$event->metraj}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Şantiye</label>
                            <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye' value="{{$event->santiye}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='yapi-elemani-group'>
                            <label class='control-label'>Yapı Elemanı</label>
                            <select class='form-control' name='yapi_elemani'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->yapi_elemani == 'Yer')
                                <option value='Yer' selected>Yer</option>
                                @else
                                <option value='Yer'>Yer</option>
                                @endif
                                @if ($event->yapi_elemani == 'Saha')
                                <option value='Saha' selected>Saha</option>
                                @else
                                <option value='Saha'>Saha</option>
                                @endif
                                @if ($event->yapi_elemani == 'Temel')
                                <option value='Temel' selected>Temel</option>
                                @else
                                <option value='Temel'>Temel</option>
                                @endif
                                @if ($event->yapi_elemani == 'Perde')
                                <option value='Perde' selected>Perde</option>
                                @else
                                <option value='Perde'>Perde</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kolon')
                                <option value='Kolon' selected>Kolon</option>
                                @else
                                <option value='Kolon'>Kolon</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kiriş')
                                <option value='Kiriş' selected>Kiriş</option>
                                @else
                                <option value='Kiriş'>Kiriş</option>
                                @endif
                                @if ($event->yapi_elemani == 'Tabliye')
                                <option value='Tabliye' selected>Tabliye</option>
                                @else
                                <option value='Tabliye'>Tabliye</option>
                                @endif
                                @if ($event->yapi_elemani == 'Diğer')
                                <option value='Diğer' selected>Diğer</option>
                                @else
                                <option value='Diğer'>Diğer</option>
                                @endif
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
@endif
@endforeach
@endforeach

@foreach ($events as $event)
@if ($event->pompaci_id == 0 AND $event->dokum_sekli == 'MİKSERLİ')
<!-- MIKSERLI {{$event->id}}.id'li programi guncelleme alani -->
<div class="modal fade" id="guncelleMikserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('programlar.guncelle', $event->id)}}" method="post"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$event->musteri_adi}} Programını Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Müşteri Ünvanı</label>
                            <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title' value="{{$event->musteri_adi}}"/>
                        </div>
                    </div>

                    @php
                    $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                    $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                    @endphp

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600" value="{{$saatKismi}}"/>
                            <input type="hidden" name="tarihKismi" value="{{$tarihKismi}}">
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='beton-cinsi-group'>
                            <label class='control-label'>Beton Cinsi</label>
                            <select class='form-control' name='beton_cinsi'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->beton_cinsi == 'Gro')
                                <option value='Gro' selected>C16</option>
                                @else
                                <option value='Gro'>C16</option>
                                @endif
                                @if ($event->beton_cinsi == 'C20')
                                <option value='C20' selected>C20</option>
                                @else
                                <option value='C20'>C20</option>
                                @endif
                                @if ($event->beton_cinsi == 'C25')
                                <option value='C25' selected>C25</option>
                                @else
                                <option value='C25'>C25</option>
                                @endif
                                @if ($event->beton_cinsi == 'C30')
                                <option value='C30' selected>C30</option>
                                @else
                                <option value='C30'>C30</option>
                                @endif
                                @if ($event->beton_cinsi == 'C35')
                                <option value='C35' selected>C35</option>
                                @else
                                <option value='C35'>C35</option>
                                @endif
                                @if ($event->beton_cinsi == 'C40')
                                <option value='C40' selected>C40</option>
                                @else
                                <option value='C40'>C40</option>
                                @endif
                                @if ($event->beton_cinsi == 'C45')
                                <option value='C45' selected>C45</option>
                                @else
                                <option value='C45'>C45</option>
                                @endif
                                @if ($event->beton_cinsi == 'C50')
                                <option value='C50' selected>C50</option>
                                @else
                                <option value='C50'>C50</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Metraj</label>
                            <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" value="{{$event->metraj}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Şantiye</label>
                            <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye' value="{{$event->santiye}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='yapi-elemani-group'>
                            <label class='control-label'>Yapı Elemanı</label>
                            <select class='form-control' name='yapi_elemani'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->yapi_elemani == 'Yer')
                                <option value='Yer' selected>Yer</option>
                                @else
                                <option value='Yer'>Yer</option>
                                @endif
                                @if ($event->yapi_elemani == 'Saha')
                                <option value='Saha' selected>Saha</option>
                                @else
                                <option value='Saha'>Saha</option>
                                @endif
                                @if ($event->yapi_elemani == 'Temel')
                                <option value='Temel' selected>Temel</option>
                                @else
                                <option value='Temel'>Temel</option>
                                @endif
                                @if ($event->yapi_elemani == 'Perde')
                                <option value='Perde' selected>Perde</option>
                                @else
                                <option value='Perde'>Perde</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kolon')
                                <option value='Kolon' selected>Kolon</option>
                                @else
                                <option value='Kolon'>Kolon</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kiriş')
                                <option value='Kiriş' selected>Kiriş</option>
                                @else
                                <option value='Kiriş'>Kiriş</option>
                                @endif
                                @if ($event->yapi_elemani == 'Tabliye')
                                <option value='Tabliye' selected>Tabliye</option>
                                @else
                                <option value='Tabliye'>Tabliye</option>
                                @endif
                                @if ($event->yapi_elemani == 'Diğer')
                                <option value='Diğer' selected>Diğer</option>
                                @else
                                <option value='Diğer'>Diğer</option>
                                @endif
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
@endif
@endforeach

@foreach ($events as $event)
@if ($event->pompaci_id == 0 AND $event->dokum_sekli == 'SANTRAL ALTI')
<!-- SANTRAL ALTI {{$event->id}}.id'li programi guncelleme alani -->
<div class="modal fade" id="guncelleSantralAltiModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('programlar.guncelle', $event->id)}}" method="post"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{$event->musteri_adi}} Programını Güncelle</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Müşteri Ünvanı</label>
                            <input class='form-control' placeholder='Ünvan Giriniz' type='text' name='title' value="{{$event->musteri_adi}}"/>
                        </div>
                    </div>

                    @php
                    $tarihKismi = Carbon::parse($event->baslangic_saati)->format('Y-m-d');
                    $saatKismi = Carbon::parse($event->baslangic_saati)->format('H:i');
                    @endphp

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Saat</label>
                            <input class='form-control' type='time' name='start' step="3600" value="{{$saatKismi}}"/>
                            <input type="hidden" name="tarihKismi" value="{{$tarihKismi}}">
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='beton-cinsi-group'>
                            <label class='control-label'>Beton Cinsi</label>
                            <select class='form-control' name='beton_cinsi'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->beton_cinsi == 'Gro')
                                <option value='Gro' selected>C16</option>
                                @else
                                <option value='Gro'>C16</option>
                                @endif
                                @if ($event->beton_cinsi == 'C20')
                                <option value='C20' selected>C20</option>
                                @else
                                <option value='C20'>C20</option>
                                @endif
                                @if ($event->beton_cinsi == 'C25')
                                <option value='C25' selected>C25</option>
                                @else
                                <option value='C25'>C25</option>
                                @endif
                                @if ($event->beton_cinsi == 'C30')
                                <option value='C30' selected>C30</option>
                                @else
                                <option value='C30'>C30</option>
                                @endif
                                @if ($event->beton_cinsi == 'C35')
                                <option value='C35' selected>C35</option>
                                @else
                                <option value='C35'>C35</option>
                                @endif
                                @if ($event->beton_cinsi == 'C40')
                                <option value='C40' selected>C40</option>
                                @else
                                <option value='C40'>C40</option>
                                @endif
                                @if ($event->beton_cinsi == 'C45')
                                <option value='C45' selected>C45</option>
                                @else
                                <option value='C45'>C45</option>
                                @endif
                                @if ($event->beton_cinsi == 'C50')
                                <option value='C50' selected>C50</option>
                                @else
                                <option value='C50'>C50</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Metraj</label>
                            <input name='metraj' class='form-control' placeholder='Metraj Giriniz' type='number' min="0" value="{{$event->metraj}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group'>
                            <label class='control-label'>Şantiye</label>
                            <input class='form-control' placeholder='Şantiye Giriniz' type='text' name='santiye' value="{{$event->santiye}}" />
                        </div>
                    </div>

                    <div class='col-md-12'>
                        <div class='form-group' id='yapi-elemani-group'>
                            <label class='control-label'>Yapı Elemanı</label>
                            <select class='form-control' name='yapi_elemani'>
                                <option value='' disabled>Lütfen seçiniz...</option>
                                @if ($event->yapi_elemani == 'Yer')
                                <option value='Yer' selected>Yer</option>
                                @else
                                <option value='Yer'>Yer</option>
                                @endif
                                @if ($event->yapi_elemani == 'Saha')
                                <option value='Saha' selected>Saha</option>
                                @else
                                <option value='Saha'>Saha</option>
                                @endif
                                @if ($event->yapi_elemani == 'Temel')
                                <option value='Temel' selected>Temel</option>
                                @else
                                <option value='Temel'>Temel</option>
                                @endif
                                @if ($event->yapi_elemani == 'Perde')
                                <option value='Perde' selected>Perde</option>
                                @else
                                <option value='Perde'>Perde</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kolon')
                                <option value='Kolon' selected>Kolon</option>
                                @else
                                <option value='Kolon'>Kolon</option>
                                @endif
                                @if ($event->yapi_elemani == 'Kiriş')
                                <option value='Kiriş' selected>Kiriş</option>
                                @else
                                <option value='Kiriş'>Kiriş</option>
                                @endif
                                @if ($event->yapi_elemani == 'Tabliye')
                                <option value='Tabliye' selected>Tabliye</option>
                                @else
                                <option value='Tabliye'>Tabliye</option>
                                @endif
                                @if ($event->yapi_elemani == 'Diğer')
                                <option value='Diğer' selected>Diğer</option>
                                @else
                                <option value='Diğer'>Diğer</option>
                                @endif
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
@endif
@endforeach
<!--**********************************
    PROGRAM GUNCELLEME MODALLARI SONU
***********************************-->
@endsection
