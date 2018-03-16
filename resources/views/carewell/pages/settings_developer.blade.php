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
        <li class="active"><a href="#laboratoryTab" data-toggle="tab">LABORATORY </a></li>
        <li><a href="#procedureTab" data-toggle="tab">DOCTOR PROCEDURE </a></li>
        <li><a href="#descriptionTab" data-toggle="tab">DESCRIPTION</a></li>
        <li><a href="#diagnosisTab" data-toggle="tab">DIAGNOSIS</a></li>
      </ul>
      {{-- <ul class="nav  nav-stacked nav-tabs">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#procedureTab">Menu 1</a></li>
        <li><a href="#">Menu 2</a></li>
        <li><a href="#">Menu 3</a></li>
      </ul> --}}
      <div class="tab-content">
        <div class="tab-pane active" id="laboratoryTab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group margin">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div class=" box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>LABORATORY ID</th>
                <th>LABORATORY NAME</th>
                <th>LABORATORY AMOUNT</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
              @foreach($_laboratory as $laboratory)
              <tr>
                <td>{{$laboratory->laboratory_id}}</td>
                <td>{{$laboratory->laboratory_name}}</td>
                <td>{{$laboratory->laboratory_amount}}</td>
                <td><span class="label label-success">active</span></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-user_id="{{$laboratory->user_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                      <li><button type="button" data-id="{{$laboratory->user_id}}" data-name="USER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived User</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_laboratory])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="procedureTab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group margin">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
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
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group margin">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>DESCRIPTION ID</th>
                <th>DESCRIPTION NAME</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
              @foreach($_procedure as $procedure)
              <tr>
                <td>{{$procedure->procedure_id}}</td>
                <td>{{$procedure->procedure_name}}</td>
                <td><span class="label label-success">active</span></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-user_id="{{$procedure->procedure_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                      <li><button type="button" data-id="{{$procedure->procedure_id}}" data-name="USER" class="btn btn-link restore" ><i class="fa fa-trash btn-icon"></i> Restore User </button></li>
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
        <div class="tab-pane" id="diagnosisTab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group margin">
                <input type="text" class="form-control">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
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
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
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
      <!-- /.tab-content -->
    </div>
  </div>
  
</div>
@endsection