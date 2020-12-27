<?php
include'head.php';
if(isset($_GET['plan']) && isset($_GET['order_id']) && $_GET['plan']==0){
    $plan = $_GET['plan'];
    $order_id = $_GET['order_id'];
    
    $data = $connect2db->prepare("SELECT sub_total, month, id FROM subscriber WHERE order_id = ? AND user_id = ?");
    $data->execute([$order_id, $id]);
    $get = $data->fetch();
    $total = $get->sub_total;
    $month = $get->month;
    $subp_id = $get->id;    
    $status = 'Pending';
    $payment_status = 'Pending';
    $new_id = rand(00000,99999);
    $sub_date = date('Y-m-d');
    
    $insert = $connect2db->prepare("INSERT INTO subscriber (order_id,status,payment_status,user_id,sub_date,plan,month,sub_total) VALUES(?,?,?,?,?,?,?,?)");
    $insert->execute([$new_id, $status, $payment_status,$id,$sub_date,$plan,$month,$total]);
    $sub_id = $connect2db->lastInsertid();
    if($insert){
        $getProduct = $connect2db->prepare("SELECT quantity, product_id FROM tbl_custom_product WHERE order_id = ? AND subscription_id = ? ");
        $getProduct->execute([$order_id, $subp_id]);
        while($prd = $getProduct->fetch()){
            $newPrd = $connect2db->prepare("INSERT INTO tbl_custom_product (subscription_id,quantity,product_id,order_id) VALUES(?,?,?,?)");
            $newPrd->execute([$sub_id, $prd->quantity, $prd->product_id, $new_id]);
        }
        for($i=1;$i<=$month;$i++){
            $insData = $connect2db->prepare("INSERT INTO sub_duration(sub_id,user,delv_date,delv_status) VALUES(?,?,?,?)");
            $insData ->execute([$new_id,$id,'0000-00-00','Pending']);
        }
        
        echo "<script> alert('You Successfully Suscribed to for this Plan '); </script>";
        header('location:checkout.php?status=custom');
        
    }else{
        echo "<script> alert('Renewal Failed. Try Again'); </script>";
    }
    
   
}else if(isset($_GET['plan']) && isset($_GET['order_id']) && $_GET['plan']!=0){
        $plan = $_GET['plan'];
        $order_id = $_GET['order_id'];

        $data = $connect2db->prepare("SELECT sub_total, month, id FROM subscriber WHERE order_id = ? AND user_id = ?");
        $data->execute([$order_id, $id]);
        $get = $data->fetch();
        $total = $get->sub_total;
        $month = $get->month;
        $subp_id = $get->id;    
        $status = 'Pending';
        $payment_status = 'Pending';
        $new_id = rand(00000,99999);
        $sub_date = date('Y-m-d');

        $insert = $connect2db->prepare("INSERT INTO subscriber (order_id,status,payment_status,user_id,sub_date,plan,month,sub_total) VALUES(?,?,?,?,?,?,?,?)");
        $insert->execute([$new_id, $status, $payment_status,$id,$sub_date,$plan,$month,$total]);
        $sub_id = $connect2db->lastInsertid();
        if($insert){
            for($i=1;$i<=$month;$i++){
            $insData = $connect2db->prepare("INSERT INTO sub_duration(sub_id,user,delv_date,delv_status) VALUES(?,?,?,?)");
            $insData ->execute([$new_id,$id,'0000-00-00','Pending']);
        }
        
        echo "<script> alert('You Successfully Suscribed to for this Plan '); </script>";
        header('location:checkout.php?status=collection');
        
    }else{
        echo "<script> alert('Renewal Failed. Try Again'); </script>";
    }
}


?>