@extends('carewell.layout.layout')
@section('content')

<div class="container" >
    <div class="row">
        
            <div class="nav-tabs-custom">
                 <div class="tab-content">
                    
                        <div class="row">
                            <div class=" col-md-3 col-xs-12 pull-left">
                                <select class="form-control top-element filtering" data-archived="0" data-name="member">
                                    <option>SELECT COMPANY</option>
                                    @foreach($_company as $company)
                                    <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-xs-12 pull-right">
                                <div class="input-group top-element">
                                    <input type="text" class="form-control search-key">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default searching" data-name="member" data-archived="0"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="showTable" class="load-data load-active-company" data-target="load-active-company">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover table-bordered">
                                    <tr class="titlerow">
                                        <th>UNIVERSAL ID</th>
                                        <th>CAREWELL ID</th>
                                        <th>EMPLOYEE NUMBER</th>
                                        <th>MEMBER NAME</th>
                                        <th>COMPANY NAME</th>
                                        <th>ALL REPORTS</th>
                                    </tr>
                                    @foreach($_member as $member)
                                    <tr>
                                        <td>{{$member->member_universal_id}}</td>
                                        <td>{{$member->member_carewell_id}}</td>
                                        <td>{{$member->member_employee_number}}</td>
                                        <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                                        <td>{{$member->company_name}}</td>
                                        <td><span class="label label-success member-report" data-title="PAYMENT REPORTS"  data-member_id="{{$member->member_id}}">VIEW ALL REPORTS</span></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="box-footer clearfix">
                                @include('globals.pagination_v2', ['paginator' => $_member])
                            </div>
                        </div>
                    
                    
                </div>
            </div>
       
    </div>
</div>
@endsection