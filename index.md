### Welcome to TXC Developer Training Lab

Shortcut [editor on GitHub](https://github.com/myglobalidentity/tradexchain/edit/master/index.md) 

TXC is a LAMP web application stack that uses Ethereum blockchain system for banks, governments, trading companies and supply chain to interact in a cost effectively and transparently manner.

The main modules are 
-Importer - Issue letter of credit 
-Exporter - Claim payment
-Government and Banks - Administrate, faciliate

## 1a. Read up. Your should start learning by reading tutorials. There are more out there, find them

https://mlgblockchain.com/ethereum-tutorials.html


## 1b. Then create your own wallet

Create your new accounts at Ethereum wallet https://github.com/myglobalidentity/etherwallet
Make a viewer using our sample code which uses this API https://etherscan.io/apis
Practise fund transfer with you to get you comfortable with transfers, storing funds, etc


## 2. Test A : Ability to perform solid API development

Create an application page to call all these APIs below. We will provide the authentication seperately 

Bank Sandbox API - account details

Google Firebase - processing logic 

Twilio - Communication  
https://github.com/myglobalidentity/twilio-php

The page will pull in account details, process logic and send out the communication ouput in a text message

### 2. Test B : Ability to manage Smart Contract, deploy it, call it and show in a demo to us

Create an application form using this dependency https://github.com/myglobalidentity/web3.js
Using the form that show how an exporter or importer interacts with the smart contract (sample below) through this form

Smart Contract logic - Trading bond
Buyer initiates contract with balance with his address. Buyer and Government can send payment to contract to pay seller if satisfied. Seller and Government can refund to buyer if fail to deliver. Additional logic such as time and event listenings will be helpful

```markdown

contract txcbond {
    
    // set key variables
    address seller;
    address buyer;
    address gov;
    
    function txcaccounts() {
        buyer = msg.sender;
        seller = 0xf6deda468ba0aff0948bf96e17386df5ca642ae9;
        gov = 0x8f4b387c804d79dc4d56f87e221351d67a37d177;
    }
    
  
    function finalize() {
        if (msg.sender == buyer || msg.sender == gov) throw;
        seller.send(this.balance);
    }
    
    function refund() {
        if (msg.sender == seller || msg.sender == gov) throw;
        buyer.send(this.balance);        
    }
     
    function getBalance() constant returns (uint) {
    return this.balance;
  }
  
}

```



 
