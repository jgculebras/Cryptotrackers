<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/PriceAlerts.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <TITLE>Price Movements Alerts | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Find the latest movements of the main cryptocurrencies according to each time frame.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Alerts, Price Alerts.">
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
           <div class="FullBox">
             <h1>Cryptocurrencies movements alerts</h1>
             <h2>In this section you will find the latest movements of the main cryptocurrencies according to each time frame.</h2>
             <div class="OptionsBox">
               <div class="OptionsText">
                 Select which coins you want to show.
               </div>
               <div class="CoinsOptions">
                 <div class="Option Selected" id="0">
                   TOP 10 Coins
                 </div>
                 <div class="Option" id="1">
                   TOP 25 Coins
                 </div>
                 <div class="Option" id="2">
                   TOP 100 Coins
                 </div>
                 <div class="Option" id="3">
                   All Coins
                 </div>
               </div>
             </div>


             <div class="loaderSpiner">
               <div class="face">
                 <div class="circle"></div>
               </div>
               <div class="face">
                 <div class="circle"></div>
               </div>
             </div>


             <div class="NotVip remove">
               <div class="TimeFrames">
                 <div class="TimeText">
                   5 minutes frame.
                 </div>
                 <hr>
                 <div class="Lines">
                   <div class="Line">
                     <div class="AlertText" style="color:#c18423">
                       You are not [🐻] VIP Tier to see this option.
                      </div>
                   </div>
                 </div>
               </div>
               <div class="TimeFrames">
                 <div class="TimeText">
                   15 minutes frame.
                 </div>
                 <hr>
                 <div class="Lines">
                   <div class="Line">
                     <div class="AlertText" style="color:#c18423">
                       You are not [🐻] VIP Tier to see this option.
                     </div>
                   </div>
                 </div>
               </div>
               <div class="TimeFrames">
                 <div class="TimeText">
                   1 hour frame.
                 </div>
                 <hr>
                 <div class="Lines">
                   <div class="Line">
                     <div class="AlertText" style="color:#c18423">
                       You are not [🐻] VIP Tier to see this option.
                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <div class="AlertsBox">
               <div class="TimeFrames">
                 <div class="TimeText">
                   5 minutes frame.
                 </div>
                 <hr>
                 <div class="Lines">
                 </div>
               </div>
               <div class="TimeFrames">
                 <div class="TimeText">
                   15 minutes frame.
                 </div>
                 <hr>
                 <div class="Lines">
                 </div>
               </div>
               <div class="TimeFrames">
                 <div class="TimeText">
                   1 hour frame.
                 </div>
                 <hr>
                 <div class="Lines">
                 </div>
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
      <script>
      requestBackend = async function (direction)
      {
        if (direction < 5)
        {
          document.querySelector('.loaderSpiner').classList.remove('remove');
          document.querySelector('.AlertsBox').classList.add('remove');

          let response = await fetch('https://cryptotrackers.io/alertsCheck',{
            method : 'POST',
            body: JSON.stringify({
              address,
              params:{
                "xCoins": direction,
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
            document.querySelector(".AlertsBox").classList.add("remove");
            document.querySelector(".NotVip").classList.remove("remove");

            document.querySelector('.loaderSpiner').classList.add('remove');
          }

          else
          {
            document.querySelector(".NotVip").classList.add("remove");
            document.querySelector(".AlertsBox").classList.remove("remove");

            if (result.length > 0)
            {
              document.querySelector(".AlertsBox").children[0].children[2].innerHTML = "";

              let count0 = 0;

              for (let i = 0; i < result[0].length; i++)
              {
                if (result[0][i].CurrentPrice / result[0][i].price < 0.995)
                {
                  document.querySelector(".AlertsBox").children[0].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[0][i].Crypto + ".png alt='" + result[0][i].Crypto + " Icon'></div><div class=AlertText style=color:red>" + result[0][i].Crypto + " has fallen down " + (((result[0][i].price / result[0][i].CurrentPrice) - 1) * 100).toFixed(2) +"% in the last 5 minutes.</div></div>";
                  count0 += 1;
                }
                else if (result[0][i].CurrentPrice / result[0][i].price > 1.005)
                {
                  document.querySelector(".AlertsBox").children[0].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[0][i].Crypto + ".png alt='" + result[0][i].Crypto + " Icon'></div><div class=AlertText style=color:green>" + result[0][i].Crypto + " has risen " + (((result[0][i].CurrentPrice/ result[0][i].price) - 1) * 100).toFixed(2) +"% in the last 5 minutes.</div></div>";
                  count0 += 1;
                }
              }

              if (count0 == 0 || result[0].length == 0)
              {
                document.querySelector(".AlertsBox").children[0].children[2].innerHTML = "<div class = NoCoins>None To Show</div>";
              }

              document.querySelector(".AlertsBox").children[1].children[2].innerHTML = "";

              let count1 = 0;

              for (let i = 0; i < result[1].length; i++)
              {
                if (result[1][i].CurrentPrice / result[1][i].price < 0.995)
                {
                  document.querySelector(".AlertsBox").children[1].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[1][i].Crypto + ".png alt='" + result[1][i].Crypto + " Icon'></div><div class=AlertText style=color:red>" + result[1][i].Crypto + " has fallen down " + (((result[1][i].price / result[1][i].CurrentPrice) - 1) * 100).toFixed(2) +"% in the last 15 minutes.</div></div>";
                  count1 += 1;
                }
                else if (result[1][i].CurrentPrice / result[1][i].price > 1.005)
                {
                  document.querySelector(".AlertsBox").children[1].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[1][i].Crypto + ".png alt='" + result[1][i].Crypto + " Icon'></div><div class=AlertText style=color:green>" + result[1][i].Crypto + " has risen " + (((result[1][i].CurrentPrice/ result[1][i].price) - 1) * 100).toFixed(2) +"% in the last 15 minutes.</div></div>";
                  count1 += 1;
                }
              }

              if (count1 == 0 || result[1].length == 0)
              {
                document.querySelector(".AlertsBox").children[1].children[2].innerHTML = "<div class = NoCoins>None To Show</div>";
              }

              document.querySelector(".AlertsBox").children[2].children[2].innerHTML = "";

              let count2 = 0;

              for (let i = 0; i < result[2].length; i++)
              {
                if (result[2][i].CurrentPrice / result[2][i].price < 0.995)
                {
                  document.querySelector(".AlertsBox").children[2].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[2][i].Crypto + ".png alt='" + result[2][i].Crypto + " Icon'></div><div class=AlertText style=color:red>" + result[2][i].Crypto + " has fallen down " + (((result[2][i].price / result[2][i].CurrentPrice) - 1) * 100).toFixed(2) +"% in the last hour.</div></div>";
                  count2 += 1;
                }
                else if (result[2][i].CurrentPrice / result[2][i].price > 1.005)
                {
                  document.querySelector(".AlertsBox").children[2].children[2].innerHTML += "<div class = Line><div class = Coin><img src=img/cryptoicons/" + result[2][i].Crypto + ".png alt='" + result[2][i].Crypto + " Icon'></div><div class=AlertText style=color:green>" + result[2][i].Crypto + " has risen " + (((result[2][i].CurrentPrice/ result[2][i].price) - 1) * 100).toFixed(2) +"% in the last hour.</div></div>";
                  count2 += 1;
                }
              }

              if (count2 == 0 || result[2].length == 0)
              {
                document.querySelector(".AlertsBox").children[2].children[2].innerHTML = "<div class = NoCoins>None To Show</div>";
              }
            }
            document.querySelector('.loaderSpiner').classList.add('remove');
            document.querySelector('.AlertsBox').classList.remove('remove');
          }
        }
      }

      document.querySelectorAll('.Option').forEach((item, i) => {
        item.addEventListener('click', function(e) {

          document.querySelectorAll('.Option').forEach((item, i) => {
            item.classList.remove("Selected");
          });

          item.classList.add("Selected");

          requestBackend(i);
        })
      });

      requestBackend(0);

      function selectButton(buttonToActivate)
      {
        document.querySelectorAll('.Option').forEach((item, i) => {
          item.classList.remove('Selected');
        });
        buttonToActivate.classList.add('Selected');
      }

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[7].classList.add('active');

      leftNavButtons[7].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[7].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[7].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
