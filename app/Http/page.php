<?php
namespace App;

class page{

    public static function getPoints()
    {
        $page['dashboard']  = array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard");
    $page['settings']  = array(
                    'admin_pannel'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'access_level'  => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'coverage_plan' => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'maintenance'   => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'provider'      => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                    'doctor'        => array('access_id'=>1,'text'=>'Dashboard',  'href'=>'/dashboard','style'=>"background-color:#913D88","class"=>"fa fa-dashboard"),
                );

    return $page;
    }
}