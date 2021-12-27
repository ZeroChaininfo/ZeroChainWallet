<?php

$hash = $params[0];

if( strlen($hash) <> 64) {
    header("Location: https://zerochain.info/home"); 
    exit();
}

include('config_api.php');

include('header.php');
?>
<br>

<table style="border-collapse: collapse; font: bold 24px sans-serif; width: 1160px; margin-left: 10px;">
    <tr valign="top">
        <td style="height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
            &nbsp; <title1 id="bi_n"><b>Block #</b></title1>
        </td>
    </tr>
    <tr valign="top">
        <td style="height: 250px; background-color:rgb(255, 255, 255); padding: 10px 10px 0px 10px;">
            Details<br>
            <table style="width: 100%; padding-left: 10px; font-size: 18px;">
                <tr class="tr_row"><td class="td_row td_row_2">Hash:</td> <td><title1 id="bi_hash" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Previous Block:</td> <td><title1 id="bi_prev" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Next Block:</td> <td><title1 id="bi_next" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Height:</td> <td><title1 id="bi_h" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Version:</td> <td><title1 id="bi_ver" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Transaction Merkle Root:</td> <td><title1 id="bi_mer" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Time:</td> <td><title1 id="bi_date" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Difficulty:</td> <td><title1 id="bi_diff" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Transactions:</td> <td><title1 id="bi_txn" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Confirmations:</td> <td><title1 id="bi_cnf" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Size:</td> <td><title1 id="bi_size" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Reward:</td> <td><title1 id="bi_rwd" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Nonce:</td> <td><title1 id="bi_no" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Chain Network:</td> <td><title1 id="bi_chn" class="td_row td_row_2"></title1></td></tr>
                <tr class="tr_row"><td class="td_row td_row_2">Bits:</td> <td><title1 id="bi_bit" class="td_row td_row_2"></title1></td></tr>
            </table>
            <br>
            Transactions (<title1 id="bi_txn2"></title1>)<br>
            <table id="block_ransactions" style="width: 100%; padding-left: 10px; padding-top: 10px; font-size: 18px;">
            </table>
        <br></td>
    </tr>
    <tr>
        <td style="height: 20px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 20px 20px;"></td>
    </tr>
</table>

<br>

<script>

        $.get({
        	url: "<? echo $API_URL;?>/block/<? echo $hash;?>", cache: false,
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    document.getElementById("bi_n").innerHTML = "<b>Block #" + JsonResult.height + "</b>";
        	    document.getElementById("bi_hash").innerHTML = JsonResult.hash;
        	    if(typeof JsonResult.previousblockhash !== 'undefined') {
        	    document.getElementById("bi_prev").innerHTML = "<a href='https://zerochain.info/block/" + JsonResult.previousblockhash + "' style='text-decoration: none; color: #07729d;'>" + JsonResult.previousblockhash + "</a>";
        	    } else {
        	    document.getElementById("bi_prev").innerHTML = "None";
        	    }
        	    if(typeof JsonResult.nextblockhash !== 'undefined') {
        	    document.getElementById("bi_next").innerHTML = "<a href='https://zerochain.info/block/" + JsonResult.nextblockhash + "' style='text-decoration: none; color: #07729d;'>" + JsonResult.nextblockhash + "</a>";
        	    } else {
        	    document.getElementById("bi_next").innerHTML = "None";
        	    }
        	    
        	    document.getElementById("bi_h").innerHTML = JsonResult.height;
        	    document.getElementById("bi_ver").innerHTML = JsonResult.version;
        	    document.getElementById("bi_mer").innerHTML = JsonResult.merkleroot;
        	    var date1 = new Date(JsonResult.time*1000);
        	    document.getElementById("bi_date").innerHTML = date1;
        	    document.getElementById("bi_diff").innerHTML = JsonResult.difficulty;
        	    document.getElementById("bi_txn").innerHTML = JsonResult.tx.length;
        	    document.getElementById("bi_txn2").innerHTML = JsonResult.tx.length;
        	    document.getElementById("bi_cnf").innerHTML = JsonResult.confirmations;
        	    document.getElementById("bi_size").innerHTML = JsonResult.size;
        	    document.getElementById("bi_rwd").innerHTML = JsonResult.reward;
        	    document.getElementById("bi_no").innerHTML = JsonResult.nonce;
        	    document.getElementById("bi_chn").innerHTML = JsonResult.chainwork;
        	    document.getElementById("bi_bit").innerHTML = JsonResult.bits;
        	    
        	    var block_ransactions = document.getElementById('block_ransactions');
        	    for (var i = 0; i < JsonResult.tx.length; i++) {
        	    var row = block_ransactions.insertRow(-1);
        	    row.className = "tr_row";
        	    var newcell = row.insertCell(0);
        	    newcell.className = "td_row td_row_2";
        	    newcell.width = "40";
        	    newcell.innerHTML = "#" + parseInt(i+1);
        	    
        	    var newcell = row.insertCell(1);
        	    newcell.className = "td_row td_row_2";
        	    newcell.innerHTML = "<a href='https://zerochain.info/tx/"+JsonResult.tx[i]+"' style='text-decoration: none; color: #07729d;'>" + JsonResult.tx[i] + "</a>";
        	    }
        	    
        	}
    	});
    
</script>

</div></center>

<? include('footer.php'); ?>

</body>
</html>