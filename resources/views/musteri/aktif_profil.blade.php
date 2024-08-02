@extends('layouts.main')

@section('content')
@php use Carbon\Carbon; @endphp
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
                                <li class="nav-item"><a href="#faturabilgi" data-toggle="tab" class="nav-link">Fatura Bilgileri</a>
                                </li>
                                <li class="nav-item"><a href="#fiyat" data-toggle="tab" class="nav-link">Fiyat</a>
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
                                        <div class="text-center mb-2">
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
                                        <div class="text-right mb-2">
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
                                    <div class="text-center mb-2">
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

                                <div id="faturabilgi" class="tab-pane fade">
                                    <div class="profile-personal-info mt-4">
                                        <h4 class="text-primary mb-4">Fatura Bilgileri</h4>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Ünvan <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$aktif_musteri->unvan}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Adresi <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            <div class="col-9"><span>{{$aktif_musteri->fatura_adresi}} {{$aktif_musteri->sokak}} {{$aktif_musteri->semt}} {{$aktif_musteri->kent}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">VD / VN <span class="pull-right">:</span></h5>
                                            </div>
                                            <div class="col-9"><span>{{$aktif_musteri->vergi_dairesi}} / {{$aktif_musteri->vergi_numarasi}}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">E-posta <span class="pull-right">:</span>
                                                </h5>
                                            </div>
                                            @if ($aktif_musteri->mail)
                                            <div class="col-9"><span>{{$aktif_musteri->mail}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_bir_email)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_bir_email}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_iki_email)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_iki_email}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_uc_email)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_uc_email}}</span></div>
                                            @else
                                            <div class="col-9"><span>Mail adresi bulunamadı.</span></div>
                                            @endif
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-3">
                                                <h5 class="f-w-500">Telefon <span class="pull-right">:</span></h5>
                                            </div>
                                            @if ($aktif_musteri->tel)
                                            <div class="col-9"><span>{{$aktif_musteri->tel}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_bir_tel)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_bir_tel}} {{$aktif_musteri->yetkili_bir}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_iki_tel)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_iki_tel}} {{$aktif_musteri->yetkili_iki}}</span></div>
                                            @elseif ($aktif_musteri->yetkili_uc_tel)
                                            <div class="col-9"><span>{{$aktif_musteri->yetkili_uc_tel}} {{$aktif_musteri->yetkili_uc}}</span></div>
                                            @else
                                            <div class="col-9"><span>Telefon numarası bulunamadı.</span></div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                              
                                <div id="fiyat" class="tab-pane fade">
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
                                            <h4 class="text-primary">Account Setting</h4>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input type="email" placeholder="Email" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Password</label>
                                                        <input type="password" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" placeholder="1234 Main St" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address 2</label>
                                                    <input type="text" placeholder="Apartment, studio, or floor" class="form-control">
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label>City</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>State</label>
                                                        <select class="form-control" id="inputState">
                                                            <option selected="">Choose...</option>
                                                            <option>Option 1</option>
                                                            <option>Option 2</option>
                                                            <option>Option 3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>Zip</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="gridCheck">
                                                        <label for="gridCheck" class="form-check-label">Check me out</label>
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Sign
                                                    in</button>
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
@endsection