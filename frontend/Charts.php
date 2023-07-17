<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/selectChart.css">
      <TITLE>Cryptocurrency Charts, Volume, Market Caps | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Select a cryptocurrency to get information about it including a chart with diferent time ticks, its current price, market capitalization and its volume in the last 24 hours.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Charts, Price Charts, Volume, Cryptocurrencies, Market Capitalization.">
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
           <?php include "./header.html" ?>

           <div class="FullBox">
             <h1 class="ChartSelectTittle">Select Crypto Chart</h1>
             <h2>Select a cryptocurrency to get information about the Current Price, Market Capitalization, Volume...</h2>
             <div class="group">
               <input id="cryptoFilter" required="" type="text" class="input">
               <span class="highlight"></span>
               <span class="bar"></span>
               <label>Search Crypto By Tag</label>
             </div>
             <div class="TokensGrid">
             </div>
             <div class="PageSelect">
               <span class="Left hide">
                 <button onclick="requestBackendStart('-1')"><ion-icon name="chevron-back-circle"></ion-icon></button>
               </span>
               <span class="PageNow">1</span>
               <span class="Right">
                 <button onclick="requestBackendStart('1')"><ion-icon name="chevron-forward-circle"></ion-icon></button>
               </span>
             </div>
           </div>

            <?php
              include('footer.html');
            ?>
            </div>
            <?php

            ?>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
      requestBackend = async function (direction)
      {

      }

      let requestBackendStart = async function (direction)
      {
        let Page = 1;
        if (direction == 0)
        {
          Page = 1;
        }
        else if (document.querySelector('.PageNow') != null)
        {
          Page = document.querySelector('.PageNow').textContent;
        }

        let response = await fetch('https://cryptotrackers.io/coinCharts',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "PageNumber": parseInt(Page),
              "Direction": parseInt(direction),
              "like": cryptoFilter.value
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        let PageNumber = parseInt(Page) + parseInt(direction);

        const { result } = await response.json();

        if (response.status == 200)
        {
          console.log(result);
          document.querySelector('.TokensGrid').innerHTML = '';
          $(".PageNow").html(PageNumber);
          for (i = 0; i < result[0].length; i++){
            document.querySelector('.TokensGrid').innerHTML += "<a class=Coin href=TokenChart/" + result[0][i].Crypto + "><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons\\"  + result[0][i].Crypto + ".png></img></span><span class=coinName> "  + result[0][i].Crypto + "</span></a>";
            if (result[1][0].totalRows == 0)
            {
              document.querySelector('.Right').classList.add('hide');
              document.querySelector('.Left').classList.add('hide');
            }
            else {
              if (result[1][0].totalRows / 35 > PageNumber){
                document.querySelector('.Right').classList.remove('hide');
              }
              else {
                document.querySelector('.Right').classList.add('hide');
              }
              if (PageNumber != 1){
                document.querySelector('.Left').classList.remove('hide');
              }
              else {
                document.querySelector('.Left').classList.add('hide');
              }
            }
          }
        }
      }

      requestBackendStart(0);

      cryptoFilter.onkeyup = function()
      {
        requestBackendStart(0);
      }

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[1].classList.add('active');

      leftNavButtons[1].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');

      let list = document.querySelectorAll('.navigation li');
        function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[1].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[1].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
