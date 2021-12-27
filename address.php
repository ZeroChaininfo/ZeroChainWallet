<?php

$address = $params[0];

if( strlen($address) <> 35) {
    header("Location: https://zerochain.info/home");
    exit();
}

include('config_api.php');

include('header.php');
?>
<script src="https://zerochain.info/css/qrcode.js"></script>
<br>

<table style="border-collapse: collapse; font: bold 24px sans-serif; width: 1160px; margin-left: 10px;">
    <tr valign="top">
        <td style="height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
            &nbsp; <title1 id="bi_n"><b>Address</b></title1>
        </td>
    </tr>
    <tr valign="top">
        <td style="width: 1040px; background-color:rgb(255, 255, 255); padding: 10px 10px 0px 10px;">
            <table><tr>
                <td>
                    <table style="width: 850px; padding-left: 10px; font-size: 18px; display: inline-block; ">
                        <tr class="tr_row"><td class="td_row td_row_2" width="300">Hash:</td> <td width="550"><title1 id="bi_hash" class="td_row td_row_2"></title1></td></tr>
                        <tr class="tr_row"><td class="td_row td_row_2">Balance:</td> <td><title1 id="bi_bal" class="td_row td_row_2"></title1></td></tr>
                        <tr class="tr_row"><td class="td_row td_row_2">Total Received:</td> <td><title1 id="bi_totbal" class="td_row td_row_2"></title1></td></tr>
                        <tr class="tr_row"><td class="td_row td_row_2">Total Sent:</td> <td><title1 id="bi_sent" class="td_row td_row_2"></title1></td></tr>
                        <tr class="tr_row"><td id="bi_unbal0" class="td_row td_row_2">Unconfirmed Balance:</td> <td><title1 id="bi_unbal" class="td_row td_row_2"></title1></td></tr>
                        <tr class="tr_row"><td id="bi_untx0" class="td_row td_row_2">Unconfirmed Transactions:</td> <td><title1 id="bi_untx" class="td_row td_row_2"></title1></td></tr>
                    </table>
                </td>
                <td>
                    <div id="qrcode" style="display: inline-block; position:relative; width: 200px; height: 220px; margin-left:40px;"></div>
                    <br>
                    <center><a href="https://zerochain.info/wallet"><div style="width: 130px; margin-left:30px; display: inline-block; padding: 6px; background-color: #216F8B; cursor: pointer; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center;">Login</div></a></center>
                </td>
            </tr></table>
            Transactions (<title1 id="bi_txn" class=""></title1>)<br>
            <table id="adr_txs" style="width: 1130px; padding-left: 10px; padding-top: 10px; font-size: 18px; border: none; border-spacing: 0px;">
            </table>
            <center>
            <div id="PrevButton" onclick="PrevPage();" style="width: 120px; display: inline-block; padding: 6px; background-color: #ccc; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center;">Prev</div>
            <div id="NextButton" onclick="NextPage();" style="width: 120px; display: inline-block; padding: 6px; background-color: #216F8B; cursor: pointer; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center;">Next</div>
            </br><br></center>
        </td>
    </tr>
    <tr>
        <td style="height: 20px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 20px 20px;"></td>
    </tr>
</table>

<br><br><br>

<script>

var TxPage = 0;
var TxPageNum = 0;
var TxNum = 0;
var TxValue = [];
var TxValuesSwitch = 0;
var ZeroPrice = -1;
var WalletBalance = 0;
var WalletBalanceTR = 0;
var WalletBalanceTS = 0;

UpdateTxs(TxPage, 0);

        $.get({
        	url: "<? echo $API_URL;?>/addr/<? echo $address;?>/?noTxList=1", cache: false,
        	data: "noTxList=1",
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    
        	    var qrcode = new QRCode("qrcode", {
                    text: JsonResult.addrStr,
                    width: 192,
                    height: 192,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
                
        	    WalletBalance = JsonResult.balance;
        	    WalletBalanceTR = JsonResult.totalReceived;
        	    WalletBalanceTS = JsonResult.totalSent;
        	    document.getElementById("bi_n").innerHTML = "<b>Address " + JsonResult.addrStr + "</b>";
        	    document.getElementById("bi_hash").innerHTML = "<b>"+JsonResult.addrStr+"</b>";
        	    document.getElementById("bi_bal").innerHTML = "<b>"+numberWithCommas(JsonResult.balance) + "</b> ZER";
        	    document.getElementById("bi_totbal").innerHTML = numberWithCommas(JsonResult.totalReceived) + " ZER";
        	    document.getElementById("bi_sent").innerHTML = numberWithCommas(JsonResult.totalSent) + " ZER";
        	    if(JsonResult.unconfirmedBalance < 0) {
        	    document.getElementById("bi_unbal").innerHTML = "<b>" + numberWithCommas(JsonResult.unconfirmedBalance) + "</b> ZER";
        	    } else if(JsonResult.unconfirmedBalance > 0) {
        	    document.getElementById("bi_unbal").innerHTML = "<b>+" + numberWithCommas(JsonResult.unconfirmedBalance) + "</b> ZER";
        	    } else {
        	    document.getElementById("bi_unbal").innerHTML = "<font color='grey'>" + numberWithCommas(JsonResult.unconfirmedBalance) + " ZER</font>";
        	    document.getElementById("bi_unbal0").style.color = 'grey';
        	    }
        	    if(JsonResult.unconfirmedTxApperances != 0) {
        	    document.getElementById("bi_untx").innerHTML = "<b>" + JsonResult.unconfirmedTxApperances + "</b>";
        	    } else {
        	    document.getElementById("bi_untx").innerHTML = "<font color='grey'>" + JsonResult.unconfirmedTxApperances + "</font>";
        	    document.getElementById("bi_untx0").style.color = 'grey';
        	    }
        	    document.getElementById("bi_txn").innerHTML = JsonResult.txApperances;
        	}
    	});
    
    function UpdateTxs(PageId, ClickedButton) {
        $.get({
        	url: "<? echo $API_URL;?>/txs", cache: false,
        	data: "address=<? echo $address;?>&pageNum="+PageId,
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    adr_txs = document.getElementById("adr_txs");
        	    adr_txs.innerHTML = "";
        	    
        	    TxNum = JsonResult.txs.length;
        	    TxPageNum = JsonResult.pagesTotal;
        	    
        	    if(TxPageNum <= 1) {
                    document.getElementById('PrevButton').style.display = "none";
                    document.getElementById('NextButton').style.display = "none";
                }
        	    
        	    for (var i = 0; i < TxNum; i++) {
        	    
        	    // Head
        	    var rowBox = adr_txs.insertRow(-1);
        	    rowBox.style = "height: 35px;";
        	    var CellBoxH1 = rowBox.insertCell(0);
        	    CellBoxH1.style = "border-top-left-radius: 10px; padding-left: 12px; background-color: #e4e6e8; vertical-align: middle;";
        	    CellBoxH1.innerHTML = "<a href='https://zerochain.info/tx/"+JsonResult.txs[i].txid+"' style='text-decoration: none; color: #07729d;'> " + JsonResult.txs[i].txid + "</a>";
        	    var CellBoxH2 = rowBox.insertCell(1);
                CellBoxH2.style = "border-top-right-radius: 10px; padding-right: 12px; text-align: right; background-color: #e4e6e8; color:#a9a9a9; vertical-align: middle; font-size: 14px;"
        	    var dateTimeFormat = new Intl.DateTimeFormat('en-US', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' });
        	    CellBoxH2.innerHTML = dateTimeFormat.format(JsonResult.txs[i].time*1000);
        	    
        	    // Inputs Outputs
        	    var rowBox = adr_txs.insertRow(-1);
        	    var CellBoxIO = rowBox.insertCell(0);
        	    CellBoxIO.style= "width: 100%; padding: 20px 6px 20px 10px; border: 3px solid #e4e6e8; border-width: 3px 12px 6px 12px;";
        	    CellBoxIO.colSpan = "2";
        	    
        	    var TbLeft = document.createElement('table');
        	    TbLeft.style = "display: inline-block; vertical-align: top; font: bold 15px Courier New; ";
        	    CellBoxIO.appendChild(TbLeft);
        	    
        	    var LastAddressAdded = "";
        	    var LastAddressBalance = 0;
        	    var CellLeft0;
        	    var CellLeft1;
        	    var AddressInOut = 0;
        	    
        	    if(JsonResult.txs[i].vin.length == 0) {
        	        var rowLeft = TbLeft.insertRow(-1);
            	    CellLeft0 = rowLeft.insertCell(0);
            	    CellLeft0.style = "width: 340px;";
            	    CellLeft1 = rowLeft.insertCell(1);
            	    CellLeft1.style = "width: 140px; text-align: right;";
            	    CellLeft0.innerHTML = "Shielded Inputs";
        	    }
        	    
        	    for (var j = 0; j < JsonResult.txs[i].vin.length; j++) {
        	    
        	    
        	    if(typeof JsonResult.txs[i].vin[j].addr != "undefined") {
        	        
        	        if(JsonResult.txs[i].vin[j].addr == '<? echo $address;?>') {
        	            AddressInOut = AddressInOut - JsonResult.txs[i].vin[j].value;
        	        }
        	        
            	    if(LastAddressAdded != JsonResult.txs[i].vin[j].addr) {
            	    LastAddressAdded = JsonResult.txs[i].vin[j].addr;
            	    LastAddressBalance = JsonResult.txs[i].vin[j].value;
            	    
            	    var rowLeft = TbLeft.insertRow(-1);
            	    CellLeft0 = rowLeft.insertCell(0);
            	    CellLeft0.style = "width: 340px;";
            	    CellLeft1 = rowLeft.insertCell(1);
            	    CellLeft1.style = "width: 140px; text-align: right;";
            	    
                	    if(JsonResult.txs[i].vin[j].addr == '<? echo $address;?>') {
                	    CellLeft0.innerHTML = JsonResult.txs[i].vin[j].addr;
                	    } else {
                	    CellLeft0.innerHTML = "<a href='https://zerochain.info/address/"+JsonResult.txs[i].vin[j].addr+"' style='text-decoration: none; color: #07729d;'>" + JsonResult.txs[i].vin[j].addr + "</a>";
                	    }
                	    
            	    CellLeft1.innerHTML = JsonResult.txs[i].vin[j].value + " ZER";
            	    
            	    } else {
            	        LastAddressBalance = LastAddressBalance + JsonResult.txs[i].vin[j].value;
            	        CellLeft1.innerHTML = parseFloat(LastAddressBalance.toFixed(8)) + " ZER";
            	    }
            	    
        	    } else {
        	        var rowLeft = TbLeft.insertRow(-1);
            	    CellLeft0 = rowLeft.insertCell(0);
            	    CellLeft1 = rowLeft.insertCell(1);
            	    CellLeft0.innerHTML = "Newly Generated Coins";
            	    CellLeft0.style = "width: 340px;";
            	    CellLeft1.innerHTML = "";
            	    CellLeft1.style = "width: 140px;";
        	    }
        	    
        	    }
        	    
        	    var img1 = document. createElement('img');
        	    img1.src = "https://zerochain.info/img/arrow.png";
        	    img1.style = "margin: 0px 20px 0px 20px;"
        	    CellBoxIO.appendChild(img1);
        	    
        	    var TbRight = document.createElement('table');
        	    TbRight.style = "display: inline-block; vertical-align: top; font: bold 15px Courier New;";
        	    CellBoxIO.appendChild(TbRight);
        	    if(JsonResult.txs[i].vout.length == 0) {
        	        // No Outputs
        	        var rowRight = TbRight.insertRow(-1);
            	    var CellRight0 = rowRight.insertCell(0);
            	    CellRight0.innerHTML = "Shielded Outputs";
            	    
        	    } else {
        	    for (var j = 0; j < JsonResult.txs[i].vout.length; j++) {
        	        
        	        if(JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] == '<? echo $address;?>') {
        	            AddressInOut = AddressInOut + parseFloat(JsonResult.txs[i].vout[j].value);
        	        }
        	        
            	    var rowRight = TbRight.insertRow(-1);
            	    var CellRight0 = rowRight.insertCell(0);
            	    CellRight0.style = "width: 340px;";
                	    if(JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] == '<? echo $address;?>') {
                	    CellRight0.innerHTML = JsonResult.txs[i].vout[j].scriptPubKey.addresses[0];
                	    } else {
                	    CellRight0.innerHTML = "<a href='https://zerochain.info/address/"+JsonResult.txs[i].vout[j].scriptPubKey.addresses[0]+"' style='text-decoration: none; color: #07729d;'>" + JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] + "</a>";
                	    }
            	    var CellRight1 = rowRight.insertCell(1);
            	    CellRight1.style = "width: 140px; text-align: right;";
            	    CellRight1.innerHTML = JsonResult.txs[i].vout[j].value + " ZER";
        	    }
        	    }
        	    
        	    // Footer
        	    var rowBox = adr_txs.insertRow(-1);
        	    rowBox.style = "height: 40px; ";
        	    var CellBoxF1 = rowBox.insertCell(0);
        	    CellBoxF1.style = "border-bottom-left-radius: 10px; padding-left: 10px; background-color: #e4e6e8; vertical-align: middle; font-size: 14px;";
        	    if(typeof JsonResult.txs[i].fees != "undefined") {
        	        if(JsonResult.txs[i].fees == 0) {
        	        CellBoxF1.innerHTML = "<font color='grey'>Fees: 0 ZER</font>";
        	        } else {
        	        CellBoxF1.innerHTML = "Fees: " + ConvertToFixed(JsonResult.txs[i].fees) + " ZER";
        	        }
        	    } else {
        	    CellBoxF1.innerHTML = "<font color='grey'>Fees: 0 ZER</font>";
        	    }
        	    var CellBoxF2 = rowBox.insertCell(1);
        	    CellBoxF2.style = "border-bottom-right-radius: 10px; padding-right: 10px; background-color: #e4e6e8; vertical-align: top; text-align: right;";
        	    if(JsonResult.txs[i].confirmations == 0) {
        	        CellBoxF2.innerHTML = "<font color='red' size='3'>Unconfirmed Transaction </font> &nbsp; &nbsp; ";
        	    } else if(JsonResult.txs[i].confirmations <= 1000) {
        	        CellBoxF2.innerHTML = "<font color='grey' size='3'>" + JsonResult.txs[i].confirmations + " Confirmations </font> &nbsp; &nbsp; ";
        	    }
        	    
        	    if(AddressInOut > 0) {
        	    var Color_1 = "#40a745";
        	    CellBoxIO.style.backgroundColor = "#eafaf1";
        	    CellBoxH1.style.backgroundColor = "#ceffe3";
        	    CellBoxH2.style.backgroundColor = "#ceffe3";
        	    CellBoxF1.style.backgroundColor = "#ceffe3";
        	    CellBoxF2.style.backgroundColor = "#ceffe3";
        	    CellBoxIO.style.borderColor = "#ceffe3";
        	    } else {
        	    var Color_1 = "#be3333";
        	    CellBoxIO.style.backgroundColor = "#fdedec";
        	    CellBoxH1.style.backgroundColor = "#ffd7d5";
        	    CellBoxH2.style.backgroundColor = "#ffd7d5";
        	    CellBoxF1.style.backgroundColor = "#ffd7d5";
        	    CellBoxF2.style.backgroundColor = "#ffd7d5";
        	    CellBoxIO.style.borderColor = "#ffd7d5";
        	    }
        	    
        	    TxValue[i] = parseFloat(AddressInOut.toFixed(8));
        	    CellBoxF2.innerHTML = CellBoxF2.innerHTML + "<div id='txval_"+i+"' onclick='SwitchValues();' style='width: 200px; display: inline-block; cursor: pointer; padding: 6px; background-color: "+Color_1+"; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center; '>" + parseFloat(AddressInOut.toFixed(8)).toString() + " ZER</div>";
        	    
        	    // Space
        	    var rowBox = adr_txs.insertRow(-1);
        	    rowBox.style = "height: 50px; ";
        	    var CellBox = rowBox.insertCell(0);
        	    CellBox.colSpan = "2";
        	    
        	    }
        	    
        	    document.getElementById('NextButton').style.cursor = "pointer";
                document.getElementById('NextButton').style.backgroundColor = "#216F8B";
                document.getElementById('PrevButton').style.cursor = "pointer";
                document.getElementById('PrevButton').style.backgroundColor = "#216F8B";
                
        	    if(PageId+1 >= TxPageNum) {
                    document.getElementById('NextButton').style.cursor = "";
                    document.getElementById('NextButton').style.backgroundColor = "#ccc";
                }
        	    if(PageId <= 0) {
                    document.getElementById('PrevButton').style.cursor = "";
                    document.getElementById('PrevButton').style.backgroundColor = "#ccc";
                }
        	    
        	    UpdateValuesZerUSD();
        	    
        	    if(ClickedButton == 1) document.getElementById("bi_txn").scrollIntoView();
        	    
        	}
    	});
    }
    
function SwitchValues() {
    if(TxValuesSwitch == 0) {
        TxValuesSwitch = 1;
    } else {
        TxValuesSwitch = 0;
    }
    if(ZeroPrice == -1) {
        $.get({
        	url: "https://api.coingecko.com/api/v3/simple/price", cache: false,
        	data: "vs_currencies=usd&ids=zero",
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    ZeroPrice = JsonResult.zero.usd;
        	    UpdateValuesZerUSD();
        	}
    	});
    } else {
        UpdateValuesZerUSD();
    }
}

function UpdateValuesZerUSD() {
    for (var i = 0; i < TxNum; i++) {
        if(TxValuesSwitch == 0) {
        document.getElementById('txval_' + i).innerHTML = TxValue[i].toString() + " ZER";
        } else {
        document.getElementById('txval_' + i).innerHTML = parseFloat((TxValue[i]*ZeroPrice).toFixed(8)).toString() + " USD";
        }
    }
    if(TxValuesSwitch == 1) {
        document.getElementById("bi_bal").innerHTML = "<b>"+numberWithCommas(parseFloat((WalletBalance*ZeroPrice).toFixed(8)).toString()) + "</b> USD";
        document.getElementById("bi_totbal").innerHTML = "<b>"+numberWithCommas(parseFloat((WalletBalanceTR*ZeroPrice).toFixed(8)).toString()) + "</b> USD";
        document.getElementById("bi_sent").innerHTML = "<b>"+numberWithCommas(parseFloat((WalletBalanceTS*ZeroPrice).toFixed(8)).toString()) + "</b> USD";
    } else {
        document.getElementById("bi_bal").innerHTML = "<b>"+numberWithCommas(WalletBalance) + "</b> ZER";
        document.getElementById("bi_totbal").innerHTML = numberWithCommas(WalletBalanceTR) + " ZER";
        document.getElementById("bi_sent").innerHTML = numberWithCommas(WalletBalanceTS) + " ZER";
    }
}
    
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function NextPage() {
    if(TxPage+1 < TxPageNum) {
        document.getElementById('NextButton').style.cursor = "wait";
        document.getElementById('NextButton').style.backgroundColor = "#888";
        TxPage++;
        UpdateTxs(TxPage, 1);
    }
}
function PrevPage() {
    if(TxPage > 0) {
        document.getElementById('PrevButton').style.cursor = "wait";
        document.getElementById('PrevButton').style.backgroundColor = "#888";
        TxPage--;
        UpdateTxs(TxPage, 1);
    }
}

function ConvertToFixed(n){
        var sign = +n < 0 ? "-" : "",
            toStr = n.toString();
        if (!/e/i.test(toStr)) {
            return n;
        }
        var [lead,decimal,pow] = n.toString()
            .replace(/^-/,"")
            .replace(/^([0-9]+)(e.*)/,"$1.$2")
            .split(/e|\./);
        return +pow < 0 
            ? sign + "0." + "0".repeat(Math.max(Math.abs(pow)-1 || 0, 0)) + lead + decimal
            : sign + lead + (+pow >= decimal.length ? (decimal + "0".repeat(Math.max(+pow-decimal.length || 0, 0))) : (decimal.slice(0,+pow)+"."+decimal.slice(+pow)))
}

</script>

</div></center>

<? include('footer.php'); ?>

</body>
</html>