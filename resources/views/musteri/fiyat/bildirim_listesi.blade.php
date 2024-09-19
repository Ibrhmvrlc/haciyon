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
                                                @if ($tur->name != 'BOŞ')
                                                <input type="checkbox" class="form-check-input" id="{{$tur->id}}tur" name="tur{{$tur->id}}" checked>
                                                <label class="form-check-label" for="{{$tur->id}}tur">{{$tur->name}}</label>
                                                @endif
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
                                                    @if ($musteri->tur == $tur->name)
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
                                    <table class="table table-bordered table-hover">
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
                                            <tr>
                                                <td><input type="checkbox" class="row-select"></td>
                                                <td>John Doe</td>
                                                <td>
                                                    <select class="match-grouped-options" multiple="multiple" required>
                                                        <optgroup label="">
                                                            <option value="dee@john.co" selected>dee@john.co</option>
                                                            <option value="john@dee.co">john@dee.co</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td>0555 555 55 55</td>
                                                <td><a href="">yazi.pdf</a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="row-select"></td>
                                                <td>John Doe</td>
                                                <td>
                                                    <select class="match-grouped-options" multiple="multiple" required>
                                                        <optgroup label="">
                                                            <option value="dee@john.co" selected>asd@john.co</option>
                                                            <option value="john@dee.co">dsqa@dee.co</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td>0555 555 55 55</td>
                                                <td><a href="">yazi.pdf</a></td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" class="row-select"></td>
                                                <td>John Doe</td>
                                                <td>
                                                    <select class="match-grouped-options" multiple="multiple" required>
                                                        <optgroup label="">
                                                            <option value="dee@john.co" selected>zxc@john.co</option>
                                                            <option value="john@dee.co">johrtyn@dee.co</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                                <td>0555 555 55 55</td>
                                                <td><a href="">yazi.pdf</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button id="getSelected" type="button" class="btn btn-primary">Get Selected Rows</button>
                                    <p id="result" class="mt-4"></p>
                                    <script>
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