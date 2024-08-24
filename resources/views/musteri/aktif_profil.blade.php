@extends('layouts.main')

@section('content')
@php

 use Carbon\Carbon;
 use App\Models\AktifSantiyeFiyat;
 use App\Models\AktifSantiyeMetraj;
 use App\Models\Urunler;

@endphp
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">
    <div class="row page-titles mx-0 p-4">
        <div class="col-sm-10 p-md-0">
            <div class="welcome-text">
                <h3 style="word-wrap: break-word;">
                    <b>{{$aktif_musteri->unvan}}</b>
                </h3>
                <p class="mb-0">Unvanı yazılı müşteri ile ilgili kısa bilgi verilecek.</p>
            </div>
        </div>
        <div class="col-sm-2 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{route('aktif.musteri.listesi')}}" class="btn btn-light">
                <span class="ti-angle-left"></span> Listeye dön
            </a>
        </div>
        
    </div>
    <div class="row">
        <div class="col-lg-12">
            @if ($errors->any())
                <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                    </button>
                    <div class="media">
                        <div class="alert-left-icon-big">
                            <span><i class="mdi mdi-alert"></i></span>
                        </div>
                        @foreach ($errors->all() as $error)
                        <div class="media-body">
                            <h5 class="mt-1 mb-1">HATA!</h5>
                            <p>{{ $error }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="profile-statistics">
                        <div class="text-center mt-4 border-bottom-1 pb-3">
                            <div class="row">
                                <div class="col">
                                    <h3 class="m-b-0">xxx </h3><span>Şantiye</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">140 m<sup>3</sup></h3><span>Son 1 ayda</span>
                                </div>
                                <div class="col" title="En sık dökülen şantiye fiyatı">
                                    <h3 class="m-b-0">2300</h3><span>+KDV</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="xxxxxxxxxx" class="btn btn-primary pl-2 pr-2 mb-3">Fatura Gönder</a> 
                                <a href="xxxxxxxxxx" class="btn btn-dark pl-2 pr-2 mb-3">Ekstre Gönder</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-blog pt-3 border-bottom-1 pb-1">
                        <h5 class="text-primary d-inline">Son 1 aylık döküm</h5>

                        <canvas id="myDoughnutChart" class="mt-2" width="400" height="400"></canvas>
                        <script>
                            const ctx3 = document.getElementById('myDoughnutChart').getContext('2d');
                            const myDoughnutChart = new Chart(ctx3, {
                                type: 'doughnut',
                                data: {
                                    labels: ['C16', 'C20', 'C25', 'C30', 'C35'],
                                    datasets: [{
                                        label: 'm³ ',
                                        data: [12, 19, 3, 5, 2],
                                        backgroundColor: [
                                            'rgba(225, 225, 225, 1)',
                                            'rgba(185, 185, 185, 1)',
                                            'rgba(165, 165, 165, 1)',
                                            'rgba(125, 125, 125, 1)',
                                            'rgba(100, 100, 100, 1)'
                                        ]
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                        },
                                        tooltip: {
                                            enabled: true
                                        }
                                    }
                                }
                            });
                        </script>


                    </div>
                    <div class="profile-interest mt-4 pb-2 border-bottom-1">
                        <h5 class="text-primary d-inline">Zam Tarihleri</h5>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1" >
                                <div class="text-center text-white" style="background: gray;">20.01.2024</div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1">
                                <div class="text-center text-white" style="background: gray;">20.04.2024</div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1">
                                <div class="text-center text-white" style="background: gray;">20.07.2024</div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1">
                                <div class="text-center text-white" style="background: gray;">1800 <small>+KDV</small></div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1">
                                <div class="text-center text-white" style="background: gray;">2100 <small>+KDV</small></div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-4 int-col p-1">
                                <div class="text-center text-white" style="background: gray;">2300 <small>+KDV</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-news mt-4 pb-3">
                        <h5 class="text-primary d-inline">İşlem Geçmişi</h5>
                        <div class="media pt-3">
                            <div class="media-body">
                                <h5 class="m-b-5">Fiyat Güncelleme</h5>
                                <p>21.07.2024'de <a href="xxxxx">fiyat güncellemesi</a> yapıldı.</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5 class="m-b-3">Ekstre atıldı</h5>
                                <p>10.07.2024'de <a href="xxxxx">ekstre</a> atıldı.</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5 class="m-b-5">Fatura atıldı</h5>
                                <p>9.07.2024'de <a href="xxxxx">xxxxxxxx</a> nolu fatura atıldı.</p>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <h5 class="m-b-5">Fatura kesildi</h5>
                                <p>8.07.2024'de <a href="xxxxx">xxxxxxxx</a> nolu fatura kesildi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#genelbilgi" data-toggle="tab" class="nav-link active show">Genel Bilgiler</a>
                                </li>
                                <li class="nav-item"><a href="#notlar" data-toggle="tab" class="nav-link">Notlar</a>
                                </li>
                                <li class="nav-item"><a href="#analiz" data-toggle="tab" class="nav-link">Analiz</a>
                                </li>
                                <li class="nav-item"><a href="#settings" data-toggle="tab" class="nav-link">Düzenle</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div id="genelbilgi" class="tab-pane fade active show">
                                    <div class="profile-personal-info mt-4" id="container">
                                        <h4 class="text-primary mb-3 mt-4"><b>Şantiye Fiyat Bilgileri</b></h4>
                                        <div class="row">
                                            <div class="table-responsive col-lg-12">
                                                <table class="table table-bordered table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; vertical-align: middle;">#</th>
                                                            <th style="text-align: left; vertical-align: middle;">Şantiye</th>
                                                            <th style="text-align: center; vertical-align: middle;">Beton Sınıfı</th>
                                                            <th style="text-align: center; vertical-align: middle;">Fiyat</th>
                                                            <th style="text-align: center; vertical-align: middle;">Pompa Bedeli</th>
                                                            <th style="text-align: center; vertical-align: middle;">Katkı</th>
                                                            <th style="text-align: center; vertical-align: middle;">Özel</th>
                                                            <th style="text-align: center; vertical-align: middle;">Artış</th>
                                                            <th style="text-align: center; vertical-align: middle;">Azalış</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center; vertical-align: middle;">
                                                        @php
                                                            $sayac_iki = 1;
                                                        @endphp
                                                        @foreach ($aktif_santiye as $santiye)
                                                        @php
                                                            $fiyat = AktifSantiyeFiyat::where('santiye_id', $santiye->id)->get();
                                                            $bs = Urunler::where('id', $fiyat->first()->beton_sinifi)->get();
                                                        @endphp
                                                        <tr data-metraj="">
                                                            <th style="vertical-align: middle;">{{$sayac_iki}}</th>
                                                            <td style="text-align: left;">{{$santiye->santiye}}</td>
                                                            <td>
                                                                @if (isset($bs->first()->adi))
                                                                {{$bs->first()->adi}} 
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <b>
                                                                @if (isset($fiyat->first()->fiyat))
                                                                {{$fiyat->first()->fiyat}} <small> +KDV</small>
                                                                @else
                                                                -
                                                                @endif
                                                                </b>
                                                            </td>
                                                            <td>
                                                                    @if (isset($fiyat->first()->pb))
                                                                    <b>{{$fiyat->first()->pb}}</b> <small> +KDV</small>
                                                                    <br />
                                                                    (
                                                                        @if (isset($fiyat->first()->pb_siniri))
                                                                        <b>{{$fiyat->first()->pb_siniri}}m³</b> altında
                                                                        @else
                                                                        -
                                                                        @endif
                                                                    )
                                                                    @else
                                                                    -
                                                                    @endif
                                                            </td>
                                                            <td>
                                                                @if (isset($fiyat->first()->katki_farki))
                                                                +{{$fiyat->first()->katki_farki}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (isset($fiyat->first()->ozel_farki))
                                                                +{{$fiyat->first()->ozel_farki}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (isset($fiyat->first()->artis))
                                                                +{{$fiyat->first()->artis}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (isset($fiyat->first()->azalis))
                                                                -{{$fiyat->first()->azalis}}
                                                                @else
                                                                -
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $sayac_iki++;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <script>
                                            // Function to sort divs based on data-metraj attribute
                                            function sortDivsByMetraj() {
                                                const container = document.getElementById('container');
                                                const divs = Array.from(container.children);
                                    
                                                divs.sort((a, b) => {
                                                    return b.getAttribute('data-metraj') - a.getAttribute('data-metraj');
                                                });
                                    
                                                // Clear the container and append sorted divs
                                                container.innerHTML = '';
                                                divs.forEach(div => {
                                                    container.appendChild(div);
                                                });
                                            }
                                    
                                            // Call the function to sort divs
                                            sortDivsByMetraj();
                                        </script>

                                        <h4 class="text-primary mb-3 mt-4"><b>Fatura Bilgileri</b></h4>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-3">
                                                        <h5 class="f-w-500">Ünvan <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-8 col-md-9"><span>{{$aktif_musteri->unvan}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-3">
                                                        <h5 class="f-w-500">Adresi <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    <div class="col-8 col-md-9"><span>{{$aktif_musteri->fatura_adresi}} {{$aktif_musteri->sokak}} {{$aktif_musteri->semt}} {{$aktif_musteri->kent}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-3">
                                                        <h5 class="f-w-500">VD / VN <span class="pull-right">:</span></h5>
                                                    </div>
                                                    <div class="col-8 col-md-9"><span>{{$aktif_musteri->vergi_dairesi}} / {{$aktif_musteri->vergi_numarasi}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-3">
                                                        <h5 class="f-w-500">E-posta <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    @if ($aktif_musteri->mail)
                                                    <div class="col-8 col-md-9"><span>{{$aktif_musteri->mail}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-9"><span>Mail adresi bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-3">
                                                        <h5 class="f-w-500">Telefon <span class="pull-right">:</span></h5>
                                                    </div>
                                                    @if ($aktif_musteri->tel)
                                                    <div class="col-8 col-md-9"><span>{{$aktif_musteri->tel}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-9"><span>Telefon numarası bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <h4 class="text-primary mb-3 mt-4"><b>İletişim Bilgileri</b></h4>
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-12 col-lg-12 col-sm-12">
                                                @php
                                                $sayac_uc = 1;
                                                @endphp
                                                <div class="row">
                                                @foreach ($yetkililer as $yetkili)
                                                @if (isset($yetkili->adi_soyadi) OR isset($yetkili->adi_soyadi) OR isset($yetkili->tel))
                                                <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                                                    <div class="card bg-light">
                                                        <div class="card-header">
                                                            <h5 class="card-title">Yetkili - {{$sayac_uc}}</h5>
                                                        </div>
                                                        <div class="card-body mb-0">
                                                            <div class="row mb-4">
                                                                <div class="col-4 col-md-4">
                                                                    <h6 class="f-w-500">Ad Soyad <span class="pull-right">:</span>
                                                                    </h6>
                                                                </div>
                                                                @if (isset($yetkili->adi_soyadi) AND $yetkili->adi_soyadi != NULL)
                                                                <div class="col-8 col-md-8"><span>{{$yetkili->adi_soyadi}}</span></div>
                                                                @else
                                                                <div class="col-8 col-md-8"><span>- Bulunamadı -</span></div>
                                                                @endif
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-4 col-md-4">
                                                                    <h6 class="f-w-500">E-posta <span class="pull-right">:</span>
                                                                    </h6>
                                                                </div>
                                                                @if (isset($yetkili->mail) AND $yetkili->mail != NULL)
                                                                <div class="col-8 col-md-8"><span>{{$yetkili->mail}}</span></div>
                                                                @else
                                                                <div class="col-8 col-md-8"><span>- Bulunamadı -</span></div>
                                                                @endif
                                                            </div>
                                                            <div class="row mb-4">
                                                                <div class="col-4 col-md-4">
                                                                    <h6 class="f-w-500">Telefon <span class="pull-right">:</span></h6>
                                                                </div>
                                                                @if (isset($yetkili->tel) AND $yetkili->tel != NULL)
                                                                <div class="col-8 col-md-8"><span>{{$yetkili->tel}}</span></div>
                                                                @else
                                                                <div class="col-8 col-md-8"><span>- Bulunamadı -</span></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $sayac_uc++;
                                                @endphp
                                                @else
                                                <div class="col-xl-6 col-lg-6">
                                                    <h5>Yetkili bilgisi bulunamamıştır.</h5>
                                                </div>
                                                @break
                                                @endif
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="notlar" class="tab-pane fade">
                                    <div class="my-post-content pt-3">
                                        <div class="">
                                            <form method="post" action="{{route('not.ekle', $aktif_musteri->id)}}" >
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input class='form-control' placeholder='Not Başlığı' type='text' name='baslik' required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="not" id="textarea" cols="30" rows="5"
                                                            class="form-control bg-transparent" placeholder="Müşteri ile ilgili not al...." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-check mb-3 ml-1">
                                                            <input class="form-check-input" type="checkbox" name="hatirlaticiSecici" id="hs">
                                                            <label for="hs" class="form-check-label">
                                                                Hatırlatıcı ekle
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-6 hatirlatici-fields" style="display: none;">
                                                        <div class='form-group'>
                                                            <label class='control-label'>Saat</label>
                                                            <input class='form-control' type='time' name='hatirlaticiSaat' step="3600"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-6 hatirlatici-fields" style="display: none;">
                                                        <div class='form-group'>
                                                            <label class='control-label'>Tarih</label>
                                                            <input class='form-control' type='date' name='hatirlaticiGun'/>
                                                        </div>
                                                    </div>  
                                                    <script>
                                                        document.getElementById('hs').addEventListener('change', function() {
                                                            var fields = document.querySelectorAll('.hatirlatici-fields');
                                                            if (this.checked) {
                                                                fields.forEach(function(field) {
                                                                    field.style.display = 'block';
                                                                    field.querySelectorAll('input').forEach(function(input) {
                                                                        input.required = true;
                                                                        input.disabled = false;
                                                                    });
                                                                });
                                                            } else {
                                                                fields.forEach(function(field) {
                                                                    field.style.display = 'none';
                                                                    field.querySelectorAll('input').forEach(function(input) {
                                                                        input.required = false;
                                                                        input.disabled = true;
                                                                    });
                                                                });
                                                            }
                                                        });

                                                    </script>                                                  
                                                    <div class="col-md-12">
                                                        <input type="submit" class="btn btn-dark" value="Kaydet"> 
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        @if ($notes->count() > 0)
                                            @foreach ($notes as $note)
                                                @php
                                                    $tarihKismi = Carbon::parse($note->hatirlatici)->format('d-m-Y');
                                                    $saatKismi = Carbon::parse($note->hatirlatici)->format('H:i');
                                                @endphp
                                                <div class="profile-uoloaded-post border-bottom-1 my-div mt-4">
                                                    <span class="check-btn" data-id="{{ $note->id }}">
                                                        <a href="#" title="Tamamlandı">&#10003;</a>
                                                    </span>
                                                    <span class="close-btn">
                                                        <a href="#" title="Sil">&times;</a> 
                                                    </span>
                                                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
                                                    <script>
                                                        document.querySelectorAll('.close-btn').forEach(button => {
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
                                                                        // Silme formunu oluşturalım
                                                                        const form = document.createElement('form');
                                                                        form.method = 'POST';
                                                                        form.action = `/musteri/not-tamamlandi/${itemId}`;
                                                                        
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

                                                        document.querySelectorAll('.check-btn').forEach(button => {
                                                                button.addEventListener('click', function() {
                                                                    const itemId = this.getAttribute('data-id');

                                                                    Swal.fire({
                                                                        title: 'Not tamamlandı mı?',
                                                                        text: "Bu not tamamlandı olarak işaretlenecektir!",
                                                                        icon: 'success',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Evet, tamam!',
                                                                        cancelButtonText: 'Hayır, daha var'
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            // Tamamlandı formunu oluşturalım
                                                                            const form = document.createElement('form');
                                                                            form.method = 'POST';
                                                                            form.action = `/musteri/not-tamamlandi/${itemId}`;

                                                                            const csrfField = document.createElement('input');
                                                                            csrfField.type = 'hidden';
                                                                            csrfField.name = '_token';
                                                                            csrfField.value = '{{ csrf_token() }}';
                                                                            form.appendChild(csrfField);

                                                                            const methodField = document.createElement('input');
                                                                            methodField.type = 'hidden';
                                                                            methodField.name = '_method';
                                                                            methodField.value = 'PUT'; // Güncelleme işlemi için PUT veya PATCH kullanılabilir
                                                                            form.appendChild(methodField);

                                                                            document.body.appendChild(form);
                                                                            form.submit();
                                                                        }
                                                                    });
                                                                });
                                                            });

                                                    </script>
                                                    <h4> {{$note->baslik}}</h4>
                                                    @if ($note->hatirlatici == '1111-11-11 11:11:11')
                                                    @else
                                                    <small>
                                                        (<i class="fa fa-clock-o" aria-hidden="true"></i> {{$tarihKismi}} {{$saatKismi}}'de hatırlatılacak)
                                                    </small>
                                                    @endif
                                                    <p>{{$note->not}}</p>
                                                </div>
                                            @endforeach
                                        @else
                                        <div class="text-center mb-2 mt-2">
                                            <h5>Güncel Not bulunmamaktadır.</h5>
                                       </div>
                                        @endif

                                         <!-- sil ve tamalandı biçimlendirmesi -->
                                         <style>
                                            .my-div {
                                                position: relative; /* Bu, check-btn ve close-btn'nin bu div'e göre konumlanmasını sağlar */
                                            }

                                            .check-btn, .close-btn {
                                                position: absolute; /* Ebeveyni olan my-div'e göre konumlanacak */
                                                top: 10px; /* Ebeveynin üst kısmından 10px aşağıda */
                                                font-size: 20px;
                                                cursor: pointer;
                                                color: #000;
                                                transition: color 0.3s;
                                            }

                                            .check-btn {
                                                right: 35px; /* Ebeveynin sağ kısmından 35px içeride */
                                            }

                                            .close-btn {
                                                right: 10px; /* Ebeveynin sağ kısmından 10px içeride */
                                            }

                                            .check-btn:hover {
                                                color: #00ff00; /* Yeşil renge dönüşüm */
                                            }

                                            .close-btn:hover {
                                                color: #ff0000; /* Kırmızıya dönüşüm */
                                            }

                                            .check-btn::after, .close-btn::after {
                                                content: '';
                                                position: absolute;
                                                top: -25px;
                                                right: 0;
                                                background: #333;
                                                color: #fff;
                                                padding: 5px;
                                                border-radius: 3px;
                                                opacity: 0;
                                                transition: opacity 0.3s;
                                                pointer-events: none;
                                                font-size: 12px;
                                            }
                                        </style>
                                        
                                        @if ($notes->count() > 4)
                                        <div class="text-center mb-2">
                                             <!-- Not sayısı fazla olduğunda her basışta biraz daha fazla notun görünmesini sağlyacak -->
                                            <a href="javascript:void()" class="btn btn-primary">Daha Fazla</a>
                                        </div>
                                        @endif

                                        @if ($tamamlanan_notlar->count() > 0)
                                        <div class="text-right mb-2 mt-2">
                                            <!-- Eski Notlar -->
                                            <a href="#tamamlanmisNotlar" data-toggle="tab" class="nav-link" id="link1">
                                                <i class="fa fa-history" aria-hidden="true"></i> Tamamlanmış notlar
                                            </a>
                                       </div>
                                        @endif

                                    </div>
                                </div>

                                <div id="tamamlanmisNotlar" class="tab-pane fade">
                                    @if ($tamamlanan_notlar->count() > 0)
                                        @foreach ($tamamlanan_notlar as $tamamlanan_not)
                                            @php
                                                $tarihKismi = Carbon::parse($tamamlanan_not->hatirlatici)->format('d-m-Y');
                                                $saatKismi = Carbon::parse($tamamlanan_not->hatirlatici)->format('H:i');
                                            @endphp
                                            <div class="profile-uoloaded-post border-bottom-1 my-div mt-4">
                                                <h4> {{$tamamlanan_not->baslik}}</h4>
                                                @if ($tamamlanan_not->hatirlatici == '1111-11-11 11:11:11')
                                                @else
                                                <small>
                                                    (<i class="fa fa-clock-o" aria-hidden="true"></i> {{$tarihKismi}} {{$saatKismi}}'de hatırlatıcı kurulmuştu)
                                                </small>
                                                @endif
                                                <p>{{$tamamlanan_not->not}}</p>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="text-center mb-2 mt-2">
                                        <h5>Güncel tamamlanmış bulunmamaktadır.</h5>
                                    </div>
                                    @endif
                                    <div class="text-right mb-2">
                                        <!-- Notlar -->
                                        <a href="#genel" data-toggle="tab" class="nav-link" id="link2">
                                            <i class="fa fa-reply-all" aria-hidden="true"></i> Notlar
                                        </a>
                                    </div>
                                </div>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#link1').on('click', function(event) {
                                            $(this).addClass('active'); // Tıklanan linke active sınıfını ekle

                                            if ($('.nav-link').hasClass('active')) {
                                                $('.nav-link').removeClass('active'); // Diğer linkten active sınıfını kaldır
                                            }
                                        });

                                        $('#link2').on('click', function(event) {
                                            $(this).addClass('active'); // Tıklanan linke active sınıfını ekle
                                            if ($('.nav-link').hasClass('active')) {
                                                $('.nav-link').removeClass('active'); // Diğer linkten active sınıfını kaldır
                                            }
                                        });
                                    });
                                </script>
                              
                                <div id="analiz" class="tab-pane fade">
                                    
                                    <div class="text-center mb-2 mt-2">
                                        <h5>Karamürsel 5 Aylık döküm</h5>
                                    </div>
                                    <canvas id="karamursel" width="400" height="200"></canvas>
                                    <script>
                                        const ctx = document.getElementById('karamursel').getContext('2d');
                                        const karamursel = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs'],
                                                datasets: [{
                                                    label: 'C16',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: 'rgba(225, 225, 225, 1)'
                                                }, {
                                                    label: 'C20',
                                                    data: [2, 3, 20, 5, 1],
                                                    backgroundColor: 'rgba(185, 185, 185, 1)'
                                                }, {
                                                    label: 'C25',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(165, 165, 165, 1)'
                                                }, {
                                                    label: 'C30',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(125, 125, 125, 1)'
                                                }, {
                                                    label: 'C35 ',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(100, 100, 100, 1)'
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                            }
                                        });
                                    </script>

                                    <div class="text-center mb-2 mt-5">
                                        <h5>Ereğli 5 Aylık döküm</h5>
                                    </div>
                                    <canvas id="eregli" width="400" height="200"></canvas>
                                    <script>
                                        const ctx2 = document.getElementById('eregli').getContext('2d');
                                        const eregli = new Chart(ctx2, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs'],
                                                datasets: [{
                                                    label: 'C16',
                                                    data: [12, 19, 3, 5, 2],
                                                    backgroundColor: 'rgba(225, 225, 225, 1)'
                                                }, {
                                                    label: 'C20',
                                                    data: [2, 3, 20, 5, 1],
                                                    backgroundColor: 'rgba(185, 185, 185, 1)'
                                                }, {
                                                    label: 'C25',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(165, 165, 165, 1)'
                                                }, {
                                                    label: 'C30',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(125, 125, 125, 1)'
                                                }, {
                                                    label: 'C35 ',
                                                    data: [3, 10, 13, 15, 22],
                                                    backgroundColor: 'rgba(100, 100, 100, 1)'
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                            }
                                        });
                                    </script>

                                </div>

                                <div id="settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Şantiye Fiyat Bilgileri Düzenle</h4>
                                            <form method="post" action="{{route('santiye.fiyat.guncelle', $aktif_musteri->id)}}" > <!-- SANTIYE FIYAT BILGILERI DUZENLE FORMU -->
                                                @csrf
                                                @php
                                                    $sayac_bir = 1;
                                                @endphp
                                                @foreach ($aktif_santiye as $santiye)
                                                @php
                                                    $fiyat = AktifSantiyeFiyat::where('santiye_id', $santiye->id)->get();
                                                    $bs = Urunler::where('id', $fiyat->first()->beton_sinifi)->get();
                                                @endphp
                                                <div class="form-header">
                                                    <h5>{{$sayac_bir}}. Şantiye</h5>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Bölge/Şantiye Adı</label>
                                                        <input type="text" class="form-control" value="{{$santiye->santiye}}" name="santiye_{{$santiye->id}}">
                                                    </div>
                                                    <div class="form-group col-md-3 col-6">
                                                        <label>Beton Sınıfı</label>
                                                        <select name="santiye_{{$santiye->id}}_bs" class="form-control" required>
                                                            <option value="1" @if ($bs->first()->id == 1) selected @endif >C16/20</option>
                                                            <option value="2" @if ($bs->first()->id == 2) selected @endif  >C20/25</option>
                                                            <option value="3" @if ($bs->first()->id == 3) selected @endif >C25/30</option>
                                                            <option value="4" @if ($bs->first()->id == 4) selected @endif  >C30/37</option>
                                                            <option value="5" @if ($bs->first()->id == 5) selected @endif  >C35/45</option>
                                                            <option value="6" @if ($bs->first()->id == 6) selected @endif  >C40/50</option>
                                                            <option value="7" @if ($bs->first()->id == 7) selected @endif  >C45/55</option>
                                                            <option value="8" @if ($bs->first()->id == 8) selected @endif  >C50/60</option>
                                                            <option value="9" @if ($bs->first()->id == 9) selected @endif  >C55/67</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3 col-6">
                                                        <label>Fiyatı (<small>+KDV</small>)</label>
                                                        @if (isset($fiyat->first()->fiyat))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->fiyat}}" name="santiye_{{$santiye->id}}_fiyat" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="0" name="santiye_{{$santiye->id}}_fiyat" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Pompa Bedeli (<small>+KDV</small>)</label>
                                                        @if (isset($fiyat->first()->pb))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->pb}}" name="santiye_{{$santiye->id}}_pb" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_pb" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Pompa Sınırı (m³)</label>
                                                        @if (isset($fiyat->first()->pb_siniri))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->pb_siniri}}" name="santiye_{{$santiye->id}}_pbsiniri" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_pbsiniri" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Katkı Farkı</label>
                                                        @if (isset($fiyat->first()->katki_farki))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->katki_farki}}" name="santiye_{{$santiye->id}}_katki" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_katki" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Özel Farkı</label>
                                                        @if (isset($fiyat->first()->ozel_farki))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->ozel_farki}}" name="santiye_{{$santiye->id}}_ozel" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_ozel" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Artış</label>
                                                        @if (isset($fiyat->first()->artis))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->artis}}" name="santiye_{{$santiye->id}}_artis" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_artis" min="0" >
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-3 col-6" >
                                                        <label>Azalış</label>
                                                        @if (isset($fiyat->first()->azalis))
                                                        <input type="number" class="form-control" value="{{$fiyat->first()->azalis}}" name="santiye_{{$santiye->id}}_azalis" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="" name="santiye_{{$santiye->id}}_azalis" min="0" >
                                                        @endif
                                                    </div>
                                                </div>
                                                @php
                                                    $sayac_bir++;
                                                @endphp
                                                @endforeach

                                                <button class="btn btn-success" type="submit">Güncelle</button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#santiyeEkle"  title="Müşterinin max 17 şantiyesi bulunabilir.">Yeni Ekle</button>
                                            </form>
                                            <!-- Modal -->
                                            <div class="modal fade" id="santiyeEkle">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="{{route('santiye.ekle', $aktif_musteri->id)}}">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Yeni Şantiye Ekle</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group col-md-12">
                                                                    <label>Şantiye/Bölge Adı</label>
                                                                    <input type="text" class="form-control" name="yeni_santiye" required>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <div class="form-group col-md-4">
                                                                        <label>Beton Sınıfı</label>
                                                                        <select name="yeni_santiye_bs" class="form-control" required>
                                                                            <option value="" selected disabled></option>
                                                                            <option value="1" >C16/20</option>
                                                                            <option value="2" >C20/25</option>
                                                                            <option value="3" >C25/30</option>
                                                                            <option value="4" >C30/37</option>
                                                                            <option value="5" >C35/45</option>
                                                                            <option value="6" >C40/50</option>
                                                                            <option value="7" >C45/55</option>
                                                                            <option value="8" >C50/60</option>
                                                                            <option value="9" >C55/67</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label>Fiyatı (<small>+KDV</small>)</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_fiyat" min="0" required >
                                                                    </div>
                                                                    <div class="form-group col-md-4">
                                                                        <label>Pompa Bedeli</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_pb" min="0" >
                                                                    </div>
                                                                </div>
                                                                <div class="form-row col-md-12">
                                                                    <div class="form-group col-md-3">
                                                                        <label>Katkı +</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_katki" min="0" required >
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label>Özel Farkı +</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_ozel" min="0" required >
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label>Artış +</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_artis" min="0" required >
                                                                    </div>
                                                                    <div class="form-group col-md-3">
                                                                        <label>Azalış -</label>
                                                                        <input type="number" class="form-control" name="yeni_santiye_azalis" min="0" required >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Çık</button>
                                                                <button type="submit" class="btn btn-success">Kaydet</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <h4 class="text-primary mt-4">Fatura Bilgileri Düzenle</h4>
                                            <form method="POST" action="{{route('fatura.bilgileri.guncelle', $aktif_musteri->id)}}"> <!-- FATURA BILGILERI DUZENLE FORMU -->
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label>Unvan</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->unvan}}" name="unvani">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Fatura Adresi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->fatura_adresi}}" name="fAdresi">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Semt</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->semt}}" name="semt">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Kent</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->kent}}" name="kent">
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>Posta Kodu</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->posta_kodu}}" name="postaKodu">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>E-mail Adresi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->mail}}" name="email">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Vergi Dairesi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->vergi_dairesi}}" name="VD">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>V.N. / T.C.</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->vergi_numarasi}}" name="VNTCN">
                                                    </div>
                                                </div>
                                                <button class="btn btn-success" type="submit">Güncelle</button>
                                            </form>

                                            <h4 class="text-primary mt-4">İletişim Bilgileri Düzenle</h4>
                                            <form method="POST" action="{{route('iletisim.bilgileri.guncelle', $aktif_musteri->id)}}"> <!-- ILETISIM BILGILERI DUZENLE FORMU -->
                                                @csrf
                                                @php
                                                    $sayac_dort = 1;
                                                @endphp
                                                @foreach ($yetkililer as $yetkili)
                                                <h5>
                                                    Yetkili - {{$sayac_dort}}
                                                </h5>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Ad Soyad</label>
                                                        <input type="text" class="form-control" value="{{$yetkili->adi_soyadi}}" name="yet{{$yetkili->id}}AdSoyad">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label>Telefon Numarası</label>
                                                        <input type="text" class="form-control" value="{{$yetkili->tel}}" name="yet{{$yetkili->id}}Tel">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>E-Posta Adresi</label>
                                                        <input type="text" class="form-control" value="{{$yetkili->mail}}" name="yet{{$yetkili->id}}Mail">
                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <label>&nbsp;</label>
                                                        <div><a href="{{route('yetkili.sil', $yetkili->id)}}" class="btn btn-danger"><span class="ti-trash"></span></a></div>
                                                    </div>
                                                </div>
                                                @php
                                                    $sayac_dort++;
                                                @endphp
                                                @endforeach

                                                <button class="btn btn-success" type="submit">Güncelle</button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#yetkiliEkle">Yeni Ekle</button>
                                            </form>
                                            <!-- Modal -->
                                            <div class="modal fade" id="yetkiliEkle">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post" action="{{route('yetkili.ekle', $aktif_musteri->id)}}">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Yeni Yetkili Ekle</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label>Ad Soyad</label>
                                                                        <input type="text" class="form-control" name="yeni_adSoyad">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label>Telefon Numarası</label>
                                                                        <input type="text" class="form-control" name="yeni_tel">
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label>E-Posta Adresi</label>
                                                                        <input type="text" class="form-control" name="yeni_mail">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                                                                <button type="submit" class="btn btn-success">Kaydet</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection