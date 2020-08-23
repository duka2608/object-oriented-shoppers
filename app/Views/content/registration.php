<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <h2 class="h3 mb-3 text-black">
      <?php
          if(!isset($_SESSION['user'])):
      ?>
          Registration
          <?php elseif($_SESSION['user']->role == "administrator"):?>
            Insert user
      <?php endif;?>
        
      </h2>
      </div>
      <div class="col-md-7">

        <form action="#" method="POST">
          
          <div class="p-3 p-lg-5 border">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_fname" name="f_name">
              </div>
              <div class="col-md-6">
                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_lname" name="l_name">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_email" class="text-black">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="c_email" name="email" placeholder="">
              </div>
            </div>            
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_username" class="text-black">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="c_username" name="username">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_password" class="text-black">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="c_password" name="password">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12">
                <label for="c_password_repeat" class="text-black">Repeat Password <span class="text-danger">*</span></label>
                <input type="password" disabled="true" class="form-control" id="c_password_repeat" name="c_password_repeat">
              </div>
            </div>
            <!-- <div class="form-group row">
              <div class="col-md-12">
                <label for="c_message" class="text-black">Message </label>
                <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
              </div>
            </div> -->
            <div class="form-group row">
              <div class="col-lg-12">
                <input type="submit" name="send" class="btn btn-primary btn-lg btn-block" id="idRegister" value="Register">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-5 ml-auto">
        <div class="p-4 border mb-3">
          <span class="d-block text-primary h6 text-uppercase">New York</span>
          <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
        </div>
        <div class="p-4 border mb-3">
          <span class="d-block text-primary h6 text-uppercase">London</span>
          <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
        </div>
        <div class="p-4 border mb-3">
          <span class="d-block text-primary h6 text-uppercase">Canada</span>
          <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
        </div>
        <div class="p-4 border mb-3">
          <span class="d-block text-primary h6 text-uppercase">Canada</span>
          <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
        </div>
        <div class="p-4 border mb-3">
          <span class="d-block text-primary h6 text-uppercase">Canada</span>
          <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
        </div>
        

      </div>
    </div>
  </div>
</div>