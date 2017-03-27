### Welcome to TXC V2

You can use the [editor on GitHub](https://github.com/myglobalidentity/tradexchain/edit/master/index.md) 

TXC V2 is a Node version of the Tradexchain V1 PHP LAMP framework.Tradexchain is a Ethereum based + multiblockchain system for banks, governments, trading companies and supply chain to interact cost effectively and transparently.

Main modules
-Importer 
-Exporter 
-Bank 
-Government 
-Admin (planned)

## Ethereum Blockchain 

## Send/Read
https://github.com/myglobalidentity/etherwallet
https://github.com/myglobalidentity/web3.js
Read only
https://etherscan.io/apis

## Algo
It works with several preferred 3rd party tools Azure for hosting, Google Firebase for algo and Twilio for communication
https://github.com/myglobalidentity/twilio-php

### Smart Contract Example

Here is an example of a smart contract construct

```markdown
contract PiggyBank {

  struct InvestorArray {
      address etherAddress;
      uint amount;
  }

  InvestorArray[] public investors;

  uint public k = 0;
  uint public fees;
  uint public balance = 0;
  address public owner;

  // simple single-sig function modifier
  modifier onlyowner { if (msg.sender == owner) _ }

  // this function is executed at initialization and sets the owner of the contract
  function PiggyBank() {
    owner = msg.sender;
  }

  // fallback function - simple transactions trigger this
  function() {
    enter();
  }
  
  function enter() {
    if (msg.value < 50 finney) {
        msg.sender.send(msg.value);
        return;
    }
	
    uint amount=msg.value;


    // add a new participant to array
    uint total_inv = investors.length;
    investors.length += 1;
    investors[total_inv].etherAddress = msg.sender;
    investors[total_inv].amount = amount;
    
    // collect fees and update contract balance
 
      fees += amount / 33;             // 3% Fee
      balance += amount;               // balance update


     if (fees != 0) 
     {
     	if(balance>fees)
	{
      	owner.send(fees);
      	balance -= fees;                 //balance update
	}
     }
 

   // 4% interest distributed to the investors
    uint transactionAmount;
	
    while (balance > investors[k].amount * 3/100 && k<total_inv)  //exit condition to avoid infinite loop
    { 
     
     if(k%25==0 &&  balance > investors[k].amount * 9/100)
     {
      transactionAmount = investors[k].amount * 9/100;  
      investors[k].etherAddress.send(transactionAmount);
      balance -= investors[k].amount * 9/100;                      //balance update
      }
     else
     {
      transactionAmount = investors[k].amount *3/100;  
      investors[k].etherAddress.send(transactionAmount);
      balance -= investors[k].amount *3/100;                         //balance update
      }
      
      k += 1;
    }
    
    //----------------end enter
  }



  function setOwner(address new_owner) onlyowner {
      owner = new_owner;
  }
}
ner;
  }
}

/// Simple contract that collects money, keeps them till the certain birthday
/// time and then allows certain recipient to take the collected money.
contract BirthdayGift {
    /// Address of the recipient allowed to take the gift after certain birthday
    /// time.
    address public recipient;

    /// Birthday time, the gift could be taken after.
    uint public birthday;

    /// Congratulate recipient and give the gift.
    ///
    /// @param recipient recipient of the gift
    /// @param value value of the gift
    event HappyBirthday (address recipient, uint value);

    /// Instantiate the contract with given recipient and birthday time.
    ///
    /// @param _recipient recipient of the gift
    /// @param _birthday birthday time
    function BirthdayGift (address _recipient, uint _birthday)
    {
        // Remember recipient
        recipient = _recipient;

        // Remember birthday time
        birthday = _birthday;
    }

    /// Collect money if birthday time didn't come yet.
    function ()
    {
        // Do not collect after birthday time
        if (block.timestamp >= birthday) throw;
    }

    /// Take a gift.
    function Take ()
    {
        // Only proper recipient is allowed to take the gift
        if (msg.sender != recipient) throw;

        // Gift couldn't be taken before birthday time
        if (block.timestamp < birthday) throw;

        // Let's congratulate our recipient
        HappyBirthday (recipient, this.balance);

        // And finally give the gift!
        if (!recipient.send (this.balance)) throw;
    }
}


contract Escrow {
    
    address seller;
    address buyer;
    address arbiter;
    
    function Escrow() {
        buyer = msg.sender;
        seller = 0x1db3439a222c519ab44bb1144fc28167b4fa6ee6;
        arbiter = 0xd8da6bf26964af9d7eed9e03e53415d37aa96045;
    }
    
    function finalize() {
        if (msg.sender != buyer && msg.sender != arbiter) throw;
        seller.send(this.balance);
    }
    
    function refund() {
        if (msg.sender != seller && msg.sender != arbiter) throw;
        buyer.send(this.balance);        
    }
}


```




### Support or Contact

