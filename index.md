### Welcome to TXC Developer Training Lab

Shortcut [editor on GitHub](https://github.com/myglobalidentity/tradexchain/edit/master/index.md) 

TXC is a LAMP web application stack that uses Ethereum blockchain system for banks, governments, trading companies and supply chain to interact in a cost effectively and transparently manner.

The main modules are 
-Importer - Issue letter of credit 
-Exporter - Claim payment
-Government and Banks - Administrate, faciliate

## 1a. Read up. Your should start learning how the blockchain works
https://etherscan.io/apis
https://mlgblockchain.com/ethereum-tutorials.html

## 1b. Then create your own wallet

Create your new account at Ethereum wallet https://github.com/myglobalidentity/etherwallet
Explore its functions
Practise fund transfer with you to get you comfortable with transfers, storing funds, etc

# Ability to perform solid API development

Get a sample transaction from our sandbox api https://audpquvmdaownca.form.io/lc/submission/58eb4038e3210d00f1dc1050
Check if it is a fraud. If fraud - reject If not fraud, proceed to display account details using one of our banking sandbox api
Write it to the blockchain using web3.js https://github.com/myglobalidentity/web3.js

# Ability to manage Smart Contract, deploy it, call it and show in a demo to us

Create an application form that shows how an exporter or importer interacts with the smart contract (sample below) through this form

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



 
