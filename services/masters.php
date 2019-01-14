<?php
session_start();
include_once '../db_config.php';
$input = json_decode(file_get_contents('php://input'), true);
//echo json_encode(array("stat"=>$input['action'])); exit;
/*
if($con)
    echo json_encode(array("status"=>"connected"));
else
    echo json_encode(array("status"=>"not connected"));
exit;*/

if($input['action'] == 'get_cat_list')
{
    $qry = "SELECT * FROM `item_category` WHERE STATUS = 'A'";
    $res = mysqli_query($con, $qry);

    if($res)    {
        $data = array();
        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }

        echo json_encode(array("response"=>"success","data"=>json_encode($data)));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong"));
}
else if($input['action'] == 'add_category')
{
    $qry = "INSERT INTO `item_category`(`CAT_NAME`, `STATUS`) VALUES ('".$input['catdesc']."','".$input['catstat']."')";
    $res = mysqli_query($con, $qry);

    if($res)
        echo json_encode(array("response"=>"success","status"=>"Category Added Successfully"));
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong"));
}
else if($input['action'] == 'get_cat_list')
{
    $qry = "SELECT * FROM `item_category` WHERE STATUS = 'A'";
    $res = mysqli_query($con, $qry);

    if($res)    {
        $data = array();
        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }

        echo json_encode(array("response"=>"success","data"=>json_encode($data)));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong"));

}
else if($input['action'] == 'add_product')
{
    $qry = "INSERT INTO `item_master`(`ITEM_NAME`, `ITEM_DESC`, `ITEM_CATEGORY`, `ITEM_PRICE`, `ITEM_GROUP`, `QUANTITY`, `CREATED_ON`, `CREATED_BY`) VALUES ('".$input['prodname']."','".$input['proddesc']."','".$input['prodcat']."','".$input['prodprice']."','".$input['prodgroup']."','".$input['quantity']."','".date('Y-m-d H:i:s')."','uday')";
    $res = mysqli_query($con, $qry);

    if($res)
        echo json_encode(array("response"=>"success","status"=>"Product Added Successfully"));
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong","qry"=>$qry));
}
else if($input['action'] == 'get_itmgrp_list')
{

    $qry = "SELECT * FROM `item_group` WHERE STATUS = 'A'";
    if(isset($input['catid']))
        $qry .= " and CATID = ".$input['catid'];
    $res = mysqli_query($con, $qry);

    if($res)    {
        $data = array();
        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }

        echo json_encode(array("response"=>"success","data"=>json_encode($data)));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong"));
}
else if($input['action'] == 'get_products_list')
{
    $qry = "SELECT A.`SNO`, A.`ITEM_NAME`, A.`ITEM_DESC`, B.`CAT_NAME`, A.`ITEM_PRICE`, A.`ITEM_IMAGE`, C.`GROUP_DESC`, A.`QUANTITY`  FROM `item_master` A, ITEM_CATEGORY B, ITEM_GROUP C WHERE A.ITEM_CATEGORY = B.CATID AND A.ITEM_CATEGORY = C.CATID AND A.ITEM_GROUP = C.GID AND A.STATUS = 'A' ";

    if(isset($input['proditems']))
    {
        $proditems = implode(",", $input['proditems']);
        $qry .= " AND A.SNO IN (".$proditems.") ";
    }

    $res = mysqli_query($con, $qry);

    if($res)    {
        $data = array();
        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }

        echo json_encode(array("response"=>"success","data"=>json_encode($data)));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong"));

}
else if($input['action'] == 'checkout_list')
{
    $proditems = $input['proditems'];
    //echo json_encode(array("response"=>"success","data"=>$proditems[0]['pid']));


    for($i = 0; $i < count($proditems); $i++)
    {
        $qry = "INSERT INTO `item_trans_hd`(`ITEMID`, `COST`, `QUANTITY`, `DADDRESS`, `CREATED_BY`, `CREATED_ON`, `STATUS`) VALUES ('".$proditems[$i]['pid']."','".$proditems[$i]['cost']."','".$proditems[$i]['count']."','".$input['address']."','".@$_SESSION['uid']."','".date('Y-m-d H:i:s')."','A' ) ";
        mysqli_query($con, $qry);
    }

    echo json_encode(array("response"=>"success","data"=>"Transation Completed"));

}