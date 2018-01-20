@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.billing_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2  col-xs-6 pull-left">
      <select class="form-control">
        <option>SELECT COMPANY</option>
      </select>
    </div>
    <div class=" col-md-2 pull-right">
      <button type="button" class="btn btn-primary  create-cal button-lg" ><i class="fa fa-plus btn-icon"></i>CREATE CAL</button>
    </div>
    
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Period List</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-bordered">
            <tr>
              <th>CAL #</th>
              <th>Company</th>
              <th>Period Month</th>
              <th>Date Coverage</th>
              <th>Payment Period</th>
              <th>Status</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
            @foreach($_cal_company as $cal_company)
            <tr>
              <td>{{$cal_company->cal_number}}</td>
              <td>{{$cal_company->company_name}}</td>
              <td>{{date("F j, Y",strtotime($cal_company->cal_reveneu_period_month))}}</td>
              <td>{{date("F j, Y",strtotime($cal_company->cal_company_period_start))}} - {{date("F j, Y",strtotime($cal_company->cal_company_period_end))}}</td>
              <td>{{date("F j, Y",strtotime($cal_company->cal_payment_date))}}</td>
              <td><span class="label label-success">active</span></td>
              <td>{{date("F j, Y",strtotime($cal_company->cal_created))}}</td>
              <td>
                {{-- <select name="" class="form-control cal-action">
                  <option value="" >ACTION</option>
                  <option value="member" >View Member</option>
                  <option value="billing" class="pop-up-lg">Billing Statement</option>
                </select> --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-cal_id="{{$cal_company->cal_id}}" data-company_id="{{$cal_company->cal_company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived CAL</button></li>
                  </ul>
                </div>

              </td>
            </tr>
            @endforeach
            <tr style="height:70px;">
            </tr>
          </table>
        </div>
        <div class="box-footer clearfix">
          @include('globals.pagination', ['paginator' => $_cal_company])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection