<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Carewell |  {{$page}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- TOP -->
    <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/assets/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/assets/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css">
    <link rel="stylesheet" href="/assets/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">

    <link rel="stylesheet" href="/assets/css/globals.css">
    <!-- FONT -->
    {{-- <link rel="stylesheet" href="/assets/css/offline/font-offline.css"> --}}
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
    <!-- AJAX -->
    <script src="/assets/js/offline/ajax-offline.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <!-- TOASTR -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link   href="/assets/plugins/fselect/multiselect.css" rel="stylesheet">
  <script src="/assets/plugins/fselect/multiselect.js"></script>
  <script>

  $(function () 
  {
  $('body').find('select[multiple].active.3col').multiselect({
    columns: 3,
    placeholder: 'Select States',
    search: true,
    searchOptions: {
    'default': 'Search States'
    },
    selectAll: true
    });
  })
</script>
</head>



<body>

<div class="container">
  <div class="row box-globals">
    <div class="availment-box">
      @foreach($_availment as $availment)
      <div  class="table-responsive no-padding">
        <table class="table table-bordered" >
          <tr>
            <p style="font-size: 20px;font-weight: bold;">
              <input type="checkbox" id="availment_id" class="availment_id parent-box" name="availment_id[]" value=""/>
              {{$availment->availment_name}}
            </p>
          </tr>
          
          <tr>
            <th class="col-md-5">PROCEDURES</th>
            <th class="col-md-3" >CHARGES</th>
            <th class="col-md-2">AMOUNT</th>
            <th class="col-md-2">LIMIT</th>
            <th class="col-md-2"></th>
          </tr>
          
          <tr class="table-row">
            <td>
              
              <select name="basic[]" multiple="multiple" class="3col active">
                <option value="AL">Alabama hfdhfdh fgh fg hfg   hfhfhfghfgh fghfghfghfg bfgbfghfg</option>
                @foreach($availment->procedure as $procedure)
                <option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
                @endforeach
              </select>
              
              
            </td>
            <td>
              
              <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                <option>COVERED</option>
                <option>NOT COVERED</option>
              </select>
              
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
              </div>
            </td>
          </tr>
          
          <tr class="table-row">
            <td>
              
              <select name="basic[]" multiple="multiple" class="3col active">
                <option value="AL">Alabama hfdhfdh fgh fg hfg   hfhfhfghfgh fghfghfghfg bfgbfghfg</option>
                @foreach($availment->procedure as $procedure)
                <option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
                @endforeach
              </select>
              
              
            </td>
            <td>
              
              <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                <option>COVERED</option>
                <option>NOT COVERED</option>
              </select>
              
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
              </div>
            </td>
          </tr>
          <tr class="table-row">
            <td>
              
              <select name="basic[]" multiple="multiple" class="3col active">
                <option value="AL">Alabama hfdhfdh fgh fg hfg   hfhfhfghfgh fghfghfghfg bfgbfghfg</option>
                @foreach($availment->procedure as $procedure)
                <option value="{{$procedure->procedure_id}}">{{$procedure->procedure_name}}</option>
                @endforeach
              </select>
              
              
            </td>
            <td>
              
              <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                <option>COVERED</option>
                <option>NOT COVERED</option>
              </select>
              
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              
              <div class="input-group">
                <select class="form-control " name="coverage_plan_maximum_benefit" id="coverage_plan_maximum_benefit">
                  <option>10,000</option>
                  <option>20,000</option>
                  <option>30,000</option>
                  <option>40,000</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
                </span>
              </div>
            </td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" data-number="2" class="btn btn-primary btn-sm add-row"><i class="fa fa-plus-circle"></i></button>
                <button type="button" class="btn btn-danger btn-sm remove-row"><i class="fa fa-minus-circle"></i></button>
              </div>
            </td>
          </tr>
          
          
        </table>
      </div>
      @endforeach
    </div>
    
  </div> 
</div>

</body>
</html>