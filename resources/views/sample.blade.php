<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function () {
    var ajaxData = {};
    var formData = new FormData();
    
    // $(document).on('click','.james1',function() 
    // {
    //   $('table').find('tr').each(function () {
    //   var currentRow = $(this).closest("tr");
    //   var col1 = currentRow.find(".timeinhh1").val(); 
    //   var col2 = currentRow.find(".timeinhh2").val(); 
    //   var data = col1 + "\n" + col2 + "\n" ;
    //   ajaxData.col1 = col1;
    //   // ajaxData.col2 = col2;
    //   // alert(data);
    //   // console.log(data);
    // });
    // });
      
    $('body').on('click','.james',function() 
    {

        $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
          url:'/samples',
          type: "post",
          data: $(".submit-form").serialize(),
          dataType:"json",
          success: function(data)
          {
            setTimeout(function()
            {
              alert();
            }, 1000);
          }
        });
     });
});
  </script>
</head>
<body>

<div class="container">
    
<form class="submit-form" method="post">
  <input type="hidden" value="{{csrf_token()}}" name="_token">
<table>
    <tr>
        // th here
    </tr>

    <tr>
        <td><input type="text" class="timeinhh1" name="name[]" value="9"></td>
        <td><input type="text" class="timeinhh2" name="gender[]"  value="12"></td>
    </tr>

    <tr>
        <td><input type="text" class="timeinhh1"  name="name[]" value="13"></td>
        <td><input type="text" class="timeinhh2" name="gender[]" value="14"></td>
    </tr>

</table>
<button type="button" class="james">Save</button>
</form>
</div>

</body>
</html>