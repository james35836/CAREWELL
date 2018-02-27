@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.payable_center_modals')
<div class="container">
  <div class="row">
    
    <div class=" col-md-2 col-xs-6 pull-right">
      <button type="button" class="btn btn-primary create-payable top-element"><i class="fa fa-plus btn-icon"></i>CREATE PAYABLE</button>
    </div>
    
  </div>
  
  <div class="row">
    <div class="">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#open" data-toggle="tab">OPEN</a></li>
          <li><a href="#close" data-toggle="tab">CLOSE</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="open">
            <div class="row">
              <div class="col-xs-12">
                <div class="box-header">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <select class="form-control">
                      <option >SELECT PROVIDER</option>
                      @foreach($_provider as $provider)
                      <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                      @endforeach
                    </select>
                  </div>
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
                      <th>ID</th>
                      <th>PROVIDER</th>
                      <th>SOA NUMBER</th>
                      <th>DATE RECEIVED</th>
                      <th>DUE DATE</th>
                      <th>APPROVAL NUMBER</th>
                      <th>PREPARED BY</th>
                      <th>PREPARATION DATE</th>
                      <th>ACTION</th>
                    </tr>
                    @foreach($_payable_open as $payable)
                    <tr>
                      
                      <td>{{$payable->payable_id}}</td>
                      <td>{{$payable->provider_name}}</td>
                      <td>{{$payable->payable_soa_number}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
                      <td>
                        @foreach($payable->approval_number as $approval_number)
                        <span class="label label-default">{{$approval_number->approval_number}}</span>
                        @endforeach
                      </td>
                      <td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-danger">Action</button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                            <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link view-payable-details"><i class="fa fa-eye btn-icon"></i>  View Payable</button></li>
                            <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Payable</button></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <div class="box-footer clearfix">
                  @include('globals.pagination', ['paginator' => $_payable_open])
                </div>
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="close">
            <div class="row">
              <div class="col-xs-12">
                <div class="box-header">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <select class="form-control">
                      <option value="">SELECT PROVIDER</option>
                    </select>
                  </div>
                  <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-bordered">
                    <tr>
                      <th>ID</th>
                      <th>PROVIDER</th>
                      <th>SOA NUMBER</th>
                      <th>DATE RECEIVED</th>
                      <th>DUE DATE</th>
                      <th>APPROVAL NUMBER</th>
                      <th>PREPARED BY</th>
                      <th>PREPARATION DATE</th>
                      <th>ACTION</th>
                    </tr>
                    @foreach($_payable_close as $payable)
                    <tr>
                      
                      <td>{{$payable->payable_id}}</td>
                      <td>{{$payable->provider_name}}</td>
                      <td>{{$payable->payable_soa_number}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
                      <td>
                        @foreach($payable->approval_number as $approval_number)
                        <span class="label label-default">{{$approval_number->approval_number}}</span>
                        @endforeach
                      </td>
                      <td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
                      <td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
                      <td>
                        <div class="btn-group">
                          <button type="button" class="btn btn-danger">Action</button>
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                            <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link view-payable-details"><i class="fa fa-eye btn-icon"></i>  View Payable</button></li>
                            <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Payable</button></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <div class="box-footer clearfix">
                  @include('globals.pagination', ['paginator' => $_payable_close])
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>
@endsection