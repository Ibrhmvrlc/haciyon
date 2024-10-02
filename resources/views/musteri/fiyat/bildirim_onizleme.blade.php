@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
    use App\Models\AktifMusteriYetkililer;
    use App\Models\AktifMusteriler;
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
                          <div class="step active" id="step-3">
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
                            this.currentStep = parseInt(localStorage.getItem('currentStep')) || 3;
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

                    <!-- STEP 3 START-->
                    <form action="{{route('bildirim.onizleme.form')}}" method="post">
                        @csrf
                        <div class="row">
                            <h2 class="mb-4 ml-4">Bildirim Bilgileri Önizlemesi</h2>
                            <div class="table-container mb-5" style="width: 95%; margin: auto;">
                                <table class="table table-bordered table-hover" id="musteri-table">
                                    <thead class="thead-dark">
                                        @php
                                        $bildirim_sekli = session('bildirim_sekli');    
                                        @endphp
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">Onay</th>
                                            <th style="text-align: center; vertical-align: middle;">Müşteri Ünvanı</th>
                                            <th style="text-align: center; vertical-align: middle; min-width: 120px;">
                                                Gönderim Bilgisi
                                                @if ($bildirim_sekli == 'wp')
                                                    <br />
                                                    <small>('05...' ile başlamayan kayıtlar listelenmemektedir.)</small>
                                                @endif
                                            </th>
                                            <th style="text-align: center; vertical-align: middle;">Gönderim Şekli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($musteriler as $musteri)
                                        <tr>
                                            <td style="text-align: center;"><input type="checkbox" class="row-select" checked></td>
                                            <td>{{$musteri->musteri_unvani}}</td>
                                            @php
                                                $epostalar_yet = AktifMusteriYetkililer::where('aktif_musteri_id', $musteri->musteri_id)->get();
                                                $epostalar_must = AktifMusteriler::where('id', $musteri->musteri_id)->get();
                                                $teller_yet = AktifMusteriYetkililer::where('aktif_musteri_id', $musteri->musteri_id)->get();
                                                $teller_must = AktifMusteriler::where('id', $musteri->musteri_id)->get();
                                            @endphp
                                            @php
                                            $bildirim_sekli = session('bildirim_sekli');    
                                            @endphp
                                            @if ($bildirim_sekli == 'eposta')
                                            <td style="max-width: 20rem;">
                                                <select class="match-grouped-options" multiple="multiple" name="epostalar[]" required>
                                                    @foreach ($epostalar_must as $eposta)
                                                        @if (!empty($eposta->mail))
                                                        <option value="{{$eposta->id}}_{{$eposta->mail}}" selected>{{$eposta->mail}}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($epostalar_yet as $eposta)
                                                        @if (!empty($eposta->mail))
                                                        <option value="{{$eposta->aktif_musteri_id}}_{{$eposta->mail}}">{{$eposta->mail}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>                
                                            @elseif ($bildirim_sekli == 'wp')
                                            <td style="text-align: center;">
                                                <select class="match-grouped-options" multiple="multiple" name="teller[]" required>
                                                    @foreach ($teller_yet as $tel)
                                                        @if (!empty($tel->tel) && substr($tel->tel, 0, 2) == '05')
                                                        <option value="{{$tel->aktif_musteri_id}}_{{$tel->tel}}" selected>{{$tel->tel}} - {{$tel->adi_soyadi}}</option>
                                                        @endif
                                                    @endforeach
                                                    @foreach ($teller_must as $tel)
                                                        @if (!empty($tel->tel) && substr($tel->tel, 0, 2) == '05')
                                                        <option value="{{$tel->id}}_{{$tel->tel}}">{{$tel->tel}} - {{$tel->adi_soyadi}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            @elseif ($bildirim_sekli == 'indir')
                                            <td style="text-align: center;">Dosyalarınıza indirilecektir.</td>
                                            @endif

                                            <td style="text-align: center; vertical-align: middle;">
                                                <select class="default-placeholder" name="gonderim_sekli">
                                                    <option value="eposta" value="eposta" @if ($musteri->bildirim_sekli == 'eposta') selected @endif >E-posta</option>
                                                    <option value="wp" value="wp" @if ($musteri->bildirim_sekli == 'wp') selected @endif>WhatsApp</option>
                                                    <option value="indir" value="indir" @if ($musteri->bildirim_sekli == 'indir') selected @endif>İndir</option>
                                                </select>
                                                <style>
                                                    .select2-search {
                                                        display: none !important;
                                                    }
                                                </style>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="xxxxxxx" class="btn btn-primary mr-2 px-3">Geri</a>
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