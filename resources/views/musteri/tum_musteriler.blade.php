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
                                <h4 class="card-title">TÜM MÜŞTERİLER (DÜZENSİZ VERİ)</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>Yetkili</th>
                                                <th>Telefon</th>
                                                <th>E-Posta</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($musteriler as $musteri)
                                            <tr>
                                                <td>{{$musteri->unvani}}</td>

                                                @if ($musteri->yetkili_bir)
                                                    <td>{{$musteri->yetkili_bir}}</td>
                                                    <td>{{$musteri->yetkili_bir_tel}}</td>
                                                    <td>{{$musteri->yetkili_bir_email}}</td>
                                                @elseif ($musteri->yetkili_iki)
                                                    <td>{{$musteri->yetkili_iki}}</td>
                                                    <td>{{$musteri->yetkili_iki_tel}}</td>
                                                    <td>{{$musteri->yetkili_iki_email}}</td>
                                                @elseif ($musteri->yetkili_uc)
                                                    <td>{{$musteri->yetkili_uc}}</td>
                                                    <td>{{$musteri->yetkili_uc_tel}}</td>
                                                    <td>{{$musteri->yetkili_uc_email}}</td>
                                                @else
                                                    <td>BELİRTİLMEMİŞ</td>
                                                    <td>{{$musteri->tel_ana}}</td>
                                                    <td>{{$musteri->mail_ana}}</td>
                                                @endif
                                                <td>
                                                    <a href="{{route('musteri.profil', $musteri->id)}}">
                                                        <span class="ti-more-alt"></span>
                                                    </a>
                                                </td>
                                            </tr>

                                            @endforeach

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>Yetkili</th>
                                                <th>Telefon</th>
                                                <th>E-Posta</th>
                                                <th></th>
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