@extends('carewell.layout.layout')
@section('content')
<style>
/*!
* bootstrap-vertical-tabs - v1.2.1
* https://dbtek.github.io/bootstrap-vertical-tabs
* 2014-11-07
* Copyright (c) 2014 İsmail Demirbilek
* License: MIT
*/
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: 5px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}
.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.sideways {
  margin-top:50px;
  border: none;
  position: relative;
}
.sideways>li {
  height: 20px;
  width: 120px;
  margin-bottom: 100px;
}
.sideways>li>a {
  border-bottom: 1px solid #ddd;
  border-right-color: transparent;
  text-align: center;
  border-radius: 4px 4px 0px 0px;
}
.sideways>li.active>a,
.sideways>li.active>a:hover,
.sideways>li.active>a:focus {
  border-bottom-color: transparent;
  border-right-color: #ddd;
  border-left-color: #ddd;
}
.sideways.tabs-left {
  left: -50px;
}
.sideways.tabs-right {
  right: -50px;
}
.sideways.tabs-right>li {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.sideways.tabs-left>li {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
</style>
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
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-user_id="{{$doctor_procedure->user_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                      <li><button type="button" data-id="{{$doctor_procedure->user_id}}" data-name="USER" class="btn btn-link restore" ><i class="fa fa-trash btn-icon"></i> Restore User </button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
              <tr style="height:80px;">
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_doctor_procedure])
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
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-id="{{$procedure->procedure_id}}" data-name="PROCEDURE" class="btn btn-link restore" ><i class="fa fa-trash btn-icon"></i> Restore  </button></li>
                     </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_procedure])
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
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-user_id="{{$diagnosis->diagnosis_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                    <li><button type="button" data-id="{{$diagnosis->diagnosis_id}}" data-name="USER" class="btn btn-link restore" ><i class="fa fa-trash btn-icon"></i> Restore User </button></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        <div class="box-footer clearfix">
          @include('globals.pagination', ['paginator' => $_diagnosis])
        </div>
      </div>

      </div>
    </div>
  </div>
</div>
@endsection
  <!-- edrich end -->

 