const metamask = document.querySelector('.Metamask');

const metamaskButton = document.querySelector('#Metamask');
metamaskButton.addEventListener('click', loginWithMetaMask);

let BUSD_ABI = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}];

let BUSD_Contract_Address = "0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56";

let BUSD_Contract = new web3.eth.Contract(BUSD_ABI, BUSD_Contract_Address);

// Create or Update Cookie
function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/;SameSite=Lax";
}

if (typeof address !== null)
{
console.log(1234)
}

if ((getCookie("jwt") === null) && address !== null)
{
  signNewMessage();
}

async function signNewMessage()
{
  const provider = new ethers.providers.Web3Provider(window.ethereum);
  await provider.send("eth_requestAccounts", []);
  const signer = provider.getSigner();
  const walletAddr = await signer.getAddress();

  //Fetch to backend nonce to sign and save as message
  response = await fetch('https://cryptotrackers.io/nonce',{
    method : 'POST',
    body: JSON.stringify({
      walletAddr,
    }),
    headers: {
      "Content-Type": "application/json"
    }
  })

  const { newNonce } = await response.json();

  // Sign nonce and send signature to backend
  const signature = await signer.signMessage(newNonce);

  response = await fetch('https://cryptotrackers.io/wallet', {
    method : 'POST',
    body: JSON.stringify({
      walletAddr,
      newNonce,
      signature,
    }),
    headers: {
      "Content-Type": "application/json"
    }
  })

  // Save JWT as token
  const { token } = await response.json();

  console.log(token)
  setCookie("jwt", token, 365);

  jwtCookie = getCookie("jwt");


  if (walletAddr != null)
  {
    address = walletAddr;

    sessionStorage.setItem("address", address);
  }
  else
  {
    address = null;
    sessionStorage.setItem("address", null);
  }
  updateInterface(address);
  requestBackend(0);
}

const login = async (tryNewAccount) => {

  //Check JWT Token if exists
  jwtCookie = getCookie("jwt");
  let response;


  if (jwtCookie != null)
  {
    // Send Cookie To Backend And Verify
    response = await fetch('https://cryptotrackers.io/needSign',{
      method : 'POST',
      headers: {
        "Content-Type": "application/json",
        'Authorization': "Bearer " + jwtCookie,
      }
    })

    const { returnedAddress } = await response.json();


    if (returnedAddress === undefined || (tryNewAccount != null && returnedAddress.toLowerCase() != tryNewAccount.toLowerCase()))
    {
      signNewMessage();
    }

    else
    {
      updateInterface(tryNewAccount);
    }

  }

  else
  {
    signNewMessage();
  }
}

// CHANGE ACCOUNT FUNCTION
if (typeof window.ethereum !== 'undefined') {
  window.ethereum.on('accountsChanged', function (accounts2) {

    let tryNewAccount = accounts2[0];
    login(tryNewAccount);

  })
}

if (typeof window.ethereum !== 'undefined'){
window.ethereum.on('chainChanged', function (networkId) {
  console.log(networkId);
})}

function updateInterface(newAddress)
{
  address = newAddress;
  if (address != null)
  {
    sessionStorage.setItem("address", address);
  }
  if (address != null && address != "null")
  {
    metamaskButton.innerHTML = "<a id = TextMetamask>" + address.substring(0,5).toLowerCase() + "...." + address.substring(address.length-4).toLowerCase() + "</a><img id=MetamaskIcon src=/img/MetamaskIcon.svg.png></img>";
    if (document.querySelectorAll('.subscribeNow') != null)
    {
      document.querySelectorAll('.subscribeNow').forEach((item, i) => {
        item.removeEventListener('click', loginWithMetaMask);
    });
  }
  }
  else
  {
    metamaskButton.innerHTML = "<img id=MetamaskIcon src=/img/MetamaskIcon.svg.png></img><a id=TextMetamask>Connect Wallet</a>";
    if (document.querySelector('#clickToLogin') != null)
    {
      document.querySelector('#clickToLogin').addEventListener('click', loginWithMetaMask);
    }
    if (document.querySelectorAll('.subscribeNow') != null)
    {
      document.querySelectorAll('.subscsribeNow').forEach((item) =>
      item.addEventListener('click', loginWithMetaMask));
    }
  }

  requestBackend(0);
}

if (window.ethereum)
{
  updateInterface(address);
}

function checkConnection() {
    ethereum
        .request({ method: 'eth_accounts' })
        .then()
        .catch(console.error);
}


function checkConnection() {
    ethereum
        .request({ method: 'eth_accounts' })
        .then()
        .catch(console.error);
}

async function loginWithMetaMask() {
  const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' })
  .catch((e) => {
    console.error(e.message)
    return
  })
  if (!accounts) { return }

  login(accounts[0]);
}

if (typeof window.ethereum !== 'undefined')
{
  ethereum.on('accountsChanged', function (accounts) {
   if (!accounts.length)
   {
     address = null;
     sessionStorage.setItem("address", null);
   }
  })
}
else
{
address = null;
sessionStorage.setItem("address", null);
}

$(document).ready(function(){
  document.querySelector('.main').classList.remove('hide');
});
