<?php

include('config_api.php');

include('header.php');
?>
<br>

<script src="https://zerochain.info/css/qrcode.js"></script>
<script src="https://zerochain.info/css/app.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<table style="border-collapse: collapse; font: bold 24px sans-serif; margin-left: 10px;">
    <tr valign="top">
        <td width="770" style="height: 40px; background: #216F8B; border-radius: 10px 0px 0px 0px; color: #fff; font: bold 24px sans-serif;" valign="middle">
            &nbsp; <b>ZeroCurrency Wallet</b>
        </td>
        <td width="300" style="background: #216F8B; color: #fff; font: bold 24px sans-serif; padding-right: 12px;" valign="middle" align="right">
            <title1 id="total_balance" title="Total Balance"></title1>
        </td>
        <td width="40" style="background: #216F8B;" valign="middle">
            <img id="LogoutBtn" src="https://zerochain.info/img/logout_btn.png" width="30" height="30" onclick="ExitMyWallet();" style="cursor: pointer; display: none;" title="Logout">
        </td>
        <td width="40" style="background: #216F8B; border-radius: 0px 10px 0px 0px;" valign="middle">
            <img id="RefreshBtn" src="https://zerochain.info/img/refresh_btn.png" width="30" height="30" onclick="displayMyWallet();" style="cursor: pointer; display: none;" title="Refresh">
        </td>
    </tr>
    <tr valign="top">
        <td colspan="4" style="height: 250px; background-color:rgb(255, 255, 255); padding: 10px 10px 0px 10px; border-radius: 0px 0px 20px 20px; " align="center">
            <center>
            <table id="LoginBox" style="width: 920px; font: bold 24px sans-serif;">
                <tr>    <td colspan="2"><center>
                <p style='text-align:center;
                  margin-bottom: 2px; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5); border: 1px solid #ffe6cc; border-radius: 4px; color: #cc6600; background-color: #ffe6cc; border-color: #ffc180; padding: 5px;font-size: 14px; font-family: arial;font-weight:nornal'>IMPORTANT</br>
                This is Client-side Javascript Wallet Generator.</br>
                Do Not Forget Your ID and Password. We Have No Control Over Your Wallet.</br>
                Keep Backup In Safe Place. We Can Not Restore Your Balance If You Forget Your Login.</br>
                Password is case sensitive, any changes in password will make you login into a different wallet.</p>
            </center><br></td></tr>
                <tr height="50">
                <td>Wallet ID:</td> <td><input id="EntropyId" name="EntropyId" size="40" class="submit_b1" style="font: bold 18px sans-serif;" placeholder="Enter your Wallet ID" ></td>
            </tr><tr height="50">
                <td><font color='grey' size='4'>Do not have an Wallet ID ?</font></td> <td><div onclick="GenerateNewWalletID();" style="width: 200px; display: inline-block; padding: 6px; background-color: #216F8B; cursor: pointer; border-radius: 10px; font: bold 18px sans-serif; color: #fff; text-align: center;">Generate a New ID</div></td>
            </tr><tr height="50">
                <td>Password:</td> <td><input id="PassPhrase" name="PassPhrase" type="password" size="40" class="submit_b1" style="font: bold 18px sans-serif;" placeholder="Enter Wallet Password" ></td>
            </tr><tr height="80">
                <td></td>
                <td><div id="loginbutton" onclick="LoginPaperWallet();" style="width: 280px; height:40px; display: inline-block; padding-top: 10px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Login My Wallet</div></td>
            </tr><tr>

            <td colspan="2"><br><center>
                <p style='text-align:center;
                  margin-bottom: 2px; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5); border: 1px solid #DDFBD5; border-radius: 4px; color: #358247; background-color: #D5F0D7; border-color: #B0E8A2; padding: 5px;font-size: 14px; font-family: arial;font-weight:nornal'>
                You can use rememberable ID and Password.</br>
                example : ID <b>Donald</b> and Password <b>trump</b>.</br>
                Your wallet is encrypted and can only be decrypted with your password.</br>
                It's recommended to set a random ID and strong Password to keep your wallet secured.</br></p>
            </center><br></td>

            </tr></table>
            </center>
            
            <div id="WalletBox" style="font: bold 24px sans-serif; display: none;">
                <table style="font: bold 24px sans-serif;"><tr><td>
                    Address: <select id="AddressList" style="font: 24px Courier New; width: 860px;" onchange="ActiveAddressID = this.value; UpdateWalletInfoTrans();"></select>
                </td>
                <td>
                    <img src="https://zerochain.info/img/add_btn.png" width="30" height="30" onclick="InsertNextWalletAddress();" style="cursor: pointer; ">
                </td>
                </tr></table>
                <table><tr>
                    <td valign="middle" width="220" height="220" align="left"><div id="qrcode" width="192" height="192" style="width: 192px; height: 192px; padding-left: 20px;"></div></td>
                    <td>
                        <table style="padding-left: 10px; font-size: 18px; display: inline-block; ">
                            <tr class="tr_row"><td class="td_row td_row_2">Address:</td> <td><title1 id="bi_hash" class="td_row td_row_2"></title1></td></tr>
                            <tr class="tr_row"><td class="td_row td_row_2" width="250">Balance:</td> <td width="460"><title1 id="bi_bal" class="td_row td_row_2"></title1></td></tr>
                            <tr class="tr_row"><td class="td_row td_row_2">Total Received:</td> <td><title1 id="bi_totbal" class="td_row td_row_2"></title1></td></tr>
                            <tr class="tr_row"><td class="td_row td_row_2">Total Sent:</td> <td><title1 id="bi_sent" class="td_row td_row_2"></title1></td></tr>
                            <tr class="tr_row"><td id="bi_unbal0" class="td_row td_row_2">Unconfirmed Balance:</td> <td><title1 id="bi_unbal" class="td_row td_row_2"></title1></td></tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td width="12"></td>
                                <td><div onclick="ShowSendBox();" style="width: 120px; height:35px; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;" title="Send a Transaction">Send &raquo;</div></td>
                            </tr><tr>
                                <td align="right" valign="middle"><img id="BackupNewAccount" src="img/dot.gif" width="10" height="10" style="visibility: hidden;" title="Don't forget to backup your wallet"></td>
                                <td><div id="BackupNewAccountBtn" onclick="document.getElementById('backupmessage').innerHTML = 'Backup your wallet :'; document.getElementById('ModalBackup').style.display = 'block';" style="width: 120px; height:30px; padding-top: 6px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 20px sans-serif; color: #fff; text-align: center;" title="Export Private Keys">Export</div></td>
                            </tr><tr>
                                <td></td>
                                <td><div onclick="ImportPKBox();" style="width: 120px; height:30px; padding-top: 6px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 20px sans-serif; color: #fff; text-align: center;" title="Import a Private Key">Import</div></td>
                            </tr>
                        </table>
                    </td>
                </tr></table>
                
                <br>
                <div id="TransactionsBox" style="text-align: left;">
                    Transactions (<title1 id="bi_txn"></title1>)<br>
                    <table id="adr_txs" style="width: 1130px; padding-left: 10px; padding-top: 10px; font-size: 18px; border: none; border-spacing: 0px;">
                    </table>
                    <center>
                    <div id="PrevButton" onclick="PrevPage();" style="width: 120px; display: inline-block; padding: 6px; background-color: #ccc; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center;">Prev</div>
                    <div id="NextButton" onclick="NextPage();" style="width: 120px; display: inline-block; padding: 6px; background-color: #216F8B; cursor: pointer; border-radius: 10px; font: bold 18px Arial; color: #fff; text-align: center;">Next</div>
                    </br><br></center>
                </div>
                <div id="SendBox" style="display: none;">
                    <center>
                    Send a Transaction <br>
                    <table style="font-size: 18px; padding: 10px 6px 10px 10px;"><tr>
                        <td width="120" height="50">From: </td>
                        <td width="580"> <title1 id="send_from"></title1> </td>
                        <td width="70" colspan="2"></td>
                    </tr><tr>
                        <td>To: </td>
                        <td>
                            <div id="SendToAddressList" style="font: bold 18px Courier New; display: inline-block;">
                                <input id="SendToAd_0" size="42" class="submit_b1" placeholder="Type Address Send To..." >&nbsp;
                                <input id="SendToAm_0" size="10" class="submit_b1" placeholder="Type Amount">
                            </div>
                        </td>
                        <td align="left" valign="bottom">
                            <img src="https://zerochain.info/img/add_btn.png" width="30" height="30" onclick="AddNewOutputAddress();" title="Add Output Address">
                        </td>
                        <td align="left" valign="bottom">
                            <img src="https://zerochain.info/img/min_btn.png" width="30" height="30" onclick="RemoveOutputAddress();" title="Remove Address">
                        </td>
                    </tr><tr>
                    <td width="120" height="50">Fees: </td>
                        <td width="580"> 
                            <table style="width: 570px;"><tr>
                                <td width="365"><input id="Send_Fees" size="10" class="submit_b1" placeholder="Fees Amount" value="0.0001" > </td>
                                <td><title1 id="total_outputs" style="text-align: right;"></title1></td>
                            </tr></table>
                        </td>
                        <td width="70" colspan="2"></td>
                    </tr></table>
                    <br>
                    
                    <div onclick="CancelTransaction();" style="width: 100px; height:35px; display: inline-block; padding-top: 8px; background-color: #f36f6f; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Cancel</div>
                    
                    <div onclick="GenerateTransaction();" style="width: 250px; height:35px; display: inline-block; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Send Transaction</div>
                    
                    <br>&nbsp;
                    </center>
                </div>
                
                <div id="ExportKeysBox" style="display: none;">
                    <center>
                    Private Keys : <br><br>
                    <div id="PrivKeysList" style="font: bold 18px Courier New; display: inline-block; text-align: left;">
                    </div>
                    <br>
                    <div onclick="CancelTransaction();" style="width: 100px; height:35px; display: inline-block; padding-top: 8px; background-color: #f36f6f; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Close</div>
                    
                    <div onclick="ExportPDF();" style="width: 200px; height:35px; display: inline-block; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Save as PDF</div>
                    
                    <br>&nbsp;
                </div>
                
                <div id="ImportPaperWallet" style="display: none;">
                    <center>
                    Import Paper Wallet (Private Key) <br>
                    <br>
                    <font size='4'>Private Key:</font> <br>
                    <input id="SweepPK" size="70" class="submit_b1" placeholder="Type Private Key ..." >
                    <br><br>
                    <font size='4'>Sweep Balance to Address:</font> <br>
                    <input id="SweepToAd" size="40" class="submit_b1" placeholder="Type Address" >
                    <br><br>
                    <div onclick="CancelTransaction();" style="width: 100px; height:35px; display: inline-block; padding-top: 8px; background-color: #f36f6f; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Close</div>
                    
                    <div onclick="ImportSweepPK();" style="width: 250px; height:35px; display: inline-block; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Sweep Balance</div>
                    
                    <br>&nbsp;
                    </center>
                </div>
                
            </div>
            
        </div>
    </td>
    </tr></table>

<div id="ModalBackup" style="display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.8);">
    <div style="background-color: #E0FFFF; margin: 10% auto; padding: 10px; border: 5px solid lightblue; width: 550px; line-height:32px;">
        <center>
        <br><b><aa1 id="backupmessage">Please backup your wallet before using.</aa1></b> <br>
        <br>
        <div onclick="ExportPDF();" style="width: 350px; height:35px; display: inline-block; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Save Wallet Info as PDF</div>
        <br>- or -<br>
        <div onclick="ExportPKBox();" style="width: 300px; height:35px; display: inline-block; padding-top: 8px; background-color: #50AD4D; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Export Private Keys</div>
        <br><br>
        <div onclick="document.getElementById('ModalBackup').style.display='none';" style="width: 150px; height:35px; display: inline-block; padding-top: 8px; background-color: #f36f6f; cursor: pointer; border-radius: 10px; font: bold 24px sans-serif; color: #fff; text-align: center;">Close</div>
        <br>&nbsp;
        </center>
    </div>
</div>

<script src="https://zerochain.info/css/bitcoin-lib.js"></script>

<script>
libs.bitcoin.networks.zcash = {
  messagePrefix: '\x18Zcash Signed Message:\n',
  bip32: {
    public: 0x0488B21E,
    private: 0x0488ADE4,
  },
  pubKeyHash: 0x1CB8,
  scriptHash: 0x1CBD,
  wif: 0x80,
};

libs.bitcoin.networks.zcash.p2pkh = {
  messagePrefix: '\x18Zcash Signed Message:\n',
  bip32: {
    public: 0x0488B21E,
    private: 0x0488ADE4,
  },
  pubKeyHash: 0x1CB8,
  scriptHash: 0x1CBD,
  wif: 0x80,
};
</script>

<script src="https://zerochain.info/css/sjcl_crypto.js"></script>

<script src="https://zerochain.info/css/wallet_generate.js"></script>

<script>(function() {
    var mnemonic = new Mnemonic("english");
    var DOM_phrase;

    function init() {
        document.getElementById("EntropyId").loginup = function(){setMnemonicFromEntropy();};
    }

    function phraseUpdate() {
        seed = mnemonic.toSeed(DOM_phrase, document.getElementById("PassPhrase").value);
        bip32RootKey = libs.bitcoin.HDNode.fromSeedHex(seed, libs.bitcoin.networks.zcash);
        bip32ExtendedKey = calcBip32ExtendedKey("m/44'/133'/0'/0");
        
        displayMyWallet();
    }

    function calcBip32ExtendedKey(path) {
        if (!bip32RootKey) {
            return bip32RootKey;
        }
        var extendedKey = bip32RootKey;
        // Derive the key from the path
        var pathBits = path.split("/");
        for (var i=0; i<pathBits.length; i++) {
            var bit = pathBits[i];
            var index = parseInt(bit);
            if (isNaN(index)) {
                continue;
            }
            var hardened = bit[bit.length-1] == "'";
            var isPriv = !(extendedKey.isNeutered());
            var invalidDerivationPath = hardened && !isPriv;
            if (invalidDerivationPath) {
                extendedKey = null;
            }
            else if (hardened) {
                extendedKey = extendedKey.deriveHardened(index);
            }
            else {
                extendedKey = extendedKey.derive(index);
            }
        }
        return extendedKey;
    }

    function setMnemonicFromEntropy() {
        // Get entropy value
        var entropyStr = document.getElementById("EntropyId").value;
        // Work out minimum base for entropy
        var entropy = null;
            entropy = Entropy.fromString(entropyStr);
        if (entropy.binaryStr.length == 0) {
            return;
        }
        // Use entropy hash if not using raw entropy
        var bits = entropy.binaryStr;
        var mnemonicLength = "12";
        if (mnemonicLength != "raw") {
            // Get bits by hashing entropy with SHA256
            var hash = sjcl.hash.sha256.hash(entropy.cleanStr);
            var hex = sjcl.codec.hex.fromBits(hash);
            bits = libs.BigInteger.BigInteger.parse(hex, 16).toString(2);
            while (bits.length % 256 != 0) {
                bits = "0" + bits;
            }
            // Truncate hash to suit number of words
            mnemonicLength = parseInt(mnemonicLength);
            var numberOfBits = 32 * mnemonicLength / 3;
            bits = bits.substring(0, numberOfBits);
        }
        
        // Discard trailing entropy
        var bitsToUse = Math.floor(bits.length / 32) * 32;
        var start = bits.length - bitsToUse;
        var binaryStr = bits.substring(start);
        // Convert entropy string to numeric array
        var entropyArr = [];
        for (var i=0; i<binaryStr.length / 8; i++) {
            var byteAsBits = binaryStr.substring(i*8, i*8+8);
            var entropyByte = parseInt(byteAsBits, 2);
            entropyArr.push(entropyByte)
        }
        // Convert entropy array to mnemonic
        DOM_phrase = mnemonic.toMnemonic(entropyArr);
        
        phraseUpdate();
    }

    init();

})();

</script>

<script>
    var seed = null;
    var bip32RootKey = null;
    var bip32ExtendedKey = null;
    var AddressListNum = 0;
    var MyAddresses = [];
    var MyAddressesTR = [];
    var MyAddressesBalance = [];
    var ActiveAddressID = 0;

    var TxPage = 0;
    var TxPageNum = 0;
    var TxNum = 0;
    var TxValue = [];
    var TxValuesSwitch = 0;
    var ZeroPrice = -1;
    var WalletBalance = 0;
    var WalletBalanceTR = 0;
    var WalletBalanceTS = 0;
    var SelectList = document.getElementById('AddressList');
    
    var SendToAddressNum = 0;
    var SendToAddress = [];
    var SendToAmount = [];
    
    var NewWalletBackup = 1;
    var RequireRefreshTx = 0;
    var refreshtimer = setInterval(function() {
        if(RequireRefreshTx == 1) UpdateWalletInfoTrans(0);
    }, 60000);
    
    setInterval(function() {
        if(AddressListNum >= 1 && RequireRefreshTx == 0) UpdateWalletInfoTrans(0);
    }, 300000);
    
    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }
    
    function uuid() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
          });
    }
    
    function GenerateNewWalletID() {
        document.getElementById("EntropyId").value = uuid();
    }
    
    function LoginPaperWallet() {
        document.getElementById("loginbutton").style.cursor = "wait";

        setTimeout(function(){
        document.getElementById("EntropyId").loginup.call();
        }, 50);
    }
    
    function displayMyWallet() {
        document.getElementById("loginbutton").style.cursor = "pointer";
        document.getElementById("LoginBox").style.display = "none";
        document.getElementById("WalletBox").style.display = "table";
        AddressListNum = 0;
        
        document.getElementById("RefreshBtn").src = "https://zerochain.info/img/loading.gif";
        document.getElementById("RefreshBtn").style.display = "block";
        document.getElementById("LogoutBtn").style.display = "block";
        
        var i, L = SelectList.options.length - 1;
        for(i = L; i >= 0; i--) {
            SelectList.remove(i);
        }
        InsertNextWalletAddress(1);
    }
    
    function InsertNextWalletAddress(FirstLoadWallet = 0) {
        if(AddressListNum >= 1) {
            if(MyAddressesTR[AddressListNum-1] == 0) {
                alert("Please use the last address generated before adding a new one.");
                SelectList.selectedIndex = AddressListNum-1;
                ActiveAddressID = AddressListNum-1; UpdateWalletInfoTrans();
                return;
            }
        }
        
        var key = "NA";
                key = bip32ExtendedKey.derive(AddressListNum);
            var keyPair = key.keyPair;
            var address = keyPair.getAddress().toString();
            var privkey = keyPair.toWIF();
        
        MyAddresses[AddressListNum] = address;
        MyAddressesTR[AddressListNum] = 0;
        MyAddressesBalance[AddressListNum] = 0;
        
        var opt = document.createElement('option');
            opt.value = AddressListNum;
            opt.innerHTML = address + " (0 ZER)";
        SelectList.appendChild(opt);
        SelectList.selectedIndex = AddressListNum;
        
        document.getElementById("bi_hash").innerHTML = address;
        
        ActiveAddressID = AddressListNum;
        
        AddressListNum++;
        
        UpdateWalletInfoTrans(FirstLoadWallet);
    }
    
    function UpdateWalletInfoTrans(FirstLoadWallet = 0) {
        document.getElementById("qrcode").innerHTML = "";
        var qrcode = new QRCode("qrcode", {
                    text: MyAddresses[ActiveAddressID],
                    width: 192,
                    height: 192,
                    colorDark : "#000000",
                    colorLight : "#ffffff",
                    correctLevel : QRCode.CorrectLevel.H
                });
        
        $.get({
        	url: "<? echo $API_URL;?>/addr/"+MyAddresses[ActiveAddressID]+"/?noTxList=1", cache: false,
        	data: "noTxList=1",
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    
                SelectList.options[ActiveAddressID].innerHTML = MyAddresses[ActiveAddressID] + " ("+numberWithCommas(JsonResult.balance)+" ZER)";
                
                WalletBalance = JsonResult.balance;
        	    WalletBalanceTR = JsonResult.totalReceived;
        	    WalletBalanceTS = JsonResult.totalSent;
        	    
        	    MyAddressesBalance[ActiveAddressID] = JsonResult.balance;
        	    MyAddressesTR[ActiveAddressID] = WalletBalanceTR;
                
        	    document.getElementById("bi_hash").innerHTML = MyAddresses[ActiveAddressID];
        	    document.getElementById("bi_bal").innerHTML = "<b>"+numberWithCommas(JsonResult.balance) + "</b> ZER";
        	    document.getElementById("bi_totbal").innerHTML = numberWithCommas(JsonResult.totalReceived) + " ZER";
        	    document.getElementById("bi_sent").innerHTML = numberWithCommas(JsonResult.totalSent) + " ZER";
        	    document.getElementById("bi_txn").innerHTML = JsonResult.txApperances;
        	    
        	    document.getElementById("send_from").innerHTML = MyAddresses[ActiveAddressID];
        	    
        	    if(JsonResult.unconfirmedBalance < 0) {
        	    document.getElementById("bi_unbal").innerHTML = "<b>" + numberWithCommas(JsonResult.unconfirmedBalance) + "</b> ZER";
        	    } else if(JsonResult.unconfirmedBalance > 0) {
        	    document.getElementById("bi_unbal").innerHTML = "<b>+" + numberWithCommas(JsonResult.unconfirmedBalance) + "</b> ZER";
        	    } else {
        	    document.getElementById("bi_unbal").innerHTML = "<font color='grey'>" + numberWithCommas(JsonResult.unconfirmedBalance) + " ZER</font>";
        	    document.getElementById("bi_unbal0").style.color = 'grey';
        	    }
        	    
        	    if(FirstLoadWallet == 1) {
        	        
        	        if(JsonResult.totalReceived > 0) {
        	            NewWalletBackup = 0;
        	            InsertNextWalletAddress(1);
        	        } else {
        	            
        	            if(AddressListNum == 1) {
        	                NewWalletBackup = 1;
        	                UpdateTxs(0, 0);
        	            } else {
        	                NewWalletBackup = 0;
        	                SelectList.remove(SelectList.length-1);
        	                SelectList.remove(SelectList.length-1);
        	                AddressListNum = AddressListNum - 2;
        	                InsertNextWalletAddress(0);
        	            }
        	            
        	        }
        	        
        	        if(AddressListNum == 1 && NewWalletBackup == 1) { // New wallet
        	            document.getElementById("BackupNewAccount").style.visibility = 'visible';
        	            document.getElementById("BackupNewAccountBtn").style.border = '1px dotted red';
        	            document.getElementById("BackupNewAccountBtn").style.width = '118px';
        	            document.getElementById("ModalBackup").style.display = 'block';
        	        } else {
        	            document.getElementById("BackupNewAccount").style.visibility = 'hidden';
        	            document.getElementById("BackupNewAccountBtn").style.borderWidth = '0px';
        	            document.getElementById("BackupNewAccountBtn").style.width = '120px';
        	        }
        	        
        	    } else {
        	        UpdateTxs(0, 0);
        	    }
        	}
        
        	});
    }
    
    
    function UpdateTxs(PageId, ClickedButton) {
        RequireRefreshTx = 0;
        
        $.get({
        	url: "<? echo $API_URL;?>/txs", cache: false,
        	data: "address="+MyAddresses[ActiveAddressID]+"&pageNum="+PageId,
        	success: function(rawresult){
        	    const JsonResult = JSON.parse(JSON.stringify(rawresult));
        	    adr_txs = document.getElementById("adr_txs");
        	    adr_txs.innerHTML = "";
        	    
        	    TxNum = JsonResult.txs.length;
        	    TxPageNum = JsonResult.pagesTotal;
        	    
        	    if(TxPageNum <= 1) {
                    document.getElementById('PrevButton').style.display = "none";
                    document.getElementById('NextButton').style.display = "none";
                } else {
                    document.getElementById('PrevButton').style.cursor = "";
                    document.getElementById('PrevButton').style.backgroundColor = "#ccc";
                    document.getElementById('NextButton').style.cursor = "pointer";
                    document.getElementById('NextButton').style.backgroundColor = "#216F8B";
                    document.getElementById('PrevButton').style.display = "inline-block";
                    document.getElementById('NextButton').style.display = "inline-block";
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
        	    var CellLeft0;
        	    var CellLeft1;
        	    var AddressInOut = 0;
        	    LastAddressAdded = "";
        	    var LastAddressBalance = 0;
        	    
        	    if(JsonResult.txs[i].vin.length == 0) {
        	        var rowLeft = TbLeft.insertRow(-1);
            	    CellLeft0 = rowLeft.insertCell(0);
            	    CellLeft0.innerHTML = "Shielded Inputs";
            	    CellLeft0.style = "width: 340px;";
            	    CellLeft1 = rowLeft.insertCell(1);
            	    CellLeft1.style = "width: 140px; text-align: right;";
            	    CellLeft1.innerHTML = "";
        	    }
        	    
        	    for (var j = 0; j < JsonResult.txs[i].vin.length; j++) {
        	    
        	    
        	    if(typeof JsonResult.txs[i].vin[j].addr != "undefined") {
        	        
        	        if(JsonResult.txs[i].vin[j].addr == MyAddresses[ActiveAddressID]) {
        	            AddressInOut = AddressInOut - JsonResult.txs[i].vin[j].value;
        	        }
        	        
            	    if(LastAddressAdded != JsonResult.txs[i].vin[j].addr) {
            	    LastAddressAdded = JsonResult.txs[i].vin[j].addr;
            	    LastAddressBalance = JsonResult.txs[i].vin[j].value;
            	    
            	    var rowLeft = TbLeft.insertRow(-1);
            	    CellLeft0 = rowLeft.insertCell(0);
            	    CellLeft0.style = "width: 340px;";
            	    
                	    if(JsonResult.txs[i].vin[j].addr == MyAddresses[ActiveAddressID]) {
                	    CellLeft0.innerHTML = JsonResult.txs[i].vin[j].addr;
                	    } else {
                	    CellLeft0.innerHTML = "<a href='https://zerochain.info/address/"+JsonResult.txs[i].vin[j].addr+"' style='text-decoration: none; color: #07729d;'>" + JsonResult.txs[i].vin[j].addr + "</a>";
                	    }
                	    
                	    CellLeft1 = rowLeft.insertCell(1);
            	        CellLeft1.style = "width: 140px; text-align: right;";
                	    
            	        CellLeft1.innerHTML = JsonResult.txs[i].vin[j].value + " ZER";
            	    } else {
            	        LastAddressBalance = LastAddressBalance + JsonResult.txs[i].vin[j].value;
            	        CellLeft1.innerHTML = parseFloat(LastAddressBalance.toFixed(8)) + " ZER";
            	    }
            	    
        	    } else {
        	        LastAddressAdded = "";
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
        	    
        	    var CellRight0;
        	    var CellRight1;
        	    
        	    if(JsonResult.txs[i].vout.length == 0) {
        	        // No Outputs
        	        var rowRight = TbRight.insertRow(-1);
            	    CellRight0 = rowRight.insertCell(0);
            	    CellRight0.innerHTML = "Shielded Outputs";
            	    CellRight1 = rowRight.insertCell(1);
            	    CellRight1.style = "width: 140px; text-align: right;";
            	    CellRight1.innerHTML = "";
            	    
        	    } else {
        	    for (var j = 0; j < JsonResult.txs[i].vout.length; j++) {
        	        
        	        if(JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] == MyAddresses[ActiveAddressID]) {
        	            AddressInOut = AddressInOut + parseFloat(JsonResult.txs[i].vout[j].value);
        	        }
        	        
            	    var rowRight = TbRight.insertRow(-1);
            	    CellRight0 = rowRight.insertCell(0);
            	    CellRight0.style = "width: 340px;";
                	    if(JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] == MyAddresses[ActiveAddressID]) {
                	    CellRight0.innerHTML = JsonResult.txs[i].vout[j].scriptPubKey.addresses[0];
                	    } else {
                	    CellRight0.innerHTML = "<a href='https://zerochain.info/address/"+JsonResult.txs[i].vout[j].scriptPubKey.addresses[0]+"' style='text-decoration: none; color: #07729d;'>" + JsonResult.txs[i].vout[j].scriptPubKey.addresses[0] + "</a>";
                	    }
            	    CellRight1 = rowRight.insertCell(1);
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
        	        RequireRefreshTx = 1;
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
        	    RefreshTotalBalance();
        	    
        	    if(ClickedButton == 1) document.getElementById("bi_txn").scrollIntoView();
        	    
        	}
    	});
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

function RefreshTotalBalance() {
    var MyTotalBalance = 0;
    for (var i = 0; i < AddressListNum; i++) {
        MyTotalBalance = MyTotalBalance + MyAddressesBalance[i];
    }
    
    document.getElementById("total_balance").innerHTML = "<b>"+numberWithCommas(parseFloat(MyTotalBalance.toFixed(4)).toString()) + "</b> ZER";
    
    document.getElementById("RefreshBtn").src = "https://zerochain.info/img/refresh_btn.png";
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

function ShowSendBox() {
    document.getElementById("TransactionsBox").style.display = "none";
    document.getElementById("SendBox").style.display = "block";
    document.getElementById("send_from").innerHTML = MyAddresses[ActiveAddressID];
    document.getElementById("ExportKeysBox").style.display = "none";
    document.getElementById("ImportPaperWallet").style.display = "none";
    
    document.getElementById("Send_Fees").value = ConvertToFixed((Math.random() * 0.000001).toFixed(8));
    
    SendToAddressNum = 0;
    document.getElementById("SendToAddressList").innerHTML = "";
    AddNewOutputAddress();
}

function AddNewOutputAddress() {
    SendToAddress[SendToAddressNum] = "";
    SendToAmount[SendToAddressNum] = "";
    SendToAddressNum++;
    RefreshOutputAddressesList();
}

function RemoveOutputAddress() {
    if(SendToAddressNum > 1) {
        SendToAddressNum--;
        RefreshOutputAddressesList();
    }
}

function RefreshOutputAddressesList() {
    document.getElementById("SendToAddressList").innerHTML = "";
        for (var i = 0; i < SendToAddressNum; i++) {
            document.getElementById("SendToAddressList").innerHTML = document.getElementById("SendToAddressList").innerHTML + '<input id="SendToAd_'+i+'" size="42" class="submit_b1" placeholder="Type Address Send To..." onchange="SendToAddress['+i+']=this.value;" value="'+SendToAddress[i]+'" >&nbsp;<input id="SendToAm_'+i+'" size="10" class="submit_b1" placeholder="Amount" onchange="SendToAmount['+i+']=this.value; CalcTotalOutputs();" value="'+SendToAmount[i]+'" ><br>';
        }
}

function CalcTotalOutputs() {
    var TotalSentSat = 0;
    for (var i = 0; i < SendToAddressNum; i++) {
        var Output1 = parseFloat(SendToAmount[i]);
        TotalSentSat = TotalSentSat + Output1;
    }
    TotalSentSat = parseFloat(TotalSentSat.toFixed(8));
    if(SendToAddressNum <= 1) {
    document.getElementById("total_outputs").innerHTML = "";
    } else {
    document.getElementById("total_outputs").innerHTML = "Total: " + TotalSentSat + " ZER";
    }
}

function GenerateTransaction() {
    $.get({
        url: "<? echo $API_URL;?>/addr/"+MyAddresses[ActiveAddressID]+"/utxo", cache: false,
        success: function(rawresult){
            const JsonResult = JSON.parse(JSON.stringify(rawresult));
            
        	if(JsonResult.length == 0) {
        	    alert("No balance to send!"); return;
        	}
        	
        	var WalletBalance1 = 0;
        	
        	var InputTxs = [];
        	var InputTxV = [];
        	var InputBal = [];
        	for (var i = 0; i < JsonResult.length; i++) {
        	    InputTxs.push( JsonResult[i].txid );
        	    InputTxV.push( parseInt(JsonResult[i].vout) );
        	    InputBal.push( parseInt(JsonResult[i].satoshis) );
        	    WalletBalance1 = WalletBalance1 + parseInt(JsonResult[i].satoshis);
        	}
        	
        	var key = "NA";
                key = bip32ExtendedKey.derive(parseInt(ActiveAddressID));
            var keyPair = key.keyPair;
            var privkey = keyPair.toWIF();
        	
        	var OutputAddresses0 = [];
        	for (var i = 0; i < SendToAddressNum; i++) {
        	    OutputAddresses0[i] = SendToAddress[i];
        	}
        	
        	var TotalSentSat = 0;
        	
        	var OutputAmount0 = [];
        	var Output1 = 0;
        	for (var i = 0; i < SendToAddressNum; i++) {
        	    Output1 = parseFloat(SendToAmount[i]);
        	    Output1 = parseInt(Output1 * 100000000);
        	    OutputAmount0.push( parseInt(Output1) );
        	    TotalSentSat = parseInt(TotalSentSat + Output1);
        	}
        	
        	var FeesAmount = parseInt(document.getElementById("Send_Fees").value * 100000000);
        	
        	Output1 = parseInt(WalletBalance1 - TotalSentSat - FeesAmount);
        	
        	if(Output1 > 0) {
        	OutputAddresses0.push( MyAddresses[ActiveAddressID] );
        	OutputAmount0.push( parseInt(Output1) );
        	}
        	
        	var RawTransaction = foo.myFunction(InputTxs, InputTxV, InputBal, privkey, OutputAddresses0, OutputAmount0);
        	
        	BroadcastTransaction(RawTransaction);
        }
        
    });
    
}

function BroadcastTransaction(RawTxData) {
    $.post({
        url: "<? echo $API_URL;?>/tx/send", cache: false,
        data: "rawtx="+RawTxData,
        success: function(rawresult){
            document.getElementById("SendBox").style.display = "none";
            document.getElementById("TransactionsBox").style.display = "block";
            UpdateWalletInfoTrans();
        },
        error: function(rawresult){
            const JsonResult = JSON.parse(JSON.stringify(rawresult));
                if(JsonResult.responseText == "16: bad-txns-in-belowout. Code:-26") JsonResult.responseText = "Please wait until the last transaction being confirmed.\n\nError: " + JsonResult.responseText;
                if(JsonResult.responseText == "64: dust. Code:-26") JsonResult.responseText = "There is a small amount cannot be moved.\n\nPlease send less amount.\n\nError: " + JsonResult.responseText;
            alert(JsonResult.responseText);
        }
    });
}

function CancelTransaction() {
    document.getElementById("SendBox").style.display = "none";
    document.getElementById("ExportKeysBox").style.display = "none";
    document.getElementById("TransactionsBox").style.display = "block";
    document.getElementById("ImportPaperWallet").style.display = "none";
    
    UpdateWalletInfoTrans();
}

function ExitMyWallet() {
    AddressListNum = 0;
    RequireRefreshTx = 0;
    
    document.getElementById("SendBox").style.display = "none";
    document.getElementById("ExportKeysBox").style.display = "none";
    document.getElementById("TransactionsBox").style.display = "block";
    document.getElementById("ImportPaperWallet").style.display = "none";
    
    document.getElementById("total_balance").innerHTML = "";
    document.getElementById("RefreshBtn").style.display = "none";
    document.getElementById("LogoutBtn").style.display = "none";
    
    document.getElementById("LoginBox").style.display = "table";
    document.getElementById("WalletBox").style.display = "none";
}

function ExportPKBox() {
    document.getElementById("SendBox").style.display = "none";
    document.getElementById("ExportKeysBox").style.display = "block";
    document.getElementById("TransactionsBox").style.display = "none";
    document.getElementById("ImportPaperWallet").style.display = "none";
    
    document.getElementById("PrivKeysList").innerHTML = "";
    
    var MinimumPKs = AddressListNum;
    if(MinimumPKs <= 3) MinimumPKs = 3;
    
    for (var i = 0; i < MinimumPKs; i++) {
        var key = "NA";
        key = bip32ExtendedKey.derive(parseInt(i));
        var keyPair = key.keyPair;
        var address = keyPair.getAddress().toString();
        var privkey = keyPair.toWIF();
        
        document.getElementById("PrivKeysList").innerHTML = document.getElementById("PrivKeysList").innerHTML + "Address: " + address + "<br>PK: " + privkey + "<br><br>";
    }
    
    document.getElementById("ModalBackup").style.display = 'none';
}

function ImportPKBox() {
    document.getElementById("SendBox").style.display = "none";
    document.getElementById("ExportKeysBox").style.display = "none";
    document.getElementById("TransactionsBox").style.display = "none";
    document.getElementById("ImportPaperWallet").style.display = "block";
}

function ImportSweepPK() {
    
    var privkey = document.getElementById("SweepPK").value;
    var SendToAddress1 = document.getElementById("SweepToAd").value;
    
    var address = libs.bitcoin.ECPair.fromWIF(privkey,libs.bitcoin.networks.zcash).getAddress();
    
    $.get({
        url: "<? echo $API_URL;?>/addr/"+address+"/utxo", cache: false,
        success: function(rawresult){
            const JsonResult = JSON.parse(JSON.stringify(rawresult));
            
        	if(JsonResult.length == 0) {
        	    alert("No balance to sweep!"); return;
        	}
        	
        	var InputTxs = [];
        	var InputTxV = [];
        	var InputBal = [];
        	var Output1 = 0;
        	for (var i = 0; i < JsonResult.length; i++) {
        	    InputTxs.push( JsonResult[i].txid );
        	    InputTxV.push( parseInt(JsonResult[i].vout) );
        	    InputBal.push( parseInt(JsonResult[i].satoshis) );
        	    Output1 = Output1 + parseInt(JsonResult[i].satoshis);
        	}
        	
        	var OutputAddresses0 = [];
        	    OutputAddresses0.push ( SendToAddress1 );
        	
        	var OutputAmount0 = [];
        	    OutputAmount0.push ( parseInt(Output1) );
        	
        	var RawTransaction = foo.myFunction(InputTxs, InputTxV, InputBal, privkey, OutputAddresses0, OutputAmount0);
        	
        	BroadcastTransaction(RawTransaction);
        }
        
    });
    
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

function ExportPDF() {
    var pdf = new jsPDF('p', 'pt', 'a4');
    
    pdf.setFontType("bold");
    pdf.text(20, 25, 'Id: ' + document.getElementById("EntropyId").value);
    
    pdf.text(20, 50, 'Password: ' + document.getElementById("PassPhrase").value);
    
    pdf.line(10, 70, 585, 70, "D");
    
    pdf.text(20, 100, 'Paper Wallet');
    pdf.setFontType("normal");
    
    for (var i = 0; i < AddressListNum; i++) {
        var key = "NA";
        key = bip32ExtendedKey.derive(parseInt(i));
        var keyPair = key.keyPair;
        var address = keyPair.getAddress().toString();
        var privkey = keyPair.toWIF();
        
        pdf.text('Address: ' + address, 20, 130+60*i);
        pdf.text('PK: ' + privkey, 20, 130+20+60*i);
    }
    
    pdf.setTextColor(128, 128, 128);
    for (var i = AddressListNum; i <= 11; i++) {
        var key = "NA";
        key = bip32ExtendedKey.derive(parseInt(i));
        var keyPair = key.keyPair;
        var address = keyPair.getAddress().toString();
        var privkey = keyPair.toWIF();
        
        pdf.text('Address: ' + address, 20, 130+60*i);
        pdf.text('PK: ' + privkey, 20, 130+20+60*i);
    }
    
    pdf.save('backup-zero.pdf');
    
    document.getElementById("ModalBackup").style.display = 'none';
}
</script>

<? include('footer.php'); ?>

</body></html>