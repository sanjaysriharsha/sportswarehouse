<?php session_start(); ?>
<!-- Start Fables Navigation -->
<div class="fables-navigation fables-main-background-color py-3 py-lg-0">
    <div class="container">
               <div class="row">
                   <div class="col-12 col-md-10 col-lg-9 pr-md-0">                       
                       <nav class="navbar navbar-expand-md btco-hover-menu py-lg-2">
         
                            <a class="navbar-brand pl-0" href="index.html"><img src="assets/custom/images/fables-logo.png" alt="Fables Template" class="fables-logo"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fablesNavDropdown" aria-controls="fablesNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="fables-iconmenu-icon text-white font-16"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="fablesNavDropdown"> 

                                <ul class="navbar-nav mx-auto fables-nav">   
                                    <li class="nav-item ">
                                        <a class="nav-link" href="home.php" id="sub-nav1" >
                                            Home
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="about.php" id="sub-nav3" aria-haspopup="true" aria-expanded="false">
                                            About
                                        </a>
                                    </li>

                                    <?php
                                    if(isset($_SESSION['role']) && @$_SESSION['role'] == 'Y') { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="sub-nav5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Admin
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="sub-nav5">
                                            <li><a class="dropdown-item" href="category.php">Category</a></li>
                                            <li><a class="dropdown-item" href="products.php">Products</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="contactus.php" id="sub-nav7" aria-haspopup="true" >
                                            Contact Us
                                        </a>
                                    </li>
                                </ul> 

                    </div>
                </nav>
                   </div>
                   <div class="col-12 col-md-2 col-lg-3 pr-md-0 icons-header-mobile">
                       
                    <div class="fables-header-icons">
                        <div class="dropdown"> 
                                  <a href="#_" class="fables-third-text-color dropdown-toggle right px-3 px-md-2 px-lg-4 fables-second-hover-color top-header-link max-line-height position-relative" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <span class="fables-iconcart-icon font-20"></span>
                                       <span id="fables-cart-number" class="fables-cart-number fables-second-background-color text-center">0</span>
                                    </a>
 
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                     <div class="p-3 cart-block">
                                             <div class="text-center">
                                                 <a href="checkout.php" class="fables-second-text-color border fables-second-border-color fables-btn-rounded text-center white-color p-2 px-4 font-14 fables-second-hover-background-color">Checkout</a>
                                             </div>
                                        </div>
                                  </div>
                         </div>


                        <div class="dropdown">

                            <a href="javascript:void(0)" class="fables-third-text-color fables-second-hover-color font-13 top-header-link px-3 px-md-2 px-lg-4 max-line-height" id="profilemenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" `><span class="fables-iconuser"></span></a>

                            <div class="dropdown-menu" aria-labelledby="profilemenu">
                            <?php if(!isset($_SESSION['uid'])){ ?>
                                <ul  aria-labelledby="sub-nav7" id="beforelog" >
                                    <li><a class="dropdown-item" href="signin.php">Login</a></li>
                                </ul>

                                <?php }else { ?>
                                <ul  aria-labelledby="sub-nav7" id="afterlog" >
                                    <li><a class="dropdown-item" href="javascript:void(0)">Hello Uday</a></li>
                                    <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                    <li><a class="dropdown-item" href="profile.php">Change Password</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a></li>
                                </ul>
                            <?php } ?>

                            </div>
                        </div>

                         
                    </div>
                   </div>
               </div>
    </div>
</div> 
<!-- /End Fables Navigation -->



<script>

    function logout()
    {
        var action = { "action":"logout" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $.ajax({
            type: 'POST',
            url: 'services/auth.php',
            data: action,
            dataType: "json"
        })
            .done(function(data){
                // show the response
                console.log(data);
                if(data['response'] == 'success')
                {
                    alert("You are Successfully Logged out");
                    window.localStorage.removeItem("userinfo");
                    window.location.href = "";
                }
                else
                {
                    alert("Something Went Wrong");
                }
            })
            .fail(function() {
                console.log(data);
            });

        return false;
    }

</script>