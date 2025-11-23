<?php

include '../functions/products.php';

$id=$_GET['id'];

if(deleteProduct($id)){
    header('location: ../products.php');
}else{
    echo 'Delete Failed';
}