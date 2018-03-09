<?php ?>
<?php $ip = getenv("REMOTE_ADDR");
$addr_details = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
$country = stripslashes(ucfirst($addr_details['geoplugin_countryName']));
dd($addr_details);

 ?>