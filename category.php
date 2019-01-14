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
                <li class="breadcrumb-item active" aria-current="page">Category list</li>
                <li style="float:right">
                    <span style="float:right" >
                        <button type="button"  class="btn btn-info btn-sm" onclick="add_category()">Add Category</button>
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
            <th>Category Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="catlist">
        <tr>
            <td>John</td>
            <td>Doe</td>
            <td><button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
            </td>
            <td><span class="glyphicon glyphicon-pencil"></span></td>
        </tr>
        <tr>
            <td>Mary</td>
            <td>Moe</td>
            <td>mary@example.com</td>
        </tr>
        <tr>
            <td>July</td>
            <td>Dooley</td>
            <td>july@example.com</td>
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
    function  add_category() {
        window.location.href = "add_category.php";
    }

    function get_cat_list()
    {
        var action = { "action":"get_cat_list" };
        action = JSON.stringify(action);
        console.log(action);
        //return false;

        $('#catlist').html('<tr><td colspan="4">Loading...</td></tr>');

        $.ajax({
            type: 'POST',
            url: 'services/masters.php',
            data: action,
            dataType: "json"
        })
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
                                    '<td>'+res_arr[i]['CAT_NAME']+'</td>'+
                                    '<td>'+((res_arr[i]['STATUS'] == 'A') ? 'Active' : 'In Active')+'</td>'+
                                    '<td><button class="btn btn-sm btn-primary">Edit</button>'+
                                '<button class="btn btn-sm btn-danger">Delete</button>'+
                                '</td>'+
                                '<td><span class="glyphicon glyphicon-pencil"></span></td>'+
                                '</tr>';
                }

                if(res_arr.length == 0)
                    append = '<tr><td colspan="4">No Records Found</td></tr>';
            }
            else
            {
                append = '<tr><td colspan="4">No Records Found</td></tr>';
                alert("Something Went Wrong here");
            }

            $('#catlist').html(append);
        })
        .fail(function() {
            console.log(data);
        });

    }

    get_cat_list();

</script>

