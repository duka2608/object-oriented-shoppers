<footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Sell online</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Shopping cart</a></li>
                  <li><a href="#">Store builder</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Mobile commerce</a></li>
                  <li><a href="#">Dropshipping</a></li>
                  <li><a href="#">Website development</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Point of sale</a></li>
                  <li><a href="#">Hardware</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <h3 class="footer-heading mb-4">Promo</h3>
            <a href="#" class="block-6">
              <img src="app/assets/images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
              <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
              <p>Promo from  January 15 &mdash; 25, 2019</p>
            </a>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>
            <?php if(!isset($_SESSION['user'])):?>
            <div class="block-7">
              <form action="#" method="POST">
                <label for="login_username" class="footer-heading">Log in</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="login_username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control py-4" id="login_password" placeholder="Password">
                  <input type="submit" id="login_submit" class="btn btn-sm btn-primary" value="Send">
                </div>
              </form>
              <a href="index.php?page=registration">Create account</a>
            </div>
            <?php endif;?>
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script data-cfasync="false"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="https://www.linkedin.com/in/du%C5%A1ko-stupar-a9a906197/" target="_blank">Duško Stupar - LinkedIn</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="app/assets/js/jquery-3.3.1.min.js"></script>
  <script src="app/assets/js/jquery-ui.js"></script>
  <script src="app/assets/js/popper.min.js"></script>
  <script src="app/assets/js/bootstrap.min.js"></script>
  <script src="app/assets/js/owl.carousel.min.js"></script>
  <script src="app/assets/js/jquery.magnific-popup.min.js"></script>
  <script src="app/assets/js/aos.js"></script>

  <script src="app/assets/js/main.js"></script>
  <script src="app/assets/js/user-functions.js"></script>
  <?php
    if($_GET['page'] == "shop"): 
  ?>
  <script src="app/assets/js/shop-functions.js"></script>
  <?php endif;?>
  <?php if($_GET['page'] == 'cart'):?>
    <script src="app/assets/js/cart-functions.js"></script>
  <?php endif;?>
  <?php
    if(isset($_SESSION['user']) && $_SESSION['user']->role == "administrator"):
  ?>
    <script src="app/assets/js/admin-functions.js"></script>
  <?php endif;?>
 
  </body>
</html>