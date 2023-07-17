<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/NewsArticle.css">
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

         <div class="main hide">
           <?php
             include('header.html');
           ?>

            <div class="newBox">

              <div class="article">
                <h1>Tittle</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                <div class="image">
                  <img src="img/AxieLogo.png"></img>
                </div>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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
        let response = await fetch('https://cryptotrackers.io/NewsArticle',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "id" : parseInt(direction),
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
          document.querySelector('.newBox').innerHTML = "<div class = article><h2>" + result[0].tittle + "</h2><h6>" + result[0].paragraph1 + "</h6><div class = image><img src=" + result[0].img + "></img></div><h6>" + result[0].paragraph2 + "</h6><div class = font><a href=" + result[0].link + ">Source</a></div></div>";
          document.title = result[0].tittle + " | CryptoTrackers";
          $('meta[name=DESCRIPTION]').attr('content', result[0].paragraph1.split('.')[0].replace('<br>', '') + "." + result[0].paragraph1.split('.')[1].replace('<br>', '') + ".");
        }
      }

      const querystring = window.location.search;
      // usando el querystring, creamos un objeto del tipo URLSearchParams
      const params = new URLSearchParams(querystring);

      var NewPassed = params.get('Tittle');

      requestBackendStart(NewPassed);

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
      <script src="js/Metamask.js"></script>
   </body>
</html>
