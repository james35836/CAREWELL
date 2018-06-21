<?php


    $dashboard  = array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard");
    $settings   = array(
                    'admin_pannel'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'access_level'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'coverage_plan' => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'maintenance'   => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'provider'      => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'doctor'        => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                );



?>
 
             
                   <li style="{{$dashboard['style']}}">
                        <a href="{{$dashboard['href']}}">
                            <i class="{{$dashboard['class']}}"></i> <span>{{$dashboard['text']}}</span>
                        </a>
                    </li>
                    
                   
                    <li class="treeview" style="background-color: #03A678">
                        <a href="#">
                            <i class="fa fa-cog"></i>
                            <span>SETTINGS</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                             @foreach($settings as $item)
                            <li style="{{$item['style']}}"><a href="{{$item['href']}}"><i class="{{$item['class']}}"></i> <span>{{$item['text']}}</span></a></li>
                            @endforeach
                        </ul>
                    </li>
                    

