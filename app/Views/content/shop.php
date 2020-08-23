<div class="site-section">
  <div class="container">
  <input type="hidden" id="hdn_products" value="<?=isset($_SESSION['user'])?$_SESSION['user']->user_id:""?>"/>
    <div class="row mb-5">
      <div class="col-md-9 order-2">

        <div class="row">
          <div class="col-md-12 mb-5">
            <div class="float-md-left mb-4"><h2 class="text-black h5">Shop All</h2></div>
            <div class="d-flex">
              <div class="dropdown mr-1 ml-md-auto">

              </div>
                <div class="col-md-6">

                <select class="form-control" id="ddl_sort" name="ddl_sort">
                <option value="0">Sort by</option>
                <?php
                  $options = [
                    [
                      "value" => 1,
                      "title" => "Name asc"
                    ],
                    [ 
                      "value" => 2,
                      "title" => "Name desc"
                    ],
                    [
                      "value" => 3,
                      "title" => "Price asc"
                    ],
                    [
                      "value" => 4,
                      "title" => "Price desc"
                    ]
                  ];
                  foreach($options as $option):
                ?>
                  <option value="<?=$option['value']?>"><?=$option['title']?></option>
                <?php endforeach;?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5" id="products">
        <?php
            foreach($data['products'] as $product):
        ?>
          <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
            <div class="block-4 text-center border">
              <figure class="block-4-image">
                <a href="#"><img src="<?= $product->large?>" alt="<?= $product->title?>" class="img-fluid"></a>
              </figure>
              <div class="block-4-text p-4">
                <h3><a href="#"><?= $product->title?></a></h3>
                <p class="mb-0"><?= $product->description?></p>
                <p class="text-primary font-weight-bold">$<?= $product->price?></p>
                <!-- Hide button if user is not signed in -->
                <?php if(isset($_SESSION['user'])):?>
                <p>
                  <a href="#" class="btn btn-sm btn-primary add-to-cart" data-id="<?= $product->product_id?>">Shop Now</a>
                </p>
                <?php endif;?>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          
        </div>
        <div class="row" data-aos="fade-up">
          <div class="col-md-12 text-center">
            <div class="site-block-27">
              <ul id="pagination">                
                <!-- pagination -->
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3 order-1 mb-5 mb-md-0">
        <div class="border p-4 rounded mb-4">
          <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
          <ul class="list-unstyled mb-0">
          <li class="mb-1"><a href="#" class="d-flex filter-gender" data-gender="0"><span>All</span> <span class="text-black ml-auto"></span></a></li>
          <?php
            $br = 0;
            foreach($data['gendersAndCount']['genders'] as $gender):
              $count = $data['gendersAndCount']['count'][$br++]->gender_count;
          ?>
            <li class="mb-1"><a href="#" class="d-flex filter-gender" data-gender="<?=$gender->id?>"><span><?=$gender->title?></span> <span class="text-black ml-auto">(<?=$count?>)</span></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="border p-4 rounded mb-4">
<!-- 
          <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3> -->
            <!-- </*?php
              $sizes = getSizes();
              foreach($sizes as $size):
                $numOfProducts = sizeProductCount($size->id);
            ?*/> -->
            <!-- <label for="s_<//?=strtolower($size->title)?>" class="d-flex">
              <input type="checkbox" id="s_<>" class="mr-2 mt-1 filter-sizes" value="<//?=$size->id?>"> <span class="text-black"><//?=$size->title?> (<//?=$numOfProducts->size_count?>)</span>
            </label> -->
            <!-- <//?php endforeach;?> -->
          <!-- </div> -->

          <div class="mb-4">
            <h3 class="mb-3 h6 text-uppercase text-black d-block">Color</h3>
            <?php
                $br = 0;
                foreach($data['colorsAndCount']['colors'] as $color):
                  $count = $data['colorsAndCount']['count'][$br++]->color_count;
            ?>
            <a href="#" data-color="<?=$color->id?>" class="d-flex color-item align-items-center filter-colors" >
              <span class="bg-<?=$color->color_code?> color d-inline-block rounded-circle mr-2"></span> <span class="text-black"><?=$color->title?> (<?=$count?>)</span>
            </a>
              <?php endforeach;?>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="site-section site-blocks-2">
            <div class="row justify-content-center text-center mb-5">
              <div class="col-md-7 site-section-heading pt-4">
                <h2>Categories</h2>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                <a class="block-2-item" href="#">
                  <figure class="image">
                    <img src="app/assets/images/women.jpg" alt="" class="img-fluid">
                  </figure>
                  <div class="text">
                    <span class="text-uppercase">Collections</span>
                    <h3>Women</h3>
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="100">
                <a class="block-2-item" href="#">
                  <figure class="image">
                    <img src="app/assets/images/children.jpg" alt="" class="img-fluid">
                  </figure>
                  <div class="text">
                    <span class="text-uppercase">Collections</span>
                    <h3>Children</h3>
                  </div>
                </a>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200">
                <a class="block-2-item" href="#">
                  <figure class="image">
                    <img src="app/assets/images/men.jpg" alt="" class="img-fluid">
                  </figure>
                  <div class="text">
                    <span class="text-uppercase">Collections</span>
                    <h3>Men</h3>
                  </div>
                </a>
              </div>
            </div>
          
        </div>
      </div>
    </div>
    
  </div>
</div>