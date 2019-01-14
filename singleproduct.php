<?php
include_once('models/includes/header.html');
include_once('models/includes/navbar.php');
include_once('db_config.php');

if(isset($_GET['pid']))
{
    $qry = " SELECT A.`SNO`, A.`ITEM_NAME`, A.`ITEM_DESC`, B.`CAT_NAME`, A.`ITEM_PRICE`, A.`ITEM_IMAGE`, C.`GROUP_DESC`, A.`QUANTITY`  FROM `item_master` A, ITEM_CATEGORY B, ITEM_GROUP C WHERE A.ITEM_CATEGORY = B.CATID AND A.ITEM_CATEGORY = C.CATID AND A.ITEM_GROUP = C.GID AND A.STATUS = 'A' and A.SNO = ".$_GET['pid'];
    $res = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($res);
    //echo json_encode($row);

    $images = $row['ITEM_IMAGE'];
    $images = explode("||", $images);
}
else
    header('Location:home.php');


?>

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
            <li class="breadcrumb-item"><a href="#" class="fables-second-text-color"><?php echo $row['CAT_NAME']; ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $row['ITEM_NAME']; ?></li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content -->   
<div class="container"> 
     <div class="row my-4 my-md-5">
          <div class="col-12 col-lg-6">
                 <div class="fables-single-slider store-single-slider">
                     <div id="sync1" class="owl-carousel owl-theme">
                         <?php
                         for($i = 0; $i < sizeof($images); $i++)
                         {
                            echo '<div class="item">
                                    <img src="assets/custom/images/products/'.$images[$i].'" alt="" class="w-100">
                                  </div>';
                         }
                         ?>

                        </div>
                     <div id="sync2" class="owl-carousel owl-theme">
                         <?php
                         for($i = 0; $i < sizeof($images); $i++)
                         {
                             echo '<div class="item">
                                    <img src="assets/custom/images/products/'.$images[$i].'" alt="" class="w-100">
                                  </div>';
                         }
                         ?>

                        </div> 
                 </div>
          </div> 
          <div class="col-12 col-lg-6 col-12 col-lg-6 mt-3 mt-lg-0">
              <h2 class="fables-main-text-color font-20 semi-font"><?php echo $row['ITEM_NAME']; ?></h2>
          
              <div class="fables-forth-text-color fables-single-tags mt-3">
                  <span class="fables-fifth-text-color fables-icontags"></span> 
                  <a href="#"><?php echo $row['CAT_NAME']; ?></a>
                  <a href="#"><?php echo $row['GROUP_DESC']; ?></a>
              </div>
              
              <p class="fables-forth-text-color font-15 my-3">
                  <?php echo $row['ITEM_DESC']; ?>
              </p>
              
              <div class="row mb-5">
                  <div class="col-5 col-md-3">
                      <span class="fables-fifth-text-color"> COLORS : </span>
                  </div>                          
                  <div class="col-7 col-sm-6">                             
                      <ul class="nav">
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #E54D42;"></span>
                              </label> 
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #343434;"></span>
                              </label>
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox" checked="checked">
                                  <span class="checkmark" style="background-color: #E3C38E;"></span>
                              </label>
                         </li>
                         <li>
                             <label class="fable-product-color">
                                  <input type="checkbox">
                                  <span class="checkmark" style="background-color: #CDCDCD;"></span>
                              </label>
                         </li>

                      </ul>
                  </div>
              </div> 
              <div class="row mb-5">
                  <div class="col-12 col-sm-7 text-center text-md-left"> 
                      <span class="fables-fifth-text-color"><span class="fables-iconprice"></span> Price :</span> 
                      <span class="fables-second-text-color font-20 font-weight-bold">$<?php echo $row['ITEM_PRICE']; ?></span>
                  </div>
                  <div class="col-9 col-md-4 col-lg-5 mt-3 mt-sm-0 mr-auto ml-auto mr-md-0 ml-md-auto">
                      <div class="fables-calc fables-light-background-color fables-btn-rouned">
                          <span  class="calc-btn minus fables-forth-text-color float-left calc-width mt-2">-</span> 
                          <span class="calc-width">
                              <input type="text" id="input-val" class="form-control d-inline-block border text-center form-circle-input rounded-circle">
                          </span>
                          <span  class="calc-btn plus fables-forth-text-color float-right calc-width mt-2">+</span>
                      </div>
                  </div>
              </div> 
            
              <div class="row mb-5">
                  <div class="col-4">
                        <a href="javascript:void(0)" onclick="add_to_cart('<?php echo $row["SNO"]; ?>','<?php echo $row["ITEM_PRICE"]; ?>','checkout')" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 px-4 py-2 semi-font">
                        <span class="fables-iconcart"></span> 
                        <span class="fables-btn-value">Buy Now</span></a>
                  </div>
                  <div class="col-4">
                        <a href="javascript:void(0)" class="btn fables-second-border-color fables-second-text-color fables-btn-rouned fables-hover-btn-color font-14 px-4 py-2 semi-font" onclick="add_to_cart('<?php echo $row["SNO"]; ?>','<?php echo $row["ITEM_PRICE"]; ?>')" >
                        <span class="fables-iconcart"></span>
                        <span class="fables-btn-value">ADD To Cart</span></a>
                  </div>
                  <div class="col-4 text-right">
                         <a href="" class="btn fables-product-btn text-white fables-forth-background-color rounded-circle fables-second-hover-background-color p-0"><span class="fables-iconcompare"></span></a> 
                        <button class="btn text-white fables-product-btn fables-forth-background-color rounded-circle fables-second-hover-background-color p-0"><span class="fables-iconheart"></span></button>
                       
                  </div>
              </div> 

          </div> 
     </div>
     <div class="row">
        <div class="col-12">
            <nav class="fables-single-nav">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="fables-single-item nav-link fables-forth-text-color fables-second-active fables-second-hover-color fables-forth-after px-3 px-md-5 font-15 semi-font border-0 active rounded-0 py-3" id="nav-desc-tab" data-toggle="tab" href="#nav-desc" role="tab" aria-controls="nav-desc" aria-selected="true">DESCRIPTION</a>
          </div>
        </nav>
            <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-desc" role="tabpanel" aria-labelledby="nav-desc-tab">
              <p class="fables-single-info mt-4 font-15 fables-fifth-text-color">
                  It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
              </p>
          </div>
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

    if(window.localStorage.getItem("mycart")) {
        var cart_arr = JSON.parse(JSON.stringify(JSON.parse(window.localStorage.getItem("mycart"))));
        console.log("cart length "+cart_arr.length);
        $('#fables-cart-number').html(cart_arr.length);
    }

    function add_to_cart(itemid,cost,callfrom)
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
                    cart_arr[i]['count'] = $('#input-val').val();
                    catflag = true;
                    break;
                }
            }

            if(!catflag)
              cart_arr.push({'pid':itemid,"count":$('#input-val').val(),"cost":cost});

            window.localStorage.setItem("mycart", JSON.stringify(cart_arr));
            console.log("car items2 "+JSON.stringify(cart_arr));
        }
        else
        {
            cart_arr.push({'pid':itemid,"count":$('#input-val').val()});
            window.localStorage.setItem("mycart", JSON.stringify(cart_arr));
            console.log("car items3 "+JSON.stringify(cart_arr));
        }

        console.log("car items4 "+JSON.stringify(cart_arr));
        $('#fables-cart-number').html(cart_arr.length)

        if(callfrom != undefined)
            window.location.href = "checkout.php";
    }


</script>