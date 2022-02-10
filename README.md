# ZeroChain Wallet & Blockchain Explorer
Offline wallet based on javascript for Zero currency

You can run (wallet_offline.html) on your browser to use as a simple Javascript-based Zero Wallet.

or copy the whole project file to PHP server to use the explorer & API functions.

or use the updated live version on http://zerochain.info/


## ZeroChain Basic Query API

### address-balance
###### Returns amount ever received minus amount ever sent by a given address.
##### URL
https://zerochain.info/api/addressbalance
##### Example
https://zerochain.info/api/addressbalance/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK


### received-by-address
###### Returns the amount ever received by a given address.
##### URL
https://zerochain.info/api/receivedbyaddress
##### Example
https://zerochain.info/api/receivedbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK


### sent-by-address
###### Returns the amount ever received by a given address.
##### URL
https://zerochain.info/api/sentbyaddress
##### Example
https://zerochain.info/api/sentbyaddress/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK


### address-info
###### Returns the information for a given address.
##### URL
https://zerochain.info/api/addressinfo
##### Example
https://zerochain.info/api/addressinfo/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK


### block
###### Returns the latest block in the chain.
##### URL
https://zerochain.info/api/block


### block-info
###### Returns the information for a given block hash.
##### URL
https://zerochain.info/api/blockinfo
##### Example
https://zerochain.info/api/blockinfo/000004470879b9f99c6f263df830ca82f10935f0a164f704ae0feb90d7f8226d


### difficulty
###### Returns the last solved block's difficulty.
##### URL
https://zerochain.info/api/difficulty


### price
###### Returns the last trade price.
##### URL
https://zerochain.info/api/price


### Push Raw Transaction
###### Push raw transaction onto network.
##### URL
https://zerochain.info/api/rawtx
##### Example
https://zerochain.info/api/rawtx/xxxxx-raw-data-xxxxx


### Create or Send a Transaction
###### Build raw transaction by a given address key & outputs data.
##### URL
https://zerochain.info/api/rawtxbuild/pkey/toaddress/amount/fees/send
##### Example
https://zerochain.info/api/rawtxbuild/L4SSfAAJzeHzHvD6UYfggpCTbWsofAzP79qvJCi6Uy7Sh29AX98g/t1PGNLKNm9ABoaWQTBNjy41ZCUoSXqv4DLK/0.25/0.0001/0
