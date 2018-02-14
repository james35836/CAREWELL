@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.provider_center_modals')

  <div class="container">
    <div class="row">
      <div class=" col-md-2 col-xs-6 pull-right">
        <button type="button" class="btn btn-primary create-provider top-element"><i class="fa fa-plus btn-icon"></i>CREATE PROVIDER</button> 
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
                <th>PROVIDER NUMBER</th>
                <th>PROVIDER NAME</th>
                <th>PAYEE</th>
                <th>STATUS</th>
                <th>DATE ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_provider as $provider)
              <tr>
                <td>{{sprintf("%05d",$provider->provider_id)}}</td>
                <td>{{$provider->provider_name}}</td>
                <td>
                  @foreach($provider->provider_payee as $payee)
                  <span class="label label-default">{{$payee->provider_payee_name}}</span>
                  @endforeach
                </td>
                <td><span class="label label-success">active</span></td>
                <td>{{date("F j, Y",strtotime($provider->provider_created))}}</td>
                <td>
                  <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-provider_id="{{$provider->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Provider</button></li>
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
            @include('globals.pagination', ['paginator' => $_provider])
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection