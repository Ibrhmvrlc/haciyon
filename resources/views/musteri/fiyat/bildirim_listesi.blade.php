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
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form step</h4>
                </div>
                <div class="card-body">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-steps@1.1.0/dist/jquery.steps.css">
                    <script src="https://cdn.jsdelivr.net/npm/jquery-steps@1.1.0/dist/jquery.steps.min.js"></script>

                    <div id="wizardd">
                        <h1>Step 1: Personal Information</h1>
                        <section>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email">
                        </section>
                        <h1>Step 2: Address</h1>
                        <section>
                            <label for="address">Address:</label>
                            <input type="text" id="address" name="address">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city">
                        </section>
                        <h1>Step 3: Payment</h1>
                        <section>
                            <label for="card-number">Card Number:</label>
                            <input type="text" id="card-number" name="card-number">
                            <label for="expiration">Expiration:</label>
                            <input type="text" id="expiration" name="expiration">
                        </section>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $("#wizardd").steps({
                                headerTag: "h1",
                                bodyTag: "section",
                                transitionEffect: "slideLeft",
                                enableAllSteps: true
                            });
                        });
                    </script>

                    <style>
                        .wizard-content {
                            padding: 20px;
                            border: 1px solid #ccc;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }
                    </style>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection