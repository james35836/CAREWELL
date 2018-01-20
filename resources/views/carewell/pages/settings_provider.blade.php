@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.settings_provider_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 pull-right">
      <button type="button" class="btn btn-primary  create-provider button-lg"><i class="fa fa-plus btn-icon"></i>CREATE PROVIDER</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Provider List</h3>
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
              <th>Provider ID</th>
              <th>Provider Name</th>
              <th>Provider Contact Person</th>
              <th>Provider Contact Number</th>
              <th>Provider Address</th>
              <th>Provider Created</th>
              <th>Provider Status</th>
              <th>Action</th>
            </tr>
            @foreach($_provider as $provider)
            <tr>
              <td>{{$_provider->provider_id}}</td>
              <td>{{$_provider->provider_name}}</td>
              <td>{{$_provider->provider_contact_person}}</td>
              <td>{{$_provider->provider_contact_email}}</td>
              <td>{{$_provider->provider_contact_number}}</td>
              <td>{{$_provider->provider_address}}</td>
              <td>{{$_provider->provider_created}}</td>
              <td><span class="label label-success">Active</span></td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-id="{{$_provider->availment_plan_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Member</button></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
            <tr style="height: 70px;">
            </tr>
          </table>
        </div>
        <div class="box-footer clearfix">
          @include('globals.pagination', ['paginator' => $_provider])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection