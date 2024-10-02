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
                          <div class="step" id="step-1">
                            <span class="step-number">1</span>
                            <span class="step-description">Müşteri Türü</span>
                          </div>
                          <div class="step" id="step-2">
                            <span class="step-number">2</span>
                            <span class="step-description">Gönderim Şekli</span>
                          </div>
                          <div class="step" id="step-3">
                            <span class="step-number">3</span>
                            <span class="step-description">Önizleme</span>
                          </div>
                          <div class="step active" id="step-4">
                            <span class="step-number">4</span>
                            <span class="step-description">Onay</span>
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
                        const stepCounter = new StepCounter(4, stepDescriptions);
                        document.getElementById('next-step-button').addEventListener('click', () => {
                        stepCounter.nextStep();
                        });
                    </script>

                    <!-- STEP 4 START-->
                    <form action="xxxxxxxxx" method="post">
                        @csrf
                        <div class="row">
                            <h2 class="mb-4 ml-4">Bildirim Onay</h2>
                            <div class="table-container mb-5" style="width: 95%; margin: auto;">
                                <table class="table table-bordered table-hover" id="musteri-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">#</th>
                                            <th style="text-align: center; vertical-align: middle;">Müşteri Ünvanı</th>
                                            <th style="text-align: center; vertical-align: middle; min-width: 120px;">Özet Bilgi</th>
                                            <th style="text-align: center; vertical-align: middle;">Bildirim Yazısı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($musteriler as $musteri)
                                       @if ($musteri->musteri_unvani)
                                        <tr>
                                            <td>{{$musteri->id}}</td>
                                            <td>{{$musteri->musteri_unvani}}</td>
                                            <td style="text-align: center;">
                                                @if ($musteri->bildirim_sekli == 'eposta')
                                                    @php
                                                        $musteri_epostalari = FiyatGuncellemeBildirim::where('musteri_id', $musteri->musteri_id)->get(); //MODELLERDEN YAPILMA SEKLI VAR BU ISLEMIN
                                                    @endphp
                                                    <b>E-posta:</b> 
                                                    @foreach ($musteri_epostalari as $musteri_epostasi)
                                                    {{$musteri_epostasi->eposta}} <br />
                                                    @endforeach
                                                @elseif ($musteri->bildirim_sekli == 'wp')
                                                    @php
                                                    $musteri_telleri = FiyatGuncellemeBildirim::where('musteri_id', $musteri->musteri_id)->get(); //MODELLERDEN YAPILMA SEKLI VAR BU ISLEMIN
                                                    @endphp
                                                    <b>WhatsApp:</b> 
                                                    @foreach ($musteri_telleri as $musteri_teli)
                                                        @if (substr($musteri_teli->tel, 0, 2) == '05')
                                                        {{$musteri_teli->tel}} <br />
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td><a href="xxxx">ibrahim varelci - fiyat guncelleme.pdf</a></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="xxxxxxx" class="btn btn-primary mr-2 px-3">Geri</a>
                            <button class="btn btn-success px-4" type="submit">İşlemi Onayla</button>
                        </div>
                    </form>
                    <!-- STEP 4 END -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection