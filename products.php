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
                <li class="breadcrumb-item active" aria-current="page">Products list</li>
                <li style="float:right">
                    <span style="float:right" >
                        <button type="button"  class="btn btn-info btn-sm" onclick="add_product()">Add Product</button>
                    </span>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- /End Breadcrumbs -->

<!-- Start page content -->
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>SNO.</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Group</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="prodlist">
        <tr>
            <td>1</td>
            <td>prod Name</td>
            <td>Desc</td>
            <td>Category</td>
            <td>Group</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>Active</td>
            <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>

</div>
<!-- /End page content -->

<?php
include_once('models/includes/footer.html');
?>

</body>
</html>
<script>
    function  add_product() {
        window.location.href = "add_product.php";
    }

    function get_prod_list()
    {
        var action = { "action":"get_products_list" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $('#catlist').html('<tr><td colspan="8">Loading...</td></tr>');

        $.ajax({type: 'POST', url: 'services/masters.php', data: action, dataType: "json"  })
            .done(function(data){
                // show the response
                console.log(data);
                var append = '';
                if(data['response'] == 'success')
                {
                    var res_arr = JSON.parse(data['data']);
                    for(var i = 0; i < res_arr.length; i++)
                    {
                        append += '<tr>'+
                            '<td>'+(i+1)+'</td>'+
                            '<td>'+res_arr[i]['ITEM_NAME']+'</td>'+
                            '<td>'+res_arr[i]['ITEM_DESC']+'</td>'+
                            '<td>'+res_arr[i]['CAT_NAME']+'</td>'+
                            '<td>'+res_arr[i]['CAT_NAME']+'</td>'+
                            '<td>'+res_arr[i]['ITEM_PRICE']+'</td>'+
                            '<td>'+res_arr[i]['GROUP_DESC']+'</td>'+
                            '<td>'+((res_arr[i]['STATUS'] == 'A') ? 'Active' : 'In Active')+'</td>'+
                            '<td><button class="btn btn-sm btn-primary">Edit</button>'+
                            '<button class="btn btn-sm btn-danger">Delete</button>'+
                            '</td>'+
                            '</tr>';
                    }

                    if(res_arr.length == 0)
                        append = '<tr><td colspan="8">No Records Found</td></tr>';
                }
                else
                {
                    append = '<tr><td colspan="8">No Records Found</td></tr>';
                    alert("Something Went Wrong here");
                }

                $('#prodlist').html(append);
            })
            .fail(function() {
                console.log(data);
            });

    }

    get_prod_list();

</script>

