@extends('layouts.main')

@section('content')
@php

 use Carbon\Carbon;
 use App\Models\AktifSantiyeFiyat;
use App\Models\AktifSantiyeMetraj;

@endphp
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>
                    {{$aktif_musteri->unvan}}
                </h4>
                <p class="mb-0">Unvanı yazılı müşteri ile ilgili kısa bilgi verilecek.</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="{{route('aktif.musteri.listesi')}}" class="btn btn-light">
                <span class="ti-angle-left"></span> Listeye dön
            </a>
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
    </div>
  
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="profile">
                <div class="profile-head">
                    <div class="profile-info">
                        <div class="row justify-content-start">
                            <div class="col-xl-8">
                                <div class="row">
                                    <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                        @if ($aktif_musteri->yetkili_bir)
                                        <div class="profile-name">
                                            <h4 class="text-primary">{{$aktif_musteri->yetkili_bir}}</h4>
                                            <p>Yetkili</p>
                                        </div>
                                        @elseif ($aktif_musteri->yetkili_iki)
                                        <div class="profile-name">
                                            <h4 class="text-primary">{{$aktif_musteri->yetkili_iki}}</h4>
                                            <p>Yetkili</p>
                                        </div>
                                        @elseif ($aktif_musteri->yetkili_uc)
                                        <div class="profile-name">
                                            <h4 class="text-primary">{{$aktif_musteri->yetkili_uc}}</h4>
                                            <p>Yetkili</p>
                                        </div>
                                        @else
                                        <div class="profile-name">
                                            <h4 class="text-primary">ATANMAMIŞ</h4>
                                            <p>Yetkili</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-xl-4 col-sm-4 prf-col">
                                        @if ($aktif_musteri->tel)
                                        <div class="profile-call">
                                            <h4 class="text-muted">{{$aktif_musteri->tel}}</h4>
                                            <p>Genel İletişim</p>
                                        </div>
                                        @elseif ($aktif_musteri->yetkili_bir_tel)
                                        <div class="profile-call">
                                            <h4 class="text-muted">{{$aktif_musteri->yetkili_bir_tel}}</h4>
                                            @if ($aktif_musteri->yetkili_bir)
                                            <p>{{$aktif_musteri->yetkili_bir}} İletişim</p>
                                            @else
                                            <p>Yetkili İletişim</p>
                                            @endif
                                        </div>
                                        @elseif ($aktif_musteri->yetkili_iki_tel)
                                        <div class="profile-call">
                                            <h4 class="text-muted">{{$aktif_musteri->yetkili_iki_tel}}</h4>
                                            @if ($aktif_musteri->yetkili_iki)
                                            <p>{{$aktif_musteri->yetkili_iki}} İletişim</p>
                                            @else
                                            <p>Yetkili İletişim</p>
                                            @endif
                                        </div>
                                        @elseif ($aktif_musteri->yetkili_uc_tel)
                                        <div class="profile-call">
                                            <h4 class="text-muted">{{$aktif_musteri->yetkili_uc_tel}}</h4>
                                            @if ($aktif_musteri->yetkili_uc)
                                            <p>{{$aktif_musteri->yetkili_uc}} İletişim</p>
                                            @else
                                            <p>Yetkili İletişim</p>
                                            @endif
                                        </div>
                                        @else
                                        <div class="profile-call">
                                            <h4 class="text-muted">ATANMAMIŞ</h4>
                                            <p>İletişim</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <h3 class="m-b-0">150</h3><span>Follower</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">140</h3><span>Place Stay</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">45</h3><span>Reviews</span>
                                </div>
                            </div>
                            <div class="mt-4"><a href="javascript:void()" class="btn btn-primary pl-5 pr-5 mr-3 mb-4">Follow</a> <a href="javascript:void()" class="btn btn-dark pl-5 pr-5 mb-4">Send
                                    Message</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-blog pt-3 border-bottom-1 pb-1">
                        <h5 class="text-primary d-inline">Today Highlights</h5><a href="javascript:void()" class="pull-right f-s-16">More</a>
                        <img src="images/profile/1.jpg" alt="" class="img-fluid mt-4 mb-4 w-100">
                        <h4>Darwin Creative Agency Theme</h4>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    </div>
                    <div class="profile-interest mt-4 pb-2 border-bottom-1">
                        <h5 class="text-primary d-inline">Interest</h5>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/2.jpg" alt="" class="img-fluid">
                                    <p>Shopping Mall</p>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/3.jpg" alt="" class="img-fluid">
                                    <p>Photography</p>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/4.jpg" alt="" class="img-fluid">
                                    <p>Art &amp; Gallery</p>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/2.jpg" alt="" class="img-fluid">
                                    <p>Visiting Place</p>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/3.jpg" alt="" class="img-fluid">
                                    <p>Shopping</p>
                                </a>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-sm-4 col-6 int-col">
                                <a href="javascript:void()" class="interest-cat">
                                    <img src="images/profile/4.jpg" alt="" class="img-fluid">
                                    <p>Biking</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="profile-news mt-4 pb-3">
                        <h5 class="text-primary d-inline">Our Latest News</h5>
                        <div class="media pt-3 pb-3">
                            <img src="images/profile/5.jpg" alt="image" class="mr-3">
                            <div class="media-body">
                                <h5 class="m-b-5">John Tomas</h5>
                                <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
                            </div>
                        </div>
                        <div class="media pt-3 pb-3">
                            <img src="images/profile/6.jpg" alt="image" class="mr-3">
                            <div class="media-body">
                                <h5 class="m-b-5">John Tomas</h5>
                                <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
                            </div>
                        </div>
                        <div class="media pt-3 pb-3">
                            <img src="images/profile/7.jpg" alt="image" class="mr-3">
                            <div class="media-body">
                                <h5 class="m-b-5">John Tomas</h5>
                                <p>I shared this on my fb wall a few months back, and I thought I'd share it here again because it's such a great read</p>
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
                                <li class="nav-item"><a href="#genel" data-toggle="tab" class="nav-link active show">Notlar</a>
                                </li>
                                <li class="nav-item"><a href="#genelbilgi" data-toggle="tab" class="nav-link">Genel Bilgiler</a>
                                </li>
                                <li class="nav-item"><a href="#analiz" data-toggle="tab" class="nav-link">Analiz</a>
                                </li>
                                <li class="nav-item"><a href="#settings" data-toggle="tab" class="nav-link">Düzenle</a>
                                </li>
                            </ul>
                            <div class="tab-content">

                                <div id="genel" class="tab-pane fade active show">
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

                                <div id="genelbilgi" class="tab-pane fade">
                                    <h4 class="text-primary mb-4 mt-4">Şantiye Fiyat Bilgileri</h4>
                                    <div class="profile-personal-info mt-4" id="container">
                                        @foreach ($aktif_santiye as $santiye)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_bir_metraj)){{$metraj->first()->santiye_bir_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_bir}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $bir_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($bir_fiyat->first()->santiye_bir_fiyat) AND $bir_fiyat->first()->santiye_bir_fiyat != 0)
                                                {{$bir_fiyat->first()->santiye_bir_fiyat}}
                                                <small>+KDV</small>
                                                @else
                                                Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @if ($santiye->santiye_iki)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_iki_metraj)){{$metraj->first()->santiye_iki_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_iki}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $iki_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($iki_fiyat->first()->santiye_iki_fiyat) AND $iki_fiyat->first()->santiye_iki_fiyat != 0)
                                                {{$iki_fiyat->first()->santiye_iki_fiyat}}
                                                <small>+KDV</small>
                                                @else
                                                Fiyat belirtilmemiş.
                                                @endif
                                                </span> 
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_uc)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_uc_metraj)){{$metraj->first()->santiye_uc_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_uc}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $uc_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($uc_fiyat->first()->santiye_uc_fiyat) AND $uc_fiyat->first()->santiye_uc_fiyat != 0)
                                                {{$uc_fiyat->first()->santiye_uc_fiyat}}
                                                <small>+KDV</small>
                                                @else
                                                Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_dort)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_dort_metraj)){{$metraj->first()->santiye_dort_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_dort}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $dort_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($dort_fiyat->first()->santiye_dort_fiyat) AND $dort_fiyat->first()->santiye_dort_fiyat != 0)
                                                {{$dort_fiyat->first()->santiye_dort_fiyat}}
                                                <small>+KDV</small>
                                                @else
                                                Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_bes)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_bes_metraj)){{$metraj->first()->santiye_bes_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_bes}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $bes_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($bes_fiyat->first()->santiye_bes_fiyat) AND $bes_fiyat->first()->santiye_bes_fiyat != 0)
                                                    {{$bes_fiyat->first()->santiye_bes_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_alti)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_alti_metraj)){{$metraj->first()->santiye_alti_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_alti}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $alti_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($alti_fiyat->first()->santiye_alti_fiyat) AND $alti_fiyat->first()->santiye_alti_fiyat != 0)
                                                    {{$alti_fiyat->first()->santiye_alti_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_yedi)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_yedi_metraj)){{$metraj->first()->santiye_yedi_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_yedi}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $yedi_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($yedi_fiyat->first()->santiye_yedi_fiyat) AND $yedi_fiyat->first()->santiye_yedi_fiyat != 0)
                                                    {{$yedi_fiyat->first()->santiye_yedi_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_sekiz)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_sekiz_metraj)){{$metraj->first()->santiye_sekiz_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_sekiz}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $sekiz_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($sekiz_fiyat->first()->santiye_sekiz_fiyat) AND $sekiz_fiyat->first()->santiye_sekiz_fiyat != 0)
                                                    {{$sekiz_fiyat->first()->santiye_sekiz_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_dokuz)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_dokuz_metraj)){{$metraj->first()->santiye_dokuz_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_dokuz}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $dokuz_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($dokuz_fiyat->first()->santiye_dokuz_fiyat) AND $dokuz_fiyat->first()->santiye_dokuz_fiyat != 0)
                                                    {{$dokuz_fiyat->first()->santiye_dokuz_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_on)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_on_metraj)){{$metraj->first()->santiye_on_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_on}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $on_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($on_fiyat->first()->santiye_on_fiyat) AND $on_fiyat->first()->santiye_on_fiyat != 0)
                                                    {{$on_fiyat->first()->santiye_on_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_onbir)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_onbir_metraj)){{$metraj->first()->santiye_onbir_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_onbir}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $onbir_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($onbir_fiyat->first()->santiye_onbir_fiyat) AND $onbir_fiyat->first()->santiye_onbir_fiyat != 0)
                                                    {{$onbir_fiyat->first()->santiye_onbir_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_oniki)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_oniki_metraj)){{$metraj->first()->santiye_oniki_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_oniki}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $oniki_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($oniki_fiyat->first()->santiye_oniki_fiyat) AND $oniki_fiyat->first()->santiye_oniki_fiyat != 0)
                                                    {{$oniki_fiyat->first()->santiye_oniki_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_onuc)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_onuc_metraj)){{$metraj->first()->santiye_onuc_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_onuc}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $onuc_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($onuc_fiyat->first()->santiye_onuc_fiyat) AND $onuc_fiyat->first()->santiye_onuc_fiyat != 0)
                                                    {{$onuc_fiyat->first()->santiye_onuc_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_ondort)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_ondort_metraj)){{$metraj->first()->santiye_ondort_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_ondort}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $ondort_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($ondort_fiyat->first()->santiye_ondort_fiyat) AND $ondort_fiyat->first()->santiye_ondort_fiyat != 0)
                                                    {{$ondort_fiyat->first()->santiye_ondort_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_onbes)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_onbes_metraj)){{$metraj->first()->santiye_onbes_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_onbes}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $onbes_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($onbes_fiyat->first()->santiye_onbes_fiyat) AND $onbes_fiyat->first()->santiye_onbes_fiyat != 0)
                                                    {{$onbes_fiyat->first()->santiye_onbes_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_onalti)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_onalti_metraj)){{$metraj->first()->santiye_onalti_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_onalti}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $onalti_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($onalti_fiyat->first()->santiye_onalti_fiyat) AND $onalti_fiyat->first()->santiye_onalti_fiyat != 0)
                                                    {{$onalti_fiyat->first()->santiye_onalti_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($santiye->santiye_onyedi)
                                        <div class="row mb-4" data-metraj="@if (isset($metraj->first()->santiye_onyedi_metraj)){{$metraj->first()->santiye_onyedi_metraj}} @endif">
                                            <div class="col-md-5 col-7">
                                                <h6 class="f-w-500">{{$santiye->santiye_onyedi}}<span class="pull-right">:</span>
                                                </h6>
                                            </div>
                                            <div class="col-md-7 col-5">
                                                <span>
                                                @php
                                                    $onyedi_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                @endphp
                                                @if (isset($onyedi_fiyat->first()->santiye_onyedi_fiyat) AND $onyedi_fiyat->first()->santiye_onyedi_fiyat != 0)
                                                    {{$onyedi_fiyat->first()->santiye_onyedi_fiyat}}
                                                    <small>+KDV</small>
                                                @else
                                                    Fiyat belirtilmemiş.
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

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

                                        <h4 class="text-primary mb-4">Fatura Bilgileri</h4>
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

                                        <h4 class="text-primary mb-4">İletişim Bilgileri</h4>
                                        <div class="row">
                                            @if ($aktif_musteri->yetkili_bir)
                                            <div class="col-xl-6 col-lg-6">
                                                <h5 title="Genel Müdür, Mal sahibi, Mühendis vs."><b><u>Yetkili - 1</u></b></h5>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">Ad Soyad <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_bir)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_bir}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Yetkili bilgisi bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">E-posta <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_bir_mail)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_bir_mail}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Mail adresi bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">Telefon <span class="pull-right">:</span></h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_bir_tel)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_bir_tel}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Telefon numarası bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            @if ($aktif_musteri->yetkili_iki)
                                            <div class="col-xl-6 col-lg-6">
                                                <h5 title="Muhasebe, Şef, Kalfa vs."><b><u>Yetkili - 2</u></b></h5>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">Ad Soyad <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_iki)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_iki}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Yetkili bilgisi bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">E-posta <span class="pull-right">:</span>
                                                        </h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_iki_mail)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_iki_mail}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Mail adresi bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-4 col-md-5">
                                                        <h5 class="f-w-500">Telefon <span class="pull-right">:</span></h5>
                                                    </div>
                                                    @if ($aktif_musteri->yetkili_iki_tel)
                                                    <div class="col-8 col-md-7"><span>{{$aktif_musteri->yetkili_iki_tel}}</span></div>
                                                    @else
                                                    <div class="col-8 col-md-7"><span>Telefon numarası bulunamadı.</span></div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                              
                                <div id="analiz" class="tab-pane fade">
                                    <div class="profile-about-me">
                                        <div class="pt-4 border-bottom-1 pb-4">
                                            <h4 class="text-primary">Fiyat</h4>
                                            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the
                                                bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>
                                            <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed
                                                in a nice, gilded frame.</p>
                                        </div>
                                    </div>
                                    <div class="profile-skills pt-2 border-bottom-1 pb-2">
                                        <h4 class="text-primary mb-4">Skills</h4>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Admin</a>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Dashboard</a>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Photoshop</a>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Bootstrap</a>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Responsive</a>
                                        <a href="javascript:void()" class="btn btn-outline-dark btn-rounded pl-4 my-3 my-sm-0 pr-4 mr-3 m-b-10">Crypto</a>
                                    </div>
                                    <div class="profile-lang pt-5 border-bottom-1 pb-5">
                                        <h4 class="text-primary mb-4">Language</h4><a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                class="flag-icon flag-icon-us"></i> English</a> <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                class="flag-icon flag-icon-fr"></i> French</a>
                                        <a href="javascript:void()" class="text-muted pr-3 f-s-16"><i
                                                class="flag-icon flag-icon-bd"></i> Bangla</a>
                                    </div>
                                    <div class="profile-personal-info">
                                        <h4 class="text-primary mb-4">Personal Information</h4>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Name <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>Mitchell C.Shay</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Email <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>example@examplel.com</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Availability <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>Full Time (Free Lancer)</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Age <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>27</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Location <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>Rosemont Avenue Melbourne,
                                                    Florida</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Year Experience <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>07 Year Experiences</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="settings" class="tab-pane fade">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Şantiye Fiyat Bilgileri Düzenle</h4>
                                            <form method="post" action="{{route('santiye.fiyat.guncelle', $aktif_musteri->id)}}" > <!-- SANTIYE FIYAT BILGILERI DUZENLE FORMU -->
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Birinci Şantiye</label>
                                                        <input type="text" class="form-control" value="{{$santiye->santiye_bir}}" name="santiye_bir">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Birinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                        @php
                                                        $bir_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                        @endphp
                                                        @if (isset($bir_fiyat->first()->santiye_bir_fiyat))
                                                        <input type="number" class="form-control" value="{{$bir_fiyat->first()->santiye_bir_fiyat}}" name="santiye_bir_fiyat" min="0" >
                                                        @else
                                                        <input type="number" class="form-control" value="0" name="santiye_bir_fiyat" min="0" >
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                @if ($santiye->santiye_iki)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>İkinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_iki}}" name="santiye_iki">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>İkinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $iki_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($iki_fiyat->first()->santiye_iki_fiyat))
                                                                <input type="number" class="form-control" value="{{$iki_fiyat->first()->santiye_iki_fiyat}}" name="santiye_iki_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_iki_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_uc)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Üçüncü Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_uc}}" name="santiye_uc">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Üçüncü Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $uc_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($uc_fiyat->first()->santiye_uc_fiyat))
                                                                <input type="number" class="form-control" value="{{$uc_fiyat->first()->santiye_uc_fiyat}}" name="santiye_uc_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_uc_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_dort)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Dördüncü Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_dort}}" name="santiye_dort">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Dördüncü Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $dort_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($dort_fiyat->first()->santiye_dort_fiyat))
                                                                <input type="number" class="form-control" value="{{$dort_fiyat->first()->santiye_dort_fiyat}}" name="santiye_dort_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_dort_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_bes)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Beşinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_bes}}" name="santiye_bes">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Beşinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $bes_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($bes_fiyat->first()->santiye_bes_fiyat))
                                                                <input type="number" class="form-control" value="{{$bes_fiyat->first()->santiye_bes_fiyat}}" name="santiye_bes_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_bes_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_alti)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Altıncı Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_alti}}" name="santiye_alti">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Altıncı Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $alti_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($alti_fiyat->first()->santiye_alti_fiyat))
                                                                <input type="number" class="form-control" value="{{$alti_fiyat->first()->santiye_alti_fiyat}}" name="santiye_alti_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_alti_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_yedi)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Yedinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_yedi}}" name="santiye_yedi">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Yedinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $yedi_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($yedi_fiyat->first()->santiye_yedi_fiyat))
                                                                <input type="number" class="form-control" value="{{$yedi_fiyat->first()->santiye_yedi_fiyat}}" name="santiye_yedi_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_yedi_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_sekiz)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Sekizinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_sekiz}}" name="santiye_sekiz">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Sekizinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $sekiz_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($sekiz_fiyat->first()->santiye_sekiz_fiyat))
                                                                <input type="number" class="form-control" value="{{$sekiz_fiyat->first()->santiye_sekiz_fiyat}}" name="santiye_sekiz_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_sekiz_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_dokuz)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Dokuzuncu Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_dokuz}}" name="santiye_dokuz">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Dokuzuncu Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $dokuz_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($dokuz_fiyat->first()->santiye_dokuz_fiyat))
                                                                <input type="number" class="form-control" value="{{$dokuz_fiyat->first()->santiye_dokuz_fiyat}}" name="santiye_dokuz_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_dokuz_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_on)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onuncu Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_on}}" name="santiye_on">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onuncu Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $on_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($on_fiyat->first()->santiye_on_fiyat))
                                                                <input type="number" class="form-control" value="{{$on_fiyat->first()->santiye_on_fiyat}}" name="santiye_on_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_on_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_onbir)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onbirinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_onbir}}" name="santiye_onbir">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onbirinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $onbir_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($onbir_fiyat->first()->santiye_onbir_fiyat))
                                                                <input type="number" class="form-control" value="{{$onbir_fiyat->first()->santiye_onbir_fiyat}}" name="santiye_onbir_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_onbir_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_oniki)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onikinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_oniki}}" name="santiye_oniki">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onikinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $oniki_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($oniki_fiyat->first()->santiye_oniki_fiyat))
                                                                <input type="number" class="form-control" value="{{$oniki_fiyat->first()->santiye_oniki_fiyat}}" name="santiye_oniki_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_oniki_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_onuc)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onüçüncü Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_onuc}}" name="santiye_onuc">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onüçüncü Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $onuc_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($onuc_fiyat->first()->santiye_onuc_fiyat))
                                                                <input type="number" class="form-control" value="{{$onuc_fiyat->first()->santiye_onuc_fiyat}}" name="santiye_onuc_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_onuc_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_ondort)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Ondördüncü Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_ondort}}" name="santiye_ondort">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Ondördüncü Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $ondort_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($ondort_fiyat->first()->santiye_ondort_fiyat))
                                                                <input type="number" class="form-control" value="{{$ondort_fiyat->first()->santiye_ondort_fiyat}}" name="santiye_ondort_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_ondort_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_onbes)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onbeşinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_onbes}}" name="santiye_onbes">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onbeşinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $onbes_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($onbes_fiyat->first()->santiye_onbes_fiyat))
                                                                <input type="number" class="form-control" value="{{$onbes_fiyat->first()->santiye_onbes_fiyat}}" name="santiye_onbes_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_onbes_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_onalti)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onaltıncı Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_onalti}}" name="santiye_onalti">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onaltıncı Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $onalti_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($onalti_fiyat->first()->santiye_onalti_fiyat))
                                                                <input type="number" class="form-control" value="{{$onalti_fiyat->first()->santiye_onalti_fiyat}}" name="santiye_onalti_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_onalti_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                @if ($santiye->santiye_onyedi)
                                                <hr />
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label>Onyedinci Şantiye</label>
                                                            <input type="text" class="form-control" value="{{$santiye->santiye_onyedi}}" name="santiye_onyedi">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Onyedinci Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                            @php
                                                            $onyedi_fiyat = AktifSantiyeFiyat::where('aktif_santiye_id', $santiye->aktif_musteri_id)->get();
                                                            @endphp
                                                            @if (isset($onyedi_fiyat->first()->santiye_onyedi_fiyat))
                                                                <input type="number" class="form-control" value="{{$onyedi_fiyat->first()->santiye_onyedi_fiyat}}" name="santiye_onyedi_fiyat" min="0" >
                                                            @else
                                                                <input type="number" class="form-control" value="0" name="santiye_onyedi_fiyat" min="0" >
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            
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
                                                                    <input type="text" class="form-control" name="yeni_santiye">
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label>Şantiye Fiyatı (<small>+KDV</small>)</label>
                                                                    <input type="number" class="form-control" name="yeni_santiye_fiyat" min="0" >
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
                                                    <div class="form-group col-md-6">
                                                        <label>Vergi Dairesi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->vergi_dairesi}}" name="VD">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>V.N. / T.C.</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->vergi_numarasi}}" name="VNTCN">
                                                    </div>
                                                </div>
                                                <button class="btn btn-success" type="submit">Güncelle</button>
                                            </form>

                                            <h4 class="text-primary mt-4">İletişim Bilgileri Düzenle</h4>
                                            <form method="POST" action="{{route('iletisim.bilgileri.guncelle', $aktif_musteri->id)}}"> <!-- ILETISIM BILGILERI DUZENLE FORMU -->
                                                @csrf
                                                <h5 title="Genel Müdür, Mal sahibi, Mühendis vs.">Yetkili - 1</h5>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Ad Soyad</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_bir}}" name="birAdSoyad">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Telefon Numarası</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_bir_tel}}" name="birTel">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>E-Posta Adresi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_bir_mail}}" name="birMail">
                                                    </div>
                                                </div>

                                                @if ($aktif_musteri->yetkili_iki)
                                                <h5 title="Muhasebe, Şef, Kalfa vs.">Yetkili - 2</h5>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label>Ad Soyad</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_iki}}" name="ikiAdSoyad">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>Telefon Numarası</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_iki_tel}}" name="ikiTel">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>E-Posta Adresi</label>
                                                        <input type="text" class="form-control" value="{{$aktif_musteri->yetkili_iki_mail}}" name="ikiMail">
                                                    </div>
                                                </div>
                                                @endif

                                                <button class="btn btn-success" type="submit">Güncelle</button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#yetkiliEkle" title="Müşteriyi max 2 yetkili temsil edebilir.">Yeni Ekle</button>
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