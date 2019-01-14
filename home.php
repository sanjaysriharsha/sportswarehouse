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
            <li class="breadcrumb-item active" aria-current="page">Store List</li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content --> 
<div class="container">
     <div class="row my-4 my-md-5">
           <div class="col-12 col-md-4 col-lg-3">
               <div class="fables-store-search mb-4">
                   <form> 
                         <div class="input-icon">
                             <span class="fables-iconsearch-icon fables-input-icon"></span>
                             <input type="text" class="form-control rounded-0 form-control rounded-0 font-14 fables-store-input pl-5 py-2"  placeholder="Search Product">
                         </div>
 
                  </form>
               </div>

               <h2 class="font-16 semi-font fables-forth-text-color fables-light-gary-background  p-3 mb-4">Product Categories</h2>
               <ul class="nav fables-forth-text-color fables-forth-before fables-store-left-list" id="prodcat">
                   <li><a href="#">BELTS</a></li>
                   <li><a href="#">BLAZERS</a></li>
               </ul>


           </div>
           <div class="col-12 col-md-8 col-lg-9"> 
                   <div class="row mb-4">
                       <div class="col-12 col-lg-4">
                           <form> 
                              <div class="form-group mb-0"> 
                                <select class="form-control rounded-0">
                                  <option value="" selected>Sorting By Price</option>
                                  <option>Low - High</option>
                                  <option>High - Low</option>
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

           </div>
     </div>

</div> 
<!-- /End page content -->
<?php
    include_once('models/includes/footer.html');
?>

    
</body>
</html>


<script>

    //window.localStorage.clear();
    function get_prod_list()
    {
        if(window.localStorage.getItem("mycart") != undefined) {
            var cart_arr = JSON.parse(JSON.stringify(JSON.parse(window.localStorage.getItem("mycart"))));
            $('#fables-cart-number').html(cart_arr.length);
        }

        //window.localStorage.clear();

        var action = { "action":"get_products_list" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $('#prodlist').html('<div><p>Loading...</p></div>');
        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                console.log(data);
                var append = images = '';
                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    for(var i = 0; i < res_arr.length; i++)
                    {
                        images = res_arr[i]['ITEM_IMAGE'];
                        images = images.split('||');

                        append += '<div class="col-12 col-sm-6 col-lg-4 fables-product-block">'+
                            '<div class="card rounded-0 mb-4">'+
                        '<div class="row">'+
                        '<div class="fables-product-img col-12">'+
                        '<img class="card-img-top rounded-0" src="assets/custom/images/products/'+images[0]+'" alt="dress fashion">'+
                        '<div class="fables-img-overlay">'+
                        '<ul class="nav fables-product-btns">'+
                        '<li><a href="singleproduct.php?pid='+res_arr[i]["SNO"]+'" class="fables-product-btn"><span class="fables-iconeye"></span></a></li>'+
                        //'<li><a href="" class="fables-product-btn"><span class="fables-iconcompare"></span></a></li>'+
                        //'<li><button class="fables-product-btn"><span class="fables-iconheart"></span></button></li>'+
                        '</ul>'+
                        '</div>'+
                        '</div>'+
                        '<div class="card-body col-12">'+
                        '<h5 class="card-title mx-xl-3">'+
                        '<a href="#" class="fables-main-text-color fables-store-product-title fables-second-hover-color">'+res_arr[i]['ITEM_NAME']+'</a>'+
                    '</h5>'+
                    '<p class="store-card-text fables-fifth-text-color font-15 mx-xl-3">'+res_arr[i]["ITEM_DESC"]+'</p>'+
                    '<p class="font-15 font-weight-bold fables-second-text-color my-2 mx-xl-3">$ '+res_arr[i]["ITEM_PRICE"]+'</p>'+
                    '<p class="fables-product-info"><a href="javascript:void(0)" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 p-2 px-2 px-xl-4">'+
                        '<span class="fables-iconcart"></span>'+
                        '<span class="fables-btn-value" onclick="add_to_cart('+res_arr[i]["SNO"]+','+res_arr[i]["ITEM_PRICE"]+')">ADD TO CART</span></a></p>'+
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
            })
            .fail(function() {
                console.log(data);
            });

    }

    get_prod_list();

    function add_to_cart(itemid, cost)
    {
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
                    catflag = true;
                    break;
                }
            }

            if(!catflag)
                cart_arr.push({'pid':itemid,"count":1,"cost":cost});

            window.localStorage.setItem("mycart", JSON.stringify(cart_arr));
           console.log("car items2 "+JSON.stringify(cart_arr));
        }
        else
        {
            cart_arr.push({'pid':itemid,"count":1,"cost":cost});
            window.localStorage.setItem("mycart", JSON.stringify(cart_arr));
            console.log("car items3 "+JSON.stringify(cart_arr));
            console.log("car items31 "+cart_arr[0]['pid']+" length "+cart_arr.length);
        }

        console.log("car items4 "+JSON.stringify(cart_arr));

        $('#fables-cart-number').html(cart_arr.length);
    }


    function get_cat_list()
    {
        var action = { "action":"get_cat_list" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $('#prodcat').html('<li>Loading...</li>');
        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                console.log(data);
                var append = '';
                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    for(var i = 0; i < res_arr.length; i++)
                        append += '<li><a href="#">'+res_arr[i]["CAT_NAME"]+'</a></li>';

                    if(res_arr.length == 0)
                        append = '<li>No Records Found</li>';
                }
                else
                {
                    append = '<li>No Records Found</li>';
                    alert("Something Went Wrong here");
                }

                $('#prodcat').html(append);
            })
            .fail(function() {
                console.log(data);
            });

    }

    get_cat_list();

</script>