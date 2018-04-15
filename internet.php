<?php
function is_connected()
{
    $connected = @fsockopen("www.example.com", 80); 
                                        //website, port  (try 80 or 443)
    if ($connected){
        $is_conn = true; //action when connected
        echo "Hello There";
        fclose($connected);
    }else{
        $is_conn = false; //action in connection failure
        echo "Hello Here";
    }
    return $is_conn;

}
is_connected();
?>