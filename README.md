pragma solidity ^0.4.18;

contract PWTEST  {
    uint public _totalSupply = 1200000000000000000000000000;

    string public constant symbol = "PWTEST";
    string public constant name = "PWTest";
    uint8 public constant decimals = 18;

    address public owner;
    address public whitelistedContract;
    bool freeTransfer = false;
    mapping (address => uint256) balances;
    mapping (address => mapping (address => uint256)) allowed;

    function PWTEST(address _multisig) {
        balances[_multisig] = _totalSupply;
        owner = _multisig;
    }

    modifier onlyOwner() {
        require(msg.sender == owner);
        _;
    }

    modifier ownerOrEnabledTransfer() {
        require(freeTransfer || msg.sender == owner || msg.sender == whitelistedContract);
        _;
    }

    function enableTransfer() ownerOrEnabledTransfer() {
        freeTransfer = true;
    }

    function totalSupply() constant returns (uint256 totalSupply){
        return _totalSupply;
    }

    function balanceOf(address _owner) constant returns (uint256 balance) {
        return balances[_owner];
    }

    modifier onlyPayloadSize(uint size) {
        assert(msg.data.length == size + 4);
        _;
    }

    function transfer(address _to, uint256 _value) ownerOrEnabledTransfer public returns (bool) {
        require(
        balances[msg.sender]>= _value
        && _value > 0
        );
        balances[msg.sender] -= _value;
        balances[_to] += _value;
        Transfer(msg.sender, _to, _value);
        return true;
    }
    function transferFrom(address _from, address _to, uint256 _value) ownerOrEnabledTransfer public returns (bool success) {
        require(
        allowed[_from][msg.sender]  >= _value
        && balances[_from] >= _value
        && _value > 0
        );
        balances[_from] -= _value;
        balances[_to] += _value;
        allowed[_from][msg.sender] -= _value;
        Transfer(_from, _to, _value);
        return true;
    }
    function approve(address _spender, uint256 _value) public returns (bool success) {
        // To change the approve amount you first have to reduce the addresses`
        //  allowance to zero by calling `approve(_spender, 0)` if it is not
        //  already 0 to mitigate the race condition described here:
        //  https://github.com/ethereum/EIPs/issues/20#issuecomment-263524729
        require(_value == 0 || allowed[msg.sender][_spender] == 0);
        allowed[msg.sender][_spender] = _value;
        Approval(msg.sender, _spender, _value);
        return true;
    }
    function allowance(address _owner, address _spender) constant returns (uint256 remaining) {
        return allowed[_owner][_spender];
    }
    function changeWhitelistedContract(address newAddress) public onlyOwner returns (bool) {
        require(newAddress != address(0));
        whitelistedContract = newAddress;
    }
    function transferOwnership(address newOwner) public onlyOwner returns (bool) {
      require(newOwner != address(0));
      owner = newOwner;
    }
    event Approval(address indexed _owner, address indexed _spender, uint256 _value);
    event Transfer(address indexed _from, address indexed _to, uint256 _value);

}



60606040526b03e09de2596099e2b00000006000556002805460a060020a60ff0219169055341561002f57600080fd5b6108c08061003e6000396000f3006060604052600436106100e55763ffffffff7c010000000000000000000000000000000000000000000000000000000060003504166306fdde0381146100ea578063095ea7b31461017457806318160ddd146101aa57806318e45427146101cf57806323b872dd146101fe578063313ce567146102265780633eaaf86b1461024f57806370a08231146102625780638da5cb5b1461028157806395d89b4114610294578063a9059cbb146102a7578063c8bd1d13146102c9578063dd62ed3e146102ea578063edc42b2d1461030f578063f1b50c1d1461032e578063f2fde38b14610341575b600080fd5b34156100f557600080fd5b6100fd610360565b60405160208082528190810183818151815260200191508051906020019080838360005b83811015610139578082015183820152602001610121565b50505050905090810190601f1680156101665780820380516001836020036101000a031916815260200191505b509250505060405180910390f35b341561017f57600080fd5b610196600160a060020a0360043516602435610397565b604051901515815260200160405180910390f35b34156101b557600080fd5b6101bd61043d565b60405190815260200160405180910390f35b34156101da57600080fd5b6101e2610443565b604051600160a060020a03909116815260200160405180910390f35b341561020957600080fd5b610196600160a060020a0360043581169060243516604435610452565b341561023157600080fd5b610239610594565b60405160ff909116815260200160405180910390f35b341561025a57600080fd5b6101bd610599565b341561026d57600080fd5b6101bd600160a060020a036004351661059f565b341561028c57600080fd5b6101e26105ba565b341561029f57600080fd5b6100fd6105c9565b34156102b257600080fd5b610196600160a060020a0360043516602435610600565b34156102d457600080fd5b6102e8600160a060020a03600435166106ef565b005b34156102f557600080fd5b6101bd600160a060020a0360043581169060243516610731565b341561031a57600080fd5b610196600160a060020a036004351661075c565b341561033957600080fd5b6102e86107c0565b341561034c57600080fd5b610196600160a060020a0360043516610830565b60408051908101604052600681527f5057546573740000000000000000000000000000000000000000000000000000602082015281565b60008115806103c95750600160a060020a03338116600090815260046020908152604080832093871683529290522054155b15156103d457600080fd5b600160a060020a03338116600081815260046020908152604080832094881680845294909152908190208590557f8c5be1e5ebec7d5bd14f71427d1e84f3dd0314c0f7b2291e5b200ac8c7c3b9259085905190815260200160405180910390a350600192915050565b60005490565b600254600160a060020a031681565b60025460009060a060020a900460ff168061047b575060015433600160a060020a039081169116145b80610494575060025433600160a060020a039081169116145b151561049f57600080fd5b600160a060020a03808516600090815260046020908152604080832033909416835292905220548290108015906104ef5750600160a060020a038416600090815260036020526040902054829010155b80156104fb5750600082115b151561050657600080fd5b600160a060020a03808516600081815260036020908152604080832080548890039055878516808452818420805489019055848452600483528184203390961684529490915290819020805486900390557fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef9085905190815260200160405180910390a35060019392505050565b601281565b60005481565b600160a060020a031660009081526003602052604090205490565b600154600160a060020a031681565b60408051908101604052600681527f5057544553540000000000000000000000000000000000000000000000000000602082015281565b60025460009060a060020a900460ff1680610629575060015433600160a060020a039081169116145b80610642575060025433600160a060020a039081169116145b151561064d57600080fd5b600160a060020a0333166000908152600360205260409020548290108015906106765750600082115b151561068157600080fd5b600160a060020a033381166000818152600360205260408082208054879003905592861680825290839020805486019055917fddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef9085905190815260200160405180910390a350600192915050565b60008054600160a060020a0390921680825260036020526040909120919091556001805473ffffffffffffffffffffffffffffffffffffffff19169091179055565b600160a060020a03918216600090815260046020908152604080832093909416825291909152205490565b60015460009033600160a060020a0390811691161461077a57600080fd5b600160a060020a038216151561078f57600080fd5b6002805473ffffffffffffffffffffffffffffffffffffffff1916600160a060020a03939093169290921790915590565b60025460a060020a900460ff16806107e6575060015433600160a060020a039081169116145b806107ff575060025433600160a060020a039081169116145b151561080a57600080fd5b6002805474ff0000000000000000000000000000000000000000191660a060020a179055565b60015460009033600160a060020a0390811691161461084e57600080fd5b600160a060020a038216151561086357600080fd5b6001805473ffffffffffffffffffffffffffffffffffffffff1916600160a060020a039390931692909217909155905600a165627a7a7230582033540b858e8de74c7ba6c137a058eb2a9f58d1e741a4c7b7efce26d80ed681f50029


[{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"totalSupply","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"whitelistedContract","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"}],"name":"balanceOf","outputs":[{"name":"balance","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newAddress","type":"address"}],"name":"changeWhitelistedContract","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"enableTransfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_multisig","type":"address"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_owner","type":"address"},{"indexed":true,"name":"_spender","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"_from","type":"address"},{"indexed":true,"name":"_to","type":"address"},{"indexed":false,"name":"_value","type":"uint256"}],"name":"Transfer","type":"event"}]
