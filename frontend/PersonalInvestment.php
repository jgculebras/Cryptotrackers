<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/pinvestment.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <TITLE>Personal Investment | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Find our movements and investments in the crypto ecosystem.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Personal Investment.">
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
           <div class="pInvestmentBoxTest remove">
             <h1 class="tittleTest">Personal Investment</h1>
             <h2>In this section you will find our movements and investments in the crypto ecosystem.</h2>
             <div class="MovesBoxTest">
               <div class="Alert hide">
                 <div class="text">
                   <a href="./VIP" class="dropbtn" style="color:#784a42">🐂 BUY [BULL] VIP TIER 🐂</a>
                 </div>
               </div>
               <div class="LeftBoxTest">
                 <div class="MonthMovesTest">
                   <div class="MonthTest">
                     <div class="nameTest">
                       September 2022
                     </div>
                     <div class="ActionTest" style="color:green">
                       <span style="color:var(--black2)">
                         - September 23 (22:15)
                       </span>
                        Sold 1 Infected Mob For 7.5 SOL (225$).
                     </div>
                     <div class="ActionTest" style="color:red">
                       <span style="color:var(--black2)">
                         - September 20 (21:00)
                       </span>
                       Bought 1 ETH For 1350$.
                      </div>
                      <div class="ActionTest" style="color:green">
                        <span style="color:var(--black2)">
                          - September 15 (18:10)
                        </span>
                         Sold 4 SOL For 153$.
                      </div>
                      <div class="ActionTest" style="color:green">
                        <span style="color:var(--black2)">
                          - September 12 (15:25)
                        </span>
                         Sold 6 SOL For 210$.
                      </div>
                      <div class="ActionTest" style="color:red">
                        <span style="color:var(--black2)">
                          - September 08 (16:55)
                        </span>
                         Bought 10 SOL For 320$.
                      </div>
                      <div class="ActionTest" style="color:red">
                        <span style="color:var(--black2)">
                          - September 02 (10:20)
                        </span>
                         Bought 1 Infected Mob For 5 SOL (150$).
                      </div>
                    </div>
                    <div class="MonthTest">
                      <div class="nameTest">
                        August 2022
                      </div>
                      <div class="ActionTest" style="color:green">
                        <span style="color:var(--black2)">
                          - August 29 (12:33)
                        </span>
                         Sold 1 Jarpix Dao Pass For 10 SOL (330$)
                      </div>
                    </div>
                 </div>
                 <div class="utcTime">
                   ~ All dates are displayed in UTC Time
                 </div>
                 <div class="PageSelectTest">
                   <span class="LeftTest hide">
                     <button><ion-icon name="chevron-back-circle"></ion-icon></button>
                   </span>
                   <span class="PageNowTest">1</span>
                   <span class="RightTest hide">
                     <button><ion-icon name="chevron-forward-circle"></ion-icon></button>
                   </span>
                 </div>
               </div>
               <div class="RightBoxTest">
                 <div class="profitBoxTest">
                   <div class="TittleBoxTest">
                     Total Profit
                   </div>
                   <hr>
                   <div id = "profitTest" class="NumberBoxTest" style="color:green">
                     1543,25 $
                   </div>
                 </div>
                 <div class="profitBoxTest">
                   <div class="TittleBoxTest">
                     Total Assets Holding
                   </div>
                   <hr>
                   <div id = "assetsTest" class="NumberBoxTest" style="color:var(--black2)">
                     1425,25 $
                   </div>
                 </div>
                 <div class="profitBoxTest">
                   <div class="TittleBoxTest">
                     Total Deposit
                   </div>
                   <hr>
                   <div id = "depositTest" class="NumberBoxTest" style="color:red">
                     400 $
                   </div>
                 </div>
                 <div class="profitBoxTest">
                   <div class="TittleBoxTest">
                     Total Withdraw
                   </div>
                   <hr>
                   <div id = "withdrawTest" class="NumberBoxTest" style="color:green">
                     518 $
                   </div>
                 </div>
               </div>
             </div>
           </div>

           <div class="pInvestmentBox">
             <h1 class="tittleTest">Personal Investment</h1>
             <h2>In this section you will find our movements and investments in the crypto ecosystem.</h2>
             <div class="MovesBox">
               <div class="LeftBox">
                 <div class="MonthMoves">
                 </div>
                 <div class="utcTime">
                   ~ All dates are displayed in UTC Time
                 </div>
                 <div class="PageSelect">
                   <span class="Left hide">
                     <button onclick="requestBackend('-1')"><ion-icon name="chevron-back-circle"></ion-icon></button>
                   </span>
                   <span class="PageNow">1</span>
                   <span class="Right">
                     <button onclick="requestBackend('1')"><ion-icon name="chevron-forward-circle"></ion-icon></button>
                   </span>
                 </div>
               </div>
               <div class="RightBox">
                 <div class="profitBox">
                   <div class="TittleBox">
                     Total Profit
                   </div>
                   <hr>
                   <div id = "profit" class="NumberBox">
                   </div>
                 </div>
                 <div class="profitBox">
                   <div class="TittleBox">
                     Total Assets Holding
                   </div>
                   <hr>
                   <div id = "assets" class="NumberBox">
                   </div>
                 </div>
                 <div class="profitBox">
                   <div class="TittleBox">
                     Total Deposit
                   </div>
                   <hr>
                   <div id = "deposit" class="NumberBox">
                   </div>
                 </div>
                 <div class="profitBox">
                   <div class="TittleBox">
                     Total Withdraw
                   </div>
                   <hr>
                   <div id = "withdraw" class="NumberBox">
                     30,203$
                   </div>
                 </div>
               </div>
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
        let Page = 1;
        if (document.querySelector('.PageNow') != null)
        {
          Page = document.querySelector('.PageNow').textContent;
        }

        let response = await fetch('https://cryptotrackers.io/pInvestment',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Page": parseInt(Page),
              "direction": parseInt(direction)
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
          document.querySelector('.pInvestmentBoxTest').classList.remove('remove');
          document.querySelector('.pInvestmentBox').classList.add('remove');
          document.querySelector('.Alert').classList.remove('hide');
        }

        else if (response.status == 401)
        {
          document.querySelector('.pInvestmentBoxTest').classList.remove('remove');
          document.querySelector('.pInvestmentBox').classList.add('remove');
          document.querySelector('.Alert').classList.remove('hide');
        }

        else
        {
          document.querySelector('.pInvestmentBoxTest').classList.add('remove');
          document.querySelector('.Alert').classList.add('hide');
          document.querySelector('.pInvestmentBox').classList.remove('remove');

          var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
          document.querySelector('.MonthMoves').innerHTML = '';

          for (let i = 0; i < dataReturned[1][0].totalRows; i++)
          {
            var x = dataReturned[0][i].day.split("-");
            if (dataReturned[0][i].mins >= 0 && dataReturned[0][i].mins < 10) {
              var min = "0"+dataReturned[0][i].mins;
            }
            else {
              var min = dataReturned[0][i].mins;
            }
            var month = months[parseInt(x[1]) - 1];
            if (document.getElementById(month + "moves" + x[0]) == null)
            {
              document.querySelector('.MonthMoves').innerHTML += "<div class = Month id = " + month + "moves" + x[0] + "><div class = name>" + month + " " + x[0] + "</div>";
            }
            document.getElementById(month + "moves" + x[0]).innerHTML += "<div class = Action style= color:" + dataReturned[0][i].color + "><span style=color:var(--black2)>- " + month + " " + x[2].split("T")[0] + " (" + dataReturned[0][i].hour + ":" + min + ")</span> " + dataReturned[0][i].actiondesc + "</div>";
          }
          document.querySelector('.PageNow').innerHTML = 1;
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

          response = await fetch('https://cryptotrackers.io/pInvestmentProfit',{
            method : 'POST',
            body: JSON.stringify({
              address,
            }),
            headers: {
              "Content-Type": "application/json",
              'Authorization': "Bearer " + jwtCookie,
            }
          });

          const { profitData } = await response.json();

          if (response.status == 200)
          {
            if (profitData[0][0].profit < 0)
            {
              document.getElementById("profit").style.color = "red";
            }
            else {
              document.getElementById("profit").style.color = "green";
            }
            var decimals = countDecimals(profitData[0][0].assets);

            $("#assets").each(function( index,element ) {
            var currentNumber = 0;

            var toValue = profitData[0][0].assets;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text((now.toFixed(decimals)) + ' $');
              },
              });
            });

            decimals2 = countDecimals(profitData[0][0].deposit);

            $("#deposit").each(function( index,element ) {
            var currentNumber = 0;

            var toValue = profitData[0][0].deposit;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text((now.toFixed(decimals2)) + ' $');
              },
              });
            });

            decimals3 = countDecimals(profitData[0][0].withdraw);

            $("#withdraw").each(function( index,element ) {
            var currentNumber = 0;

            var toValue = profitData[0][0].withdraw;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text((now.toFixed(decimals3)) + ' $');
              },
              });
            });

            decimals4 = countDecimals(profitData[0][0].profit);

            $("#profit").each(function( index,element ) {
            var currentNumber = 0;

            var toValue = profitData[0][0].profit;

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text((now.toFixed(decimals4)) + ' $');
              },
              });
            });
          }
        }

      }

      requestBackend(0);

      function countDecimals(value) {
        if(Math.floor(value) === value) return 0;
        return value.toString().split(".")[1].length || 0;
      }

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[9].classList.add('active');

      leftNavButtons[9].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[9].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[9].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
