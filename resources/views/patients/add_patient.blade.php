@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css')}}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css')}}">
@endsection
@section('title')
    اضافة مريض
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة المرضى</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/اضافة مريض</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="mr-4">{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('patient.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        {{csrf_field()}}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">اسم المريض</label>
                                <input type="text" class="form-control" id="inputName" name="name" title="يرجي ادخال اسم المريض" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الولادة</label>
                                <input class="form-control fc-datepicker" name="dob" placeholder="YYYY-MM-DD" type="text" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">رقم الجوال</label>
                                <input type="text" class="form-control" id="inputName" name="mobile" title="يرجي ادخال رقم الجوال" required>
                            </div>

                        </div>

                        {{-- 2 --}}

                        <div class="row mt-2">
                            <div class="col">
                                <label for="inputName" class="control-label">الجنس</label>

                                <select name="gender" class="custom-select" id="inputGroupSelect01" required>
                                    <option selected disabled>اختر الجنس...</option>
                                    <option value="ذكر">ذكر</option>
                                    <option value="أنثى">أنثى</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الحالة الاجتماعية</label>

                                <select name="social_status" class="custom-select" id="inputGroupSelect01" required>
                                    <option selected disabled>اختر الحالة الاجتماعية...</option>
                                    <option value="اعزب">اعزب</option>
                                    <option value="متزوج">متزوج</option>
                                    <option value="مطلق">مطلق</option>
                                    <option value="ارمل">ارمل</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المهنة</label>
                                <input type="text" class="form-control" id="inputName" name="career" title="يرجي ادخال المهنة" required>
                            </div>

                        </div>


                        {{-- 3 --}}

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">العنوان</label>
                                <textarea class="form-control" id="exampleTextarea" name="address" rows="3" required></textarea>
                            </div>
                        </div><br>

                        {{-- 4 --}}


                        <div class = "form-group">
                            <label for = "note">الملاحظات</label>
                            <textarea class = "form-control" rows = "3" name="note"></textarea>
                        </div>

                       <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
    <script src="{{URL::asset('assets/js/select2.js')}}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
    <!-- Internal form-elements js -->
    <script src="{{URL::asset('assets/js/form-elements.js')}}"></script>


    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>


@endsection