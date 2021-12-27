<?

if (isset($_GET['searchinfo'])) {

$searchinfo = $_GET['searchinfo'];
$searchinfo = trim($searchinfo);

    if( strlen($searchinfo) == 35) {
        header("Location: https://zerochain.info/address/".$searchinfo);
        exit();
    }

    if( strlen($searchinfo) == 64) {
        if(substr($searchinfo, 0, 3) == "000") {
            header("Location: https://zerochain.info/block/".$searchinfo);
        } else {
            header("Location: https://zerochain.info/tx/".$searchinfo);
        }
        exit();
    }

}

include('header.php');
?>

<script src="https://zerochain.info/css/highcharts.js"></script>

<br>

<table style="border-collapse: collapse; font: bold 24px sans-serif; width: 1200px; margin-left: 40px;">
<tr>
    <td valign="top">
        <table><tr><td>
            <table style="border-collapse: collapse;">
                <tr valign="top">
                    <td style="width: 650px; height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
                        &nbsp; <b>Latest Blocks</b>
                    </td>
                </tr>
                <tr valign="top">
                    <td style="width: 650px; height: 250px; background-color:rgb(255, 255, 255); padding: 0px 10px 0px 10px;">
                        <table style="width: 650px;">
                            <tr><td class="td_head1" width="110"> Height </td>
                                <td class="td_head1" width="180"> Age </td>
                                <td class="td_head1" width="110"> Transactions </td>
                                <td class="td_head1"> Size </td>
                            </tr>
                            <? for ($x = 0; $x <= 19; $x++) { ?>
                            <tr class="tr_row"><td class="td_row"> <title1 id="block_<?=$x;?>_h"></title1> </td>
                                <td class="td_row"> <title1 id="block_<?=$x;?>_a"></title1> </td>
                                <td class="td_row"> <title1 id="block_<?=$x;?>_t"></title1> </td>
                                <td class="td_row"> <title1 id="block_<?=$x;?>_s"></title1> </td>
                            </tr>
                            <? } ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 650px; height: 12px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 10px 10px;"></td>
                </tr>
            </table>
        </td></tr>
        <tr><td height="20"></td></tr>
        <tr>
            <td>
                <table style="border-collapse: collapse; font: 18px Courier New;">
                    <tr>
                        <td>
                        <table>
                        <tr><td width="300">
                        <font color="grey">Built with</font></br>
                        <a href="https://nodejs.org/" target="_blank"><img src="https://zerochain.info/img/nodejs.png" width="130"></a>
                        <a href="#" target="_blank"><img src="https://zerochain.info/img/bitcoinlib.png" width="140"></a> 
                        </td><td width="150">
                        <font color="grey">Open-Source</font></br>
                        <a href="https://github.com/ZeroChaininfo/ZeroChainWallet" target="_blank"><img src="https://zerochain.info/img/github.png" width="110"></a>
                        </td><td width="150">
                        <font color="grey">Buy ZERO</font></br>
                        <a href="https://www.coinex.com/exchange/ZER-USDT?refer_code=zf9ca" target="_blank"><img src="https://zerochain.info/img/coinex.png" width="130"></a>
                        </td></tr>
                        </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr></table>
    </td>
    <td valign="top" align="right">
        <table>
            <tr>
                <td>
                    <table style="border-collapse: collapse; font: 18px Courier New;">
                        <tr valign="top">
                            <td style="width: 450px; height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
                                &nbsp; <b>Info</b>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="width: 450px; height: 250px; background-color:rgb(255, 255, 255); padding: 0px 0px 0px 0px;" valign="middle">
                            <center><br>
                            <title1 id="stat_info_price"><font size='6'><b>0.000000 USD/ZER</b></font></title1><br>
                            Last trade price</br><br>
                            <title1 id="stat_info_blocks"><font size='6'><b>0</b></font></title1><br>
                            Blocks in chain</br><br>
                            <title1 id="stat_info_diff"><font size='6'><b>0</b></font></title1><br>
                            Current difficulty</br>
                            <br></center>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 450px; height: 12px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 10px 10px;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr><td height="20"></td></tr>
            <tr>
                <td>
                    <table style="border-collapse: collapse;">
                        <tr valign="top">
                            <td style="width: 450px; height: 40px; background: #216F8B; border-radius: 10px 10px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
                                &nbsp; <b>Mining Pools</b>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="width: 300px; height: 320px; background-color:rgb(255, 255, 255); padding: 10px 0px 0px 0px;" valign="middle">
                            <center>
                            <div id="pools_chart" style="width: 300px; height: 310px; margin: 0; padding: 0;"></div>
                            </center>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 450px; height: 12px; background-color:rgba(255, 255, 255, 0.85); border-radius: 0px 0px 10px 10px;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
    <td width="40"></td>
</tr>
</table>

<br>

<script>

RefreshLatestBlocks();
setInterval(function() { RefreshLatestBlocks(); }, 60000);

function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = seconds / 31536000;

  if (interval > 1) {
    return Math.floor(interval) + " years";
  }
  interval = seconds / 2592000;
  if (interval > 1) {
    return Math.floor(interval) + " months";
  }
  interval = seconds / 86400;
  if (interval > 1) {
    return Math.floor(interval) + " days";
  }
  interval = seconds / 3600;
  if (interval > 1) {
    if(Math.floor(interval) == 1) {
        return "one hour ago";
    } else {
        return Math.floor(interval) + " hours";
    }
  }
  interval = seconds / 60;
  if (interval > 1) {
    if(Math.floor(interval) == 1) {
        return "a minute ago";
    } else {
        return Math.floor(interval) + " minutes";
    }
  }
  //return Math.floor(seconds) + " seconds";
  return "few seconds ago";
}

    function RefreshLatestBlocks() {
    $.get({
        	url: "https://insight.zeromachine.io/insight-api-zero/blocks?limit=20", cache: false,
        	data: "limit=10",
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    var MyTimeHoursDiff = 0;
        	    for (let i = 0; i <= 19; i++) {
        	        document.getElementById("block_"+i+"_h").innerHTML = '<a href="block/' + JsonResult.blocks[i].hash + '" style="text-decoration: none; color: inherit;">' + JsonResult.blocks[i].height + '</a>';
        	        
        	        let unix_timestamp = JsonResult.blocks[i].time;
                    document.getElementById("block_"+i+"_a").innerHTML = timeSince(unix_timestamp*1000);
                    
                    document.getElementById("block_"+i+"_t").innerHTML = JsonResult.blocks[i].txlength;
                    document.getElementById("block_"+i+"_s").innerHTML = JsonResult.blocks[i].size;
        	    }
        	}
    	});
    }
    
        $.get({
        	url: "https://api.coingecko.com/api/v3/simple/price", cache: false,
        	data: "vs_currencies=usd&ids=zero",
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    document.getElementById("stat_info_price").innerHTML = "<font size='6'><b>" + JsonResult.zero.usd + " USD/ZER</b></font>";
        	    
        	}
    	});
    	
    	$.get({
        	url: "https://insight.zeromachine.io/insight-api-zero/status", cache: false,
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    document.getElementById("stat_info_blocks").innerHTML = "<font size='6'><b>" + JsonResult.info.blocks + "</b></font>";
        	    document.getElementById("stat_info_diff").innerHTML = "<font size='6'><b>" + parseFloat(JsonResult.info.difficulty).toFixed(2).toString() + "</b></font>";
        	    
        	}
    	});
    	
    	$.get({
        	url: "pools_info.data", cache: false,
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(rawresult);
        	    
        	    var MinersPoolsArr = [];
        	    
        	    //var TotalHashRate = 0;
        	    //for (let i = 0; i < JsonResult.data.length; i++) {
        	    //    TotalHashRate = TotalHashRate + JsonResult.data[i].hashrate;
        	    //}
        	    
        	    for (let i = 0; i < JsonResult.data.length; i++) {
        	        //MinersPoolsArr.push( [JsonResult.data[i].pool_id, parseFloat((JsonResult.data[i].hashrate * 100 / TotalHashRate).toFixed(2)) ] );
        	        MinersPoolsArr.push( [JsonResult.data[i].pool_id, JsonResult.data[i].hashrate ] );
        	    }
        	    
        	    MinersPoolsArr.sort(compareSecondColumn);
        	    
        	    var chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'pools_chart',
                        
                        margin: [0, 0, 0, 0],
                        spacingTop: 0,
                        spacingBottom: 0,
                        spacingLeft: 0,
                        spacingRight: 0
                    },
                    credits: { enabled: false},
                    title: { text: null},
                    tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                    plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                },
                                showInLegend: false
                            }
                        },
                    series: [{
                        type: 'pie',
                        name: 'Hashrate',
                        data: MinersPoolsArr}]    
                });
        	    
        	}
    	});
    
    function compareSecondColumn(a, b) {
        if (a[1] === b[1]) {
            return 0;
        }
        else {
            return (a[1] > b[1]) ? -1 : 1;
        }
    }
    
</script>

</div></center>

<? include('footer.php'); ?>

</body>
</html>