@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-12 pull-right no-padding">
            <button type="button" class="btn btn-primary  developer-modals top-element"><i class="fa fa-upload btn-icon"></i>IMPORT DATA</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#procedureTab" data-toggle="tab">DOCTOR PROCEDURE</a></li>
                <li><a href="#descriptionTab" data-toggle="tab">DESCRIPTION</a></li>
                <li><a href="#diagnosisTab" data-toggle="tab">DIAGNOSIS</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="procedureTab">
                    <div class="col-md-3 col-xs-12 pull-right">
                        <div class="input-group top-element">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-procedure" data-target="load-procedure">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>PROCEDURE ID</th>
                                    <th>PROCEDURE CODE</th>
                                    <th>PROCEDURE DESCRIPTIVE</th>
                                    <th>PROCEDURE RVU</th>
                                    <th>PROCEDURE CASE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_doctor_procedure as $doctor_procedure)
                                <tr>
                                    <td>{{$doctor_procedure->doctor_procedure_id}}</td>
                                    <td>{{$doctor_procedure->doctor_procedure_code}}</td>
                                    <td>{{$doctor_procedure->doctor_procedure_descriptive}}</td>
                                    <td>{{$doctor_procedure->doctor_procedure_rvu}}</td>
                                    <td>{{$doctor_procedure->doctor_procedure_case}}</td>
                                    <td><span class="label label-success">active</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-id="{{$doctor_procedure->doctor_procedure_id}}" data-name="DOCTOR PROCEDURE" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_doctor_procedure])
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="descriptionTab">
                    <div class="col-md-3 col-xs-12 pull-right">
                        <div class="input-group top-element">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-description" data-target="load-description">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>DESCRIPTION ID</th>
                                    <th>DESCRIPTION NAME</th>
                                    <th>TYPE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_procedure as $procedure)
                                <tr>
                                    <td>{{$procedure->procedure_id}}</td>
                                    <td>{{$procedure->procedure_name}}</td>
                                    <td>{{$procedure->type}}</td>
                                    <td><span class="label label-success">active</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                               <li><button type="button" data-id="{{$procedure->procedure_id}}" data-name="PROCEDURE" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_procedure])
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="diagnosisTab">
                    <div class="col-md-3 col-xs-12 pull-right">
                        <div class="input-group margin">
                            <input type="text" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-diagnosis" data-target="load-diagnosis">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>DIAGNOSIS ID</th>
                                    <th>DIAGNOSIS NAME</th>
                                    <th>DIAGNOSIS COVERED</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_diagnosis as $diagnosis)
                                <tr>
                                    <td>{{$diagnosis->diagnosis_id}}</td>
                                    <td>{{$diagnosis->diagnosis_name}}</td>
                                    <td>{{$diagnosis->diagnosis_covered}}</td>
                                    <td><span class="label label-success">active</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-id="{{$diagnosis->diagnosis_id}}" data-name="DIAGNOSIS" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_diagnosis])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
