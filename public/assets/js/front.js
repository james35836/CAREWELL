var front   = new front();
var resetData = [];

var formFrontReset = '<form action="/reset/password" method="post">'+
        '<div class="form-group has-feedback">'+
          '<p>Please enter your email. </p>'+
          '<p>We will email instructions on how to reset your password</p>'+
        '</div>'+
        '<div class="form-group has-feedback">'+
          '<input type="email" class="form-control" name="email" placeholder="Enter Email">'+
          '<span class="glyphicon glyphicon-envelope form-control-feedback"></span>'+
        '</div>'+
        '<hr>'+
        '<div class="row ">'+
          '<div class="front-button">'+
            '<button type="button" class=" btn btn-primary btn-block btn-flat">Reset Password</button>'+
          '</div>'+
        '</div>'+
        '<div class="row front-text" style="padding:10px;">'+
         '<p class="reset-password" style="cursor: pointer;color:#3C8DBC;">Already have an account?</p><br>'+
        '</div>'+
      '</form>';

function front()
{
  init();

  function init()
  {
    ready_document();

  }

  function ready_document()
  {
    $(document).ready(function()
    {
      reset_password();
      reset_password_submit();
    });
  }
  
  
  function reset_password()
  {
    $('body').on('click','.reset-password',function()
    {
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/reset/password',
        method: "get",
        success: function(data)
        {
          $('#showForm').html(data);
        }
      });
    });
  }
  function reset_password_submit()
  {
    $('body').on('click','.reset-password-submit',function()
    {

      var resetEmail = $('#resetEmail').val();
      alert(resetEmail);
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        url:'/reset/password/submit',
        data:{resetEmail:resetEmail},
        type: "POST",
        dataType:'text',
        success: function(data)
        {
          $('#show-error').html(data);
        }
      });
    });
  }
}