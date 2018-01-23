<html lang="en">
<head>
    <title>Jquery - notification popup box using toastr JS</title>
    <link rel="stylesheet" href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <link rel="stylesheet" href="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="/assets/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/assets/plugins/timepicker/bootstrap-timepicker.min.css">
    
    <link rel="stylesheet" href="/assets/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/css/globals.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- TOASTR -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
</head>
<body>


<div class="container text-center">
    <br/>
        <h2>Jquery - notification popup box using toastr JS Plugin</h2>
    <br/>
    <button class="success btn btn-success " data-james="">Success</button>
    <input type="text" id="james"/>
    <button class="error btn btn-danger">Error</button>
    <button class="info btn btn-info">Info</button>
    <button class="warning btn btn-warning">Warning</button>
</div>  


<script type="text/javascript">
    $(".success").click(function(){
        if($('#james').val()=="2")
        {
            toastr.success('We do have the Kapua suite available.', 'Success Alert', {timeOut: 5000})
        }
        
    });


    $(".error").click(function(){
        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
    });


    $(".info").click(function(){
        toastr.info('It is for your kind information', 'Information', {timeOut: 5000})
    });


    $(".warning").click(function(){
        toastr.warning('It is for your kind warning', 'Warning', {timeOut: 5000})
    });
</script>


</body>
</html>