@extends('layouts.main')

@section('content')
@php
    use App\Models\PermissionRequest;
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
                    <form action="xxxxxxx" method="post">
                        @csrf
                        <div class="row">
                            <h2 class="mb-4 ml-4">Bildirim Bilgileri Önizlemesi</h2>
                            <div class="table-container mb-5" style="width: 95%; margin: auto;">
                                <table class="table table-bordered table-hover" id="musteri-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Onay</th>
                                            <th>Müşteri Ünvanı</th>
                                            <th>e-Posta Adresleri</th>
                                            <th>Telefon Numarası</th>
                                            <th>Fiyat Güncelleme Yazısı</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($musteriler as $musteri)
                                        <tr>
                                            <td><input type="checkbox" class="row-select"></td>
                                            <td>{{$musteri->unvan}}</td>
                                            <td>
                                                <select class="match-grouped-options" multiple="multiple" required>
                                                    <optgroup label="">
                                                        <option value="dee@john.co" selected>{{$musteri->mail}}</option>
                                                    </optgroup>
                                                </select>
                                            </td>
                                            <td>{{$musteri->tel}}</td>
                                            <td><a href="">yazi.pdf</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button id="getSelected" class="btn btn-primary" type="button">Get Selected Rows</button>
                                <p id="result" class="mt-4"></p>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                            
                            <script>
                                $(document).ready(function () {
                                    // Checkbox'ların durum değişikliğini dinle
                                    $('input[class="tur"]').change(function () {
                                        let selectedTurs = [];

                                        // Seçili checkboxları topla
                                        $('input[class="tur"]:checked').each(function() {
                                            selectedTurs.push($(this).val());
                                        });

                                        // Eğer hiçbir checkbox seçili değilse uyarı ver
                                        if (selectedTurs.length === 0) {
                                            alert('Lütfen en az bir müşteri türü seçin.');
                                            return;
                                        }

                                        // Ajax isteği gönder
                                        $.ajax({
                                            url: '/musteri/filtrele',
                                            type: 'get',
                                            data: {
                                                checkboxes: selectedTurs,
                                                _token: '{{ csrf_token() }}'  // CSRF token eklenmeli
                                            },
                                            success: function(response) {
                                                if (response.length === 0) {
                                                    $('#musteri-table').html('<tr><td colspan="5">Veri bulunamadı</td></tr>');
                                                } else {
                                                    let rows = '';
                                                    response.forEach(function(musteri) {
                                                        rows += '<tr>'
                                                            + '<td><input type="checkbox" class="row-select"></td>'
                                                            + '<td>' + musteri.unvan + '</td>'
                                                            + '<td><select class="match-grouped-options" multiple="multiple" required>'
                                                            + '<optgroup label=""><option value="' + musteri.mail + '" selected>' + musteri.mail + '</option></optgroup>'
                                                            + '</select></td>'
                                                            + '<td>' + musteri.tel + '</td>'
                                                            + '<td><a href="">yazi.pdf</a></td>'
                                                            + '</tr>';
                                                    });
                                                    $('#musteri-table').html(rows);
                                                }
                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                console.error('Hata: ', textStatus, errorThrown);
                                                alert('Veriler yüklenirken bir hata oluştu.');
                                            }
                                        });
                                    });
                                });


                                // Seçili satırları al
                                document.getElementById('getSelected').addEventListener('click', function() {
                                    let selectedRows = [];
                                    let checkboxes = document.querySelectorAll('.row-select:checked');
                                    
                                    checkboxes.forEach(function(checkbox) {
                                        let row = checkbox.closest('tr');
                                        let unvan = row.cells[1].innerText;
                                        let tel = row.cells[3].innerText;
                                        
                                        // Select elementinden birden fazla seçimi al
                                        let optionsSelect = row.querySelector('.match-grouped-options');
                                        let selectedOptions = Array.from(optionsSelect.selectedOptions).map(option => option.value);
                                        
                                        selectedRows.push({
                                            unvan: unvan,
                                            selectedOptions: selectedOptions,
                                            tel: tel,
                                        });
                                    });
                                    
                                    // Seçili satırları ekrana yazdır
                                    let result = document.getElementById('result');
                                    if (selectedRows.length > 0) {
                                        result.innerHTML = `<strong>Selected Rows:</strong> ${JSON.stringify(selectedRows)}`;
                                    } else {
                                        result.innerHTML = "<strong>No rows selected</strong>";
                                    }
                                });
                            </script>
                        
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