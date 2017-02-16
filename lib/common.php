<?php
function alertMes($mes, $url)
{
    echo "<script>alert('{$mes}')</script>";

    echo "<script>window.location.href='{$url}';</script>";
}


function goBack($mes)
{
    if($mes){
        echo "<script>alert('{$mes}')</script>";
    }

    echo "<script>window.history.back();</script>";

}