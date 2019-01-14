<?php
include_once('models/includes/header.html');
include_once('models/includes/navbar.php');
?>

<body>

<!-- Loading Screen -->
<div id="ju-loading-screen">
    <div class="sk-double-bounce">
        <div class="sk-child sk-double-bounce1"></div>
        <div class="sk-child sk-double-bounce2"></div>
    </div>
</div>

<!-- Start Breadcrumbs -->
<div class="fables-light-gary-background">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="fables-breadcrumb breadcrumb px-0 py-3">
                <li class="breadcrumb-item"><a href="#" class="fables-second-text-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /End Breadcrumbs -->
<p></p><p></p>
<div class="col-12 col-md-8 col-lg-9">
    <div class="row mb-4">
        <div class="col-12 col-lg-4">
            <form>
                <div class="form-group mb-0">
                    <select class="form-control rounded-0">
                        <option value="" selected>default sorting</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-4 col-md-6 col-lg-2 offset-lg-6 text-center pl-0 d-none d-lg-block">
            <span class="fables-iconlist fa-fw fables-view-btn fables-list-btn fables-third-border-color fables-third-text-color"></span>
            <span class="fables-icongrid active fa-fw fables-view-btn fables-grid-btn fables-third-border-color fables-third-text-color"></span>
        </div>

    </div>
    <div class="row" id="prodlist">
        <!-- All Products Displayed here -->
    </div>
    <br><br>

    <div class="row">
        <p><b>Total Amount : $<span id="cartprice"></span></b></p>

    </div>



        <div class="form-row form-group">
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                <div class="input-icon">
                    <span class="fables-iconuser-register fables-input-icon mt-2 font-13"></span>
                    <textarea type="text" id="address" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="Delivary Address"></textarea>
                </div>
            </div>
            <p class="fables-product-info"><a href="javascript:void(0)" onclick="checkout()" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4">
                    <span class="fables-btn-value">Pay Now</span></a></p>

        </div>


    <br><br>
</div>

<!-- /End page content -->
<?php
include_once('models/includes/footer.html');
?>


</body>
</html>

<script>

    console.log("value  "+window.localStorage.getItem("mycart"));

    if(window.localStorage.getItem("mycart") == undefined) {
        alert("No Items Added in the cart")
        window.location.href = "home.php";
    }

    function get_prod_list()
    {
        if(window.localStorage.getItem("mycart") != undefined ) {
            var cart_arr = JSON.parse(JSON.stringify(JSON.parse(window.localStorage.getItem("mycart"))));
            $('#fables-cart-number').html(cart_arr.length);

            if(cart_arr.length == 0){
                alert("No Items Added in the cart")
                window.location.href = "home.php";
                return false;
            }
        }
        else
        {
            alert("No Items Added in the cart")
            window.location.href = "home.php";
            return false;
        }

        var proditems = new Array();
        for(var i = 0; i < cart_arr.length; i++)
            proditems[i] = cart_arr[i]['pid'];
        //window.localStorage.clear();

        var cartprice = 0;
        var action = { "action":"get_products_list" ,"proditems":proditems};
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $('#prodlist').html('<div><p>Loading...</p></div>');
        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                console.log(data);
                var append = images = '';
                var count = j = 0;
                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    for(var i = 0; i < res_arr.length; i++)
                    {
                        images = res_arr[i]['ITEM_IMAGE'];
                        images = images.split('||');

                        for(j = 0; j < cart_arr.length; j++)
                        {
                            if(cart_arr[j]['pid'] == res_arr[i]['SNO']){
                                count = cart_arr[j]['count'];
                                cartprice += res_arr[i]['ITEM_PRICE'] * count;
                                break;
                            }
                        }

                        append += '<div class="col-12 col-sm-6 col-lg-4 fables-product-block">'+
                            '<div class="card rounded-0 mb-4">'+
                            '<div class="row">'+
                            '<div class="fables-product-img col-12">'+
                            '<img class="card-img-top rounded-0" src="assets/custom/images/products/'+images[0]+'" alt="dress fashion">'+
                            '<div class="fables-img-overlay">'+
                            '<ul class="nav fables-product-btns">'+
                            '<li><a href="singleproduct.php?pid='+res_arr[i]["SNO"]+'" class="fables-product-btn"><span class="fables-iconeye"></span></a></li>'+
                            '</ul>'+
                            '</div>'+
                            '</div>'+
                            '<div class="card-body col-12">'+
                            '<h5 class="card-title mx-xl-3">'+
                            '<a href="#" class="fables-main-text-color fables-store-product-title fables-second-hover-color">'+res_arr[i]['ITEM_NAME']+'</a>'+
                            '</h5>'+
                            '<p class="store-card-text fables-fifth-text-color font-15 mx-xl-3">'+res_arr[i]["ITEM_DESC"]+'</p>'+
                            '<p class="font-15 font-weight-bold fables-second-text-color my-2 mx-xl-3">$ '+res_arr[i]["ITEM_PRICE"]+' X '+count+'</p>'+
                            '<p class="fables-product-info"><a href="javascript:void(0)" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4">'+
                            '<span class="fables-btn-value" onclick="remove_from_cart('+res_arr[i]["SNO"]+')">REMOVE</span></a></p>'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
                    }

                    if(res_arr.length == 0)
                        append = '<div><p>No Records Found</p></div>';
                }
                else
                {
                    append = '<div><p>No Records Found</p></div>';
                    alert("Something Went Wrong here");
                }

                $('#prodlist').html(append);
                $('#cartprice').html(cartprice);

            })
            .fail(function() {
                console.log(data);
            });

    }
    get_prod_list();

    function remove_from_cart(itemid)
    {
        console.log("remove_from_cart ");
        var cart_arr = new Array();
        var catflag = false;
        if(window.localStorage.getItem("mycart") != undefined)
        {
            cart_arr = JSON.parse(JSON.stringify(JSON.parse(window.localStorage.getItem("mycart"))));
            console.log("car items1 "+JSON.stringify(cart_arr));
            for(var i = 0; i < cart_arr.length; i++)
            {
                if(cart_arr[i]['pid'] == itemid)
                {
                    cart_arr.splice(i,1);
                    catflag = true;
                    break;
                }
            }

            if(cart_arr.length > 0)
            {
                window.localStorage.setItem("mycart", JSON.stringify(cart_arr));
                get_prod_list();
            }
            else{
                window.localStorage.removeItem("mycart");
                alert("No Items Added in the cart")
                window.location.href = "home.php";
            }

            console.log("car items2 "+JSON.stringify(cart_arr));
        }

    }


    function checkout(){

        if($('#address').val() == '')
        {
            alert("Please Enter Delevary Address");
            return false;
        }

        var cart_arr = JSON.parse(JSON.stringify(JSON.parse(window.localStorage.getItem("mycart"))));
        var action = { "action":"checkout_list" ,"proditems":cart_arr, "address": $('#address').val()};
        action = JSON.stringify(action);
        console.log(action);
        //return false;
        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                console.log(data);
                var count = j = 0;
                if(data['response'] == 'success')
                {
                    alert("Your Product Registration Completed, delevered soon.");
                    window.localStorage.removeItem("mycart");
                    window.location.href = "home.php";
                }
                else
                {
                    alert("Something Went Wrong here");
                }

            })
            .fail(function() {
                console.log(data);
            });

    }



</script>