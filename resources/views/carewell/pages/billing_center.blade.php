@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.billing_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-right no-padding">
      <button class="btn btn-primary top-element create-cal" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE CAL</button>
    </div>
  </div>
  <div class="row">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activeCompany" data-toggle="tab">OPEN  </a></li>
        <li><a href="#inActiveCompany" data-toggle="tab">CLOSE </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activeCompany">
          <div class="row">
            <div class=" col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element">
                <option>SELECT COMPANY</option>
                @foreach($_company as $company)
                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                @endforeach
              </select>
            </div>
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
                <th>CAL #</th>
                <th>COMPANY</th>
                <th>PERIOD MONTH</th>
                <th>DATE COVERAGE</th>
                <th>PAYMENT PERIOD</th>
                <th>STATUS</th>
                <th>DATE CREATED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_cal_open as $cal_open)
              <tr>
                <td>{{$cal_open->cal_number}}</td>
                <td>{{$cal_open->company_name}}</td>
                <td>{{date("F j, Y",strtotime($cal_open->cal_reveneu_period_month))}}</td>
                <td>{{date("F j, Y",strtotime($cal_open->cal_company_period_start))}} - {{date("F j, Y",strtotime($cal_open->cal_company_period_end))}}</td>
                <td>{{date("F j, Y",strtotime($cal_open->cal_payment_date))}}</td>
                <td><span class="label label-success">active</span></td>
                <td>{{date("F j, Y",strtotime($cal_open->cal_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-cal_id="{{$cal_open->cal_id}}" data-company_id="{{$cal_open->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                      <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_cal_open])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
          <div class="row">
            <div class=" col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element">
                <option>SELECT COMPANY</option>
                @foreach($_company as $company)
                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                @endforeach
              </select>
            </div>
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
                <th>CAL #</th>
                <th>COMPANY</th>
                <th>PERIOD MONTH</th>
                <th>DATE COVERAGE</th>
                <th>PAYMENT PERIOD</th>
                <th>STATUS</th>
                <th>DATE CREATED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_cal_close as $cal_close)
              <tr>
                <td>{{$cal_close->cal_number}}</td>
                <td>{{$cal_close->company_name}}</td>
                <td>{{date("F j, Y",strtotime($cal_close->cal_reveneu_period_month))}}</td>
                <td>{{date("F j, Y",strtotime($cal_close->cal_company_period_start))}} - {{date("F j, Y",strtotime($cal_close->cal_company_period_end))}}</td>
                <td>{{date("F j, Y",strtotime($cal_close->cal_payment_date))}}</td>
                <td><span class="label label-success">active</span></td>
                <td>{{date("F j, Y",strtotime($cal_close->cal_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-cal_id="{{$cal_close->cal_id}}" data-company_id="{{$cal_close->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                      <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_cal_close])
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection