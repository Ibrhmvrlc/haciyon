@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
@endphp
<div class="container-fluid">
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


        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="xxxxxxxxxxxxx">Müşteri Fiyat Listesi</a></li>
                <li class="breadcrumb-item active">Bildirim Ayarları</li>
            </ol>
        </div>
        <div class="col-sm-12 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <a href="xxxxxxxxxxxx" class="btn btn-primary">Listeye Dön</a>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h3>Bildirim Ayarları</h3>
                </div>
                <div class="card-body">
                    <div class="step-counter">
                        <div class="step-counter-steps">
                          <div class="step active" id="step-1">
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
                          <div class="step" id="step-4">
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
                            this.currentStep = parseInt(localStorage.getItem('currentStep')) || 1;
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

                    <!-- STEP 1 START-->
                    <form action="{{route('bildirim.musteri.turu.form')}}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="form-group">
                                    <div class="mb-3">
                                    <h5>Bildirim yapılacak müşteri türlerini seçiniz: </h5>
                                    </div>
                                    <div class="form-group">
                                        <p>
                                            Lütfen Fiyat güncelleme bildirimi yapılacak müşteri çeşitlerini seçiniz. Eğer İlgili müşteri çeşidi arasında bildirim yapılmayacak müşteriler varsa,
                                            istisna olarak bu müşterileri seçip bildirim listesinin dışında tutabilirsiniz.
                                        </p>
                                    </div>
                                    @foreach ($turler as $tur)
                                    <div class="form-check mb-2">
                                        <input type="checkbox" class="tur" id="tur{{$tur->id}}" name="checkboxes[]" value="{{$tur->name}}" checked>
                                        <label class="form-check-label" for="tur{{$tur->id}}">{{$tur->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="form-group">
                                    <div class="mb-3">
                                        <h5>Bildirim yapılmayacak istisna müşterileri seçiniz: </h5>
                                    </div>
                                    <select class="match-grouped-options" multiple="multiple" id="mySelect">
                                        @foreach ($turler as $tur)
                                        <optgroup label="{{$tur->name}}">
                                            @foreach ($musteriler as $musteri)
                                            @if ($musteri->turs == $tur->name)
                                            <option>{{$musteri->unvan}}</option>
                                            @endif
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary mr-2 px-3" type="button" disabled>Geri</button>
                            <button class="btn btn-primary px-4" type="submit">İleri</button>
                        </div>
                    </form>
                    <!-- STEP 1 END -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection