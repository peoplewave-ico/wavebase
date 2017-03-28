### Welcome to TXC V2

Shortcut [editor on GitHub](https://github.com/myglobalidentity/tradexchain/edit/master/index.md) 

TXC V2 is a proposed Node version of the Tradexchain V1 PHP LAMP framework.Tradexchain is a Ethereum based + multiblockchain system for banks, governments, trading companies and supply chain to interact cost effectively and transparently.

Modules available 
-Importer - Apply for credit and ship
-Exporter - Deliver and Claim payment
-Bank - Monitor and regulate. Provide value added services
-Government- Tax and regulate
 
Back end process - there are the operators available
 

## 1. Ethereum Blockchain Send/Read 

Create account and send/rcv money/tokens
https://github.com/myglobalidentity/etherwallet
https://github.com/myglobalidentity/web3.js

Account view
https://etherscan.io/apis

## 2. Cloud  
It works with several preferred 3rd party tools Azure for hosting, Google Firebase api for computing and Twilio for communication
https://github.com/myglobalidentity/twilio-php



### 3. Ethereum Blockchain Smart Contract  

Smart contracts holds the import bond till government regulation is satisfied. Example 0xad7d88452599efde4ada444b1b810e009d0a42ef

```markdown

contract txcimportbond {
    
    address seller;
    address buyer;
    address gov;
    
    function txcimportbond() {
        buyer = msg.sender;
        seller = 0xf6deda468ba0aff0948bf96e17386df5ca642ae9;
        gov = 0x8f4b387c804d79dc4d56f87e221351d67a37d177;
    }
    
    function finalize() {
        if (msg.sender != buyer && msg.sender != gov) throw;
        seller.send(this.balance);
    }
    
    function refund() {
        if (msg.sender != seller && msg.sender != gov) throw;
        buyer.send(this.balance);        
    }
}

```

 
