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
                        <div class="alert alert-success left-icon-big alert-dismissible fade show">
                            <div class="media">
                                <div class="alert-left-icon-big">
                                    <span><i class="mdi mdi-timer-sand"></i></span>
                                </div>
                                <div class="media-body">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <h5 class="mt-1 mb-1">Giriş Talebiniz İletilmiştir</h5>
                                            <p class="mb-2 text-dark">
                                              Yöneticinizin onayından sonra modülü kullanabileceksiniz. 
                                            </p>
                                            <p class="mb-2 text-dark">
                                               Talebiniz şu yöneticilere iletilmiştir:
                                            </p>
                                            <ul class="mb-2 text-dark">
                                                <li>xxxx xxxxx</li>
                                                <li>yyyyyy yyyyyy</li>
                                           </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection