<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="/css/generalStyle.css">
      <link rel="stylesheet" href="/css/chaingas.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Select a chain to get its last gas fees and a grid about the last week average fees ordered by day and hour..">
      <META NAME="KEYWORDS" CONTENT="Crypto, Utilities, Gas Tracker, Ethereum, BSC, Avax, Polygon, Gas Fee, Cryptocurrencies.">
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
             <h1>Live average transaction fee.</h1>
             <div class="loaderSpiner" style="position:absolute; top:calc(50% - 3em);">
               <div class="face">
                 <div class="circle"></div>
               </div>
               <div class="face">
                 <div class="circle"></div>
               </div>
             </div>
             <div class="GasGrid">
             </div>
             <h1>Average transaction fee by day and hour.</h1>
             <div class="Table">
             </div>
             <div class="utcTime">
               ~ All dates are displayed in UTC Time
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
      var Chain = window.location.href.split('/').pop();

      document.title = Chain + " Live Gas Fee | CryptoTrackers"

      $('meta[name=KEYWORDS]').attr('content', 'Crypto, Utilities, Gas Tracker, Gas Fee, Cryptocurrencies, ' + Chain + '.');

      var firstLoad = true;

      let requestBackend = async function ()
      {

      }

      let requestBackendStart = async function(Chain)
      {
        let response = await fetch('https://cryptotrackers.io/chainGas',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "chain" : Chain
            }
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 200)
        {
          console.log(result);

          let gasTittle = ['LOW', 'MEDIUM', 'FAST']
          let gas = [result[0].low, result[0].median, result[0].fast];
          let num = [0.000021*result[0].CurrentPrice*result[0].low,0.000021*result[0].CurrentPrice*result[0].median,0.000021*result[0].CurrentPrice*result[0].fast]
          $('meta[name=DESCRIPTION]').attr('content', 'Check the last week average fees by day and hour. ' + Chain + ' Live Gas fees: Low: ' + gas[0] + ' Gwei | Median: ' + gas[1] + ' Gwei | Fast: ' + gas[2] + ' Gwei.');
          if (firstLoad)
          {
          document.querySelector('.GasGrid').innerHTML = '';
          for (i = 0; i < gas.length; i++){
            document.querySelector('.GasGrid').innerHTML += '<div class = GasBox> <h4 class = GasEnum>' + gasTittle[i] + '</h4><div class = GasNum> <div class = GasQty></div><div class = Gwei>Gwei</div></div><div class = usdPrice><div class = num></div><div class=dollar>$</div></div></div>';
          }
          }
          $(".num").each(function( index,element ) {
                  var currentNumber = $(element).text();

                  var toValue = num[index];

                  $({numberValue: currentNumber}).animate({numberValue: toValue}, {
                    duration: 1000,
                    easing: 'swing',
                    step: function (now) {
                      $(element).text(now.toFixed(2));
                    },
                  });
              });

          $(".GasQty").each(function( index, element) {
            var currentNumber = $(element).text();

            var toValue = gas[index];

            $({numberValue: currentNumber}).animate({numberValue: toValue}, {
              duration: 1000,
              easing: 'swing',
              step: function (now) {
                $(element).text(now.toFixed(1));
              },
            });
          });
          firstLoad = false;
        }

        document.querySelector('.loaderSpiner').classList.add('remove');

      }

      let loadAvgFee = async function(Chain)
      {
        let response = await fetch('https://cryptotrackers.io/chainAvgGas',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "chain" : Chain
            }
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();

        if (response.status == 200)
        {
          console.log(result);


          var higherValue = result[1][0].HigherGas;
          var lowerValue = result[1][0].LowerGas;
          var diff = higherValue - lowerValue;

          document.querySelector('.Table').innerHTML = "<table id=gasTable><tr> <th>Hour</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>";

          let i = 0;
          let x = 0;

          var stringToAdd = "<tr><td>0</td>";


          let cont = 0;

          do
          {

            if (result[0][cont].day == x && result[0][cont].hour == i)
            {
              var color = ((result[0][cont].fast - lowerValue) / diff);
              if (color < 0.033){
                var back = '#00ff00';
              }
              else if (color < 0.066){
                var back = '#3ffa00';
              }
              else if (color < 0.1){
                var back = '#59f400';
              }
              else if (color < 0.133){
                var back = '#6cef00';
              }
              else if (color < 0.166){
                var back = '#7be900';
              }
              else if (color < 0.2){
                var back = '#88e300';
              }
              else if (color < 0.233){
                var back = '#94dd00';
              }
              else if (color < 0.266){
                var back = '#9ed700';
              }
              else if (color < 0.3){
                var back = '#a7d100';
              }
              else if (color < 0.333){
                var back = '#b0cb00';
              }
              else if (color < 0.366){
                var back = '#b8c500';
              }

              else if (color < 0.4){
                var back = '#c0be00';
              }
              else if (color < 0.433){
                var back = '#c7b800';
              }
              else if (color < 0.466){
                var back = '#ceb100';
              }
              else if (color < 0.5){
                var back = '#d4aa00';
              }
              else if (color < 0.533){
                var back = '#d9a300';
              }
              else if (color < 0.566){
                var back = '#df9c00';
              }
              else if (color < 0.6){
                var back = '#e49400';
              }
              else if (color < 0.633){
                var back = '#e88c00';
              }
              else if (color < 0.666){
                var back = '#ec8400';
              }
              else if (color < 0.7){
                var back = '#f07c00';
              }
              else if (color < 0.733){
                var back = '#f66b00';
              }
              else if (color < 0.766){
                var back = '#f96100';
              }
              else if (color < 0.8){
                var back = '#fb5800';
              }
              else if (color < 0.833){
                var back = '#fc4d00';
              }
              else if (color < 0.866) {
                var back = '#fe4100';
              }
              else if (color < 0.9){
                var back = '#ff3400';
              }
              else if (color < 0.933){
                var back = '#ff2200';
              }
              else{
                var back = '#ff0000';
              }
              stringToAdd += "<td style=background-color:"+back+">"+ parseFloat(result[0][cont].fast).toFixed(1) +" Gwei</td>";
              cont += 1
            }

            else {
              stringToAdd += "<td style=background-color:#d4aa00>"+ parseFloat((((higherValue - lowerValue) / 2) + lowerValue)).toFixed(1) +" Gwei</td>";
            }


            if (x < 6)
            {
              x += 1;
            }
            else
            {
              x = 0;
              i += 1;
              stringToAdd += "</tr>";
              if (cont < result[0].length)
                stringToAdd += "<tr><td>" + i + "</td>";
            }
          } while(cont < result[0].length)

          document.querySelector('#gasTable').innerHTML += stringToAdd;
          document.querySelector('#gasTable').innerHTML += "</table>";
        }
      }

    if (Chain !== null){
      requestBackendStart(Chain);
      loadAvgFee(Chain);
    }

    setInterval(function(){
      requestBackendStart(Chain);
    }, 10000);

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


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
      </script>
      <script src="/js/Metamask.js"></script>
   </body>
</html>
