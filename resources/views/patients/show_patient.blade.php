@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    معلومات المريض
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة المرضى</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ معلومات المريض</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="wizard1">
                        <h3>معلومات المريض</h3>
                        <section>

                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="control-group form-group">
                                            <label class="form-label">الاسم:</label>
                                            <h5>{{$patients->name}}</h5>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="form-label">رقم الجوال:</label>
                                            <h5>{{$patients->mobile}}</h5>
                                        </div>
                                        <div class="control-group form-group mb-0">
                                            <label class="form-label">عنوان:</label>
                                            <h5>{{$patients->address}}</h5>
                                        </div>
                                        <div class="control-group form-group mb-0">
                                            <label class="form-label">تاريخ الولادة:</label>
                                            <h5>{{$patients->dob}}</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="control-group form-group">
                                            <label class="form-label">المهنة:</label>
                                            <h5>{{$patients->career}}</h5>
                                        </div>
                                        <div class="control-group form-group mb-0">
                                            <label class="form-label">الجنس:</label>
                                            <h5>{{$patients->gender}}</h5>
                                        </div>
                                        <div class="control-group form-group mb-0">
                                            <label class="form-label">الحالة الاجتماعية:</label>
                                            <h5>{{$patients->social_status}}</h5>
                                        </div>
                                        @if($patients->note != null)
                                            <div class="control-group form-group">
                                                <label class="form-label">الملاحظات:</label>
                                                <h5>{{$patients->note}}</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </section>
                        <h3>معلومات زيارة العيادة</h3>
                        <section>
                            <div class="table-responsive mg-t-20">
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($patient_id as $pa)
                                        <tr>
                                            <td>نوع المعالجة</td>
                                            <td class="text-right">{{$pa->type_treatment}}</td>
                                        </tr>
                                        <tr>
                                            <td>المبلغ</td>
                                            <td class="text-right">{{$pa->Total}}</td>
                                        </tr>
                                        <tr>
                                            <td>حالة الدفع</td>
                                            <td class="text-right">{{$pa->Status}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <h3>المرفقات</h3>
                        <section>
                            <div class="tab-pane" id="tab6">
                                <!--المرفقات-->
                                <div class="card card-statistics">

                                    <div class="table-responsive mt-15">
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="text-dark">
                                                <th scope="col">م</th>
                                                <th scope="col">اسم الملف</th>
                                                <th scope="col">قام بالاضافة</th>
                                                <th scope="col">تاريخ الاضافة</th>
                                                <th scope="col">العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($attachments as $attachment)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $attachment->file_name }}</td>
                                                    <td>{{ $attachment->Created_by }}</td>
                                                    <td>{{ $attachment->created_at }}</td>
                                                    <td colspan="2">

                                                        <a class="btn btn-outline-success btn-sm"
                                                           href="{{ url('View_file') }}/{{ $attachment->patient_name }}/{{ $attachment->file_name }}"
                                                           role="button"><i class="fas fa-eye"></i>&nbsp;عرض </a>

                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{ url('download') }}/{{ $attachment->patient_name }}/{{ $attachment->file_name }}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp;تحميل </a>

                                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                                                data-file_name="{{ $attachment->file_name }}" data-patient_name="{{ $attachment->patient_name }}"
                                                                data-id_file="{{ $attachment->id }}" data-target="#delete_file">حذف</button>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /row -->


    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Select2 js -->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.steps js -->
    <script src="{{URL::asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!--Internal  Form-wizard js -->
    <script src="{{URL::asset('assets/js/form-wizard.js')}}"></script>
@endsection