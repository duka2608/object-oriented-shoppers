$(document).ready(function () {
    $(".btn-dlt").click(deleteProduct);
    $("#clear-cart").click(emptyCart);
});

function deleteProduct(e){
    e.preventDefault();
    let id = $(this).data("id");
    $.ajax({
        url: 'index.php?page=cart&method=removeFromCart',
        method: 'POST',
        dataType: 'json',
        data:{
            id: id
        },
        success: function(data, status, request){
            alert("Uspesno obrisan proizvod.");
            document.location.reload(true);
        },
        error: ajaxErrors
    });
}

function emptyCart(e){
    e.preventDefault();
    $.ajax({
        url: 'index.php?page=cart&method=emptyCart',
        method: 'POST',
        dataType: 'json',
        data:{
            delete: true
        },
        success: function(data, status, request){
            alert("Uspesno ispraznjena korpa.");
            document.location.reload(true);
        },
        error: ajaxErrors
    });
}