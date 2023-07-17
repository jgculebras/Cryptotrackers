<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/media.css">
      <TITLE>Media | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Find interesting community's videos about the crypto ecosystem.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Media, Youtube.">
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
        <?php
          include('navigation.html');
        ?>
         <div class="main">
           <?php
             include('header.html');
           ?>


            <div class="MediaBox">
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
      let requestBackend = async function ()
      {

      }

      let requestBackendStart = async function()
      {
        let response = await fetch('https://cryptotrackers.io/media',{
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
          document.querySelector('.MediaBox').innerHTML = '';
          for (let i = 0; i < result.length; i++)
          {
            document.querySelector('.MediaBox').innerHTML += "<div class = MediaCard><div><div class = YtTitle>" + result[i].tittle + "</div><div class = YtVideo><iframe src=" + result[i].link + "></iframe></div><a class = YtChannel href=https://www.youtube.com/c/" + result[i].ytChannel.replace(/ /g,'') + "><ion-icon class=YtIcon name=logo-youtube></ion-icon><span class=YtName>" + result[i].ytChannel + "</span></a></div></div>";
          }
        }
      }

      requestBackendStart();



         let leftNavButtons = document.querySelectorAll('.LeftNav');

         leftNavButtons[6].classList.add('active');

         leftNavButtons[6].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');

         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[6].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[6].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));

         window.addEventListener("load",() =>
         [...document.querySelectorAll("a[target=_blank]")]
         .forEach(lnk => lnk.setAttribute("rel", "noopener noreferrer"))
         );
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
