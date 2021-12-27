<?php

include('config_api.php');

if($params[0] == "addressbalance") {
    echo file_get_contents($API_URL."/addr/".$params[1]."/balance");
    exit();
}

if($params[0] == "receivedbyaddress") {
    echo file_get_contents($API_URL."/addr/".$params[1]."/totalReceived");
    exit();
}

if($params[0] == "sentbyaddress") {
    echo file_get_contents($API_URL."/addr/".$params[1]."/totalSent");
    exit();
}

if($params[0] == "addressinfo") {
    echo file_get_contents($API_URL."/addr/".$params[1]);
    exit();
}

if($params[0] == "block") {
    echo file_get_contents($API_URL."/sync");
    exit();
}

if($params[0] == "blockinfo") {
    echo file_get_contents($API_URL."/block/".$params[1]);
    exit();
}

if($params[0] == "difficulty") {
    echo file_get_contents($API_URL."/status");
    exit();
}

if($params[0] == "price") {
    echo file_get_contents("https://api.coingecko.com/api/v3/simple/price?vs_currencies=usd&ids=zero"); 
    exit();
}

if($params[0] == "rawtx") {
    $data = array('rawtx' => $params[1]);
    $output = httpPost($API_URL.'/tx/send', $data);
    echo $output;
    exit();
}

function httpPost($url, $data) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

include('header.php');
?>
<br>

<table style="border-collapse: collapse; font: bold 24px sans-serif; width: 1160px; margin-left: 10px;">
    <tr valign="top">
        <td style="height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
            &nbsp; <b>ZeroChain Basic Query API</b>
        </td>
    </tr>
    <tr valign="top">
        <td style="background-color:rgb(255, 255, 255); padding: 10px 10px 0px 15px; font: normal 16px sans-serif; line-height: 30px;">
            <u><b><font size='5'>address-balance</font></b></u><br>
            <font color='grey'>Returns amount ever received minus amount ever sent by a given address.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/addressbalance</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/addressbalance/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/addressbalance/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK</a></font><br>
            <br>
            
            <u><b><font size='5'>received-by-address</font></b></u><br>
            <font color='grey'>Returns the amount ever received by a given address.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/receivedbyaddress</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/receivedbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/receivedbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK</a></font><br>
            <br>
            
            <u><b><font size='5'>sent-by-address</font></b></u><br>
            <font color='grey'>Returns the amount ever received by a given address.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/sentbyaddress</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/sentbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/sentbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK</a></font><br>
            <br>
            
            <u><b><font size='5'>address-info</font></b></u><br>
            <font color='grey'>Returns the information for a given address.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/addressinfo</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/addressinfo/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/addressinfo/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK</a></font><br>
            <br>
            
            <u><b><font size='5'>block</font></b></u><br>
            <font color='grey'>Returns the latest block in the chain.</font><br>
            URL<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/block' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/block</a></font><br>
            <br>
            
            <u><b><font size='5'>block-info</font></b></u><br>
            <font color='grey'>Returns the information for a given block hash.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/blockinfo</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/blockinfo/000004470879b9f99c6f263df830ca82f10935f0a164f704ae0feb90d7f8226d' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/blockinfo/000004470879b9f99c6f263df830ca82f10935f0a164f704ae0feb90d7f8226d</a></font><br>
            <br>
            
            <u><b><font size='5'>difficulty</font></b></u><br>
            <font color='grey'>Returns the last solved block's difficulty.</font><br>
            URL<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/difficulty' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/difficulty</a></font><br>
            <br>
            
            <u><b><font size='5'>price</font></b></u><br>
            <font color='grey'>Returns the last trade price.</font><br>
            URL<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/price' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/price</a></font><br>
            
        </td>
    </tr>
    <tr>
        <td style="height: 20px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 20px 20px;"></td>
    </tr>
</table>

<br>

<table style="border-collapse: collapse; font: bold 24px sans-serif; width: 1160px; margin-left: 10px;">
    <tr valign="top">
        <td style="height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
            &nbsp; <b>Push Raw Transaction</b>
        </td>
    </tr>
    <tr valign="top">
        <td style="background-color:rgb(255, 255, 255); padding: 10px 10px 0px 15px; font: normal 16px sans-serif; line-height: 30px;">
            <u><b><font size='5'>rawtx</font></b></u><br>
            <font color='grey'>Push raw transaction onto network.</font><br>
            URL<br>
            <font color='#216F8B'>https://zerochain.info/api/rawtx</font><br>
            Example<br>
            <font color='#216F8B'><a href='https://zerochain.info/api/rawtx/xxxxx-raw-data-xxxxx' style='text-decoration: none; color: #216F8B;'>https://zerochain.info/api/rawtx/xxxxx-raw-data-xxxxx</a></font><br>
        </td>
    </tr>
    <tr>
        <td style="height: 20px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 20px 20px;"></td>
    </tr>
</table>

</div></center>

<? include('footer.php'); ?>

</body>
</html>