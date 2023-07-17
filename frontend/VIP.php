<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/vip.css">
      <TITLE>Vip | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Buy any Vip tier to get acccess to our private tools like the whale tracker, personal investment...">
      <META NAME="KEYWORDS" CONTENT="Crypto, Vip, BSC, ETH, Avax, Polygon.">
      <META NAME="Resource-type" CONTENT="Document">
      <META NAME="robots" content="ALL">
   </head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VF47PCBD53"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VF47PCBD53');
</script>
   <body>
      <div class="container">
        <?php include "./navigation.html" ?>

         <div class="main hide">
           <?php
             include('header.html');
           ?>

           <div class="Confirm hide">
             <div class="Text">Confirming transaction.</div>
             <div class="loader"></div>
             <div class="InfoText">Wait for transaction to be confirmed.<br>Join our Discord to find out all the news and take advantage of all the VIP benefits.</div>
             <button class="InfoButton remove" onclick="removeInfo()">OK</button>
           </div>

           <h6>Fill the information in the "My Account 👤" tab ⇈ (next to "Moon" icon) so we can get better in touch with you.</h6>

           <div class="vipCheck">

           </div>

           <div class="ChainTittle">
             Select in which chain you want to pay.
           </div>

           <div class="paymentMethods">
             <div class="method" id="BSC">
               <div class="Chain">
                 <div class="ChainImg">
                   <img src="img/chains/BSC.png" alt="Bsc Chain">
                 </div>
                 <div class="ChainName">BSC</div>
               </div>
             </div>
             <div class="method" id="ETH">
               <div class="Chain">
                 <div class="ChainImg">
                   <img src="img/chains/ETH.png" alt="Eth Chain">
                 </div>
                 <div class="ChainName">ETH</div>
               </div>
             </div>
             <div class="method" id="Polygon">
               <div class="Chain">
                 <div class="ChainImg">
                   <img src="img/chains/Polygon.png" alt="Polygon Chain">
                 </div>
                 <div class="ChainName">Polygon</div>
               </div>
             </div>
           </div>

           <div class="currencyMethods remove">
             <div class="currMethod">
               <div class="Chain">
                 <div class="ChainImg">
                   <img src="img/cryptoicons/BNB.png" alt="Bnb Coin">
                 </div>
                 <div class="ChainName">BNB</div>
               </div>
             </div>

             <div class="currMethod">
               <div class="Chain">
                 <div class="ChainImg">
                   <img src="img/cryptoicons/USDT.png" alt="Usdt Coin">
                 </div>
                 <div class="ChainName">USDT</div>
               </div>
             </div>
           </div>

            <div class="vipBox">
              <div class="vipCard">
                <div>
                  <div class="vipCardName" style="color:#c18423">
                    🐻 Bear 🐻
                  </div>
                  <div class="vipPrice">
                    <span class="DollarPrice">$19.99</span>
                    <span class="Month">/mo</span>
                  </div>
                  <div class = "subscribeButton">
                    <button class = "subscribeNow"><img id="MetamaskVip" src="img/MetamaskIcon.svg.png" alt="Metamask Icon"></img><a id="TextMetamask">Connect Wallet</a></button>
                  </div>
                  <hr>
                  <div class="Perks">
                    <p>Exclusive Bear Raffles <br>
                    [🐻] Tag on discord <br>
                    [🐻] Special Channel on Discord <br>
                    Participate in 20$ to 80$ monthly challenge (By Discord) <br>
                    Upload 1 Video to Media (Crypto-Themed) <br>
                    Hall of fame (1 point/month) <br>
                    Track Your Portfolio Wallet Chart Day to Day <br>
                    Vote for new things coming to website<br>
                    Dashboard Show 25,50,100 Coins <br>
                    Price Alerts (100, All Coins) <br>
                    Access To Whale Tracker {SOL} (Soon ETH...) <br>
                    15% Chance for each Betting Arbitrage Opportunity (Coming Soon)<br>
                    Hide Ads (Coming Soon)<br>
                    2 Crypto price email alert (Coming Soon)</p>
                  </div>
                </div>
              </div>

              <div class="vipCard">
                <div>
                  <div class="vipCardName" style="color:#784a42">
                    🐂 Bull 🐂
                  </div>
                  <div class="vipPrice">
                    <span class="DollarPrice">$44.99</span>
                    <span class="Month">/mo</span>
                  </div>
                  <div class = "subscribeButton">
                    <button class = "subscribeNow"><img id="MetamaskVip" src="img/MetamaskIcon.svg.png" alt="Metamask Icon"></img><a id="TextMetamask">Connect Wallet</a></button>
                  </div>
                  <hr>
                  <div class="Perks">
                    <p>Bear Perks <br>
                    Exclusive Bull Raffles <br>
                    [🐂] Tag on discord <br>
                    [🐂] Special Channel on Discord <br>
                    Participate in 50$ to 200$ monthly challenge (By Discord) <br>
                    Upload 2 Videos to Media (Crypto-Themed) <br>
                    Hall of fame (2 point/month) <br>
                    Access To Personal Investment <br>
                    25% Chance for each Betting Arbitrage Opportunity (Coming Soon) <br>
                    5 Crypto price email alert (Coming Soon) </p>
		  </div>
                </div>
              </div>

                <div class="vipCard">
                  <div>
                    <div class="vipCardName" style="color:#6693dd">
                      🐋 Whale 🐋
                    </div>
                    <div class="vipPrice">
                      <span class="DollarPrice">$89.99</span>
                      <span class="Month">/mo</span>
                    </div>
                    <div class = "subscribeButton">
                      <button class = "subscribeNow"><img id="MetamaskVip" src="img/MetamaskIcon.svg.png" alt="Metamask Icon"></img><a id="TextMetamask">Connect Wallet</a></button>
                    </div>
                    <hr>
                    <div class="Perks">
                      <p>Bull Perks <br>
                      Exclusive Whale Raffles<br>
                      [🐋] Tag on discord <br>
                      [🐋] Special Channels on Discord <br>
                      Participate in 150$ to 600$ monthly challenge (By Discord) <br>
                      Upload 3 Videos to Media (Crypto-Themed) <br>
                      Hall of fame (3 point/month) <br>
                      Monthly Gift <br>
                      Special Contact With Owner<br>
                      10 Crypto price email alert (Coming Soon) <br>
                      Referral Program (Coming Soon, Check Roadmap) <br>
                      Betting Arbitrage (Coming Soon, Check Roadmap) </p>
		    </div>
                  </div>
                </div>


              </div>
              <div class="vipInfo">
                Same vips tier can be renewed 5 days before subscription finishs. <br>
                If you attempt to upgrade or downgrade your vip rank, you will lose the days of your current subscription so it will be upgraded or downgraded to your chosen vip rank. <br>
                If you think there is an error with the purchase of your rank, contact us by Discord or by email in the right-bottom corner. <br>
                Join our discord to make the most of your subscription, where we will do most of the raffles, you can ask for whitelists for projects, we will do the challenges of each vip rank and you will learn more about everything that happens/will happen in our Website.
              </div>
              <?php
                include('footer.html');
              ?>
         </div>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script>
      let BSC_USDT_ABI = [{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"burn","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]

      let BSC_USDT_Contract_Address = "0x55d398326f99059fF775485246999027B3197955";

      const bscContract = new web3.eth.Contract(BSC_USDT_ABI, BSC_USDT_Contract_Address);

      let ETH_USDT_ABI =
      [{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_upgradedAddress","type":"address"}],"name":"deprecate","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"deprecated","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_evilUser","type":"address"}],"name":"addBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"upgradedAddress","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"balances","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"maximumFee","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"unpause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_maker","type":"address"}],"name":"getBlackListStatus","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"},{"name":"","type":"address"}],"name":"allowed","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"paused","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"who","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"pause","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"newBasisPoints","type":"uint256"},{"name":"newMaxFee","type":"uint256"}],"name":"setParams","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"issue","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"amount","type":"uint256"}],"name":"redeem","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_owner","type":"address"},{"name":"_spender","type":"address"}],"name":"allowance","outputs":[{"name":"remaining","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"basisPointsRate","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"isBlackListed","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_clearedUser","type":"address"}],"name":"removeBlackList","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"MAX_UINT","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_blackListedUser","type":"address"}],"name":"destroyBlackFunds","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[{"name":"_initialSupply","type":"uint256"},{"name":"_name","type":"string"},{"name":"_symbol","type":"string"},{"name":"_decimals","type":"uint256"}],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Issue","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"amount","type":"uint256"}],"name":"Redeem","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"newAddress","type":"address"}],"name":"Deprecate","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"feeBasisPoints","type":"uint256"},{"indexed":false,"name":"maxFee","type":"uint256"}],"name":"Params","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_blackListedUser","type":"address"},{"indexed":false,"name":"_balance","type":"uint256"}],"name":"DestroyedBlackFunds","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"AddedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"_user","type":"address"}],"name":"RemovedBlackList","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[],"name":"Pause","type":"event"},{"anonymous":false,"inputs":[],"name":"Unpause","type":"event"}]

      let ETH_USDT_Contract_Address = "0xdAC17F958D2ee523a2206206994597C13D831ec7";

      const ethContract = new web3.eth.Contract(ETH_USDT_ABI, ETH_USDT_Contract_Address);

      let POLYGON_USDT_ABI =
      [{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"userAddress","type":"address"},{"indexed":false,"internalType":"address payable","name":"relayerAddress","type":"address"},{"indexed":false,"internalType":"bytes","name":"functionSignature","type":"bytes"}],"name":"MetaTransactionExecuted","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"previousAdminRole","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"newAdminRole","type":"bytes32"}],"name":"RoleAdminChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleGranted","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleRevoked","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"inputs":[],"name":"CHILD_CHAIN_ID","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"CHILD_CHAIN_ID_BYTES","outputs":[{"internalType":"bytes","name":"","type":"bytes"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DEFAULT_ADMIN_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DEPOSITOR_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"ERC712_VERSION","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"ROOT_CHAIN_ID","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"ROOT_CHAIN_ID_BYTES","outputs":[{"internalType":"bytes","name":"","type":"bytes"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"string","name":"name_","type":"string"}],"name":"changeName","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"},{"internalType":"bytes","name":"depositData","type":"bytes"}],"name":"deposit","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"userAddress","type":"address"},{"internalType":"bytes","name":"functionSignature","type":"bytes"},{"internalType":"bytes32","name":"sigR","type":"bytes32"},{"internalType":"bytes32","name":"sigS","type":"bytes32"},{"internalType":"uint8","name":"sigV","type":"uint8"}],"name":"executeMetaTransaction","outputs":[{"internalType":"bytes","name":"","type":"bytes"}],"stateMutability":"payable","type":"function"},{"inputs":[],"name":"getChainId","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"pure","type":"function"},{"inputs":[],"name":"getDomainSeperator","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"getNonce","outputs":[{"internalType":"uint256","name":"nonce","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"}],"name":"getRoleAdmin","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"uint256","name":"index","type":"uint256"}],"name":"getRoleMember","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"}],"name":"getRoleMemberCount","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"grantRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"hasRole","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"name_","type":"string"},{"internalType":"string","name":"symbol_","type":"string"},{"internalType":"uint8","name":"decimals_","type":"uint8"},{"internalType":"address","name":"childChainManager","type":"address"}],"name":"initialize","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"renounceRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"revokeRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"withdraw","outputs":[],"stateMutability":"nonpayable","type":"function"}]

      let POLYGON_USDT_Contract_Address = "0xc2132D05D31c914a87C6611C10748AEb04B58e8F";

      const polygonContract = new web3.eth.Contract(POLYGON_USDT_ABI, POLYGON_USDT_Contract_Address);

      let activeChainPayment = "";

      let activeCoinPayment = "";

      let ready = false;

      function removeInfo()
      {
        document.querySelector('.Confirm').classList.add('hide');
        document.querySelector('.main').classList.remove('unactive');
        document.querySelector('.InfoButton').classList.add('remove');
      }

      requestBackend = async function (direction)
      {
        let response = await fetch('https://cryptotrackers.io/vipCheck',{
          method : 'POST',
          body: JSON.stringify({
            address,
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        document.querySelector(".vipCheck").innerHTML = "";

        if (result[0])
        {
          document.querySelector(".vipCheck").innerHTML += "<div>Your current vip rank is <div style=color:" + vipColors[result[0].vipType] + ";margin-left:3px;margin-top:10px;display:inline-block>[" + vipNames[result[0].vipType] + "]</div></div>";
          let today = new Date();
          let vipExpiration = new Date(result[0].vipExp);
          let days = 0;
          let dateAux = new Date(vipExpiration - today);
          days = dateAux.getMonth() * 30 + dateAux.getDate();
          document.querySelector(".vipCheck").innerHTML += "<div style=margin-top:10px;>Your vip will expire in " + days + " days. <div style=display:inline-block;font-size:0.725em;>(" + vipExpiration.getDate() + " " + monthNames[vipExpiration.getMonth()] + " 00:00 UTC)</div></div>";

          if (days > 5)
          {
            document.querySelectorAll('.vipCard').forEach((item, i) => {
              if (i == result[0].vipType - 1)
              {
                item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + (days - 5) + " days</button>";
              }

              else if (i > result[0].vipType - 1)
              {
                item.children[0].children[2].innerHTML = "<button class=subscribeNow onclick=Transact(" + (i + 1) + ")>Subscribe Now</button>";
              }
            });
          }

          else
          {
            document.querySelectorAll('.vipCard').forEach((item, i) => {
              if (i == result[0].vipType - 1)
              {
                item.children[0].children[2].innerHTML = "<button class=subscribeNow onclick=Transact(" + (i + 1) + ")>Renew Subscription</button>";
              }

              else if (i > result[0].vipType - 1)
              {
                item.children[0].children[2].innerHTML = "<button class=subscribeNow onclick=Transact(" + (i + 1) + ")>Subscribe Now</button>";
              }

            });
          }

          if (result[0].vipType > 1)
          {
            document.querySelectorAll('.vipCard').forEach((item, i) => {
              if (i < result[0].vipType - 1)
              {
                item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + days + " days</button>";
              }
            });
          }

        }

        else
        {
          document.querySelectorAll('.vipCard').forEach((item, i) => {

            item.children[0].children[2].innerHTML = "<button class=subscribeNow onclick=Transact(" + (i + 1) + ")>Subscribe Now</button>";

          });
          }
      }

      requestBackend(0);

      document.querySelectorAll('.currMethod').forEach((item, i) => {
        item.addEventListener('click', function(e) {

          document.querySelectorAll('.currMethod').forEach((item, i) => {
            item.classList.remove("activeCoin");
          });

          item.classList.add("activeCoin");

          activeCoinPayment = item.children[0].childNodes[1].innerHTML;

          ready = true;
        })
      });


      document.querySelectorAll('.method').forEach((item, i) => {
        if (i == 0)
        {
          item.addEventListener('click', function(e)
          {
            if (window.ethereum.chainId == '0x38')
            {
              document.querySelectorAll('.method').forEach((item, i) => {
                item.classList.remove("activeChain");
              });

              item.classList.add("activeChain");

              activeChainPayment = "0x38";

              document.querySelector(".currencyMethods").classList.remove('remove');

              document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/BNB.png alt='Bnb Coin'></div><div class=ChainName>BNB</div></div>";

              document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";
            }
            else
            {
              ethereum.request({ method: 'wallet_switchEthereumChain', params:[{chainId: '0x38'}]})
              .then(function()
              {
                document.querySelectorAll('.method').forEach((item, i) => {
                  item.classList.remove("activeChain");
                });

                item.classList.add("activeChain");

                document.querySelector(".currencyMethods").classList.remove('remove');

                document.querySelectorAll('.currMethod').forEach((item, i) => {
                  item.classList.remove("activeCoin");
                });

                ready = false;

                document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/BNB.png alt='Bnb Coin'></div><div class=ChainName>BNB</div></div>";

                document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";

                activeChainPayment = "0x38";
              })
            }
          });
        }
        else if (i == 1)
        {
          item.addEventListener('click', function(e)
          {
            if (window.ethereum.chainId == '0x1')
            {
              document.querySelectorAll('.method').forEach((item, i) => {
                item.classList.remove("activeChain");
              });

              item.classList.add("activeChain");

              activeChainPayment = "0x1";

              document.querySelector(".currencyMethods").classList.remove('remove');

              document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/ETH.png alt='Eth Coin'></div><div class=ChainName>ETH</div></div>";

              document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";
            }
            else
            {
              ethereum.request({ method: 'wallet_switchEthereumChain', params:[{chainId: '0x1'}]})
              .then(function()
              {
                document.querySelectorAll('.method').forEach((item, i) => {
                  item.classList.remove("activeChain");
                });

                item.classList.add("activeChain");

                document.querySelectorAll('.currMethod').forEach((item, i) => {
                  item.classList.remove("activeCoin");
                });

                ready = false;

                activeChainPayment = "0x1";

                document.querySelector(".currencyMethods").classList.remove('remove');

                document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/ETH.png alt='Eth Coin'></div><div class=ChainName>ETH</div></div>";

                document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";
              })
            }
          });
        }
        else
        {
          item.addEventListener('click', function(e)
          {
            if (window.ethereum.chainId == '0x89')
            {
              document.querySelectorAll('.method').forEach((item, i) => {
                item.classList.remove("activeChain");
              });

              item.classList.add("activeChain");

              activeChainPayment = "0x89";

              document.querySelector(".currencyMethods").classList.remove('remove');

              document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/MATIC.png alt='Matic Coin'></div><div class=ChainName>MATIC</div></div>";

              document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";
            }
            else
            {
              ethereum.request({ method: 'wallet_switchEthereumChain', params:[{chainId: '0x89'}]})
              .then(function()
              {
                document.querySelectorAll('.method').forEach((item, i) => {
                  item.classList.remove("activeChain");
                });

                item.classList.add("activeChain");

                document.querySelectorAll('.currMethod').forEach((item, i) => {
                  item.classList.remove("activeCoin");
                });

                ready = false;

                activeChainPayment = "0x89";

                document.querySelector(".currencyMethods").classList.remove('remove');

                document.querySelector(".currencyMethods").children[0].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/MATIC.png alt='Matic Coin'></div><div class=ChainName>MATIC</div></div>";

                document.querySelector(".currencyMethods").children[1].innerHTML = "<div class=Chain><div class=ChainImg><img src=img/cryptoicons/USDT.png alt='Usdt Coin'></div><div class=ChainName>USDT</div></div>";
              })
            }
          });
        }
      });


      let leftNavButtons = document.querySelectorAll('.LeftNav');

      let monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

      let vipNames = ["", "🐻 Bear 🐻", "🐂 Bull 🐂", "🐋 Whale 🐋"]

      let vipColors = ["", "#c18423", "#784a42", "#6693dd"];

      let prices = ["", "19.99", "44.99", "89.99"]

      leftNavButtons[10].classList.add('active');

      leftNavButtons[10].children[0].href = "#";

      function displayAlert(index)
      {
        document.querySelector('.AlertToBuy').innerHTML = "<div> - Send $" + prices[index] + " to 0x31231231232312.</div><div> - We will process the transaction as soon as posible. </div><div> - If you want to get all the perks like the Discord Tag, the Hall Of Fame personal spot... contact us by Email or any Social Media.</div>";
        document.querySelector('.AlertToBuy').classList.remove('hide');
        document.querySelectorAll('.vipCard').forEach((item, i) => {
          item.classList.add('unactive');
        });

      }

      function Transact(index)
      {
        buyVip(prices[index], index);
      }

      async function buyVip(amount, index)
      {
        if (ready == false)
          return;

        //  CREAR ABIS USDT CADA CHAIN
        let mainContract;
        let gweiUnit;

        if(window.ethereum.chainId == activeChainPayment){
          if (window.ethereum.chainId == "0x1")
          {
            mainContract = ethContract;
            gweiUnit = "mwei"
          }
          else if (window.ethereum.chainId == "0x38")
          {
            mainContract = bscContract;
            gweiUnit = "ether"
          }
          else if (window.ethereum.chainId == "0x89")
          {
            mainContract = polygonContract;
            gweiUnit = "mwei"
          }

          console.log(mainContract);

          if (activeCoinPayment != "USDT")
          {
            //  GET MAIN COIN PRICE BASED ON CHAIN

            let response = await fetch('https://cryptotrackers.io/getMainCoinPrice',{
              method : 'POST',
              body: JSON.stringify({
                address,
                params:{
                  "vipType": parseInt(index),
                  "chainId": window.ethereum.chainId,
                },
              }),
              headers: {
                "Content-Type": "application/json",
                'Authorization': "Bearer " + jwtCookie,
              }
            });

            const { result } = await response.json();

            ethereum.request({
              method: 'eth_sendTransaction',
              params: [
              {
                from: address,
                to: "0x5cAad14E0011f0909F0020b8C11891b35618c0a5",
                value: web3.utils.toHex(web3.utils.toWei((amount / result[0].CurrentPrice).toString(), 'ether')),
              },
              ],
            })
            .then(async function (txHash) {

              document.querySelector('.Confirm').classList.remove('hide');

              document.querySelector('.main').classList.add('unactive');

              let response = await fetch('https://cryptotrackers.io/vipBuy',{
                method : 'POST',
                body: JSON.stringify({
                  address,
                  params:{
                    "txHash" : txHash,
                    "vipType": parseInt(index),
                    "chainId": window.ethereum.chainId,
                  },
                }),
                headers: {
                  "Content-Type": "application/json",
                  'Authorization': "Bearer " + jwtCookie,
                }
              });

              const { result } = await response.json();


              if (result == true && response.status == 200)
              {
                document.querySelector('.loader').classList.add('confirmed');

                document.querySelector('.InfoButton').classList.remove('remove');

                document.querySelector('.Text').innerHTML = "Transaction Confirmed.";
                document.querySelector('.InfoText').innerHTML = "You will be able to renew your subscription 5 days before it finishes.";

                setTimeout(async function(){
                  //  UPDATE (requestBackend)
                  let response = await fetch('https://cryptotrackers.io/vipCheck',{
                    method : 'POST',
                    body: JSON.stringify({
                      address,
                    }),
                    headers: {
                      "Content-Type": "application/json",
                      'Authorization': "Bearer " + jwtCookie,
                    }
                  });

                  const { result } = await response.json();

                  document.querySelector(".vipCheck").innerHTML = "";

                  if (result[0])
                  {
                    document.querySelector(".vipCheck").innerHTML += "<div>Your current vip rank is <div style=color:" + vipColors[result[0].vipType] + ";margin-left:3px;margin-top:10px;display:inline-block>[" + vipNames[result[0].vipType] + "]</div></div>";
                    let today = new Date();
                    let vipExpiration = new Date(result[0].vipExp);
                    let days = 0;
                    let dateAux = new Date(vipExpiration - today);
                    days = dateAux.getMonth() * 30 + dateAux.getDate();
                    document.querySelector(".vipCheck").innerHTML += "<div style=margin-top:10px;>Your vip will expire in " + days + " days. <div style=display:inline-block;font-size:0.725em;>(" + vipExpiration.getDate() + " " + monthNames[vipExpiration.getMonth()] + " 00:00 UTC)</div></div>";

                    if (days > 5)
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i == result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + (days - 5) + " days</button>";
                        }

                        else if (i > result[0].vipType - 1)
                        {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                        }
                      });
                    }

                    else
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i == result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow onclick=Transact(i+1)>Renew Subscription</button>";

                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });

                        }

                        else if (i > result[0].vipType - 1)
                        {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                        }

                      });
                    }

                    if (result[0].vipType > 1)
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i < result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + days + " days</button>";
                        }
                      });
                    }

                  }

                  else
                  {
                    document.querySelectorAll('.vipCard').forEach((item, i) => {
                      item.children[0].children[2].addEventListener('click', function(e)
                      {
                          Transact(i+1);
                      });
                    });
                    }

                }, 1000);
              }
              else
              {
                document.querySelector('.loader').classList.add('denied');

                document.querySelector('.InfoButton').classList.remove('remove');

                document.querySelector('.Text').innerHTML = "Transaction Cancelled";
                document.querySelector('.InfoText').innerHTML = "If you think this is an error, open a ticket on Discord.";

                setTimeout(async function(){
                  //  UPDATE (requestBackend)
                  let response = await fetch('https://cryptotrackers.io/vipCheck',{
                    method : 'POST',
                    body: JSON.stringify({
                      address,
                    }),
                    headers: {
                      "Content-Type": "application/json",
                      'Authorization': "Bearer " + jwtCookie,
                    }
                  });

                  const { result } = await response.json();

                  document.querySelector(".vipCheck").innerHTML = "";

                  if (result[0])
                  {
                    document.querySelector(".vipCheck").innerHTML += "<div>Your current vip rank is <div style=color:" + vipColors[result[0].vipType] + ";margin-left:3px;margin-top:10px;display:inline-block>[" + vipNames[result[0].vipType] + "]</div></div>";
                    let today = new Date();
                    let vipExpiration = new Date(result[0].vipExp);
                    let days = 0;
                    let dateAux = new Date(vipExpiration - today);
                    days = dateAux.getMonth() * 30 + dateAux.getDate();
                    document.querySelector(".vipCheck").innerHTML += "<div style=margin-top:10px;>Your vip will expire in " + days + " days. <div style=display:inline-block;font-size:0.725em;>(" + vipExpiration.getDate() + " " + monthNames[vipExpiration.getMonth()] + " 00:00 UTC)</div></div>";

                    if (days > 5)
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i == result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + (days - 5) + " days</button>";
                        }

                        else if (i > result[0].vipType - 1)
                        {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                        }
                      });
                    }

                    else
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i == result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow>Renew Subscription</button>";

                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });

                        }

                        else if (i > result[0].vipType - 1)
                        {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                        }

                      });
                    }

                    if (result[0].vipType > 1)
                    {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        if (i < result[0].vipType - 1)
                        {
                          item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + days + " days</button>";
                        }
                      });
                    }

                  }

                  else
                  {
                    document.querySelectorAll('.vipCard').forEach((item, i) => {
                      item.children[0].children[2].addEventListener('click', function(e)
                      {
                          Transact(i+1);
                      });
                    });
                    }
                }, 1000);
              }
            })
            .catch((error) => console.error);
          }
          else
          {
            await mainContract.methods.transfer("0x5cAad14E0011f0909F0020b8C11891b35618c0a5", web3.utils.toWei(amount, gweiUnit))
            .send({'from':address})
            .then(async function(receipt){
              document.querySelector('.Confirm').classList.remove('hide');

              document.querySelector('.main').classList.add('unactive');

              let response = await fetch('https://cryptotrackers.io/vipBuy',{
                method : 'POST',
                body: JSON.stringify({
                address,
                params:{
                  "txHash" : receipt,
                  "vipType": parseInt(index),
                  "chainId": window.ethereum.chainId,
                  },
                }),
                headers: {
                  "Content-Type": "application/json",
                  'Authorization': "Bearer " + jwtCookie,
                  }
                });

                const { result } = await response.json();

                if (result == true && response.status == 200)
                {
                  document.querySelector('.loader').classList.add('confirmed');

                  document.querySelector('.InfoButton').classList.remove('remove');

                  document.querySelector('.Text').innerHTML = "Transaction Confirmed.";
                  document.querySelector('.InfoText').innerHTML = "You will be able to renew your subscription 5 days before it finishes.";

                  setTimeout(async function(){
                    //  UPDATE (requestBackend)
                      let response = await fetch('https://cryptotrackers.io/vipCheck',{
                        method : 'POST',
                        body: JSON.stringify({
                          address,
                        }),
                        headers: {
                          "Content-Type": "application/json",
                          'Authorization': "Bearer " + jwtCookie,
                          }
                        });

                      const { result } = await response.json();

                      document.querySelector(".vipCheck").innerHTML = "";

                      if (result[0])
                      {
                        document.querySelector(".vipCheck").innerHTML += "<div>Your current vip rank is <div style=color:" + vipColors[result[0].vipType] + ";margin-left:3px;margin-top:10px;display:inline-block>[" + vipNames[result[0].vipType] + "]</div></div>";
                        let today = new Date();
                        let vipExpiration = new Date(result[0].vipExp);
                        let days = 0;
                        let dateAux = new Date(vipExpiration - today);
                        days = dateAux.getMonth() * 30 + dateAux.getDate();
                        document.querySelector(".vipCheck").innerHTML += "<div style=margin-top:10px;>Your vip will expire in " + days + " days. <div style=display:inline-block;font-size:0.725em;>(" + vipExpiration.getDate() + " " + monthNames[vipExpiration.getMonth()] + " 00:00 UTC)</div></div>";

                        if (days > 5)
                        {
                          document.querySelectorAll('.vipCard').forEach((item, i) => {
                          if (i == result[0].vipType - 1)
                          {
                            item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + (days - 5) + " days</button>";
                          }

                          else if (i > result[0].vipType - 1)
                          {
                            item.children[0].children[2].addEventListener('click', function(e)
                            {
                              Transact(i+1);
                            });
                          }
                          });
                          }

                        else
                        {
                          document.querySelectorAll('.vipCard').forEach((item, i) => {
                          if (i == result[0].vipType - 1)
                          {
                            item.children[0].children[2].innerHTML = "<button class=subscribeNow>Renew Subscription</button>";

                            item.children[0].children[2].addEventListener('click', function(e)
                            {
                              Transact(i+1);
                            });

                            }

                            else if (i > result[0].vipType - 1)
                            {
                              item.children[0].children[2].addEventListener('click', function(e)
                              {
                                Transact(i+1);
                              });
                            }

                          });
                          }

                          if (result[0].vipType > 1)
                          {
                            document.querySelectorAll('.vipCard').forEach((item, i) => {
                            if (i < result[0].vipType - 1)
                            {
                              item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + days + " days</button>";
                            }
                            });
                          }

                        }

                        else
                        {
                          document.querySelectorAll('.vipCard').forEach((item, i) => {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                          });
                        }

                      }, 1000);
                        }
                        else
                        {
                          document.querySelector('.loader').classList.add('denied');

                          document.querySelector('.InfoButton').classList.remove('remove');

                          document.querySelector('.Text').innerHTML = "Transaction Cancelled";
                          document.querySelector('.InfoText').innerHTML = "If you think this is an error, open a ticket on Discord.";

                          setTimeout(async function(){
                            //  UPDATE (requestBackend)
                            let response = await fetch('https://cryptotrackers.io/vipCheck',{
                            method : 'POST',
                            body: JSON.stringify({
                              address,
                              }),
                            headers: {
                            "Content-Type": "application/json",
                            'Authorization': "Bearer " + jwtCookie,
                            }
                          });

                          const { result } = await response.json();

                          document.querySelector(".vipCheck").innerHTML = "";

                          if (result[0])
                          {
                            document.querySelector(".vipCheck").innerHTML += "<div>Your current vip rank is <div style=color:" + vipColors[result[0].vipType] + ";margin-left:3px;margin-top:10px;display:inline-block>[" + vipNames[result[0].vipType] + "]</div></div>";
                            let today = new Date();
                            let vipExpiration = new Date(result[0].vipExp);
                            let days = 0;
                            let dateAux = new Date(vipExpiration - today);
                            days = dateAux.getMonth() * 30 + dateAux.getDate();
                            document.querySelector(".vipCheck").innerHTML += "<div style=margin-top:10px;>Your vip will expire in " + days + " days. <div style=display:inline-block;font-size:0.725em;>(" + vipExpiration.getDate() + " " + monthNames[vipExpiration.getMonth()] + " 00:00 UTC)</div></div>";

                            if (days > 5)
                            {
                              document.querySelectorAll('.vipCard').forEach((item, i) => {
                              if (i == result[0].vipType - 1)
                              {
                                item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + (days - 5) + " days</button>";
                              }

                              else if (i > result[0].vipType - 1)
                              {
                                item.children[0].children[2].addEventListener('click', function(e)
                              {
                                Transact(i+1);
                              });
                              }
                            });
                          }

                          else
                          {
                            document.querySelectorAll('.vipCard').forEach((item, i) => {
                            if (i == result[0].vipType - 1)
                            {
                            item.children[0].children[2].innerHTML = "<button class=subscribeNow>Renew Subscription</button>";

                            item.children[0].children[2].addEventListener('click', function(e)
                            {
                              Transact(i+1);
                            });

                          }

                          else if (i > result[0].vipType - 1)
                          {
                          item.children[0].children[2].addEventListener('click', function(e)
                          {
                            Transact(i+1);
                          });
                          }

                          });
                          }

                          if (result[0].vipType > 1)
                          {
                            document.querySelectorAll('.vipCard').forEach((item, i) => {
                            if (i < result[0].vipType - 1)
                            {
                              item.children[0].children[2].innerHTML = "<button class=subscribeNow style=color:var(--black2)>Available in " + days + " days</button>";
                            }
                            });
                          }

                          }

                          else
                          {
                      document.querySelectorAll('.vipCard').forEach((item, i) => {
                        item.children[0].children[2].addEventListener('click', function(e)
                        {
                          Transact(i+1);
                        });
                        });
                      }
                    }, 1000);
                  }
                })
              .catch((error) => console.error);
          }
        } else {
          ethereum.request({ method: 'wallet_switchEthereumChain', params:[{chainId: activeChainPayment}]})
          }
      }

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[10].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[10].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
