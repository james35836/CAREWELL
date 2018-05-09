<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>CAL #</th>
      <th>COMPANY</th>
      <th>REVENEU YEAR</th>
      <th>MODE OF PAYMENT</th>
      <th># OF MEMBER</th>
      <th>DATE CREATED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_cal_pending as $cal_pending)
    <tr>
      <td>{{$cal_pending->cal_number}}</td>
      <td>{{$cal_pending->company_name}}</td>
      <td>{{$cal_pending->cal_reveneu_period_year}}</td>
      <td>{{$cal_pending->cal_payment_mode}}</td>
      <td>{{$cal_pending->members}}</td>
      <td>{{date("F j, Y",strtotime($cal_pending->cal_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-cal_id="{{$cal_pending->cal_id}}" data-company_id="{{$cal_pending->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_cal_pending])
</div>