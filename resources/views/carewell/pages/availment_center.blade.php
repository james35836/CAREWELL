@extends('carewell.layout.layout')
@section('content')
<div class="container">
     <div class="row">
          <div class=" col-md-3 col-xs-12 pull-right no-padding">
               <button type="button" class="btn btn-primary create-approval top-element"><i class="fa fa-plus btn-icon"></i>CREATE APPROVAL</button>
          </div>
     </div>
     <div class="row">
          <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                    <li class="active"><a href="#activeTab" data-toggle="tab">OPEN </a></li>
                    <li><a href="#pendingTab" data-toggle="tab">PENDING</a></li>
                    <li><a href="#inActiveTab" data-toggle="tab">CLOSE </a></li>
               </ul>
               <div class="tab-content">
                    <div class="tab-pane active" id="activeTab">
                         <div class="row">
                              <div class=" col-md-3 col-xs-12 pull-left">
                                   <select class="form-control top-element filtering" data-archived="0" data-name="availment">
                                        <option>SELECT PROVIDER</option>
                                        @foreach($_provider as $provider)
                                        <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="col-md-3 col-xs-12 pull-right">
                                   <div class="input-group top-element">
                                        <input type="text" class="form-control search-key">
                                        <span class="input-group-btn">
                                             <button type="button" class="btn btn-default searching" data-name="availment" data-archived="0"><i class="fa fa-search"></i></button>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div id="showTable" class="load-data load-active-approval" data-target="load-active-approval">
                              <div class="box-body table-responsive no-padding">
                                   <table class="table table-hover table-bordered">
                                        <tr>
                                             <th class="live-search">APPROVAL #</th>
                                             <th class="live-search">UNIVERSAL ID</th>
                                             <th class="live-search">CAREWELL ID</th>
                                             <th class="live-search">MEMBER NAME</th>
                                             <th class="live-search">COMPANY</th>
                                             <th class="live-search">PROVIDER</th>
                                             <th class="live-search">DATE ISSUED</th>
                                             <th class="live-search">ACTION</th>
                                        </tr>
                                        @foreach($_approval_active as $approval_active)
                                        <tr>
                                             <td>{{$approval_active->approval_number}}</td>
                                             <td>{{$approval_active->member_universal_id}}</td>
                                             <td>{{$approval_active->member_carewell_id}}</td>
                                             <td>{{$approval_active->member_first_name." ".$approval_active->member_last_name }}</td>
                                             <td>{{$approval_active->company_name}}</td>
                                             <td>{{$approval_active->provider_name}}</td>
                                             <td>{{date("F j, Y",strtotime($approval_active->approval_created))}}</td>
                                             <td>
                                                  <div class="btn-group">
                                                       <button type="button" class="btn btn-danger">Action</button>
                                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       <span class="caret"></span>
                                                       <span class="sr-only">Toggle Dropdown</span>
                                                       </button>
                                                       <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                            <li><button type="button" data-approval_id="{{$approval_active->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                                                            {{-- <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li> --}}
                                                       </ul>
                                                  </div>
                                             </td>
                                        </tr>
                                        @endforeach
                                   </table>
                              </div>
                              <div class="box-footer clearfix">
                                   @include('globals.pagination_v2', ['paginator' => $_approval_active])
                              </div>
                         </div>
                    </div>
                    <div class="tab-pane" id="pendingTab">
                         <div class="row">
                              <div class=" col-md-3 col-xs-12 pull-left">
                                   <select class="form-control top-element filtering" data-archived="2" data-name="availment">
                                        <option>SELECT PROVIDER</option>
                                        @foreach($_provider as $provider)
                                        <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="col-md-3 col-xs-12 pull-right">
                                   <div class="input-group top-element">
                                        <input type="text" class="form-control search-key">
                                        <span class="input-group-btn">
                                             <button type="button" class="btn btn-default searching" data-name="availment" data-archived="2"><i class="fa fa-search"></i></button>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div id="showTable" class="load-data load-pending-approval" data-target="load-pending-approval">
                              <div class="box-body table-responsive no-padding">
                                   <table class="table table-hover table-bordered">
                                        <tr>
                                             <th class="live-search">APPROVAL #</th>
                                             <th class="live-search">UNIVERSAL ID</th>
                                             <th class="live-search">CAREWELL ID</th>
                                             <th class="live-search">MEMBER NAME</th>
                                             <th class="live-search">COMPANY</th>
                                             <th class="live-search">PROVIDER</th>
                                             <th class="live-search">DATE ISSUED</th>
                                             <th class="live-search">ACTION</th>
                                        </tr>
                                        @foreach($_approval_pending as $approval_pending)
                                        <tr>
                                             <td>{{$approval_pending->approval_number}}</td>
                                             <td>{{$approval_pending->member_universal_id}}</td>
                                             <td>{{$approval_pending->member_carewell_id}}</td>
                                             <td>{{$approval_pending->member_first_name." ".$approval_pending->member_last_name }}</td>
                                             <td>{{$approval_pending->company_name}}</td>
                                             <td>{{$approval_pending->provider_name}}</td>
                                             <td>{{date("F j, Y",strtotime($approval_pending->approval_created))}}</td>
                                             <td>
                                                  <div class="btn-group">
                                                       <button type="button" class="btn btn-danger">Action</button>
                                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       <span class="caret"></span>
                                                       <span class="sr-only">Toggle Dropdown</span>
                                                       </button>
                                                       <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                            <li><button type="button" data-approval_id="{{$approval_pending->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                                                            {{-- <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li> --}}
                                                       </ul>
                                                  </div>
                                             </td>
                                        </tr>
                                        @endforeach
                                   </table>
                              </div>
                              <div class="box-footer clearfix">
                                   @include('globals.pagination_v2', ['paginator' => $_approval_pending])
                              </div>
                         </div>
                    </div>
                    <div class="tab-pane" id="inActiveTab">
                         <div class="row">
                              <div class=" col-md-3 col-xs-12 pull-left">
                                   <select class="form-control top-element filtering" data-archived="1" data-name="availment">
                                        <option>SELECT PROVIDER</option>
                                        @foreach($_provider as $provider)
                                        <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                                        @endforeach
                                   </select>
                              </div>
                              <div class="col-md-3 col-xs-12 pull-right">
                                   <div class="input-group top-element">
                                        <input type="text" class="form-control search-key">
                                        <span class="input-group-btn">
                                             <button type="button" class="btn btn-default searching" data-name="availment" data-archived="1"><i class="fa fa-search"></i></button>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div id="showTable" class="load-data load-inactive-approval" data-target="load-inactive-approval">
                              <div class="box-body table-responsive no-padding">
                                   <table class="table table-hover table-bordered">
                                        <tr>
                                             <th class="live-search">APPROVAL #</th>
                                             <th class="live-search">UNIVERSAL ID</th>
                                             <th class="live-search">CAREWELL ID</th>
                                             <th class="live-search">MEMBER NAME</th>
                                             <th class="live-search">COMPANY</th>
                                             <th class="live-search">PROVIDER</th>
                                             <th class="live-search">DATE ISSUED</th>
                                             <th class="live-search">ACTION</th>
                                        </tr>
                                        @foreach($_approval_inactive as $approval_inactive)
                                        <tr>
                                             <td>{{$approval_inactive->approval_number}}</td>
                                             <td>{{$approval_inactive->member_universal_id}}</td>
                                             <td>{{$approval_inactive->member_carewell_id}}</td>
                                             <td>{{$approval_inactive->member_first_name." ".$approval_inactive->member_last_name }}</td>
                                             <td>{{$approval_inactive->company_name}}</td>
                                             <td>{{$approval_inactive->provider_name}}</td>
                                             <td>{{date("F j, Y",strtotime($approval_inactive->approval_created))}}</td>
                                             <td>
                                                  <div class="btn-group">
                                                       <button type="button" class="btn btn-danger">Action</button>
                                                       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                       <span class="caret"></span>
                                                       <span class="sr-only">Toggle Dropdown</span>
                                                       </button>
                                                       <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                            <li><button type="button" data-approval_id="{{$approval_inactive->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                                                            {{-- <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li> --}}
                                                       </ul>
                                                  </div>
                                             </td>
                                        </tr>
                                        @endforeach
                                   </table>
                              </div>
                              <div class="box-footer clearfix">
                                   @include('globals.pagination_v2', ['paginator' => $_approval_inactive])
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection