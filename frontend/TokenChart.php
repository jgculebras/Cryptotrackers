<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="/css/generalStyle.css">
      <link rel="stylesheet" href="/css/charts.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Cryptocurrency last days charts, price right now, volume last 24 hours and market capitalization.">
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
           <?php
             include('header.html');
           ?>
            <div class="TittleName">
              <h1 class="CoinSelected">
              </h1>
              <div class="CoinSelector">
                <a href="./Charts" class="dropbtn">Select Another Coin</a>
              </div>
            </div>
            <div>
            <h4>Select a timeframe between ticks and how many ticks you want to display.</h4>
            <div class="Canvas">
              <div class="TimeSelection">
                <div class="TimeSelector">
                  <div class="TimeBtn">5m</div>
                </div>
                <div class="TimeSelector">
                  <div class="TimeBtn">15m</div>
                </div>
                <div class="TimeSelector ActiveTime">
                  <div class="TimeBtn">1h</div>
                </div>
                <div class="TimeSelector">
                  <div class="TimeBtn">8h</div>
                </div>
                <div class="TimeSelector">
                  <div class="TimeBtn">1d</div>
                </div>
              </div>
              <div class="ZoomInOut">
                <div class="ZoomSelector">
                  <div class="TicksBtn" id = "Plus"><ion-icon name="add-circle-outline"></ion-icon></div>
                </div>
                <div class="ZoomSelector" id = "PointsQty">
                  30
                </div>
                <div class="ZoomSelector">
                  <div class="TicksBtn" id = "Minus"><ion-icon name="remove-circle-outline"></ion-icon></div>
                </div>
              </div>
              <canvas id="myChart" width="250" height="150"></canvas>
              <div class="utcTime">
                ~ All dates are displayed in UTC Time
              </div>
            </div>
            <div class="Stats">
              <div class="marketCap">
                <h2 class="marketTittle">
                  Market Cap
                </h2>
                <div id="MarketCap" class="totalMarket">
                </div>
              </div>

              <div class="marketCap">
                <h2 class="marketTittle">
                  24h Volume
                </h2>
                <div id="Volume" class="totalMarket">
                </div>
              </div>

              <div class="marketCap">
                <h2 class="marketTittle">
                  Current Price
                </h2>
                <div id="CurrentPrice" class="totalMarket">
                </div>
              </div>

              </div>
            </div>

            <div>
            <h3 class="CoinDescription">
              Bitcoin is a digital currency which operates free of any central control or the oversight of banks or governments. Instead it relies on peer-to-peer software and cryptography. A public ledger records all bitcoin transactions and copies are held on servers around the world.
            </h3>

            <div class="Exchanges">
              <h2 class="ExchangeTittle">
                Where To Buy?
              </h2>
              <hr>
              <div class="Label">
                <div class="ExchangeIcon">
                  <img src="/img/exchanges/Binance.png" alt="Binance Exchange">
                </div>
                <div class="ExchangeName">
                  Binance
                </div>
                <div class="ExchangePair">
                  BTC/USDT
                </div>
                <div class="ExchangeLink">
                  www.binance
                </div>
              </div>
            </div>

          </div>
            <?php
              include('footer.html');
            ?>
         </div>
       </div>
       <script src="/js/chartGradients.js"></script>
       <script>
       var decimals = 0;
       var ctx = document.getElementById('myChart').getContext("2d");

       data2 = [];

       var config = {
        type: "line",
        data: {
          datasets: [{
          label: 'Price',
          data: data2,
          borderColor: function(context) {
           const chart = context.chart;
           const {ctx, chartArea} = chart;

           if (!chartArea) {
                 // This case happens on initial chart load
             return;
           }
           return getGradient(ctx, 0.5, 1, 0, chartArea);
          },
          fill:{
           target:{
             value: 500,
           },
           above: function(context) {
             const chart = context.chart;
             const {ctx, chartArea} = chart;

             if (typeof chartArea === 'undefined') {
               // This case happens on initial chart load
               return;
             }
             return getGradientBackAbove(ctx, 0.5, 1, 0, chartArea);
           },
           below: function(context) {
             const chart = context.chart;
             const {ctx, chartArea} = chart;

             if (typeof chartArea === 'undefined') {
               // This case happens on initial chart load
               return;
             }
             return getGradientBackBelow(ctx, 0.5, 1, 0, chartArea);
           },
           },
           pointRadius: 1,
           borderJoinStyle: 'round',
           legend: false,
           responsive:true,
           maintainAspectRatio: false,
           pointRadius: 0.75,
           borderWidth: 3
          }]
         },
         options:
         {
           responsive: true,
             animation: {
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
                      return value.toFixed(decimals) +  ' $';
                    }
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
                   autoSkip: false,
                   callback: function(value, index, ticks) {
                      if (index % 3 == 0){
                       return 24-value + 'h';
                     }
                   },
                   font: {
                     size: 11
                   }
                 }
               }
           }
         }};

         var myChart = new Chart(ctx, config);

         </script>
      </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script>
      var points = 30;

      var timePassed = '';

      var countDecimals = function (value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0;
      }

      function numberWithCommas(x) {
	if (x === null)
	  return 0;
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      }
      </script>
      <script>
      let requestBackend = async function ()
      {

      }

      let requestBackendStart = async function (time, points)
      {
        var ticks;
        timePassed = time;
        if (time == '5m')
        {
          ticks = 5;
        }
        else if (time == '15m') {
          ticks = 15;
        }
        else if (time == '1h') {
          ticks = 60;
        }
        else if (time == '8h') {
          ticks = 480;
        }
        else if (time == '1d') {
          ticks = 1440;
        }
        else {
          ticks = 60;
        }

        let response = await fetch('https://cryptotrackers.io/chart',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Crypto": CryptoPassed,
              "time" : parseInt(ticks),
              "points" : parseInt(points)
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 200)
        {
          $(".CoinSelected").html("<img class=IconChart src=/img/cryptoicons/" + CryptoPassed + ".png></img>" + CryptoPassed + " Chart");

          let stringtoadd = "";
          let stringDesc = "";

          if (result[1][0].PriceChangePercent < 0)
          {
            stringtoadd = "However in the last 24 hours its price has fall down " + result[1][0].PriceChangePercent + "%, with a total Volume of $" + numberWithCommas(result[0][0].Volume) + ".";
            stringDesc = "In the last 24 hours its price has fall down " + result[1][0].PriceChangePercent + "%, with a total Volume of $" + numberWithCommas(result[0][0].Volume) + ".";
          }

          else {
            stringtoadd = "In the last 24 hours its price has grown up " + result[1][0].PriceChangePercent + "%, with a total Volume of $" + numberWithCommas(result[0][0].Volume) + ".";
            stringDesc = "In the last 24 hours its price has grown up " + result[1][0].PriceChangePercent + "%, with a total Volume of $" + numberWithCommas(result[0][0].Volume) + ".";
          }

          $('meta[name=DESCRIPTION]').attr('content', CryptoPassed + ' last days charts, price right now, volume last 24 hours and market capitalization. ' + stringDesc);
          $('meta[name=KEYWORDS]').attr('content', 'Crypto, Btc Dominance, Top 10 Winners, Top 10 Losers, Cryptocurrencies, ' + CryptoPassed + ".");


          $(".CoinDescription").html(CryptoPassed + " is the number " + result[1][0].rowid + " in the top Cryptocurrencies by Market Cap with a total Market Cap of $" + numberWithCommas(result[0][0].MarketCap) + ". <br>" + stringtoadd + "<br>");

          document.querySelector('#PointsQty').innerHTML = result[0].length;

          let prices = [];
          let labels = [];

          let maxValue, minValue;

          if (parseFloat(result[0][0].price) <= 1e-5)
              decimals = countDecimals(result[0][0].price);
          else
              decimals = countDecimals(parseFloat(result[0][0].price));

          var firstDayLocal = new Date();

          var firstDay = new Date(firstDayLocal.getUTCFullYear(), firstDayLocal.getUTCMonth(),
              firstDayLocal.getUTCDate(), firstDayLocal.getUTCHours(),
              firstDayLocal.getUTCMinutes(), firstDayLocal.getUTCSeconds())

          var todayLocal = new Date();

          var today = new Date(todayLocal.getUTCFullYear(), todayLocal.getUTCMonth(),
              todayLocal.getUTCDate(), todayLocal.getUTCHours(),
              todayLocal.getUTCMinutes(), todayLocal.getUTCSeconds())

          var newIndex;

          var nowDayMins = ((today.getHours() * 60) +  today.getMinutes());

          if (ticks == 1440)
          {
            today.setDate(today.getDate() - 1);
          }
          else
          {
            today.setMinutes(today.getMinutes() - today.getMinutes() % ticks);
          }

          for (let i = result[0].length - 1; i >= 0; i--)
          {
            if (i == result[0].length - 1)
            {
              maxValue = result[0][i].price;
              minValue = result[0][i].price;
            }

            else {
              if (result[0][i].price < minValue)
              {
                minValue = result[0][i].price;
              }
              if (result[0][i].price > maxValue) {
                maxValue = result[0][i].price;
              }
            }

            prices.push(parseFloat(result[0][i].price));

            if (today.getDate() != firstDay.getDate())
            {
              if (ticks != 1440)
              {
                labels[0] = today.getDate()+1 + "-" + parseInt(today.getMonth()+1);
              }
              if (ticks != 1440)
              {
                if (today.getMinutes() >= 0 && today.getMinutes() < 10) {
                  labels.unshift(today.getHours() + ":0" + today.getMinutes());
                }
                else
                {
                  labels.unshift(today.getHours() + ":" + today.getMinutes());
                }
              }
              else {
                console.log(today.getDate() + "/" + parseInt(today.getMonth()+1));

                labels.unshift(today.getDate() + "-" + parseInt(today.getMonth()+1));
              }
              newIndex = (i+1) % 3;
              firstDay.setDate(today.getDate());
            }

            else {
                if (today.getMinutes() >= 0 && today.getMinutes() < 10) {
                  labels.unshift(today.getHours() + ":0" + today.getMinutes());
                }
                else
                {
                  labels.unshift(today.getHours() + ":" + today.getMinutes());
                }
            }
            if (ticks == 1440)
            {
              today.setDate(today.getDate() - 1);
            }
            else {
              today.setMinutes(today.getMinutes() - today.getMinutes() % ticks - ticks);
            }
          }

          prices.push(result[0][0].CurrentPrice);

          labels.push("Now");

          config.data.datasets[0].data = prices;
          config.options.scales.y.suggestedMax = maxValue;
          config.options.scales.y.suggestedMin = minValue;
          config.data.datasets[0].borderColor = function(context) {
            const chart = context.chart;
            const {ctx, chartArea} = chart;

            if (typeof chartArea === 'undefined') {
              // This case happens on initial chart load
            return;
            }
            return getGradient(ctx, prices[0], maxValue, minValue, chartArea);
          };
          config.data.datasets[0].fill.target.value = prices[0];
          config.data.datasets[0].fill.above = function(context) {
            const chart = context.chart;
            const {ctx, chartArea} = chart;

            if (typeof chartArea === 'undefined') {
              // This case happens on initial chart load
            return;
            }
            return getGradientBackAbove(ctx, prices[0], maxValue, minValue, chartArea);
          };
          config.data.datasets[0].fill.below = function(context) {
            const chart = context.chart;
            const {ctx, chartArea} = chart;

            if (typeof chartArea === 'undefined') {
              // This case happens on initial chart load
            return;
            }
            return getGradientBackBelow(ctx, prices[0], maxValue, minValue, chartArea);
          };
          config.data.labels = labels;

          config.options.scales.x.ticks.callback = function(value, index, ticks)
          {
            var xToAdd = labels[index];
            if (typeof newIndex !== "undefined")
            {
              if (((index % 5) - newIndex) == 0)
              {
                return xToAdd;
              }
              else {
                return '';
              }
            }
            else {
              if (index % 5 == 0)
              {
                return labels[index];
              }
              else {
                return '';
              }
            }
          }

          $("#MarketCap").each(function( index,element ) {
          var currentNumber = 0;

          var toValue = result[0][0].MarketCap;

          $({numberValue: currentNumber}).animate({numberValue: toValue}, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
              $(element).text(numberWithCommas((now.toFixed(0))) + ' $');
            },
            });
          });

          $("#CurrentPrice").each(function( index,element ) {
          var currentNumber = 0;

          var toValue = result[0][0].CurrentPrice;

          $({numberValue: currentNumber}).animate({numberValue: toValue}, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
              $(element).text(now.toFixed(decimals) + ' $');
            },
            });
          });

          $("#Volume").each(function( index,element ) {
          var currentNumber = 0;

          var toValue = result[0][0].Volume;

          $({numberValue: currentNumber}).animate({numberValue: toValue}, {
            duration: 1000,
            easing: 'swing',
            step: function (now) {
              $(element).text(numberWithCommas((now.toFixed(0))) + ' $');
            },
            });
          });

          config.options.animation.delay = function delay(context){
            let delay = 0;
            if (context.type === 'data' && (context.mode === 'default'|| context.type === 'attach')) {
              delay = context.dataIndex * 85 + context.datasetIndex * 100;
            }
            return delay;
          };

          if (myChart !== null){
            myChart.destroy();
          }

          if (!firstLoad)
          {
          setTimeout( function() {
            myChart = new Chart(ctx,config);
            firstLoad = true;
          }, 0);
          }
          else {
            myChart = new Chart(ctx,config);
          }


          if (result[2] != null)
          {
            document.querySelector('.Exchanges').innerHTML = "<h2 class=ExchangeTittle>Where To Buy?</h2><hr>";
            for (let i = 0; i < result[2].length; i++)
            {
              if (result[2][i].exchange == "Binance")
              {
                document.querySelector('.Exchanges').innerHTML += "<div class=Label><div class=ExchangeIcon><img src=/img/exchanges/" + result[2][i].exchange + ".png alt='" + result[2][i].exchange + " Exchange'></div><div class=ExchangeName>" + result[2][i].exchange + "</div><div class=ExchangePair>" + CryptoPassed + "/USDT</div><a class=ExchangeLink  href=https://accounts.binance.com/es/register?ref=130534715>Link</a></div>";
              }
              else if (result[2][i].exchange == "Kucoin") {
                document.querySelector('.Exchanges').innerHTML += "<div class=Label><div class=ExchangeIcon><img src=/img/exchanges/" + result[2][i].exchange + ".png alt='" + result[2][i].exchange + " Exchange'></div><div class=ExchangeName>" + result[2][i].exchange + "</div><div class=ExchangePair>" + CryptoPassed + "/USDT</div><a class=ExchangeLink href=https://www.kucoin.com/ucenter/signup?rcode=r3ADNZ5>Link</a></div>";
              }
            }
          }
        }
      }

      let firstLoad = false;

      var CryptoPassed = window.location.href.split('/').pop();

      if (window.location.href.includes("TokenChart?Crypto="))
      {
        CryptoPassed = window.location.href.split('TokenChart?Crypto=').pop();
      }

      if (CryptoPassed !== null){
        document.title = CryptoPassed + " Price, Chart, Volume, Market Cap. | CryptoTrackers";
        requestBackendStart('1h', 30);
      }

      $(document).ready(function(){
        main.classList.remove('hide');
      });

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


      let TimeList = document.querySelectorAll('.TimeSelector');
      let timeActive = document.querySelector('.ActiveTime');

      let Plus = document.querySelector('#Plus');
      let Minus = document.querySelector('#Minus');

         function activeTime(){
           TimeList.forEach((item) =>
           item.classList.remove('hoveredTime'));
           this.classList.add('hoveredTime');
           timeActive.classList.remove('ActiveTime');
         }

         TimeList.forEach((item) => {
           item.addEventListener('mouseover', activeTime);
         });

         function deleteTime(){
           TimeList.forEach((item) =>
           item.classList.remove('hoveredTime'));
           timeActive.classList.add('ActiveTime');
         }

         TimeList.forEach((item) => {
           item.addEventListener('mouseleave', deleteTime);
         });


         function changeTime(){
           timeActive.classList.remove('ActiveTime');
           timeActive = this;
           this.classList.add('ActiveTime');
           requestBackendStart(this.children[0].innerHTML, points);
         }

         TimeList.forEach((item) => {
           item.addEventListener('click', changeTime);
         })

         Plus.addEventListener('click', addTicks);
         Minus.addEventListener('click', restTicks);

         function addTicks()
         {
           if (points < 90)
           {
             points += 10;
             if (points >= 90)
             {
               document.querySelector('#Plus').classList.add('hideVis');
             }
             document.querySelector('#Minus').classList.remove('hideVis');
             requestBackendStart(timePassed, points);
           }
         }

      function restTicks()
      {
        if (points > 10)
        {
          points -= 10;
          if (points <= 10)
          {
            document.querySelector('#Minus').classList.add('hideVis');
          }
          document.querySelector('#Plus').classList.remove('hideVis');
          requestBackendStart(timePassed, points);
        }
      }


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));

         window.addEventListener("load",() =>
         [...document.querySelectorAll("a[target=_blank]")]
         .forEach(lnk => lnk.setAttribute("rel", "noopener noreferrer"))
         );
      </script>
      <script src="/js/Metamask.js"></script>
   </body>
</html>
