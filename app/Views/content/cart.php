<div class="site-section">
  <div class="container" id="container-message">
    <?php if($data['products']):?>
        <div class="row mb-5">
        <form class="col-md-12" method="post">
            <div class="site-blocks-table">
            <table class="table table-bordered" id="cart-table">
                <thead>
                <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Description</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach($data['products'] as $product):
                ?>
                <tr>
                    <td class="product-thumbnail">
                    <img src="<?=$product->small?>" alt="<?=$product->title?>" class="img-fluid"/>
                    </td>
                    <td class="product-name">
                    <h2 class="h5 text-black"><?=$product->title?></h2>
                    </td>
                    <td>
                        <h3 class="h5 text-black"><?=$product->price?>$</h3>
                    </td>
                    <td>
                        <span class="text-black"><?=$product->description?></span>
                    </td>
                    <td>$<?=$product->price?></td>
                    <td><a href="#" data-id="<?=$product->productId?>" class="btn btn-primary btn-sm dlt-product btn-dlt">Delete</a></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </form>
        </div>
        <div class="row">
      <div class="col-md-6">
        <div class="row mb-5">
          <div class="col-md-6 mb-3 mb-md-0">
            <button class="btn btn-primary btn-sm btn-block" id="clear-cart">Empty cart</button>
          </div>
          <div class="col-md-6">
            <a href = "index.php?page=shop" class="btn btn-primary btn-sm">Continue Shopping</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="text-black h4" for="coupon">Coupon</label>
            <p>Enter your coupon code if you have one.</p>
          </div>
          <div class="col-md-8 mb-3 mb-md-0">
            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
          </div>
          <div class="col-md-4">
            <button class="btn btn-primary btn-sm">Apply Coupon</button>
          </div>
        </div>
      </div>
      <div class="col-md-6 pl-5">
        <div class="row justify-content-end">
          <div class="col-md-7">
            <div class="row">
            </div>

            <div class="row">
              <div class="col-md-12">
                <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='index.php?page=shop'">Proceed To Checkout</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php else:?>
    <div class="row mb5">
        <h1>Your cart is empty!</h1>
    </div>
    <?php endif;?>
    
  </div>
</div>