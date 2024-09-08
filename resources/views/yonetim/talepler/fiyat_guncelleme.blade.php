@extends('layouts.main')

@section('content')
@php
    use App\Models\User;
    use Carbon\Carbon;
@endphp
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-1">Fiyat Güncelleme Talepleri</h4>
                <span><b>Dikkat!</b> Lütfen izinleri zorunluluklar dışında sadece fiyat değiştirmeye ve güncellemeye yetkili birimlere veriniz. </span>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="xxxxxxx">xxxxxxxx</a></li>
                <li class="breadcrumb-item active"><a href="xxxxxx">xxxxxxxx</a></li>
            </ol>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered verticle-middle table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tarih</th>
                            <th scope="col">Ad Soyad</th>
                            <th scope="col">Görevi</th>
                            <th scope="col">Talep Edilen Süre</th>
                            <th scope="col">Durum</th>
                            <th scope="col">Onay/Red</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($veriler as $veri)
                            <tr>
                                <td>{{ $veri->id }}</td>
                                <td>{{ Carbon::parse($veri->created_at)->format('d/m/Y H:i'); }}</td>
                                <td>
                                    @php
                                        $isim = User::findOrFail($veri->user_id);
                                    @endphp
                                    {{ $isim->name }}
                                </td>
                                <td>{{ $isim->role }}</td>
                                <td>
                                    @php
                                        $sure = Carbon::createFromFormat('Y-m-d H:i:s', $veri->expires_at);
                                    @endphp
                                    {{ $sure->format('d/m/Y H:i'); }}
                                </td>
                                <td>
                                    @if ($veri->status == 'bekliyor')
                                        Bekliyor
                                    @elseif ($veri->status == 'onaylandi')
                                        Onaylandı
                                    @elseif ($veri->status == 'reddedildi')
                                        Reddedildi
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if ($veri->status == 'bekliyor')
                                    <span>
                                        <a href="{{route('fgt.onay', $veri->id)}}" class="mr-4" data-toggle="tooltip"
                                        data-placement="top" title="Onay Ver"><i
                                            class="fa fa-check color-muted"></i> </a><a
                                        href="{{route('fgt.red', $veri->id)}}" data-toggle="tooltip"
                                        data-placement="top" title="Reddet"><i
                                            class="fa fa-close color-danger"></i></a>
                                    </span>
                                    @elseif ($veri->status == 'onaylandi')
                                        @if ($veri->expires_at  < Carbon::now())
                                        <i class="fa fa-clock-o text-dark" title="Süresi Geçmiş"></i>
                                        @else
                                        <i class="fa fa-check text-success" title="Onaylandı"></i>
                                        @endif
                                    @elseif ($veri->status == 'reddedildi')
                                    <i class="fa fa-close  text-danger" title="Reddedildi"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $veriler->links('pagination::bootstrap-4') }}

          
        </div>
    </div>
    

</div>
@endsection