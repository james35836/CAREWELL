<?php

$_item = array(

    "dasboard"  => array('access_id'=>2,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
     "1" => array(
                    'admin_pannel'  => array('access_id'=>1,'text'=>'ADMIN PANEL',      'href'=>'/settings/admin','style'=>"background-color:#3FC380","class"=>"fa fa-user"),
                    'access_level'  => array('access_id'=>1,'text'=>'CCESS LEVEL',      'href'=>'/settings/access','style'=>"background-color:#3FC380","class"=>"fa fa-universal-access"),
                    'coverage_plan' => array('access_id'=>1,'text'=>'COVERAGE PLAN',    'href'=>'/settings/coverage','style'=>"background-color:#03A678","class"=>"fa fa-fa-circle-o"),
                    'maintenance'   => array('access_id'=>1,'text'=>'AINTENANCE',       'href'=>'/settings/maintenance','style'=>"background-color:#03A678","class"=>"fa fa-fa-circle-o"),
                    'provider'      => array('access_id'=>1,'text'=>'PROVIDER CENTER',  'href'=>'/provider','style'=>"background-color:#049372","class"=>"fa fa-hospital-o"),
                    'doctor'        => array('access_id'=>1,'text'=>'DOCTOR CENTER',    'href'=>'/doctor','style'=>"background-color:#1E824C","class"=>"fa fa-user-md"),
                ),
    "company"   => array('access_id'=>1,'text'=>'COMPANY CENTER',   'href'=>'/company',     'style'=>"background-color:#C0392B","class"=>"fa fa-building-o"),
    "member"    => array('access_id'=>3,'text'=>'MEMBER CENTER',    'href'=>'/member',      'style'=>"background-color:#446CB3","class"=>"fa fa-user"),
    "billing"   => array('access_id'=>1,'text'=>'BILLING',        'href'=>'/billing',     'style'=>"background-color:#E87E04","class"=>"fa fa-credit-card"),
    "availment" => array('access_id'=>2,'text'=>'AVAILMENT',        'href'=>'/availment',   'style'=>"background-color:#336E7B","class"=>"fa fa-medkit"),
    "payable"   => array('access_id'=>7,'text'=>'PAYABLE',        'href'=>'/payable',     'style'=>"background-color:#F64747","class"=>"fa fa-paypal"),
    "2"   => array(
                    'first'     => array('access_id'=>1,'text'=>'AVAILMENT',            'href'=>'/reports/availment_per_month',         'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'second'    => array('access_id'=>1,'text'=>'COMPANY AVAILMENT',    'href'=>'/reports/company_availment',           'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'third'     => array('access_id'=>1,'text'=>'MONITORING',           'href'=>'/reports/availment_monitoring',        'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'fourth'    => array('access_id'=>1,'text'=>'PAYMENT REPORT',       'href'=>'/reports/payment_report',              'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'fifth'     => array('access_id'=>1,'text'=>'ENDING NUMBER',        'href'=>'/reports/ending_number_per_month',     'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'sixth'     => array('access_id'=>1,'text'=>'BREAKDOWN',            'href'=>'/reports/breakdown',                   'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                    'seventh'   => array('access_id'=>1,'text'=>'BREAKDOWN',            'href'=>'/reports/active_per_month',            'style'=>"background-color:#26A65B","class"=>"fa fa-circle-o"),
                ),
   
    );
$user = array(3,2,4,7,1);
?>

@foreach($_item as $key=>$item)

    @if(array_key_exists('access_id',$item))
        @if(in_array($item['access_id'], $user))
        <li style="{{$item['style']}}"><a href="{{$item['href']}}"><i class="{{$item['class']}}"></i> <span>{{$item['text']}}</span></a></li>
        @endif
    @else
    <?php
    if($key=="1")
    {
        $list = array('access_id'=>1,'text'=>'SETTINGS',  'href'=>'#','style'=>"background-color:#03A678","class"=>"fa fa-cog");
    }
    else if($key=="2")
    {
        $list  = array('access_id'=>1,'text'=>'REPORTS',  'href'=>'#','style'=>"background-color:#1BBC9B","class"=>"fa fa-bar-chart");
    }
    ?>
        @if(in_array($key, $user))
        <li class="treeview" style="{{$list['style']}}">
            <a href="#"><i class="{{$list['class']}}"></i><span>{{$list['text']}}</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
                @foreach($item as $sub_item)
                <li style="{{$sub_item['style']}}"><a href="{{$sub_item['href']}}"><i class="{{$sub_item['class']}}"></i> <span>{{$sub_item['text']}}</span></a></li>
                @endforeach
            </ul>
        </li>
        @endif
    @endif
@endforeach
                    

