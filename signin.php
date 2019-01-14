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
                <li class="breadcrumb-item active" aria-current="page">Signin</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /End Breadcrumbs -->

<!-- Start page content -->
<div class="container">
    <div class="row my-4 my-lg-5">
        <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-center">
            <img src="assets/custom/images/signin-logo.png" alt="signin" class="img-fluid">
            <p class="font-20 semi-font fables-main-text-color mt-4 mb-4 mb-lg-5">Sign In Fables</p>
            <form name="loginform" method="post" onsubmit="return login()" >
                <div class="form-group">
                    <div class="input-icon">
                        <span class="fables-iconemail fables-input-icon mt-2 font-13"></span>
                        <input type="email" id="email" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input"  placeholder="Email">
                    </div>

                </div>
                <div class="form-group">
                    <div class="input-icon">
                        <span class="fables-iconpassword fables-input-icon font-19 mt-1"></span>
                        <input type="password" id="pswd" required class="form-control rounded-0 py-3 pl-5 font-13 sign-register-input" placeholder="Password">
                    </div>

                </div>
                <button type="submit" class="btn btn-block rounded-0 white-color fables-main-hover-background-color fables-second-background-color font-16 semi-font py-3">Sign in</button>
                <a href="#" class="fables-forth-text-color font-16 fables-second-hover-color underline mt-3 mb-4 m-lg-5 d-block">Forgot Password ?</a>
                <p class="fables-forth-text-color">Dont have an account ?  <a href="register.php" class="font-16 semi-font fables-second-text-color underline fables-main-hover-color ml-2">Register</a></p>
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

    function login()
    {
        var email = $('#email').val();
        var pswd = $('#pswd').val();

        var action = {"email":email, "pswd":pswd, "action":"login" };
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
                    window.localStorage.setItem("userinfo", JSON.stringify(data['userinfo']));
                    alert("You are Successfully Login to your Account");
                    console.log(window.localStorage.getItem("userinfo"));
                    window.location.href = "home.php";
                }
                else
                {
                    alert("Invalid Login Credentials");
                }
            })
            .fail(function() {
                console.log(data);
            });

        return false;
    }

</script>