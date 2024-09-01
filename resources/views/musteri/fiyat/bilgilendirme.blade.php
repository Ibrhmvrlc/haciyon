@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header d-block">
                <h1 class="text-primary">Fiyat Güncelleme Modülü</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <form action="{{ route('confirmRead') }}" method="POST">
                            @csrf
                            <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                                <div class="media">
                                    <div class="alert-left-icon-big">
                                        <span><i class="mdi mdi-help-circle-outline"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <h5 class="mt-1 mb-1">Lütfen Okuyunuz!</h5>
                                                <p class="mb-2">
                                                    Bu modül tüm fiyatların değiştirilebilmesini sağlar bu yüzden yetkili harici girişe izin verilmez. 
                                                    Okuyup onaylıyorsanız ve giriş talebi göndermek istiyorsanız lütfen kutucuğu işaretleyiniz.
                                                </p>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" name="read_confirm" id="readConfirm" required> 
                                                <label class="form-check-label" for="readConfirm">
                                                    Okudum, anladım
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="subject" id="subject" value="fiyat_guncelleme">
                                                <button class="btn btn-danger mt-4" type="submit">Devam Et</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection