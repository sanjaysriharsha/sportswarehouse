<?php
include_once('models/includes/header.html');
include_once('models/includes/navbar.php');
?>

<body>
<link href="assets/custom/css/form_styles.css" rel="stylesheet" >

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
                <li class="breadcrumb-item active" aria-current="page">Category list</li>
                <li style="float:right">
                    <span style="float:right" >
                        <button type="button"  class="btn btn-info btn-sm" onclick="category_list()">Category List</button>
                    </span>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- /End Breadcrumbs -->

<!-- Start page content -->
<div class="container">
    <div class="row my-4 my-lg-5">
        <div class="col-12 col-md-10 offset-md-1 col-lg-6 offset-lg-3 text-center">
            <p class="font-20 semi-font fables-main-text-color mt-4 mb-5">Add New Category</p>
            <form class="form-horizontal" method="post" onsubmit="return add_category()">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="catdesc">Category Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="catdesc" placeholder="Enter Category Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" id="catstat" value="Y"> Status</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Submit</button>
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
<script>
    function  category_list() {
        window.location.href = "category.php";
    }

    function add_category()
    {
        var action = {"catdesc": $('#catdesc').val(),
                    "catstat": $('#catstat').is(":checked") ? 'A' : 'I'
                        , "action":"add_category" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $.ajax({
            type: 'POST',
            url: 'services/masters.php',
            data: action,
            dataType: "json"
        })
            .done(function(data){
                // show the response
                console.log(data);

                if(data['response'] == 'success')
                {
                    alert("Category Successfully Added");
                    window.location.href = "category.php";
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

</script>

