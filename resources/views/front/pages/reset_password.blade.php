{{csrf_field()}}
  <div class="form-group has-feedback " id="show-error">
    <p>Please enter your email. </p>
    <p>We'll email instructions on how to reset your password</p>
  </div>
  <div class="form-group has-feedback">
    <input type="email" class="form-control" id="resetEmail" name="email" placeholder="Enter Email">
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <hr>
  <div class="row ">
    <div class="front-button">
      <button type="button" class="btn btn-primary btn-block btn-flat reset-password-submit">Reset Password</button>
    </div>
  </div>
  <div class="row front-text" style="padding:10px;">
    <a href="/login">Already have an account?</a><br>
  </div>