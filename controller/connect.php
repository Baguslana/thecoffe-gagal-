<?php

$con = mysqli_connect("localhost", "root", "", "thecoffe");
if(!$con){
    echo "Koneksi Gagal";
}