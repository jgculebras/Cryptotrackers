<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/portfolio.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <TITLE>Assets Portfolio, Daily Charts | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Create your portfolio to track your assets. It will track its prices, your profits or losses (P/L) as your overall profit realised.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Portfolio, Assets, Cryptocurrencies.">
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
           <div class="BigBox">
             <h1>Create your cryptocurrency portfolio to track your assets value and trends every day.</h1>
             <div class="CoinsBox">
               <div class="Alert" id="AlertCoins">
                 <div class="text">
                   <a id="clickToLogin" class="dropbtn"><img src="img/MetamaskIcon.svg.png" alt="Metamask Icon"></img>Connect Wallet
                   </a>
                 </div>
               </div>
               <div class="Add">
                 <div class="group">
                   <input id="cryptoFilter" required="" type="text" class="input">
                   <span class="highlight"></span>
                   <span class="bar"></span>
                   <label>Search Crypto By Tag</label>
                 </div>
               </div>
               <h5 class="Tittle">
                 Add Any Crypto
               </h5>
               <div class="Remove">
                 <button type="button" onclick="requestSellCoins(0)"><ion-icon style="color:green" name="cash-outline"></ion-icon>Sell Crypto</button>
               </div>
               <div class="CoinsGrid">
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/1EARTH.png alt="1EARTH Icon"></img></span><span class=coinName>1EARTH</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AAVE.png alt="AAVE Icon"></img></span><span class=coinName>AAVE</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ACH.png alt="ACH Icon"></img></span><span class=coinName>ACH</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ACM.png alt="ACM Icon"></img></span><span class=coinName>ACM</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ADA.png alt="ADA Icon"></img></span><span class=coinName>ADA</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AERGO.png alt="AERGO Icon"></img></span><span class=coinName>AERGO</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ALGO.png alt="ALGO Icon"></img></span><span class=coinName>ALGO</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AMP.png alt="AMP Icon"></img></span><span class=coinName>AMP</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ANKR.png alt="ANKR Icon"></img></span><span class=coinName>ANKR</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/APE.png alt="APE Icon"></img></span><span class=coinName>APE</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ATM.png alt="ATM Icon"></img></span><span class=coinName>ATM</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ATOM.png alt="ATOM Icon"></img></span><span class=coinName>ATOM</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AVAX.png alt="AVAX Icon"></img></span><span class=coinName>AVAX</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AXS.png alt="AXS Icon"></img></span><span class=coinName>AXS</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BAKE.png alt="BAKE Icon"></img></span><span class=coinName>BAKE</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BAT.png alt="BAT Icon"></img></span><span class=coinName>BAT</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BNB.png alt="BNB Icon"></img></span><span class=coinName>BNB</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BTC.png alt="BTC Icon"></img></span><span class=coinName>BTC</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BUSD.png alt="BUSD Icon"></img></span><span class=coinName>BUSD</span></button>
                 <button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/C98.png alt="C98 Icon"></img></span><span class=coinName>C98</span></button>
               </div>

               <div class="PageSelect">
                 <span class="Left hide">
                   <button onclick="changePage('-1')"><ion-icon name="chevron-back-circle"></ion-icon></button>
                 </span>
                 <span class="PageNow">1</span>
                 <span class="Right hide">
                   <button onclick="changePage('1')"><ion-icon name="chevron-forward-circle"></ion-icon></button>
                 </span>
               </div>
             </div>

             <div class="RightDiv">
               <div class="InfoBox">
                 <h6 class="AddText">
                   Add a coin to your wallet to simulate you have bought it for USDT.
                 </h6>
                 <hr>
                 <h6 class="SellText">
                   Sell a coin from your wallet to simulate you have sold it for USDT.
                 </h6>
               </div>
               <div class="PriceOptions remove">
                 <div class="PriceOption Selected"><div class="textPrice">Live Price</div></div>
                 <div class="PriceOption"><div class="textPrice">Fixed Price</div></div>
               </div>
               <div class="ChartBox remove">
                 <div class="Tittle">
                   <img src="img/cryptoicons/BTC.png" alt="BTC Icon">
                   BTC
                 </div>
                 <div class="Form">
                   <div class="PricePerCoin">
                     <div class="TittlePerCoin">
                       $/BTC
                     </div>
                     <div class="Numbers">
                       <span class = "numDoll">$</span><span class="numbersnum">0</span><span class="numCoin"></span>
                     </div>
                   </div>

                   <div class="textInputWrapper">
                     <div class="Label">
                       Amount
                     </div>
                     <input id="qty" type="text" class="textInput" value="0.00">
                   </div>

                   <div class="textInputWrapper">
                     <div class="Label">
                      Amount In USD
                     </div>
                     <input id="qtyInUSD" type="text" class="textInput" value="0.00">
                   </div>

                   <div class="Submit">
                     <button class="Button" onclick="requestAddCrypto()">
                       Submit
                     </button>
                   </div>
                 </div>
               </div>

               <div class="FixedBox remove">
                 <div class="Tittle">
                   <img src="img/cryptoicons/BTC.png" alt="BTC Icon">
                   BTC
                 </div>
                 <div class="Form">
                   <div class="textInputWrapper">
                     <div class="Label">
                       $/BTC
                     </div>
                     <input id="fixedPrice" type="text" class="textInput" value="0.00">
                   </div>

                   <div class="textInputWrapper">
                     <div class="Label">
                       Amount
                     </div>
                     <input id="fixedQty" type="text" class="textInput" value="0.00">
                   </div>

                   <div class="textInputWrapper">
                     <div class="Label">
                       Amount In USD
                     </div>
                     <input id="fixedQtyInUSD" type="text" class="textInput" value="0.00">
                   </div>

                   <div class="FixedSubmit">
                     <button class="Button" onclick="requestAddFixedCrypto()">
                       Submit
                     </button>
                   </div>
                 </div>
               </div>

               <div class="TotalValue">
                 <div class="ValueTittle">
                   Total Assets Value
                 </div>
                 <div class="UsdValue">
                   <span>$</span><span class="num">0</span>
                 </div>

               </div>
               <div class="Reset hide">
                 <button onclick="askForConfirm()">Reset wallet</button>
               </div>
               <div class="confirmation remove">
                 <div class="confirmTittle">
                   Are you sure you want to reset your wallet?
                 </div>
                 <div class="confirmbuttons">
                   <button onclick="resetWallet()">Reset</button>
                   <button onclick="removeConfirmation()" style="background-color: grey;">Don't Reset</button>
                 </div>
               </div>
             </div>

             <div class="PortfolioSummary">
               <div class="PortfolioTittle">
                 Portfolio Summary
               </div>
               <div class="Canvas">
                 <canvas id="doughnutChart" width="150" height="150"></canvas>
               </div>
               <div class="CoinSummary">
                 <div class="TopLine">
                   <div>Icon</div>
                   <div>Price</div>
                   <div>24h</div>
                   <div>Holding</div>
                   <div>Profit/Loss</div>
                 </div>
                 <div class="Lines">
                   <div class="Line">
                     <div><img src="img/cryptoicons/BTC.png" alt="BTC Icon"></div>
                     <div class="PriceNow" style="color:var(--black2)">$1600</div>
                     <div class="24h Growth" style="color:green">5.55%</div>
                     <div class="Holding" style="color:var(--black2)">$1600</div>
                     <div class="Earnings" style="color:green">+ $1000 (2%)</div>
                   </div>
                   <div class="Line">
                     <div><img src="img/cryptoicons/ETH.png" alt="ETH Icon"></div>
                     <div class="PriceNow" style="color:var(--black2)">$1600</div>
                     <div class="24h Growth" style="color:red">-10.3%</div>
                     <div class="Holding" style="color:var(--black2)">$1600</div>
                     <div class="Earnings" style="color:red">- 300$ (2%)</div>
                   </div>
                   <div class="Line">
                     <div><img src="img/cryptoicons/SHIB.png" alt="SHIB Icon"></div>
                     <div class="PriceNow" style="color:var(--black2)">$1600</div>
                     <div class="24h Growth" style="color:green">0.2%</div>
                     <div class="Holding" style="color:var(--black2)">$1600</div>
                     <div class="Earnings" style="color:green">+ 300$ (2%)</div>
                   </div>
                   <div class="Line">
                     <div><img src="img/cryptoicons/USDC.png" alt="USDC Icon"></div>
                     <div class="PriceNow" style="color:var(--black2)">$1600</div>
                     <div class="24h Growth" style="color:green">3.22%</div>
                     <div class="Holding" style="color:var(--black2)">$1600</div>
                     <div class="Earnings" style="color:green">+ 20$ (2%)</div>
                   </div>
                   <div class="Line">
                     <div><img src="img/cryptoicons/DOGE.png" alt="DOGE Icon"></div>
                     <div class="PriceNow" style="color:var(--black2)">$1600</div>
                     <div class="24h Growth" style="color:green">1.11%</div>
                     <div class="Holding" style="color:var(--black2)">$1600</div>
                     <div class="Earnings" style="color:red">- 12.31$ (2%)</div>
                   </div>
                 </div>
                 <div class="PageSelectSumm">
                   <span class="LeftSumm hide">
                     <button onclick="loadPortfolio(-1)"><ion-icon name="chevron-back-circle"></ion-icon></button>
                   </span>
                   <span class="PageNowSumm">1</span>
                   <span class="RightSumm hide">
                     <button onclick="loadPortfolio(1)"><ion-icon name="chevron-forward-circle"></ion-icon></button>
                   </span>
                 </div>
               </div>
             </div>

             <div class="LineCanvas">
               <div class="Alert hide" id="AlertLineChart">
                 <div class="text">
                   <a href="./VIP" class="dropbtn" style="color:#c18423">🐻 BUY [BEAR] VIP TIER 🐻</a>
                 </div>
               </div>
               <h4>Chart considering the P/L of your movements/positions.</h4>
               <div class="TopHeader">
                 <div class="Deposit">
                   <span class="TopHeaderTittle">Deposited:</span>
                   <span class = "TopHeaderNumber" style="color:red">300.12</span>
                   <span class = "TopHeaderDollar" style="color:red">$</span>
                 </div>
                 <div class="Withdraw remove">
                   <span class="TopHeaderTittle">Withdrawn:</span>
                   <span class = "TopHeaderNumber">0</span>
                   <span class = "TopHeaderDollar">$</span>
                 </div>
                 <div class="Assets">
                   <span class="TopHeaderTittle">Assets Value:</span>
                   <span class = "TopHeaderNumber">1006.77</span>
                   <span class = "TopHeaderDollar">$</span>
                 </div>
                 <div class="Total">
                   <span class="TopHeaderTittle">Total:</span>
                   <span class = "TopHeaderNumber">706.65</span>
                   <span class = "TopHeaderDollar">$</span>
                 </div>
               </div>
               <div class="canvasDiv">
                 <canvas id="lineChart" width="200" height="400"></canvas>
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

      <script src="js/chartGradients.js"></script>

      <script>
      // MAIN MENU (loadCoins, loadPortfolio, loadVipsPortfolio)

      let totalValue = 0;

      requestBackend = async function (direction)
      {
        if (address == null || address == "null" || typeof address === 'undefined')
        {
          addDefaultLayout();
        }

        else {
          removeAlertCoins();
        }
        let totalHoldings = 0;

        cryptoFilter.onkeyup = function()
        {
          requestBackend(0);
        }

        let Page = 1;
        if (direction == 0)
        {
          Page = 1;
        }
        else if (document.querySelector('.PageNow') != null)
        {
          Page = document.querySelector('.PageNow').textContent;
        }

        let response = await fetch('https://cryptotrackers.io/portfolio',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Page": parseInt(Page),
              "PageSumm": parseInt(document.querySelector('.PageNowSumm').textContent),
              "directionSumm": 0,
              "direction": parseInt(direction),
              "like": cryptoFilter.value
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        let PageNumber = parseInt(Page) + parseInt(direction);

        const { dataReturned } = await response.json();

        if (response.status == 400)
        {
          document.querySelector('#AlertLineChart').classList.remove('hide');
          addDefaultLayout();
        }

        else if (response.status == 401) {
          document.querySelector('#AlertLineChart').classList.remove('hide');
          addDefaultLayout();
        }

        else
        {
          if (dataReturned[0] != null)
        {
          adding = true;

          document.querySelector('.CoinsGrid').innerHTML = '';
          document.querySelector('.Submit').innerHTML = "<button class=Button onclick=requestAddCrypto()>Submit</button>";
          document.querySelector('.FixedSubmit').innerHTML = "<button class=Button onclick=requestAddFixedCrypto()>Submit</button>";
          document.querySelector('.numDoll').innerHTML = "$";
          document.querySelector('.numCoin').innerHTML = "";
          document.querySelector('.InfoBox').classList.remove('remove');
          document.querySelector('.PriceOptions').classList.add('remove');
          document.querySelector('.PriceOptions').children[0].classList.add('Selected');
          document.querySelector('.PriceOptions').children[1].classList.remove('Selected');
          document.querySelector('.ChartBox').classList.add('remove');
          document.querySelector('.FixedBox').classList.add('remove');
          document.querySelector('.Remove').classList.remove('hide');
          document.querySelector('.Remove').innerHTML = "<button type=button onclick=requestSellCoins(0)><ion-icon name=cash-outline style=color:green></ion-icon>Sell Crypto</button>";
          document.querySelector('.Tittle').innerHTML = "Add Any Crypto";
          document.querySelector('.Left').innerHTML = "<button onclick=requestBackend('-1')><ion-icon name=chevron-back-circle></ion-icon></button>";
          document.querySelector('.Right').innerHTML = "<button onclick=requestBackend('1')><ion-icon name=chevron-forward-circle></ion-icon></button>";

          $(".PageNow").html(PageNumber);

          for (i = 0; i < dataReturned[0][0].length; i++){
            document.querySelector('.CoinsGrid').innerHTML += "<button class=Coin onclick=requestTryToInsert(this.children[1].innerHTML)><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/"  + dataReturned[0][0][i].Crypto + ".png alt='" + dataReturned[0][0][i].Crypto + " Icon'></img></span><span class=coinName> "  + dataReturned[0][0][i].Crypto + "</span></button>";
          }

          if (dataReturned[0][1][0].totalRows == 0)
          {
            document.querySelector('.Left').classList.add('hide');
            document.querySelector('.Right').classList.add('hide');
          }

          else {
            if (dataReturned[0][1][0].totalRows / 40 > PageNumber){
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

        removeAlertCoins();

        }

        if (dataReturned[1] != null && dataReturned[1][0].length != null && dataReturned[1][0].length > 0)
        {
          document.querySelector('.PortfolioSummary').classList.remove('remove');

          //  LOAD PORTFOLIO
          totalValue = 0;

          if (dataReturned[1][1][0].totalRows <= 5)
          {
            document.querySelector('.LeftSumm').classList.add('hide');
            document.querySelector('.RightSumm').classList.add('hide');
          }

          else {
            if (dataReturned[1][1][0].totalRows / 5 > parseInt(document.querySelector('.PageNowSumm').textContent)){
              document.querySelector('.RightSumm').classList.remove('hide');
            }
            else {
              document.querySelector('.RightSumm').classList.add('hide');
            }
          }

          for (var i = 0; i < dataReturned[1][2].length; i++)
          {
            totalValue += dataReturned[1][2][i].CurrentPrice * dataReturned[1][2][i].qty;
          }

          $(".num").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = totalValue;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(2));
              },
            });
          });

          if (totalValue == 0){
            document.querySelector('.Canvas').classList.add('remove');
          }
          else
          {
            document.querySelector('.Canvas').classList.remove('remove');
            let dataJson = {};
            let datatoadd = [];
            arrayCoins = [];
            let string = ""
            totalHoldings = 0;
            for (let i = 0; i < dataReturned[1][2].length; i++) {
              dataJson.value = dataReturned[1][2][i].CurrentPrice * dataReturned[1][2][i].qty;
              dataJson.coin = dataReturned[1][2][i].crypto;
              datatoadd.push(dataJson);
              arrayCoins.push(dataReturned[1][2][i].crypto);
              totalHoldings += parseFloat((dataReturned[1][2][i].qty * dataReturned[1][2][i].CurrentPrice).toFixed(2))
              dataJson = {};
            }
            for (let i = 0; i < dataReturned[1][0].length; i++)
            {
              string += "<div class=Line><div><img src=img/cryptoicons/" + dataReturned[1][0][i].crypto + ".png alt='" + dataReturned[1][0][i].crypto + " Icon'></div><div class=PriceNow style=color:var(--black2)><div class = numDoll>$</div><div class = PriceNum>" + parseFloat(dataReturned[1][0][i].CurrentPrice) + "</div></div>";
              if (dataReturned[1][0][i].PriceChangePercent >= 0)
              {
                string += "<div class = 24hGrowth style=color:green>" + dataReturned[1][0][i].PriceChangePercent + "<span style=color:green>%</span></div>";
              }
              else
              {
                string += "<div class = 24hGrowth style=color:red>" + dataReturned[1][0][i].PriceChangePercent + "<span style=color:red>%</span></div>";
              }
              string += "<div class=Holdings style=color:var(--black2)><div class = numDoll>$</div><div class = Holdingnum>" + (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) +"</div></div>";
              if (dataReturned[1][0][i].cryptoDeposit > (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2))
              {
                string += "<div class=Earnings style=color:red><div class =numDoll>$</div><div class = earningsNum>"+ ((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) - dataReturned[1][0][i].cryptoDeposit).toFixed(2) +"</div><div class = earningsPerc>(-" + (((dataReturned[1][0][i].cryptoDeposit / (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice)) - 1) * 100).toFixed(2)  + "%)</div></div></div>"
              }
              else {
                string += "<div class=Earnings style=color:green><div class =numDoll>$</div><div class = earningsNum>" + ((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) - dataReturned[1][0][i].cryptoDeposit).toFixed(2) + "</div><div class = earningsPerc>(" + ((((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice) / dataReturned[1][0][i].cryptoDeposit) - 1) * 100).toFixed(2) + "%)</div></div></div>"
              }
            }

            document.querySelector(".Lines").innerHTML = string;

            config.data.labels = arrayCoins;
            config.data.datasets[0].data = datatoadd;
          }

          if (doughnutChart !== null){
            doughnutChart.destroy();
          }
          doughnutChart = new Chart(ctx, config);
        }

        else {
          document.querySelector('.PortfolioSummary').classList.add('remove');
          $(".num").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = 0.00;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(2));
              },
            });
          });
        }

        if (dataReturned[2] != null)
        {
          document.querySelector('#AlertLineChart').classList.add('hide');

          if (dataReturned[2].length > 0) {
            //  REMOVE VIP ALERT AND MAKE LINE CHART
            //  When loadPortfolio also load vipChart
            let arrayPrices = [];
            let labels = [];

            let dayToAddOne;
            let dayAdded;

            let maxValue = 0;
            let minValue = 1000000000000;

            for (let i = dataReturned[2].length - 1; i >= 0; i--)
            {
              arrayPrices.push(dataReturned[2][i].totalValue);
              if (dataReturned[2][i].totalValue < minValue)
              {
                minValue = dataReturned[2][i].totalValue;
              }
              if (dataReturned[2][i].totalValue > maxValue)
              {
                maxValue = dataReturned[2][i].totalValue
              }
            }

            for (let i = dataReturned[2].length - 1; i >= 0; i--)
            {
              dayToAddOne = dataReturned[2][i].day.split("T")[0].split("-");
              dayToAddOne[2] = parseInt(dayToAddOne[2]) + 1;
              dayAdded = dayToAddOne.join('-');
              labels.push(dayAdded.split('-')[2] + "/" + dayAdded.split('-')[1]);
            }

            if (minValue == maxValue)
            {
              minValue -= 0.01
            }

            console.log(totalHoldings)
            arrayPrices.push(totalHoldings + parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit));
            labels.push("Now");
            console.log(totalHoldings + parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit))
            console.log(dataReturned[2][0].withdraw)
            console.log(dataReturned[2][0].deposit)
            console.log(arrayPrices)

            console.log(labels);

            config2.data.datasets[0].data = arrayPrices;

            config2.data.labels = labels;

            config2.data.datasets[0].fill.target.value = 0;

            config2.data.datasets[0].borderColor = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradient(ctx2, 0.5, 1, 0, chartArea);
            };
            config2.data.datasets[0].fill.above = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradientBackAbove(ctx2, 0.5, maxValue, minValue, chartArea);
            };
            config2.data.datasets[0].fill.below = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradientBackBelow(ctx2, 0.5, maxValue, minValue, chartArea);
            };

            config2.options.animation.delay = function delay(context){
              let delay = 0;
              if (context.type === 'data' && (context.mode === 'default'|| context.type === 'attach')) {
                delay = context.dataIndex * 150 + context.datasetIndex * 250;
              }
              return delay;
            };

            if (dataReturned[2][0].deposit < dataReturned[2][0].withdraw)
            {
              document.querySelector(".Deposit").classList.add("remove");
              document.querySelector(".Withdraw").classList.remove("remove");
            }
            else {
              document.querySelector(".Withdraw").classList.add("remove");
              document.querySelector(".Deposit").classList.remove("remove");
            }

            if ((totalHoldings + dataReturned[2][0].withdraw - dataReturned[2][0].deposit) < 0)
            {
              document.querySelector(".Total .TopHeaderNumber").style.color = 'red';
              document.querySelector(".Total .TopHeaderDollar").style.color = 'red';
            }

            $(".Deposit .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = parseFloat(dataReturned[2][0].deposit) - parseFloat(dataReturned[2][0].withdraw);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Withdraw .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Total .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = totalHoldings + parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Assets .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = totalHoldings;

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            if (lineChart !== null){
              lineChart.destroy();
            }

            if (!firstLoad)
            {
              setTimeout( function() {
                lineChart.destroy();
                lineChart = new Chart(ctx2,config2);
                firstLoad = true;
                }, 0);
              }
            else {
              lineChart = new Chart(ctx2,config2);
              }
          }
          }
          else
          {
              //  NO VIP SO DISPLAY ALERT AND LINE EXAMPLE.
              document.querySelector('#AlertLineChart').classList.remove('hide');
          }
        }
      }

      loadPortfolio = async function (direction)
      {
        let response = await fetch('https://cryptotrackers.io/portfolio',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Page": 1,
              "PageSumm": parseInt(document.querySelector('.PageNowSumm').textContent),
              "direction": 0,
              "directionSumm": parseInt(direction),
              "like": cryptoFilter.value
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { dataReturned } = await response.json();

        if (response.status == 400)
        {
          // TEMPLATE
          document.querySelector('#AlertLineChart').classList.remove('hide');
          addDefaultLayout();
        }

        else if (response.status == 401) {
          //  YOU ARE NOT WHO YOU SAID
          document.querySelector('#AlertLineChart').classList.remove('hide');
          addDefaultLayout();
        }

        else if (dataReturned[1] != null && dataReturned[1][0].length != null && dataReturned[1][0].length > 0)
        {
          document.querySelector('.PortfolioSummary').classList.remove('remove');

          let PageNumber = parseInt(document.querySelector('.PageNowSumm').textContent) + parseInt(direction);
          if (dataReturned[1][0].length > 0)
          {
            $(".PageNowSumm").html(PageNumber);
          }

          if (dataReturned[1][1][0].totalRows <= 5)
          {
            document.querySelector('.LeftSumm').classList.add('hide');
            document.querySelector('.RightSumm').classList.add('hide');
          }

          else {
            if (dataReturned[1][1][0].totalRows / 5 > PageNumber){
              document.querySelector('.RightSumm').classList.remove('hide');
            }
            else {
              document.querySelector('.RightSumm').classList.add('hide');
            }
            if (PageNumber != 1){
              document.querySelector('.LeftSumm').classList.remove('hide');
            }
            else {
              document.querySelector('.LeftSumm').classList.add('hide');
            }
          }

          //  LOAD PORTFOLIO
          totalValue = 0;

          for (var i = 0; i < dataReturned[1][2].length; i++)
          {
            totalValue += dataReturned[1][2][i].CurrentPrice * dataReturned[1][2][i].qty;
          }

          $(".num").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = totalValue;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(2));
              },
            });
          });

          if (totalValue == 0){
            document.querySelector('.Canvas').classList.add('remove');
          }
          else
          {
            document.querySelector('.Canvas').classList.remove('remove');
            let dataJson = {};
            let datatoadd = [];
            arrayCoins = [];
            let string = "";
            totalHoldings = 0;
            for (let i = 0; i < dataReturned[1][2].length; i++) {
              dataJson.value = dataReturned[1][2][i].CurrentPrice * dataReturned[1][2][i].qty;
              dataJson.coin = dataReturned[1][2][i].crypto;
              datatoadd.push(dataJson);
              arrayCoins.push(dataReturned[1][2][i].crypto);
              totalHoldings += parseFloat((dataReturned[1][2][i].qty * dataReturned[1][2][i].CurrentPrice).toFixed(2))
              dataJson = {};
            }
            for (let i = 0; i < dataReturned[1][0].length; i++)
            {
              string += "<div class=Line><div><img src=img/cryptoicons/" + dataReturned[1][0][i].crypto + ".png alt='" + dataReturned[1][0][i].crypto + " Icon'></div><div class=PriceNow style=color:var(--black2)><div class = numDoll>$</div><div class = PriceNum>" + parseFloat(dataReturned[1][0][i].CurrentPrice) + "</div></div>";
              if (dataReturned[1][0][i].PriceChangePercent >= 0)
              {
                string += "<div class = 24hGrowth style=color:green>" + dataReturned[1][0][i].PriceChangePercent + "<span style=color:green>%</span></div>";
              }
              else
              {
                string += "<div class = 24hGrowth style=color:red>" + dataReturned[1][0][i].PriceChangePercent + "<span style=color:red>%</span></div>";
              }
              string += "<div class=Holdings style=color:var(--black2)><div class = numDoll>$</div><div class = Holdingnum>" + (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) +"</div></div>";
              if (dataReturned[1][0][i].cryptoDeposit > (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2))
              {
                string += "<div class=Earnings style=color:red><div class =numDoll>$</div><div class = earningsNum>"+ ((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) - dataReturned[1][0][i].cryptoDeposit).toFixed(2) +"</div><div class = earningsPerc>(-" + (((dataReturned[1][0][i].cryptoDeposit / (dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice)) - 1) * 100).toFixed(2)  + "%)</div></div></div>"
              }
              else {
                string += "<div class=Earnings style=color:green><div class =numDoll>$</div><div class = earningsNum>" + ((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice).toFixed(2) - dataReturned[1][0][i].cryptoDeposit).toFixed(2) + "</div><div class = earningsPerc>(" + ((((dataReturned[1][0][i].qty * dataReturned[1][0][i].CurrentPrice) / dataReturned[1][0][i].cryptoDeposit) - 1) * 100).toFixed(2) + "%)</div></div></div>"
              }
            }
            config.data.labels = arrayCoins;
            config.data.datasets[0].data = datatoadd;
            document.querySelector('.Lines').innerHTML = string;
          }

          if (doughnutChart !== null){
            doughnutChart.destroy();
          }
          doughnutChart = new Chart(ctx, config);
        }

        else {
          document.querySelector('.PortfolioSummary').classList.add('remove');
        }

        if (dataReturned[2] != null)
        {
          document.querySelector('#AlertLineChart').classList.add('hide');

          if (dataReturned[2].length > 0) {
            let arrayPrices = [];
            let labels = [];

            let dayToAddOne;
            let dayAdded;

            let maxValue = 0;
            let minValue = 1000000000000;

            for (let i = dataReturned[2].length - 1; i >= 0; i--)
            {
              arrayPrices.push(dataReturned[2][i].totalValue);
              if (dataReturned[2][i].totalValue < minValue)
              {
                minValue = dataReturned[2][i].totalValue;
              }
              if (dataReturned[2][i].totalValue > maxValue)
              {
                maxValue = dataReturned[2][i].totalValue
              }
            }

            for (let i = dataReturned[2].length - 1; i >= 0; i--)
            {
              dayToAddOne = dataReturned[2][i].day.split("T")[0].split("-");
              dayToAddOne[2] = parseInt(dayToAddOne[2]) + 1;
              dayAdded = dayToAddOne.join('-');
              labels.push(dayAdded.split('-')[2] + "/" + dayAdded.split('-')[1]);
            }

            arrayPrices.push(totalHoldings + parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit));
            labels.push("Now");


            if (minValue == maxValue)
            {
              minValue -= 0.01
            }

            config2.data.datasets[0].data = arrayPrices;

            config2.data.labels = labels;

            config2.data.datasets[0].fill.target.value = 0;

            config2.data.datasets[0].borderColor = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradient(ctx2, 0.5, maxValue, minValue, chartArea);
            };
            config2.data.datasets[0].fill.above = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradientBackAbove(ctx2, 0.5, maxValue, minValue, chartArea);
            };
            config2.data.datasets[0].fill.below = function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
              return;
              }
              return getGradientBackBelow(ctx2, 0.5, maxValue, minValue, chartArea);
            };

            config2.options.animation.delay = function delay(context){
              let delay = 0;
              if (context.type === 'data' && (context.mode === 'default'|| context.type === 'attach')) {
                delay = context.dataIndex * 150 + context.datasetIndex * 250;
              }
              return delay;
            };

            if (dataReturned[2][0].deposit < dataReturned[2][0].withdraw)
            {
              document.querySelector(".Deposit").classList.add("remove");
              document.querySelector(".Withdraw").classList.remove("remove");
            }
            else {
              document.querySelector(".Withdraw").classList.add("remove");
              document.querySelector(".Deposit").classList.remove("remove");
            }

            if ((totalHoldings + dataReturned[2][0].withdraw - dataReturned[2][0].deposit) < 0)
            {
              document.querySelector(".Total .TopHeaderNumber").style.color = 'red';
              document.querySelector(".Total .TopHeaderDollar").style.color = 'red';
            }

            $(".Deposit .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = parseFloat(dataReturned[2][0].deposit) - parseFloat(dataReturned[2][0].withdraw);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Withdraw .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Total .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = totalHoldings + parseFloat(dataReturned[2][0].withdraw) - parseFloat(dataReturned[2][0].deposit);

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            $(".Assets .TopHeaderNumber").each(function( index,element ) {
              var currentNumber = $(element).text();

              var toValue = totalHoldings;

              $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                  $(element).text(now.toFixed(2));
                },
              });
            });

            if (lineChart !== null){
              lineChart.destroy();
            }

            if (!firstLoad)
            {
              setTimeout( function() {
                lineChart.destroy();
                lineChart = new Chart(ctx2,config2);
                firstLoad = true;
                }, 0);
              }
            else {
              lineChart = new Chart(ctx2,config2);
              }
          }
        }
        else
        {
            //  NO VIP SO DISPLAY ALERT AND LINE EXAMPLE.
            document.querySelector('#AlertLineChart').classList.remove('hide');
        }
      }


      //  SELL COIN MENU

      requestSellCoins = async function (direction)
      {
        cryptoFilter.onkeyup = function()
        {
          requestSellCoins(0);
        }

        let Page = 1;
        if (direction == 0)
        {
          Page = 1;
        }
        else if (document.querySelector('.PageNow') != null)
        {
          Page = document.querySelector('.PageNow').textContent;
        }

        let response = await fetch('https://cryptotrackers.io/portfolioSell',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Page": parseInt(Page),
              "direction": direction,
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

        dataReturned = result;

        if (response.status == 400)
        {
          //  Display Template and Buy Vip HTML

          //  Hide This and Create Template in Main OR FILL WITH OTHER DATA
        }

        else if (response.status == 401)
        {
          // YOU ARE NOT ADDRESS
        }


        else if (dataReturned != null)
        {
          adding = false;

          document.querySelector('.Remove').innerHTML = "<button type=button onclick=requestBackend(0)><ion-icon name=add-circle-outline></ion-icon>Add Crypto</button>";
          document.querySelector('.Tittle').innerHTML = "Sell Any Crypto";
          document.querySelector('.numDoll').innerHTML = "";
          document.querySelector('.Submit').innerHTML = "<button class=Button onclick=requestSellCrypto()>Submit</button>";
          document.querySelector('.FixedSubmit').innerHTML = "<button class=Button onclick=requestSellFixedCrypto()>Submit</button>";
          document.querySelector('.PriceOptions').children[0].classList.add('Selected');
          document.querySelector('.PriceOptions').children[1].classList.remove('Selected');
          document.querySelector('.ChartBox').classList.add('remove');
          document.querySelector('.InfoBox').classList.remove('remove');
          document.querySelector('.PriceOptions').classList.add('remove');
          document.querySelector('.FixedBox').classList.add('remove');
          document.querySelector('.CoinsGrid').innerHTML = "";
          document.querySelector('.Right').innerHTML = "<button onclick=requestSellCoins('1')><ion-icon name=chevron-forward-circle></ion-icon></button>";
          document.querySelector('.Left').innerHTML = "<button onclick=requestSellCoins('-1')><ion-icon name=chevron-back-circle></ion-icon></button>";

          $(".PageNow").html(PageNumber);

          if (dataReturned[0].length == 0)
          {
            document.querySelector('.Left').classList.add('hide');
            document.querySelector('.Right').classList.add('hide');
          }

          for (let i = 0; i < dataReturned[0].length; i++) {
            document.querySelector('.CoinsGrid').innerHTML += "<button class=Coin onclick=requestTryToSell(this.children[1].innerHTML)><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/"  + dataReturned[0][i].Crypto + ".png alt='" + dataReturned[0][i].Crypto + " Icon'></img></span><span class=coinName> "  + dataReturned[0][i].Crypto + "</span></button>";
          }

          if (dataReturned[1][0].totalRows / 40 > PageNumber){
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

      //  INSERT COIN

      requestTryToInsert = async function (cryptoName)
      {
        x = cryptoName.replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
        document.querySelector('.ChartBox').children[0].innerHTML = "<img src=img/cryptoicons/"  + x + ".png alt='" + x + " Icon'>" + x;
        document.querySelector('.FixedBox').children[0].innerHTML = "<img src=img/cryptoicons/"  + x + ".png alt='" + x + " Icon'>" + x;
        document.querySelector('.PriceOptions').classList.remove('remove');
        if (document.querySelector('.FixedBox').classList.contains('remove'))
        {
          document.querySelector('.ChartBox').classList.remove('remove');
        }
        document.querySelector('.InfoBox').classList.add('remove');
        document.querySelector('.PricePerCoin .TittlePerCoin').innerHTML = "$/" + x;
        document.querySelector('.FixedBox .Form').children[0].children[0].innerHTML = "$/"+x;


        let response = await fetch('https://cryptotrackers.io/getCoinPrice',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "CryptoToAdd": document.querySelector('.ChartBox').children[0].textContent,
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result2 } = await response.json();

        if (response.status == 200)
        {
          coinValue = parseFloat(result2[0].CurrentPrice);
          $(".numbersnum").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = result2[0].CurrentPrice;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 500,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(countDecimals(parseFloat(result2[0].CurrentPrice))));
              },
            });
          });
          document.querySelector("#qty").value = (document.querySelector("#qtyInUSD").value / coinValue).toFixed(2);
        }
      }

      requestAddCrypto = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/portfolioAddCoin',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "CryptoToAdd": document.querySelector('.ChartBox').children[0].textContent,
              "qty": parseFloat(document.querySelector('#qty').value)
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { dataReturned } = await response.json();

        if (response.status == 400)
        {
          console.log("Failed to Insert");
        }

        else if (response.status == 401) {
          // Address not you
          console.log("S");
        }

        else
        {
          setTimeout(function()
          {
            loadPortfolio(0);
          }, 100);
        }
      }

      requestAddFixedCrypto = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/portfolioAddFixedCoin',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "CryptoToAdd": document.querySelector('.FixedBox').children[0].textContent,
              "qty": parseFloat(fixedQty.value),
              "price": parseFloat(fixedPrice.value),
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { dataReturned } = await response.json();

        if (response.status == 400)
        {
          console.log("Failed to Insert");
        }

        else if (response.status == 401) {
          // Address not you
          console.log("S");
        }

        else
        {
          setTimeout(function () {
            loadPortfolio(0)}, 100);
        }
      }

      //  SELL COIN
      requestTryToSell = async function (cryptoName)
      {
        x = cryptoName.replace(/[\n\r]+|[\s]{2,}/g, ' ').trim();
        document.querySelector('.ChartBox').children[0].innerHTML = "<img src=img/cryptoicons/"  + x + ".png alt='" + x + " Icon'>" + x;
        document.querySelector('.FixedBox').children[0].innerHTML = "<img src=img/cryptoicons/"  + x + ".png alt='" + x + " Icon'>" + x;
        document.querySelector('.PriceOptions').classList.remove('remove');
        document.querySelector('.FixedBox .Form').children[0].children[0].innerHTML = "$/"+x;
        if (document.querySelector('.FixedBox').classList.contains('remove'))
        {
          document.querySelector('.ChartBox').classList.remove('remove');
        }
        document.querySelector('.InfoBox').classList.add('remove');

        let response = await fetch('https://cryptotrackers.io/portfolioCoinAmount',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "CryptoToSell": document.querySelector('.FixedBox').children[0].textContent,
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 400)
        {
          console.log("BAD");
        }

        else if (response.status == 401) {
          // address not you
        }

        else
        {
          document.querySelector('.PricePerCoin .TittlePerCoin').innerHTML = "Amount You Have";

          document.querySelector('.numCoin').innerHTML = cryptoName;

          $(".numbersnum").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = result[0].qty;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 500,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(countDecimals(parseFloat(result[0].qty))));
              },
            });
          });

          let response = await fetch('https://cryptotrackers.io/getCoinPrice',{
            method : 'POST',
            body: JSON.stringify({
              address,
              params:{
                "CryptoToAdd": document.querySelector('.ChartBox').children[0].textContent,
              },
            }),
            headers: {
              "Content-Type": "application/json",
              'Authorization': "Bearer " + jwtCookie,
            }
          });

          const { result2 } = await response.json();

          if (response.status == 200)
          {
            coinValue = parseFloat(result2[0].CurrentPrice);
            document.querySelector("#qty").value = (document.querySelector("#qtyInUSD").value / coinValue).toFixed(2);
          }
        }

      }

      requestSellCrypto = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/portfolioSellCoin', {
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "CryptoToSell": document.querySelector('.ChartBox').children[0].textContent,
              "qty": parseFloat(document.querySelector('#qty').value)
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 400)
        {
          console.log("Failed to Sell");
        }

        else if (response.status == 401) {
          // address not you
        }

        else
        {
        $(".numbersnum").each(function( index,element ) {
          var currentNumber = $(element).text();

          var toValue = result;

          $({numberValue: currentNumber}).animate({numberValue: toValue}, {
            duration: 500,
            easing: 'swing',
            step: function (now) {
              $(element).text(now.toFixed(countDecimals(parseFloat(result))));
            },
          });
        });

        if (result == 0)
        {
          setTimeout(function() {requestSellCoins(0)}, 100);
        }
        setTimeout(function() {
          loadPortfolio(0)}, 100);
        }
      }

      requestSellFixedCrypto = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/portfolioSellFixedCoin',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "CryptoToSell": document.querySelector('.FixedBox').children[0].textContent,
              "qty": parseFloat(fixedQty.value),
              "price": parseFloat(fixedPrice.value),
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 400)
        {
          console.log("Failed to Sell");
        }

        else if (response.status == 401) {
          // address not you
        }

        else
        {
          if (result == 0)
          {
            setTimeout(function() {requestSellCoins(0)}, 100);
          }
          setTimeout(function() {loadPortfolio(0)}, 100);
        }
      }


      // RESET WALLET

      resetWallet = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/portfolioReset', {
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

        if (response.status == 400)
        {
          console.log("BAD");
        }

        else if (response.status == 401) {
          // address not you
        }

        else {
          $(".num").each(function( index,element ) {
            var currentNumber = $(element).text();

            var toValue = 0;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(2));
              },
            });
          });
          removeConfirmation();
          loadPortfolio(0);
          requestBackend(0);
        }
      }

      function removeAlertCoins()
      {
        document.querySelector('#AlertCoins').classList.add('remove');
        document.querySelector('.Reset').classList.remove('hide');
      }

      function addDefaultLayout()
      {
        document.querySelector('.Lines').innerHTML = "<div class=Line><div><img src=img/cryptoicons/BTC.png></div><div class=PriceNow style=color:var(--black2)>$1600</div><div class=24h Growth style=color:green>5.55%</div><div class=Holding style=color:var(--black2)>$1600</div><div class=Earnings style=color:green>+ 1000$ (2%)</div></div><div class=Line><div><img src=img/cryptoicons/ETH.png></div><div class=PriceNow style=color:var(--black2)>$1600</div><div class=24h Growth style=color:red>-10.3%</div><div class=Holding style=color:var(--black2)>$1600</div><div class=Earnings style=color:red>- 300$ (2%)</div></div><div class=Line><div><img src=img/cryptoicons/SHIB.png></div><div class=PriceNow style=color:var(--black2)>$1600</div><div class=24h Growth style=color:green>0.2%</div><div class=Holding style=color:var(--black2)>$1600</div><div class=Earnings style=color:green>+ 300$ (2%)</div></div><div class=Line><div><img src=img/cryptoicons/USDC.png></div><div class=PriceNow style=color:var(--black2)>$1600</div><div class=24h Growth style=color:red>3.22%</div><div class=Holding style=color:var(--black2)>$1600</div><div class=Earnings style=color:green>+ 20$ (2%)</div></div><div class=Line><div><img src=img/cryptoicons/DOGE.png></div><div class=PriceNow style=color:var(--black2)>$1600</div><div class=24h Growth style=color:green>1.11%</div><div class=Holding style=color:var(--black2)>$1600</div><div class=Earnings style=color:red>- 12.31$ (2%)</div></div>"
        document.querySelector('.ChartBox').classList.add('remove');
        document.querySelector('.FixedBox').classList.add('remove');
        document.querySelector('.PriceOptions').classList.add('remove');
        document.querySelector('.InfoBox').classList.remove('remove');
        document.querySelector('#AlertCoins').classList.remove('remove');
        document.querySelector('.Reset').classList.add('hide');
        document.querySelector('.CoinsGrid').innerHTML = "<button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/1EARTH.png></img></span><span class=coinName>1EARTH</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AAVE.png></img></span><span class=coinName>AAVE</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ACH.png></img></span><span class=coinName>ACH</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ACM.png></img></span><span class=coinName>ACM</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ADA.png></img></span><span class=coinName>ADA</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AERGO.png></img></span><span class=coinName>AERGO</span></button><button class=Coin><span class=CoinIconDiv><img class=coinIcon src=img/cryptoicons/ALGO.png></img></span><span class=coinName>ALGO</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AMP.png></img></span><span class=coinName>AMP</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ANKR.png></img></span><span class=coinName>ANKR</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/APE.png></img></span><span class=coinName>APE</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ATM.png></img></span><span class=coinName>ATM</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/ATOM.png></img></span><span class=coinName>ATOM</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AVAX.png></img></span><span class=coinName>AVAX</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/AXS.png></img></span><span class=coinName>AXS</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BAKE.png></img></span><span class=coinName>BAKE</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BAT.png></img></span><span class=coinName>BAT</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BNB.png></img></span><span class=coinName>BNB</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BTC.png></img></span><span class=coinName>BTC</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/BUSD.png></img></span><span class=coinName>BUSD</span></button><button class=Coin><span class=CoinIconDiv> <img class=coinIcon src=img/cryptoicons/C98.png></img></span><span class=coinName>C98</span></button>";
        document.querySelector('.Left').classList.add('hide');
        document.querySelector('.Right').classList.add('hide');
        document.querySelector('.PageSelect .PageNow').innerHTML = 1;
        $(".num").each(function( index,element ) {
          var currentNumber = $(element).text();

          var toValue = 0.00;

          $({numberValue: currentNumber}).animate({numberValue: toValue}, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
              $(element).text(now.toFixed(2));
            },
          });
        });
      }

      let coinValue = 0;

      qty.onkeyup = function()
      {
        if (qty.value > 0)
        {
          qtyInUSD.value = (qty.value * coinValue).toFixed(2);
        }
      }

      qtyInUSD.onkeyup = function()
      {
        if (qtyInUSD.value > 0)
        {
          qty.value = (qtyInUSD.value / coinValue).toFixed(2);
        }
      }

      fixedQtyInUSD.onkeyup = function ()
      {
        if (fixedQtyInUSD.value > 0)
        {
          if (fixedPrice.value > 0)
          {
            fixedQty.value = (fixedQtyInUSD.value / fixedPrice.value).toFixed(2);
          }
          else if (fixedQty.value > 0)
          {
            fixedPrice.value = (fixedQtyInUSD.value / fixedQty.value).toFixed(2);
          }
        }
      }

      fixedQty.onkeyup = function ()
      {
        if (fixedQty.value > 0)
        {
          if (fixedPrice.value > 0)
          {
            fixedQtyInUSD.value = (fixedQty.value * fixedPrice.value).toFixed(2);
          }
          else if (fixedQtyInUSD.value > 0)
          {
            fixedPrice.value = (fixedQtyInUSD.value / fixedQty.value).toFixed(2);
          }
        }
      }

      fixedPrice.onkeyup = function ()
      {
        if (fixedPrice.value > 0)
        {
          if (fixedQtyInUSD.value > 0)
          {
            fixedQty.value = (fixedQtyInUSD.value / fixedPrice.value).toFixed(2);
          }
          else if (fixedQty.value > 0)
          {
            fixedQtyInUSD.value = (fixedQty.value * fixedPrice.value).toFixed(2);
          }
        }
      }

      function countDecimals(value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0;
      }

      var ctx2 = document.getElementById('lineChart').getContext("2d");

      var config2 = {
      type: "line",
      data: {
        labels:['13d', '12d', '11d', '10d', '9d', '8d', '7d', '6d', '5d', '4d', '3d', '2d', '1d', 'Today'],
        datasets: [{
          label: 'Portfolio',
          data: [-10.11, -102.10, -1.23, 50.02, 100, 200, 300, 502, 650, 777, 1000, 900, 700, 706.55],
          borderColor: function(context) {
            const chart = context.chart;
            const {ctx, chartArea} = chart;

            if (typeof chartArea === 'undefined') {
              // This case happens on initial chart load
              return;
            }
            return getGradient(ctx2, 0.5, 1, 0, chartArea);
          },
          fill:{
            target:{
              value: 0,
            },
            above: function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
                return;
              }
              return getGradientBackAbove(ctx2, 0.5, 1, 0, chartArea);
            },
            below: function(context) {
              const chart = context.chart;
              const {ctx, chartArea} = chart;

              if (typeof chartArea === 'undefined') {
                // This case happens on initial chart load
                return;
              }
              return getGradientBackBelow(ctx2, 0.5, 1, 0, chartArea);
            },
          },
          pointRadius: 1,
          borderJoinStyle: 'round',
          legend: false,
          pointRadius: 0.75,
          borderWidth: 3
        }]
      },
      options:
      {
        responsive: true,
        maintainAspectRatio: false,
        animation: {
            delay: 1000,
          },
        plugins: {
          legend:{
            display: false
          }
        },
        scales: {
            y: {
              ticks: {
                callback: function(value, index, ticks) {
                  if (index % 1 == 0){
                   return value.toFixed(0) +  ' $';
                 }
               },
             },
            font: {
              size: 11
            }
            }
          },
            x:
            {
              grid:
              {
                display:false
              },
              ticks: {
                },
                font: {
                  size: 11
                }
              }
      }};

      var lineChart = new Chart(ctx2, config2);

      let firstLoad = false;


      var ctx = document.getElementById('doughnutChart').getContext("2d");

      var config = {
        type: "doughnut",
        data: {
          labels: ["BTC", "ETH", "SHIB", "USDC", "DOGE"],
          datasets: [{
            label: 'Portfolio Assets',
            data: [1600, 1600, 1600, 1600, 1600],
            backgroundColor: ["#c77031","#a27740","#7d7e4f","#58855f","#338c6e","#0d937e", "#338c6e", "#58855f", "#7d7e4f", "#a27740"],
            hoverOffset: 4
          }]
        },
        options:{
          responsive: true,
          maintainAspectRatio: false,
          parsing:{
            key: 'value'
          },
          plugins:{
            tooltip:{
              callbacks:{
                label: (context) => {
                  return ` ${context.label} `;
                }
              }
            },
            legend:
            {
              display:false,
            }
          }
        }
      };

      var doughnutChart = new Chart(ctx,config);


         $(document).ready(function(){
           main.classList.remove('hide');
         });
      </script>
      <script>
      let displaying = false;
      function askForConfirm()
      {
        if (displaying){
          document.querySelector('.confirmation').classList.add('remove');
          displaying = false;
        }
        else {
          document.querySelector('.confirmation').classList.remove('remove');
          displaying = true;
        }
      }

      function removeConfirmation()
      {
        document.querySelector('.confirmation').classList.add('remove');
        displaying = false;
      }

      let adding = true;

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[2].classList.add('active');

      leftNavButtons[2].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');

      function changeSelectedOption()
      {
        document.querySelectorAll('.PriceOption').forEach((item) =>
          item.classList.remove("Selected"));

          this.classList.add("Selected");
          if (this.firstChild.innerHTML == "Fixed Price")
          {
            document.querySelector(".FixedBox").classList.remove("remove");
            document.querySelector(".ChartBox").classList.add("remove");
          }
          else
          {
            document.querySelector(".FixedBox").classList.add("remove");
            document.querySelector(".ChartBox").classList.remove("remove");
          }
      }

      document.querySelectorAll('.PriceOption').forEach((item) =>
        item.addEventListener('click', changeSelectedOption));


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[2].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[2].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));


         setInterval(function(){
           console.log("Interval Start");
           loadPortfolio(0);
           if (adding)
           {
             changePriceCoin();
           }
         }, 30200);


         changePriceCoin = async function()
         {
           let response = await fetch('https://cryptotrackers.io/getCoinPrice',{
             method : 'POST',
             body: JSON.stringify({
               address,
               params:{
                 "CryptoToAdd": document.querySelector('.ChartBox').children[0].textContent,
               },
             }),
             headers: {
               "Content-Type": "application/json",
               'Authorization': "Bearer " + jwtCookie,
             }
           });

           const { result2 } = await response.json();

           if (response.status == 200)
           {
             coinValue = parseFloat(result2[0].CurrentPrice);
             $(".numbersnum").each(function( index,element ) {
                     var currentNumber = $(element).text();

                     var toValue = parseFloat(result2[0].CurrentPrice);

                     $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                       duration: 500,
                       easing: 'swing',
                       step: function (now) {
                         $(element).text(now.toFixed(countDecimals(parseFloat(result2[0].CurrentPrice))));
                       },
                     });
                 });
             document.querySelector("#qty").value = (document.querySelector("#qtyInUSD").value / coinValue).toFixed(2);
           }
         }

         requestBackend(0);

      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
