<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/news.css">
      <TITLE>News | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Find news about interesting events in the CryptoCurrency ecosystem.">
      <META NAME="KEYWORDS" CONTENT="Crypto, News.">
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
           <div class="">
             <h1 class="Tittle">
               News: Crypto movements, analysis, protocols...
             </h1>
             <h2>In this section you will find news about interesting events in the CryptoCurrency ecosystem.</h2>


             <div class="NewsFullBox">
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
      <script>
      requestBackend = async function ()
      {

      }

      let requestBackendStart = async function (direction)
      {
        let response = await fetch('https://cryptotrackers.io/news',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "PageNumber" : parseInt(document.querySelector('.PageNow').textContent),
              "Direction" : parseInt(direction)
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
          document.querySelector('.NewsFullBox').innerHTML = '';

          for (let i = 0; i < result[0].length; i++)
          {
            document.querySelector('.NewsFullBox').innerHTML += "<a href=NewArticle?Tittle=" + result[0][i].id + " class = NewBox><h3>" + result[0][i].tittle + "</h3><h4>" + result[0][i].description + "</h4><img src=" + result[0][i].img + "></a>";
          }

          document.querySelector('.PageNow').innerHTML = parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction);

          if (result[1][0].totalRows / 12 > parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction)){
            document.querySelector('.Right').classList.remove('hide');
          }
          else {
            document.querySelector('.Right').classList.add('hide');
          }
          if ((parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction))  != 1){
            document.querySelector('.Left').classList.remove('hide');
          }
          else {
            document.querySelector('.Left').classList.add('hide');
          }
        }
      }

      requestBackendStart(0);


      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[5].classList.add('active');

      leftNavButtons[5].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');

         let activePage = document.getElementById('activePage');

         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[5].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[5].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
