$(document).ready(function(){
    $("#ddl_sort").change(sortProducts);
    $("body").on("click", ".filter-colors", filterColors);
    $("body").on("click", ".filter-gender", filterGender);
    // $("body").on("click", ".pagination", pagination);
    $("#search-box").keyup(searchProducts);
    $("body").on("click", ".add-to-cart", addToCart);
});
function addToCart(e) {
    e.preventDefault();
    let productId = $(this).data("id");
    
    $.ajax({
        url: 'index.php?page=shop&method=addToCart',
        method: 'get',
        dataType: 'json',
        data: {
            productId: productId
        }, 
        success: (data, status, request) => {
            alert("Ubačeno u korpu!");
        },
        error: (err, status, statusText) => {
            alert("Došlo je do greške.");
        }
    });
}

function filterColors(e){
    e.preventDefault();
    let id = $(this).data("color");
        $.ajax({
        url: "index.php?page=shop&method=filterByColor",
        method: "GET",
        dataType: 'json',
        data: {
            color_id: id,
            send: "filter-color"
        },
        success: function(data){
            console.log(data);

            displayProducts(data.products);
        },
        error: function(error){
            console.log(error);
        }
    })
}
function filterGender(e){
    e.preventDefault();
    let id = $(this).data("gender");

        $.ajax({
        url: "index.php?page=shop&method=filterByGender",
        method: "GET",
        dataType: 'json',
        data: {
            gender_id: id,
            send: "filter-gender"
        },
        success: function(data){
            displayProducts(data.products);
        },
        error: function(error){
            console.log(error);
        }
    })
}
function searchProducts(){
    let input = $(this).val().trim();
    
    $.ajax({
        url: "index.php?page=shop&method=searchProducts",
        method: "GET",
        dataType: 'json',
        data: {
            input: input,
            send: "search"
        },
        success: function(data){
            displayProducts(data.products);
        },
        error: function(error){
            console.log(error);
        }
    })
}
function pagination(){
    let limit = $(this).data("limit");

    $.ajax({
        url: "models/admin/products/get_pagination.php",
        method: "GET",
        data: {
            limit: limit
        },
        success: function(data){
            console.log(data);

            displayProducts(data.products);
            displayPagination(data.num);
        },
        error: function(error){
            console.log(error);
        }
    })
        
}
function displayProducts(products){
    let user_id = $("#hdn_products").val();
    let html = "";
    products.forEach(function(product){
        html += singleProduct(product, user_id);
    });
    $("#products").html(html);
}
function singleProduct(product, user_id){
    if(user_id){
        return `<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
        <div class="block-4 text-center border">
          <figure class="block-4-image">
            <a href="index.php?page=single_product&id=${product.product_id}"><img src="${product.large}" alt="${product.title}" class="img-fluid"></a>
          </figure>
          <div class="block-4-text p-4">
            <h3><a href="index.php?page=single_product&id=${product.product_id}">${product.title}</a></h3>
            <p class="mb-0">${product.description}</p>
            <p class="text-primary font-weight-bold">$${product.price}</p>
            <p>
              <a href="index.php?page=shop" class="btn btn-sm btn-primary insert-in-cart" data-id="${product.product_id}">Shop Now</a>
            </p>
          </div>
        </div>
      </div>`;
    }else{
        return `<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
        <div class="block-4 text-center border">
          <figure class="block-4-image">
            <a href="index.php?page=single_product&id=${product.product_id}"><img src="${product.large}" alt="${product.title}" class="img-fluid"></a>
          </figure>
          <div class="block-4-text p-4">
            <h3><a href="index.php?page=single_product&id=${product.product_id}">${product.title}</a></h3>
            <p class="mb-0">${product.description}</p>
            <p class="text-primary font-weight-bold">$${product.price}</p>
            <p>
            </p>
          </div>
        </div>
      </div>`;
    }

}
function displayPagination(num){
    let html = "";
    for(let i = 0; i < num; i++){
        html += `<li><a href="#" class="pagination" data-limit="${i}">${i+1}</a></li>`;
    }
    $("#pagination").html(html);
}

function sortProducts(){
    let sort = $(this).val();
    if(sort != 0){
        $.ajax({
            url: "index.php?page=shop&method=sortProducts",
            method: "GET",
            dataType: 'json',
            data: {
                sort: sort,
            },
            success: function(data){
                displayProducts(data.products);
            },
            error: function(error){
                console.log(error);
            }
        });
    }

}