@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4 class="mb-2">Beton Programı Yap</h4>
                <p class="mb-0">Aşağıdaki takvim arayüzünden günlük, haftalık ya da aylık şekilde program yapabilirsiniz. <br/> 
                    (Dikkat: Sistem mobil cihazlarda henüz kullanılmamaktadır!)</p>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Ana Menü</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Günlük Program Yap</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->


    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-intro-title">Calendar</h4>

                    <div class="">
                        <div id="external-events" class="my-3">
                            <p>*Program türünü seçip sürükle-bırak yöntemi ile saatlere uygun şekilde programı oluşturabilirsiniz.</p>
                            <p>*Eklediğiniz programın üzerine tıklayarak gerekli düzenlemeleri yapabilirsiniz.</p>
                            <div class="external-event" data-class="bg-primary"><i class="fa fa-move"></i>Pompalı Program</div>
                            <div class="external-event" data-class="bg-success"><i class="fa fa-move"></i>Mikserli Program
                            </div>
                            <div class="external-event" data-class="bg-warning"><i class="fa fa-move"></i>Santral Altı Program</div>
                            <div class="external-event" data-class="bg-dark"><i class="fa fa-move"></i>Boş Program</div>
                        </div>
                        <!-- checkbox -->
                        <div class="checkbox checkbox-event pt-3 pb-5">
                            <input id="drop-remove" class="styled-checkbox" type="checkbox">
                            <label class="ml-2 mb-0" for="drop-remove">Remove After Drop</label>
                        </div>
                        <a href="javascript:void()" data-toggle="modal" data-target="#add-category" class="btn btn-primary btn-event w-100">
                            <span class="align-middle"><i class="ti-plus"></i></span> Create New
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div id="calendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#calendar').fullCalendar(
                   header:any
                   {
                    left: 'month, agendaWeek, agendaDay, list',
                    center: 'title'
                   }
                );
            });
        </script>
        <!-- BEGIN MODAL -->
        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add New Event</strong></h4>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                            event</button>

                        <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><strong>Add a category</strong></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="control-label">Category Name</label>
                                    <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name">
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label">Choose Category Color</label>
                                    <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                        <option value="success">Success</option>
                                        <option value="danger">Danger</option>
                                        <option value="info">Info</option>
                                        <option value="pink">Pink</option>
                                        <option value="primary">Primary</option>
                                        <option value="warning">Warning</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection