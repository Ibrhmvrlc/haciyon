@extends('layouts.main')

@section('content')
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4 class="mb-2">Aktif Müşteriler</h4>
                            <span class="ml-1 mt-2">Kayıtlı aktif döküm yapan müşterilerin listesi aşağıda belirtilmiştir. İlgili müşteri satırına tıklayarak ayrıntılara gidebilirsiniz.</span>
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
                                <h4 class="card-title">AKTİF MÜŞTERİLER</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>C30 Fiyatı</th>
                                                <th>Yetkili</th>
                                                <th>Telefon</th>
                                                <th>E-Posta</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($aktif_musteriler as $musteri)
                                            <tr>
                                                <td>{{$musteri->unvan}}</td>
                                                @if ($musteri->fiyat)
                                                <td title="C30 fiyatı">{{$musteri->fiyat}}<small> +KDV</small></td>
                                                @else
                                                <td>Belirtilmemiş</td>
                                                @endif
                                                <td>{{$musteri->yetkili_bir}}</td>
                                                <td>{{$musteri->tel}}</td>
                                                <td>{{$musteri->mail}}</td>
                                                <td>
                                                    <a href="{{route('aktif.musteri.profil', $musteri->id)}}">
                                                        <span class="ti-more-alt"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Müşteri Ünvanı</th>
                                                <th>C30 Fiyatı</th>
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