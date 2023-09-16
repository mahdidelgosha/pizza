<?php

$conn = mysqli_connect('localhost:3307','root','mahdi@#200','pizzas');

if (!$conn){
    echo 'connection eroor' . mysqli_connect_error();
}