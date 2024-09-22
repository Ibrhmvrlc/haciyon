@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>Fiyat Güncelleme Bildirim Listesi</h4>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, corporis? </p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Components</a></li>
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
                <div class="card-body">
                    <div class="step-counter">
                        <div class="step-counter-steps">
                          <div class="step" id="step-1">
                            <span class="step-number">1</span>
                            <span class="step-description">Müşteri Türü</span>
                          </div>
                          <div class="step active" id="step-2">
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
                            this.currentStep = parseInt(localStorage.getItem('currentStep')) || 2;
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

                    <!-- STEP 2 START-->
                    <form action="xxxxxxx" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="form-check mb-2">
                                    <input type="radio" class="form-check-input" id="bildirimEposta" name="bildirimSekli" checked>
                                    <label class="form-check-label" for="bildirimEposta"><b>E-posta Gönder:</b></label>
                                    <p>
                                        Bu seçenekte ile zam bildirimleri müşterilere kayıtlı E-posta adreslerinden gönderilir. 
                                        'Önizleme' adımında E-posta adresi olmayan müşterileri görebilir, başka yöntem ile bildirim yapılacak istisnaları seçebilirsiniz.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="form-check mb-2">
                                    <input type="radio" class="form-check-input" id="bildirimWhatsapp" name="bildirimSekli" >
                                    <label class="form-check-label" for="bildirimWhatsapp"><b>WhatsApp ile Gönder:</b></label>
                                    <p>
                                        Bu seçenekte ile zam bildirimleri müşterilere kayıtlı Telefon numaraları üzerinden WhatsApp uygulaması ile gönderilir. 
                                        'Önizleme' adımında telefon numarası olmayan müşterileri görebilir, başka yöntem ile bildirim yapılacak istisnaları seçebilirsiniz.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="form-check mb-2">
                                    <input type="radio" class="form-check-input" id="bildirimIndir" name="bildirimSekli" >
                                    <label class="form-check-label" for="bildirimIndir"><b>Yalnızca indir:</b></label>
                                    <p>
                                        Fiyat güncelleme yazılarını gönderme işlemi yapmadan yalnızca indirir.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- STEP 2 END -->
















                    <form action="#" id="step-form-horizontal" class="step-form-horizontal">                
                        <div>
                            <h4>Müşteri Türü</h4>
                            <section>
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
                                             <select class="match-grouped-options" multiple="multiple">
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
                            </section>
                            <h4>Gönderim Türü</h4>
                            <section>
                                <div class="row">
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-check mb-2">
                                            <input type="radio" class="form-check-input" id="bildirimEposta" name="bildirimSekli" checked>
                                            <label class="form-check-label" for="bildirimEposta"><b>E-posta Gönder:</b></label>
                                            <p>
                                                Bu seçenekte ile zam bildirimleri müşterilere kayıtlı E-posta adreslerinden gönderilir. 
                                                'Önizleme' adımında E-posta adresi olmayan müşterileri görebilir, başka yöntem ile bildirim yapılacak istisnaları seçebilirsiniz.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-check mb-2">
                                            <input type="radio" class="form-check-input" id="bildirimWhatsapp" name="bildirimSekli" >
                                            <label class="form-check-label" for="bildirimWhatsapp"><b>WhatsApp ile Gönder:</b></label>
                                            <p>
                                                Bu seçenekte ile zam bildirimleri müşterilere kayıtlı Telefon numaraları üzerinden WhatsApp uygulaması ile gönderilir. 
                                                'Önizleme' adımında telefon numarası olmayan müşterileri görebilir, başka yöntem ile bildirim yapılacak istisnaları seçebilirsiniz.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="form-check mb-2">
                                            <input type="radio" class="form-check-input" id="bildirimIndir" name="bildirimSekli" >
                                            <label class="form-check-label" for="bildirimIndir"><b>Yalnızca indir:</b></label>
                                            <p>
                                                Fiyat güncelleme yazılarını gönderme işlemi yapmadan yalnızca indirir.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <h4>Önizleme</h4>
                            <section>
                                <div class="row">
                                    <h2 class="mb-4">Bildirim Bilgileri Önizlemesi</h2>
                                    <div class="table-container mb-5" style="width: 100%;">
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
                                    </div>

                                    <!-- DataTable icin CDN -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                                    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
                                    
                                    <button id="getSelected" class="btn btn-primary" type="button">Get Selected Rows</button>
                                    <p id="result" class="mt-4"></p>

                                    <script>
                                        $(document).ready(function() {
                                            if ($.fn.DataTable.isDataTable('#musteri-table')) {
                                                $('#musteri-table').DataTable().destroy();
                                            }
                                            $('#musteri-table').DataTable({
                                                "paging": true,
                                                "pageLength": 50,
                                                "searching": true
                                            });
                                        });

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
                            </section>
                            <h4>Onay</h4>
                            <section>
                                <div class="row emial-setup">
                                    <div class="col-sm-3 col-6">
                                        <div class="form-group">
                                            <label for="mailclient11" class="mailclinet mailclinet-gmail">
                                                <input type="radio" name="emailclient" id="mailclient11">
                                                <span class="mail-icon">
                                                    <i class="mdi mdi-google-plus" aria-hidden="true"></i>
                                                </span>
                                                <span class="mail-text">I'm using Gmail</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <div class="form-group">
                                            <label for="mailclient12" class="mailclinet mailclinet-office">
                                                <input type="radio" name="emailclient" id="mailclient12">
                                                <span class="mail-icon">
                                                    <i class="mdi mdi-office" aria-hidden="true"></i>
                                                </span>
                                                <span class="mail-text">I'm using Office</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <div class="form-group">
                                            <label for="mailclient13" class="mailclinet mailclinet-drive">
                                                <input type="radio" name="emailclient" id="mailclient13">
                                                <span class="mail-icon">
                                                    <i class="mdi mdi-google-drive" aria-hidden="true"></i>
                                                </span>
                                                <span class="mail-text">I'm using Drive</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-6">
                                        <div class="form-group">
                                            <label for="mailclient14" class="mailclinet mailclinet-another">
                                                <input type="radio" name="emailclient" id="mailclient14">
                                                <span class="mail-icon">
                                                    <i class="fa fa-question-circle-o"
                                                        aria-hidden="true"></i>
                                                </span>
                                                <span class="mail-text">Another Service</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="skip-email text-center">
                                            <p>Or if want skip this step entirely and setup it later</p>
                                            <a href="javascript:void()">Skip step</a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection