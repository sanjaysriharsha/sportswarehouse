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

<!-- Start Top Header -->
<div class="fables-forth-background-color fables-top-header-signin">
    <div class="container">
        <div class="row" id="top-row">
            <div class="col-12 col-sm-2 col-lg-5">

            </div>
            <div class="col-12 col-sm-5 col-lg-4 text-right">
                <p class="fables-third-text-color font-13"><span class="fables-iconphone"></span> Phone :  (888) 6000 6000 - (888) 6000 6000</p>
            </div>
            <div class="col-12 col-sm-5 col-lg-3 text-right">
                <p class="fables-third-text-color font-13"><span class="fables-iconemail"></span> Email: Design@domain.com</p>
            </div>
            
        </div>
    </div>
</div>
 
<!-- /End Top Header -->

<!-- Start Header -->
<div class="fables-header fables-after-overlay">
    <div class="container"> 
         <h2 class="fables-page-title fables-second-border-color">Contacts</h2>
    </div>
</div>  
<!-- /End Header -->
     
<!-- Start Breadcrumbs -->
<div class="fables-light-background-color">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="#" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contacts </li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content --> 

    <div class="container"> 
        <div class="row overflow-hidden">
             <div class="col-12 col-md-4 text-center px-4 px-lg-5 my-4 my-lg-5 wow fadeInDown" data-wow-delay=".5s">
                  <div class="fables-second-border-color border fables-contact-block-border fables-rounded px-2">
                        <span class="fables-iconmap-icon fa-3x fables-second-text-color fables-contact-icon bg-white d-inline-block px-4"></span> 
                        <h2 class="font-16 semi-font fables-main-text-color my-3">Address Information</h2>
                        <p class="font-14 fables-forth-text-color">
                        level13, 2Elizabeth St, Melbourne,Victor 2000</p>        
                  </div> 
             </div>
             <div class="col-12 col-md-4 text-center px-4 px-lg-5 my-4 my-lg-5 wow fadeInDown" data-wow-delay=".8s">
                  <div class="fables-second-border-color border fables-contact-block-border fables-rounded px-2">
                    <span class="fables-iconphone fa-3x fables-second-text-color fables-contact-icon bg-white d-inline-block px-4"></span>
                    <h2 class="font-16 semi-font fables-main-text-color my-3">Mail & Phone number</h2>
                    <p class="font-14 fables-forth-text-color text-truncate">adminsupport@website.com</p>
                    <p class="font-14 fables-forth-text-color">+333 111 111 000</p>
                 </div> 
             </div>
             <div class="col-12 col-md-4 text-center px-4 px-lg-5 my-4 my-lg-5 wow fadeInDown" data-wow-delay="1.1s">
                 <div class="fables-second-border-color border fables-contact-block-border fables-rounded px-2">
                        <span class="fables-iconshare-icon fa-3x fables-second-text-color fables-contact-icon bg-white d-inline-block px-4"></span>
                        <h2 class="font-16 semi-font fables-main-text-color my-3">Stay In Touch</h2>
                        <ul class="nav fables-contact-social-links"> 
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f fables-forth-text-color fa-fw"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram fables-forth-text-color  fa-fw"></i></a></li> 
                            <li><a href="#" target="_blank"><i class="fab fa-twitter fables-forth-text-color    fa-fw"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin fables-forth-text-color   fa-fw"></i></a></li>
                        </ul>
                 </div> 
             </div>
        </div>        
        <div class="row mt-0 mb-4 my-md-5 overflow-hidden"> 
           <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h3 class="font-35 font-weight-bold fables-main-text-color mb-4 text-center">Contact Us</h3>
                <p class="fables-contact-text fables-forth-text-color text-center">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal </p>
           </div>  
                  
        </div>    
        <div class="row">
            <div class="col-12 wow fadeInLeft">
                <form class="fables-contact-form">
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <input type="text" class="form-control p-3 fables-rounded"  placeholder="First Name">   
                      </div>
                      <div class="form-group col-md-6">
                          <input type="text" class="form-control p-3 fables-rounded"  placeholder="Last Name">  
                      </div> 
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <input type="email" class="form-control p-3 fables-rounded" placeholder="Email"> 
                      </div>
                      <div class="form-group col-md-6">
                          <input type="text" class="form-control p-3 fables-rounded" placeholder="Subject"> 
                      </div> 
                  </div> 
                  <div class="form-row"> 
                       <div class="form-group col-md-12">
                           <textarea class="form-control p-3 fables-rounded" placeholder="Message" rows="4"></textarea>
                      </div> 
                  </div>
                  <div class="form-row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn fables-second-background-color 
                         text-white fables-btn-rounded px-7 py-2 font-20">Send</button>
                    </div>
                  </div>
                </form>
                
                   
            </div>
                
        </div> 
    </div> 
<!-- /End page content -->

<?php
include_once('models/includes/footer.html');
?>
</body>
</html>