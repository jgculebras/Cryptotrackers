<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/dashboard.css">
      <TITLE>Cryptocurrency Prices, Volume, Market Caps | CryptoTrackers</TITLE>
      <META NAME="DC.Language" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Top cryptocurrencies winners and losers in the last 24 hours. Free access to cryptocurrencies market data and movements.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Btc Dominance, Top 10 Winners, Top 10 Losers, Cryptocurrencies.">
      <META NAME="Resource-type" CONTENT="Document">
      <META NAME="robots" content="ALL">
      <link rel="canonical" href="https://cryptotrackers.io/">
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

          <h1>Crypto stats in the last day</h1>
          <div class="h4Container">
            <h4>Total Market Cap is an indicator that measures and keeps track of the market value of all cryptocurrencies.</h4>
            <h4>Total Volume is an indicator that measures how much money has been traded over the last 24 hours.</h4>
            <h4>BTC Dominance is the ratio between the market capitalization of Bitcoin to the total market cap of the entire cryptocurrency market.</h4>
          </div>

          <div class="marketBox">
          </div>

          <hr class ="divsSeparation">

          <div class="QtyDisplay">
            <span class="Text">Display Coins:</span>
            <span class="Buttons">
              <button id = '10' class="active" type="button" name="button" onClick = "LoadPricesChange(10)">10</button>
              <button id = '25' type="button" name="button" onClick = "LoadPricesChange(25)">25</button>
              <button id = '50' type="button" name="button" onClick = "LoadPricesChange(50)">50</button>
              <button id = '100' type="button" name="button" onClick = "LoadPricesChange(100)">100</button>
            </span>
          </div>
          <div class="h4Container">
            <h4>Here you will find in order the coins that have risen the most in the last 24 hours.</h4>
            <h4>Here you will find in order the coins with the most market cap.</h4>
            <h4>Here you will find in order the coins that have lost the most in the last 24 hours.</h4>
          </div>
          <div class="loaderSpiner remove">
            <div class="face">
              <div class="circle"></div>
            </div>
            <div class="face">
              <div class="circle"></div>
            </div>
          </div>
          <div id="Prices" class="FullBox">

          </div>
          <?php
            include('footer.html');
          ?>
          </div>
      </div>


      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script>
          function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }

      let currencyIcon = "$";
      let currencyMultiplier = 1.00;

      function countDecimals(value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0;
      }

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      var coinsToDisplay = 10;

      leftNavButtons[0].classList.add('active');

      leftNavButtons[0].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');

         let priceChange = document.querySelectorAll('.coinPercent')


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[0].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[0].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));

         let coinPriceBefore = [];
         let coinPercentBefore = [];

         let activeButton = document.getElementById(10);

         let qtyButtons = document.querySelectorAll('.Buttons button');
         function activateButton(){
           qtyButtons.forEach((item) =>
           item.classList.remove('hovered'));
           activeButton.classList.remove('active');
           this.classList.add('hovered');
         }

         qtyButtons.forEach((item) =>
         item.addEventListener('mouseover', activateButton));

         function activateDashboardButton(buttonToActivate)
         {
           qtyButtons.forEach((item) => {
             item.classList.remove('active');
           });
           buttonToActivate.classList.add('active');
         }

         function deleteButton(){
           qtyButtons.forEach((item) =>
           item.classList.remove('hovered'));
           activeButton.classList.add('active');
         }

         qtyButtons.forEach((item) =>
         item.addEventListener('mouseleave', deleteButton));

         var timeout;

         function opacity(){
           document.querySelector('.AlertVip').classList.add('remove');
           timeout = setTimeout(function(){
             document.querySelector('.AlertVip').classList.add('moveAway');
           }, 1000)
         }

          setInterval(function(){
            LoadPrices();
          }, 15000);

          function LoadPrices(){
            requestBackend(0);
          }

          requestBackend = async function (direction)
          {
            let response = await fetch('https://cryptotrackers.io/dashboardStats',{
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

            if (response.status == 200)
            {
              marketBefore = [];

              $(".marketNumebers").each(function(index, element){
                marketBefore.push($(element).text());
              });

              let string = "<div class = marketCard><div><h2 class=marketCardName>Total Market Cap</h2><hr><div class = prices><span class=marketNumebers></span><span class = dollar>" + currencyIcon + "</span></div></div></div>";
              string += "<div class = marketCard><div><h2 class=marketCardName>24h Volume</h2><hr><div class = prices><span class=marketNumebers></span><span class = dollar>" + currencyIcon + "</span></div></div></div>";
              string += "<div class = marketCard><div><h2 class=marketCardName>BTC Dominance</h2><hr><div class = prices><span class=marketNumebers></span><span class = dollar>%</span></div></div></div>";
              document.querySelector('.marketBox').innerHTML = string;
              $(".marketNumebers").each(function( index,element ) {
                if (index == 0) {
                  var toValue = result[0].totalMC * currencyMultiplier;
                }
                else if (index == 1) {
                  var toValue = result[0].totalVolume * currencyMultiplier;
                }
                else {
                  var toValue = result[0].btcDominance;
                }

                if (index == 2 && marketBefore.length > 0)
                {
                  var decimals = 2;
                  var before = marketBefore[index];
                }
                else if (marketBefore.length > 0) {
                  var decimals = 0;
                  var before = parseInt(marketBefore[index].replace(/,/g,''), 10);
                }

              $({numberValue: before}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(numberWithCommas(now.toFixed(decimals)));
                },
                });
              });
            }

              //  FETCH TO BACKEND TO CHECK IF VIP.
            response = await fetch('https://cryptotrackers.io/dashboard',{
                method : 'POST',
                body: JSON.stringify({
                  address,
                  params:{
                    "nCoins": coinsToDisplay
                  },
                }),
                headers: {
                  "Content-Type": "application/json",
                  'Authorization': "Bearer " + jwtCookie,
                }
              });

              const { dataReturned } = await response.json();

              //  USER NOT VIP

              if (response.status == 403)
              {
                clearTimeout(timeout);
                document.querySelector('#Prices').innerHTML  = "<div class = GainersBox><h2 class = BoxTittle><span class=Trend style=color:green;><ion-icon name=rocket-outline></ion-icon></span>Top " + coinsToDisplay + " Winners 24h</h2><div class = VIPAdvice style=color:#c18423>You are not [🐻] VIP Tier to fetch the " + coinsToDisplay + " Gainers in the last 24h.</div></div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:var(--black2);><ion-icon name=diamond-outline></ion-icon></span>Top " + coinsToDisplay + " Coins</h2><div class = VIPAdvice style=color:#c18423>You are not [🐻] VIP Tier to fetch the " + coinsToDisplay + " Top Cryptos.</div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:red;><ion-icon name=skull-outline></ion-icon></span>Top " + coinsToDisplay + " Losers 24h</h2><div class = VIPAdvice style=color:#c18423>You are not [🐻] VIP Tier to fetch the " + coinsToDisplay + " Losers in the last 24h.</h2></div></div>";

                activeButton = document.getElementById(coinsToDisplay);
                activateDashboardButton(activeButton);
                document.querySelector('.loaderSpiner').classList.add('remove');
              }

              if (response.status == 404)
              {
                clearTimeout(timeout);
                document.querySelector('#Prices').innerHTML  = "<div class = GainersBox><h2 class = BoxTittle><span class=Trend style=color:green;><ion-icon name=rocket-outline></ion-icon></span>Top " + coinsToDisplay + " Winners 24h</h2><div class = VIPAdvice>Connect or Install Metamask first.</div></div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:var(--black2);><ion-icon name=diamond-outline></ion-icon></span>Top " + coinsToDisplay + " Coins</h2><div class = VIPAdvice>Connect or Install Metamask first.</div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:red;><ion-icon name=skull-outline></ion-icon></span>Top " + coinsToDisplay + " Losers 24h</h2><div class = VIPAdvice>Connect or Install Metamask first.</div></div></div>";

                activeButton = document.getElementById(coinsToDisplay);
                activateDashboardButton(activeButton);
                document.querySelector('.loaderSpiner').classList.add('remove');
              }

              else if (response.status == 400)
              {
                clearTimeout(timeout);
                document.querySelector('#Prices').innerHTML  = "<div class = GainersBox><h2 class = BoxTittle><span class=Trend style=color:green;><ion-icon name=rocket-outline></ion-icon></span>Top " + coinsToDisplay + " Winners 24h</h2><div class = VIPAdvice>Not Valid Inputs.</div></div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:var(--black2);><ion-icon name=diamond-outline></ion-icon></span>Top " + coinsToDisplay + " Coins</h2><div class = VIPAdvice>Not Valid Inputs.</div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:red;><ion-icon name=skull-outline></ion-icon></span>Top " + coinsToDisplay + " Losers 24h</h2><div class = VIPAdvice>Not Valid Inputs.</div></div></div>";

                activeButton = document.getElementById(coinsToDisplay);
                activateDashboardButton(activeButton);
                document.querySelector('.loaderSpiner').classList.add('remove');
              }

              else if (response.status == 401)
              {
                clearTimeout(timeout);
                document.querySelector('#Prices').innerHTML  = "<div class = GainersBox><h2 class = BoxTittle><span class=Trend style=color:green;><ion-icon name=rocket-outline></ion-icon></span>Top " + coinsToDisplay + " Winners 24h</h2><div class = VIPAdvice>Please try to change accounts or sign another message on Metamask.</div></div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:var(--black2);><ion-icon name=diamond-outline></ion-icon></span>Top " + coinsToDisplay + " Coins</h2><div class = VIPAdvice>Please try to change accounts or sign another message on Metamask.</div></div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:red;><ion-icon name=skull-outline></ion-icon></span>Top " + coinsToDisplay + " Losers 24h</h2><div class = VIPAdvice>Please try to change accounts or sign another message on Metamask.</div></div></div>";

                activeButton = document.getElementById(coinsToDisplay);
                activateDashboardButton(activeButton);
                document.querySelector('.loaderSpiner').classList.add('remove');
              }

              //  USER IS VIP
              else
              {
                response = dataReturned;

                activeButton = document.getElementById(coinsToDisplay);
                activateDashboardButton(activeButton);

                coinPriceBefore = [];
                coinPercentBefore = [];

                $(".coinPrice").each(function(index, element){
                  coinPriceBefore.push($(element).text());
                });
                $(".coinPercent").each(function(index, element){
                  coinPercentBefore.push($(element).text());
                });

                let string='';
                let keywords = '';
                string = "<div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:green;><ion-icon name=rocket-outline></ion-icon></span>Top " + coinsToDisplay + " Winners 24h</h2>";
                for (let i = 0; i < coinsToDisplay; i++)
                {
                  string += "<div class=CoinDiv><div class=id>" + (i+1) + "</div><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/" + response[0][i].Crypto + ".png></img></span><span class=coinName> " + response[0][i].Crypto + "  </span><span class=coinPrice>" + parseFloat(response[0][i].CurrentPrice) + "</span><span class=dollar> " + currencyIcon + "</span>";
                  if (response[0][i].PriceChangePercent < 0)
                  {
                    string+= "<ion-icon class=UpOrDown style=color:red; name=caret-down-outline></ion-icon><span class=coinPercent style=color:red;>" + response[0][i].PriceChangePercent + "</span><span class=percentSymbol style=color:red;>%</span>";
                  }
                  else {
                    string+= "<ion-icon class=UpOrDown style=color:green; name=caret-up-outline></ion-icon><span class=coinPercent style=color:green;>" + response[0][i].PriceChangePercent + "</span><span class=percentSymbol style=color:green;>%</span>";
                  }
                  string += "</div>";
                }
                string += "</div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:var(--black2);><ion-icon name=diamond-outline></ion-icon></span>Top " + coinsToDisplay + " Coins</h2>";
                for (let i = 0; i < coinsToDisplay; i++)
                {
                  string += "<div class=CoinDiv><div class=id>" + (i+1) + "</div><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/" + response[1][i].Crypto + ".png></img></span><span class=coinName> " + response[1][i].Crypto + "  </span><span class=coinPrice>" + parseFloat(response[1][i].CurrentPrice) + "</span><span class=dollar> " + currencyIcon + "</span>";
                  if (response[1][i].PriceChangePercent < 0)
                  {
                    string+= "<ion-icon class=UpOrDown style=color:red; name=caret-down-outline></ion-icon><span class=coinPercent style=color:red;>" + response[1][i].PriceChangePercent + "</span><span class=percentSymbol style=color:red;>%</span>";
                  }
                  else {
                    string+= "<ion-icon class=UpOrDown style=color:green; name=caret-up-outline></ion-icon><span class=coinPercent style=color:green;>" + response[1][i].PriceChangePercent + "</span><span class=percentSymbol style=color:green;>%</span>";
                  }
                  string += "</div>";
                }
                string += "</div><div class=GainersBox><h2 class = BoxTittle><span class=Trend style=color:red;><ion-icon name=skull-outline></ion-icon></span>Top " + coinsToDisplay + " Losers 24h</h2>";
                for (let i = 0; i < coinsToDisplay; i++)
                {
                  string += "<div class=CoinDiv><div class=id>" + (i+1) + "</div><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/" + response[2][i].Crypto + ".png></img></span><span class=coinName> " + response[2][i].Crypto + "  </span><span class=coinPrice>" + parseFloat(response[2][i].CurrentPrice) + "</span><span class=dollar> " + currencyIcon + "</span>";
                  if (response[2][i].PriceChangePercent < 0)
                  {
                    string+= "<ion-icon class=UpOrDown style=color:red; name=caret-down-outline></ion-icon><span class=coinPercent style=color:red;>" + response[2][i].PriceChangePercent + "</span><span class=percentSymbol style=color:red;>%</span>";
                  }
                  else {
                    string+= "<ion-icon class=UpOrDown style=color:green; name=caret-up-outline></ion-icon><span class=coinPercent style=color:green;>" + response[2][i].PriceChangePercent + "</span><span class=percentSymbol style=color:green;>%</span>";
                  }
                  string += "</div>";
                }
                keywords = response[0][0].Crypto + ", " + response[2][0].Crypto;
                $('meta[name=KEYWORDS]').attr('content', 'Crypto, Btc Dominance, Top 10 Winners, Top 10 Losers, Cryptocurrencies, ' + keywords + ".");
                document.querySelector('#Prices').innerHTML = string;

                $(".coinPrice").each(function( index,element ) {
                var toValue = parseFloat(response[parseInt(index/coinsToDisplay)][index%coinsToDisplay].CurrentPrice) * currencyMultiplier;

                let decimalsToRound = countDecimals(parseFloat(response[parseInt(index/coinsToDisplay)][index%coinsToDisplay].CurrentPrice))

                $({numberValue: coinPriceBefore[index]}).animate({numberValue: toValue}, {
                  duration: 1000,
                  easing: 'swing',
                  step: function (now) {
                    $(element).text(now.toFixed(decimalsToRound));
                  },
                  });
                });

                $(".coinPercent").each(function( index,element ) {
                var toValue = response[parseInt(index/coinsToDisplay)][index%coinsToDisplay].PriceChangePercent;

                $({numberValue: coinPercentBefore[index]}).animate({numberValue: toValue}, {
                  duration: 1000,
                  easing: 'swing',
                  step: function (now) {
                    $(element).text(now.toFixed(2));
                  },
                  });
                });
              }
              document.querySelector('.loaderSpiner').classList.add('remove');
          }

          requestBackend(0);

          function LoadPricesChange(Coins)
          {
            if (coinsToDisplay != Coins)
            {
              document.querySelector('.loaderSpiner').classList.remove('remove');
              document.querySelectorAll('.GainersBox').forEach((item, i) => {
                item.classList.add('remove')
              });
            }
            coinsToDisplay = Coins;
            requestBackend(0);
          }


      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
