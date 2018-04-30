@extends('carewell.layout.layout')
@section('content')

<div class="container">
  <div class="row">
    <div class="">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#open" data-toggle="tab">MONTHLY MONITORING</a></li>
          <li><a href="#close" data-toggle="tab">MONTHLY SUMMARY</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="open">
            <div class="row">
              <div class="col-md-3 col-xs-12 pull-left">
                <select class="form-control top-element filtering" data-archived="0" data-name="member">
                  <option>SELECT AVAILMENT</option>
                  @foreach($_availment as $availment)
                  <option value="{{$availment->availment_id}}">{{$availment->availment_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 col-xs-12 pull-right">
                <select class="form-control">
                  <option value="2018">2018</option>
                </select>
              </div>
            </div>
            <div class="table-responsive no-padding">
              <table class="table table-hover table-bordered sum_table">
                <tr class="titlerow">
                  <th>AVAILMENT TYPE</th>
                  <th>JAN</th>
                  <th>FEB</th>
                  <th>MAR</th>
                  <th>APR</th>
                  <th>MAY</th>
                  <th>JUNE</th>
                  <th>JULY</th>
                  <th>AUG</th>
                  <th>SEP</th>
                  <th>OCT</th>
                  <th>NOV</th>
                  <th>DEC</th>
                  <th>TOTAL</th>
                </tr>
                @foreach($_availment as $availment)
                <tr>
                  <td>{{$availment->availment_name}}</td>
                  <td>5</td>
                  <td>DIGIMA</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>CAL 01</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DIGIMA</td>
                  <td>DIGIMA</td>
                  <td><span class="label label-success">active</span></td>
                  <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                </tr>
                @endforeach
                <tr>
                  <td>TOTAL</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                </tr>
              </table>
            </div>
            {{-- <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_availment])
            </div> --}}
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="close">
            <div class="row">
              <div class="col-md-3 col-xs-12 pull-left">
                <select class="form-control top-element filtering" data-archived="0" data-name="member">
                  <option>SELECT AVAILMENT</option>
                  @foreach($_availment as $availment)
                  <option value="{{$availment->availment_id}}">{{$availment->availment_name}}</option>
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
              <table class="table table-hover table-bordered sum_table">
                <tr class="titlerow">
                  <th>COMPANY</th>
                  <th>AVAILMENT TYPE</th>
                  <th>JAN</th>
                  <th>FEB</th>
                  <th>MAR</th>
                  <th>APR</th>
                  <th>MAY</th>
                  <th>JUNE</th>
                  <th>JULY</th>
                  <th>AUG</th>
                  <th>SEP</th>
                  <th>OCT</th>
                  <th>NOV</th>
                  <th>DEC</th>
                  <th>TOTAL</th>
                </tr>
                <tr>
                  <td>fgfh</td>
                  <td>fhdfd</td>
                  <td>5</td>
                  <td>DIGIMA</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>CAL 01</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DIGIMA</td>
                  <td>DIGIMA</td>
                  <td><span class="label label-success">active</span></td>
                  <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                </tr>
                <tr>
                  <td></td>
                  <td>TOTAL</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td></td>
                </tr>
              </table>
            </div>
            {{-- <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_availment])
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection