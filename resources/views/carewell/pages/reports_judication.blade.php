@extends('carewell.layout.layout')
@section('content')
<div class="container" >
    <div class="row">
        
        <div class="nav-tabs-custom">
            <div class="tab-pane tab-content">
                
                <div class="row">
                    <div class=" col-md-3 col-xs-12 pull-left">
                        <select class="form-control top-element filtering" data-archived="0" data-name="payment-member-report">
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
                                <button type="button" class="btn btn-default searching" data-name="payment-member-report" data-archived="0"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div id="showTable" class="load-data payment-member-report" data-target="payment-member-report">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th class="live-search">PAYABLE ID</th>
                                <th class="live-search">PROVIDER</th>
                                <th class="live-search">SOA NUMBER</th>
                                <th class="live-search">DATE RECEIVED</th>
                                <th class="live-search">DUE DATE</th>
                                <th class="live-search">APPROVAL NUMBER</th>
                                <th class="live-search">PREPARED BY</th>
                                <th class="live-search">PREPARATION DATE</th>
                                <th class="live-search">ACTION</th>
                            </tr>
                            @foreach($_payable as $payable)
                            <tr>
                                
                                <td>{{$payable->payable_number}}</td>
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
                                            <li><a href="/reports/ajudication/pdf/{{$payable->payable_id}}" target="_blank"><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link"><i class="fa fa-eye btn-icon"></i>View Ajudication</button></a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        @include('globals.pagination_v2', ['paginator' => $_payable])
                    </div>
                </div>
                
                
            </div>
        </div>
        
    </div>
</div>
@endsection