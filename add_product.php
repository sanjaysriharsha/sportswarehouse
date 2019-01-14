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
                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                <li style="float:right">
                    <span style="float:right" >
                        <button type="button"  class="btn btn-info btn-sm" onclick="products_list()">Products List</button>
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
            <p class="font-20 semi-font fables-main-text-color mt-4 mb-5">Add New Product</p>
            <form class="form-horizontal" method="post" onsubmit="return add_product()">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="prodname">Product Name:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="prodname" placeholder="Enter Product Name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="proddesc">Description:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="proddesc" placeholder="Enter Product Description" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="prodcat">Product Category:</label>
                    <div class="col-sm-8">
                        <select name="prodcat" id="prodcat" class="form-control" required onblur="get_itmgrp_list()">
                            <option value="" >-- Select --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4" for="prodgroup">Product Group:</label>
                    <div class="col-sm-8">
                        <select name="prodgroup" id="prodgroup" class="form-control" required>
                            <option value="" >-- Select --</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="prodprice">Product Price:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="prodprice" value="0" placeholder="Enter Price" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="quantity">Quantity:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="quantity" value="0" placeholder="Enter Quantity" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4" for="prodfile">Product Image:</label>
                    <div class="col-sm-8">
                        Select files: <input type="file" name="prodfile" accept="image/*" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" id="prodstat" value="Y" checked > Status</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
    function  products_list() {
        window.location.href = "products.php";
    }

    function add_product()
    {
        var action = {
                "prodname": $('#prodname').val(),
                "proddesc": $('#proddesc').val(),
                "prodcat": $('#prodcat').val(),
                "prodgroup": $('#prodgroup').val(),
                "prodprice": parseInt($('#prodprice').val()),
                "quantity": parseInt($('#quantity').val()),
                "prodfile": $('#prodfile').val(),
            "prodstat": $('#prodstat').is(":checked") ? 'A' : 'I'
            , "action":"add_product" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $.ajax({type: 'POST',url: 'services/masters.php',data: action,dataType: "json" })
            .done(function(data){
                // show the response
                console.log(data);

                if(data['response'] == 'success')
                {
                    alert("Product Successfully Added");
                    window.location.href = "products.php";
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

    function get_cat_list()
    {
        var action = {"action":"get_cat_list" };
        action = JSON.stringify(action);
        //console.log(action);
        //return false;

        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                //console.log(data);

                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    var append = '<option value="">-- Select --</option>';
                    for(var i = 0; i < res_arr.length; i++)
                        append += '<option value="'+res_arr[i]["CATID"]+'" >'+res_arr[i]["CAT_NAME"]+'</option>';

                    $('#prodcat').html(append);
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
    function get_itmgrp_list()
    {
        if($('#prodcat').val() == null)
            return false;

        var action = {"catid":$('#prodcat').val(),"action":"get_itmgrp_list" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                //console.log(data);

                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    var append = '<option value="">-- Select --</option>';
                    for(var i = 0; i < res_arr.length; i++)
                        append += '<option value="'+res_arr[i]["GID"]+'" >'+res_arr[i]["GROUP_DESC"]+'</option>';

                    $('#prodgroup').html(append);
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

    get_cat_list();
    //get_itmgrp_list();

</script>

