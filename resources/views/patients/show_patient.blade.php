@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
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
                        <h3>Payment Details</h3>
                        <section>
                            <div class="form-group">
                                <label class="form-label" >CardHolder Name</label>
                                <input type="text" class="form-control" id="name1" placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Card number</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-append">
													<button class="btn btn-info" type="button"><i class="fab fa-cc-visa"></i> &nbsp; <i class="fab fa-cc-amex"></i> &nbsp;
													<i class="fab fa-cc-mastercard"></i></button>
												</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group mb-sm-0">
                                        <label class="form-label">Expiration</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="MM" name="expiremonth">
                                            <input type="number" class="form-control" placeholder="YY" name="expireyear">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 ">
                                    <div class="form-group mb-0">
                                        <label class="form-label">CVV <i class="fa fa-question-circle"></i></label>
                                        <input type="number" class="form-control" required="">
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