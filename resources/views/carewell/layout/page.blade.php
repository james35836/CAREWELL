<?php

$_item = array(

    "dasboard" => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
     "settings" => array(
                    'admin_pannel'  => array('access_id'=>1,'text'=>'ADMIN PANEL',  'href'=>'/settings/admin','style'=>"background-color:#3FC380","class"=>"fa fa-user"),
                    'access_level'  => array('access_id'=>1,'text'=>'CCESS LEVEL',  'href'=>'/settings/access','style'=>"background-color:#3FC380","class"=>"fa fa-universal-access"),
                    'coverage_plan' => array('access_id'=>1,'text'=>'COVERAGE PLAN',  'href'=>'/settings/coverage','style'=>"background-color:#03A678","class"=>"fa fa-fa-circle-o"),
                    'maintenance'   => array('access_id'=>1,'text'=>'AINTENANCE',  'href'=>'/settings/maintenance','style'=>"background-color:#03A678","class"=>"fa fa-fa-circle-o"),
                    'provider'      => array('access_id'=>1,'text'=>'PROVIDER CENTER',  'href'=>'/provider','style'=>"background-color:#049372","class"=>"fa fa-hospital-o"),
                    'doctor'        => array('access_id'=>1,'text'=>'DOCTOR CENTER',  'href'=>'/doctor','style'=>"background-color:#1E824C","class"=>"fa fa-user-md"),
                ),
    "company" => array('access_id'=>1,'text'=>'COMPANY CENTER',  'href'=>'/company','style'=>"background-color:#C0392B","class"=>"fa fa-building-o"),
    "member" => array('access_id'=>1,'text'=>'MEMBER CENTER',  'href'=>'/member','style'=>"background-color:#446CB3","class"=>"fa fa-fa-user"),
    "billing" => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/billing','style'=>"background-color:#E87E04","class"=>"fa fa-credit-card"),
    "availment" => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/availment','style'=>"background-color:#336E7B","class"=>"fa fa-medkit"),
    "payable" => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/payable','style'=>"background-color:#F64747","class"=>"fa fa-paypal"),
    "reports" => array(
                    'admin_pannel'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'access_level'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'coverage_plan' => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'maintenance'   => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'provider'      => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'doctor'        => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                ),
   
    );

?>
<ul class="treeview-menu">
                            <li style="background-color:#26A65B"><a href="/reports/availment_per_month"><i class="fa fa-circle-o"></i>AVAILMENT</a></li>
                            <li style="background-color:#26A65B"><a href="/reports/company_availment"><i class="fa fa-circle-o"></i><span style="font-size:12px;">COMPANY AVAILMENT</span></a></li>
                            <li style="background-color:#26A65B"><a href="/reports/availment_monitoring"><i class="fa fa-circle-o"></i>MONITORING</a></li>
                            <li style="background-color:#26A65B"><a href="/reports/payment_report"><i class="fa fa-circle-o"></i>PAYMENT REPORT</a></li>
                            <li style="background-color:#26A65B"><a href="/reports/ending_number_per_month"><i class="fa fa-circle-o"></i>ENDING NUMBER</a></li>
                            <li style="background-color:#26A65B"><a href="/reports/breakdown"><i class="fa fa-circle-o"></i>BREAKDOWN</a></li>
                            
                        </ul>



@foreach($_item as $key=>$item)
@if(array_key_exists('access_id',$item))
<li style="{{$item['style']}}"><a href="{{$item['href']}}"><i class="{{$item['class']}}"></i> <span>{{$item['text']}}</span></a></li>
@else
<?php
if($key=="settings")
{
    $list = array('access_id'=>1,'text'=>'SETTINGS',  'href'=>'#','style'=>"background-color:#03A678","class"=>"fa fa-cog");
}
else
{
    $list  = array('access_id'=>1,'text'=>'REPORTS',  'href'=>'#','style'=>"background-color:#1BBC9B","class"=>"fa fa-bar-chart");
}
?>
<li class="treeview" style="{{$list['style']}}">
    <a href="#">
        <i class="{{$list['class']}}"></i>
        <span>{{$list['text']}}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        @foreach($item as $sub_item)
        <li style="{{$sub_item['style']}}"><a href="{{$sub_item['href']}}"><i class="{{$sub_item['class']}}"></i> <span>{{$sub_item['text']}}</span></a></li>
        @endforeach
    </ul>
</li>
@endif
@endforeach
                    

