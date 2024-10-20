@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
    use App\Models\AktifMusteriYetkililer;
    use App\Models\AktifMusteriler;
    use App\Models\FiyatGuncellemeBildirim;
@endphp
<div class="container-fluid">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-1">Fiyat Güncelleme Modülü</h4>
                <span>
                    <b>Dikkat!</b> yapılan değişiklikler kalıcıdır. Sistemdeki tüm fiyat bilgileri değişir.
                </span>
                <br />
                <span>
                    Talebinizin bitimine <b><span id="countdown"></span></b> kaldı.
                </span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="xxxxxxxxxxxxx">Müşteri Fiyat Listesi</a></li>
                <li class="breadcrumb-item active">Bildirim Ayarları</li>
            </ol>
        </div>

        @php
        $permission = PermissionRequest::where('user_id', auth()->user()->id)->where('status', 'onaylandi')->get();
        @endphp
        <script>
            // PHP'den alınan tarihleri JavaScript'e geçir
            var endDate = new Date("{{ $permission->first()->expires_at }}").getTime();
            
            // Geri sayım işlevi
            var countdown = setInterval(function() {
                var now = new Date().getTime(); // Şu anki zaman
                var distance = endDate - now; // Hedef tarihe kalan zaman

                // Gün, saat, dakika, saniye hesaplama
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Geri sayımı HTML'e yazdırma
                document.getElementById("countdown").innerHTML = days + "g " + hours + "s " 
                + minutes + "dk " + seconds + "sn ";

                // Geri sayım bittiğinde mesaj göster
                if (distance < 0) {
                    clearInterval(countdown);
                    document.getElementById("countdown").innerHTML = "Süre doldu!";
                }
            }, 1000);
        </script>

        <div class="col-sm-12 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="xxxxxxxxxxxx" class="btn btn-primary">Listeye Dön</a>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="step-counter">
                        <div class="step-counter-steps">
                            <div class="step" id="step-1"><!-- bildirim_musteri_turu.blade.php -->
                              <span class="step-number">1</span>
                              <span class="step-description">Müşteri Türü</span>
                            </div>
                            <div class="step" id="step-2"><!-- bildirim_gonderim.sekli.blade.php -->
                              <span class="step-number">2</span>
                              <span class="step-description">Genel Tercihler</span>
                            </div>
                            <div class="step" id="step-3">
                              <span class="step-number">3</span><!-- bildirim_onizleme.blade.php -->
                              <span class="step-description">Gönderim Tercihleri</span>
                            </div>
                            <div class="step active" id="step-4"><!-- YENİ OLACAK -->
                              <span class="step-number">4</span>
                              <span class="step-description">Yazı İçeriği</span>
                            </div>
                            <div class="step" id="step-5"><!-- bildirim_onay.blade.php -->
                              <span class="step-number">5</span>
                              <span class="step-description">Önizleme & Onay</span>
                            </div>
                        </div>
                        <div class="step-counter-progress">
                          <div class="step-counter-progress-bar" id="step-counter-progress-bar"></div>
                        </div>
                    </div>
                    <script>
                     class StepCounter {
                        constructor(totalSteps, stepDescriptions) {
                            this.totalSteps = totalSteps;
                            this.currentStep = parseInt(localStorage.getItem('currentStep')) || 4;
                            this.stepDescriptions = stepDescriptions;
                            this.progressbar = document.getElementById('step-counter-progress-bar');
                            this.updateStepCounter();
                        }

                        updateStepCounter() {
                            this.progressbar.style.width = (this.currentStep / this.totalSteps) * 100 + '%';
                            this.steps.forEach((step, index) => {
                                if (index < this.currentStep - 1) {
                                    step.classList.add('inactive');
                                } else if (index === this.currentStep - 1) {
                                    step.classList.add('active');
                                } else {
                                    step.classList.remove('active', 'inactive');
                                }
                            });
                        }

                        nextStep() {
                            if (this.currentStep < this.totalSteps) {
                            this.currentStep++;
                            localStorage.setItem('currentStep', this.currentStep);
                            window.location.href = `xxxxxxx`; // Redirect to the next page
                            } else {
                            console.log('You have completed all steps!');
                            }
                        }
                        }

                        // Example usage:
                        const stepDescriptions = [
                            'Enter your name',
                            'Enter your email',
                            'Enter your password',
                            'Confirm your password'
                        ];
                        const stepCounter = new StepCounter(5, stepDescriptions);
                        document.getElementById('next-step-button').addEventListener('click', () => {
                        stepCounter.nextStep();
                        });
                    </script>

                    <!-- STEP 3 START-->
                    <form action="{{route('bildirim.yazi.icerigi.form')}}" method="post">
                        @csrf
                        <div class="row">
                            <h2 class="mb-4 ml-4">Bildirim Bilgileri Önizlemesi</h2>
                            <div class="table-container mb-5 table-responsive" style="">
                                <table class="table table-bordered table-hover" id="musteri-table">
                                    <thead class="thead-dark">
                                        @php
                                        $bildirim_sekli = session('bildirim_sekli');    
                                        @endphp
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">#</th>
                                            <th style="text-align: center; vertical-align: middle;">Müşteri Ünvanı</th>
                                            <th style="text-align: center; vertical-align: middle;">Müşteri Türü</th>
                                            <th style="text-align: center; vertical-align: middle;">En Üst Sınıf</th>
                                            <th style="text-align: center; vertical-align: middle;">Güncelleme Tarihi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($musteriler as $musteri)
                                        @if ($musteri->musteri_unvani)
                                        <tr>
                                            <td style="text-align: center;">{{$musteri->id}}</td>
                                            <td>{{$musteri->musteri_unvani}}</td>
                                            <td style="text-align: center; vertical-align: middle;">{{$musteri->tur}}</td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <select class="default-placeholder" name="sinir_bs[]" required>
                                                    <option value="">Seçiniz</option>
                                                    @foreach ($urunler as $urun)
                                                        @if ($musteri->tur == 'PARÇA BETON')
                                                        <option value="{{$urun->id}}" @if($urun->id == 5) selected @endif >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'PİYASA')
                                                        <option value="{{$urun->id}}" @if($urun->id == 6) selected @endif >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'TERSANELER')
                                                        <option value="{{$urun->id}}" @if($urun->id == 8) selected @endif >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'OSB')
                                                        <option value="{{$urun->id}}" @if($urun->id == 7) selected @endif >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'ÖZEL DÖKÜMLER')
                                                        <option value="{{$urun->id}}" >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'DİĞER')
                                                        <option value="{{$urun->id}}" >{{$urun->adi}}</option>
                                                        @endif
                                                        @if ($musteri->tur == 'BOŞ')
                                                        <option value="{{$urun->id}}" >{{$urun->adi}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="sinirBSBildirimId[]" value="{{$musteri->musteri_id}}">
                                            </td>
                                            <td style="text-align: center;">
                                                @php
                                                $tarih_var_mi = FiyatGuncellemeBildirim::where('bildirim_olacak_mi', true)->where('musteri_id', $musteri->musteri_id)->get();
                                                if($tarih_var_mi){
                                                    $bildirim_tarihi = $tarih_var_mi->first()->tarih;
                                                }else{
                                                    $bildirim_tarihi = session('bildirim_tarihi');  
                                                }
                                                @endphp
                                                <input type="date" class="table-date-input" name="bildirimTarih[]" id="bildirimTarih" value="{{$bildirim_tarihi}}">
                                                <input type="hidden" name="bildirimId[]" value="{{$musteri->musteri_id}}">
                                            </td>
                                           
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                        
                            </div>
                           
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary px-4" onclick="window.history.back()" type="button">Geri</button>
                            <button class="btn btn-primary px-4" type="submit">İleri</button>
                        </div>
                    </form>
                    <!-- STEP 3 END -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection