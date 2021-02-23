@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

@endsection
@section('title')
    مواعيد المرضى
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex"><h4 class="content-title mb-0 my-auto">معلومات المرضى</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المواعيد</span></div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    @if (session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="mr-4">{{ session()->get('add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    @if (session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="mr-4">{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong class="mr-4">{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('archive'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong class="mr-4">{{ session()->get('archive') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif




    <div class="row">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href="{{route('DentistAppointments.create')}}" class="modal-effect btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal" style="color:white"><i class="fas fa-plus"></i>&nbsp; اضافة موعد </a>

                </div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length="50">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المريض</th>
                                <th class="border-bottom-0">رقم الجوال</th>
                                <th class="border-bottom-0">تاريخ الموعد</th>
                                <th class="border-bottom-0">وقت الموعد</th>
                                <th class="border-bottom-0">معلومات المريض</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($Dentist_appointments as $Dentist_appointment)
                                <tr>
                                    <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{$Dentist_appointment->patient_Name}}</td>
                                        <td>{{$Dentist_appointment->patient_Mobile}}</td>
                                        <td>{{$Dentist_appointment->patient_Date}}</td>
                                        <td>{{$Dentist_appointment->patient_Time}}</td>
                                        <td>
                                            @if($Dentist_appointment->patient_id != null)
                                                <a href="{{ url('show_patient') }}/{{ $Dentist_appointment->patient->id }}">{{ $Dentist_appointment->patient->name }}</a>
                                            @else
                                                        لم يزر العيادة من قبل
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#archive{{$Dentist_appointment->id}}"
                                                    title="انتهى الموعد"><i class="fa fa-archive"></i></button>
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#edit{{$Dentist_appointment->id}}"
                                                    title="تعديل الموعد"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{$Dentist_appointment->id}}"
                                                    title="حذف الموعد"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>

                                    <!--  تعديل الموعد -->
                                    <div class="modal fade" id="edit{{$Dentist_appointment->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        تعديل الموعد
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('DentistAppointments.update', 'test') }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf

                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="patient_Name" class="mr-sm-2">name patient:</label>
                                                                <input id="patient_Name" type="text" value="{{$Dentist_appointment->patient_Name}}" name="patient_Name" class="form-control">
                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$Dentist_appointment->id}}">
                                                            </div>

                                                            <div class="col">
                                                                <label for="patient_Mobile" class="mr-sm-2">mobile:</label>
                                                                <input id="patient_Mobile" type="text" value="{{$Dentist_appointment->patient_Mobile}}" name="patient_Mobile" class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <label for="patient_Date" class="mr-sm-2">patient Date:</label>
                                                                <input id="patient_Date" type="date" value="{{$Dentist_appointment->patient_Date}}" name="patient_Date" class="form-control">
                                                            </div>

                                                            <div class="col">
                                                                <label for="patient_Time" class="mr-sm-2">patient Time:</label>
                                                                <input id="patient_Time" type="time" value="{{$Dentist_appointment->patient_Time}}" name="patient_Time" class="form-control">
                                                            </div>
                                                        </div>

                                                        <br>

                                                        <div class="col">
                                                            <label for="inputName" class="control-label">اسم المريض</label>
                                                            <select name="patient_id" class="form-control SlectBox">
                                                                <!--placeholder-->
                                                                <option value="" selected disabled>حدد اسم المريض</option>
                                                                @foreach ($patients as $patient)
                                                                    <option value="{{$patient->id}}"> {{$patient->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                            <button type="submit"  class="btn btn-success">حفظ البيانات</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--  حذف الموعد -->
                                    <div class="modal fade" id="delete{{$Dentist_appointment->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                        حذف الموعد
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('DentistAppointments.destroy', 'test') }}" method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf

                                                       هل انت متأكد من حذف موعد المريض؟
                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{$Dentist_appointment->id}}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                            <button type="submit"  class="btn btn-success">حفظ البيانات</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <!-- ارشيف المواعيد -->
                                <div class="modal fade" id="archive{{$Dentist_appointment->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    انتهى الموعد
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('DentistAppointments.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf

                                                    هل انت متأكد من انهاء موعد المريض؟
                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{$Dentist_appointment->id}}">
                                                    <input type="hidden" name="id_page" id="id_page" value="-1">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                                        <button type="submit"  class="btn btn-success">حفظ البيانات</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->



        <!-- أضافة الموعد -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            أضافة الموعد
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- add_form -->
                        <form action="{{ route('DentistAppointments.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="patient_Name" class="mr-sm-2">name patient:</label>
                                    <input id="patient_Name" type="text" name="patient_Name" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="patient_Mobile" class="mr-sm-2">mobile:</label>
                                    <input id="patient_Mobile" type="text" name="patient_Mobile" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <label for="patient_Date" class="mr-sm-2">patient Date:</label>
                                    <input id="patient_Date" type="date" name="patient_Date" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="patient_Time" class="mr-sm-2">patient Time:</label>
                                    <input id="patient_Time" type="time" name="patient_Time" class="form-control">
                                </div>
                            </div>

                            <br>

                            <div class="col">
                                <label for="inputName" class="control-label">اسم المريض</label>
                                <select name="patient_id" class="form-control SlectBox">
                                    <!--placeholder-->
                                    <option value="" selected disabled>حدد اسم المريض</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{$patient->id}}"> {{$patient->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br><br>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit"  class="btn btn-success">حفظ البيانات</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>


    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

@endsection