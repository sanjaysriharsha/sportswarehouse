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

if($input['action'] == 'register')
{
    $qry = "INSERT INTO `users`(`USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MAILID`, `CONTACT_NO`, `PASSWORD`, `CREATED_ON`) VALUES ('".$input['email']."','".$input['fname']."','".$input['lname']."','".$input['email']."','".$input['contactno']."','".$input['pswd']."','".date('Y-m-d H:i:s')."') ";

    $res = mysqli_query($con, $qry);

    if($res)    {
        echo json_encode(array("response"=>"success","status"=>"Successfully Registered","qry"=>$qry));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Something Went Wrong","qry"=>$qry,"data" =>date('Y-m-d H:i:s')));
}
else if($input['action'] == 'verify_user')
{
    //$qry = "sql query";
    $qry = "select count(*) cnt from users where MAILID = '".$input['email']."'";
    $res = mysqli_query($con, $qry);
    $cnt = mysqli_fetch_row($res);

    //echo json_encode(array("stat"=>$input['action'], "qry"=>$qry));
    //echo json_encode(array("response"=>"success"));

        //echo $cnt;
    echo json_encode(array("response"=>"success","count"=>$cnt[0]));
}
else if($input['action'] == 'login')
{
    $qry = "select SNO, FIRST_NAME, ISADMIN from users where MAILID = '".$input['email']."' and PASSWORD = '".$input['pswd']."'";
    $res = mysqli_query($con, $qry);

    if($res)
    {
        while($row = mysqli_fetch_assoc($res))
        {
            $_SESSION['email'] = $input['email'];
            $_SESSION['uname'] = $row['FIRST_NAME'];
            $_SESSION['uid'] = $row['SNO'];
            $_SESSION['role'] = $row['ISADMIN'];
        }

        echo json_encode(array("response"=>"success","status"=>"Login Success","userinfo"=> array("uid"=>$_SESSION['uid'], "uname"=>$_SESSION['uname'] ) ));
    }
    else
        echo json_encode(array("response"=>"failed","status"=>"Login Failed"));
}
else if($input['action'] == 'logout')
{
    session_destroy();
    echo json_encode(array("response"=>"success","status"=>"Logout success"));
}
