@extends('layouts.main')

@section('content')
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="mb-2">Tüm Müşteriler</h4>
                            <span class="ml-1 mt-2">Kayıtlı Bütün müşterilerin listesi aşağıda belirtilmiştir. İlgili müşteri satırına tıklayarak ayrıntılara gidebilirsiniz.</span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Müşteri Yönetimi</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Tüm Müşteriler</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic Datatable</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>Telefon</th>
                                                <th>E-Posta</th>
                                                <th>En Aktif Şantiye</th>
                                                <th>Fiyatı</th>
                                                <th>Pompa Bedeli</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <tr>
                                                <td>Mustafa Çimen / Şükür Ticaret</td>
                                                <td>0555 555 55 55</td>
                                                <td>mustafa@cimen.com.tr</td>
                                                <td>Karamürsel</td>
                                                <td>2450</td>
                                                <td>4000</td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>Telefon</th>
                                                <th>E-Posta</th>
                                                <th>En Aktif Şantiye</th>
                                                <th>Fiyatı</th>
                                                <th>Pompa Bedeli</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection