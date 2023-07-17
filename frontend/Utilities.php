<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/utilities.css">
      <TITLE>CryptoCurrencies Main Utilities | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Main utilities aiming to the blockchain ecosystem.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Utilities, Gas Tracker, Top Nfts Collections, Cryptocurrencies.">
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

         <div class="main">
           <?php
             include('header.html');
           ?>

              <div class="BigBox">
                <div class="Tittle">
                  Utilities
                </div>
                <div class="UtilitiesGrid">
                  <div class="UtilityBox">
                    <a href = "gastracker" <span class="MarketThetanTitle"> <img class="ThetanIcon" src="img/gasstation.png" alt="Gas Tracker"></img>Gas Tracker</span> </a>
                  </div>
                  <div class="UtilityBox">
                    <a href = "topnfts" <span class="MarketThetanTitle"> <img class="ThetanIcon" src="img/nft.png" alt="Top Nft Collections"></img>Top NFT Collections</span> </a>
                  </div>
                </div>
              </div>
              <?php
                include('footer.html');
              ?>
              </div>
         </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script>
      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[3].classList.add('active');

      leftNavButtons[3].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[3].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[3].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="/js/Metamask.js"></script>
   </body>
</html>
