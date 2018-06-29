@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-6 pull-right no-padding">
            <button class="btn btn-primary top-element upload-terminated-member" type="button" ><i class="fa fa-plus btn-icon "></i>UPLOAD TERMINATED MEMBER</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeUser" data-toggle="tab">ACTIVE </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activeUser">
                    <div class="row">
                        
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control " id="search_key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class=" box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>POSITION NAME</th>
                                <th>NO. MEMBER</th>
                                <th>POSITION CREATED</th>
                                <th>ACTION</th>
                            </tr>
                            @foreach($_position as $key=>$position)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$position->position_name}}</td>
                                <td><span class="label label-success">3</span></td>
                                <td>{{date("F j, Y",strtotime($position->position_created))}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                            <li><button type="button" data-user_id="{{$position->position_id}}" class="btn btn-link view-position-details"><i class="fa fa-eye btn-icon"></i>  View position</button></li>
                                            <li><button type="button" data-id="{{$position->position_id}}" data-name="USER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived User</button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        @include('globals.pagination_v2', ['paginator' => $_position])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection