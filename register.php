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
<div class="fables-light-background-color">
    <div class="container"> 
        <nav aria-label="breadcrumb">
          <ol class="fables-breadcrumb breadcrumb px-0 py-3">
            <li class="breadcrumb-item"><a href="#" class="fables-second-text-color">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register</li>
          </ol>
        </nav> 
    </div>
</div>
<!-- /End Breadcrumbs -->
     
<!-- Start page content -->   
<div class="container">
     <div class="row my-4 my-lg-5">
          <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 text-center">
               <img src="assets/custom/images/signin-logo.png" alt="signin" class="img-fluid">
               <p class="font-20 semi-font fables-main-text-color mt-4 mb-5">Create a new account</p>
               <form name="registerform" onsubmit="return register()" method="post"  >
                  <div class="form-row form-group">
                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                        <div class="input-icon">
                              <span class="fables-iconuser-register fables-input-icon mt-2 font-13"></span>
                              <input type="text" id="fname" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="First name">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-icon">
                              <span class="fables-iconuser-register fables-input-icon mt-2 font-13"></span>
                              <input type="text" id="lname" class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="Last name">
                        </div>
                    </div>
                  </div>
                  <div class="form-group"> 
                      <div class="input-icon">
                          <span class="fables-iconemail fables-input-icon mt-2 font-13"></span>
                          <input type="email" id="email" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input"  placeholder="Email" onblur="verify_user(this.value)">
                      </div>
                    
                  </div>
                   <div class="form-group">
                      <div class="input-icon">
                          <span class="fables-iconemail fables-input-icon mt-2 font-13"></span>
                          <input type="text" id="contactno" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input"  placeholder="Contact No.">
                      </div>

                  </div>
                  <div class="form-group"> 
                      <div class="input-icon">
                         <span class="fables-iconpassword fables-input-icon font-19 mt-1"></span>
                         <input type="password" id="pswd" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="Password">
                      </div>
                    
                  </div> 
                  <div class="form-group"> 
                      <div class="input-icon">
                         <span class="fables-iconpassword fables-input-icon font-19 mt-1"></span>
                         <input type="password" id="rpswd" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="Repeat Password">
                      </div>
                    
                  </div> 
                  <button type="submit" class="btn btn-block rounded-0 white-color fables-main-hover-background-color fables-second-background-color font-16 semi-font py-3">Register Now</button>
                  <a href="#" class="fables-forth-text-color font-16 fables-second-hover-color underline mt-3 mb-4 mb-lg-5 d-block">Forgot Password ?</a>
                  <p class="fables-forth-text-color">Already have an account ?  <a href="signin.php" class="font-16 semi-font fables-second-text-color underline fables-main-hover-color ml-2">Login</a></p>
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


<script>

    function register()
    {
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var contactno = $('#contactno').val();
        var pswd = $('#pswd').val();
        var rpswd = $('#rpswd').val();

        if(pswd != rpswd)
        {
            alert("Confirm Password not matched");
            return false;
        }

        var action = {"fname": fname, "lname": lname, "email":email, "contactno": contactno, "pswd":pswd, "action":"register" };
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
                    $('#fname').val('');
                    $('#lname').val('');
                    $('#email').val('');
                    $('#contactno').val('');
                    $('#pswd').val('');
                    $('#rpswd').val('');

                    alert("You are Successfully Registred, Please login with your Email ID");
                }
                else
                {
                    alert("Something Went Wrong here");
                }
            })
            .fail(function() {
                console.log(data);
            });

        return false;
    }

    function verify_user(email)
    {
        if(email == '' || email == undefined)
            return false;
        var action = {"email":email, "action":"verify_user" };
        action = JSON.stringify(action);
        console.log(action);

        $.ajax({
            type: 'POST',
            url: 'services/auth.php',
            data: action,
            dataType: "json"
        })
            .done(function(data){
                // show the response
                console.log(data);

                if(data['count'] > 0)
                {
                    $('#email').val('');
                    alert("Email Id Already Exists");
                }
            })
            .fail(function() {
                console.log(data);
            });

    }


</script>