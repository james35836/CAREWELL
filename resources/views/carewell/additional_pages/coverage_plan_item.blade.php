<script type="text/javascript">
  $(".search-key").on("keyup", function() {
    var value = $(this).val();
    var $table = $(this).closest("table tr");

    $("table."+$(this).data('name')+" tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td.procedure").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});
</script>

<form method="POST">
  <input type="hidden" id="availment_id" value="{{$availment_id}}"/>
  <input type="hidden" id="session_name" value="{{$session_name}}"/>
  <div class="row">
    <div  class="table-responsive no-padding">
      <table class="table table-bordered" >
        <tr>
          <th class="col-md-4" >CHARGES</th>
          <th class="col-md-4">AMOUNT COVERED</th>
          <th class="col-md-4">LIMIT</th>
        </tr>
        <tr class="table-row">
          <td >
            <select class="form-control select2" id="plan_charges">
              <option value="c">COVERED</option>
              <option value="n">NOT COVERED</option>
              <option value="nc">NOT SPECIFIED</option>
            </select>
          </td>
          <td>
            <div class="input-group">
              <select class="form-control select2" id="plan_covered_amount">
                <option value="1000">10 000</option>
                <option value="2000">20 000</option>
                <option value="3000">30 000</option>
              </select>
              <span class="input-group-btn">
                <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
              </span>
            </div>
          </td>
          <td>
            <div class="input-group">
              <select  class="form-control select2 " id="plan_limit">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
              <span class="input-group-btn">
                <button class="btn btn-secondary add-new-option" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span></button>
              </span>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#lab" data-toggle="tab">LABORATORY </a></li>
        <li><a href="#comp" data-toggle="tab">COMPLEX </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="lab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
             
                <input type="text" data-name="laboratory" class="top-element form-control search-key">
                
            </div>
          </div>
          <div  class="table-responsive no-padding">
            <table class="table table-bordered laboratory" >
              <tr>
                <th class="col-md-1"><input type="checkbox" class="checkAllCheckbox"></th>
                <th class="col-md-4" >PROCEDURE</th>
               </tr>
              @foreach($_laboratory as $laboratory)
                @if($laboratory->reference_number=='hidden')
                @else
                <tr class="table-row">
                  <td>
                    <input type="checkbox" name="coverage_item[]" value="{{$laboratory->procedure_id}}"/>
                  </td>
                  <td class="procedure">{{$laboratory->procedure_name}}</td>
                </tr>
                @endif
              @endforeach
            </table>
          </div>
        </div>
        <div class="tab-pane" id="comp">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <input type="text" data-name="complex" class="top-element form-control search-key">
            </div>
          </div>
          <div  class="table-responsive no-padding">
            <table class="table table-bordered complex" >
              <tr>
                <th class="col-md-1"><input type="checkbox" class="checkAllCheckbox"></th>
                <th class="col-md-4" >PROCEDURE</th>
                
              </tr>
              @foreach($_complex as $complex)
              <tr class="table-row">
                <td>
                  <input type="checkbox" value="{{$complex->procedure_id}}"/>
                </td>
                <td class="procedure">{{$complex->procedure_name}}</td>
                
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</form>