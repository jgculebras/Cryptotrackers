<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/HallOfFame.css">
      <TITLE>Hall Of Fame | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Detailed description about the users who have contributed the most to our website or have been vip for a long time.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Vips, Hall Of Fame.">
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

            <div class="FullBox">
              <h1 class="HallOfFameTittle">Vip Hall Of Fame</h1>
              <h2>In this section you will find the users that have contributed the most or have been vip for a long time.</h2>
              <div class="List">
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
      requestBackend = async function ()
      {

      }

      let requestBackendStart = async function(direction)
      {
        let response = await fetch('https://cryptotrackers.io/hallOfFame',{
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
          document.querySelector('.List').innerHTML = '';
          let string = "";
          for (i = 0; i < result.length; i++)
          {
            string += "<div class = ListItem><div class = ItemPosition>" + (i+1) + "</div><div class = ItemAbout><div class = TopDiv><div class = Img><img class = ThetanIcon src="+ result[i].avatar + "></img></div><div class = Name>" + result[i].displayName + "</div><div class = Points>" + result[i].vipPoints + "</div></div><div class = BottomDiv><div class = ItemSocials>";

            if (result[i].social1 != null)
            {
              string += "<a target=_blank href=" + result[i].social1 + "><div class=ItemIcon><ion-icon class=ItemSocial name=logo-discord></ion-icon></div></a>";
            }

            if (result[i].social2 != null)
            {
              string += "<a target=_blank href=" + result[i].social2 + "><div class=ItemIcon><ion-icon class=ItemSocial name=logo-twitter></ion-icon></div></a>";
            }

            if (result[i].social3 != null)
            {
              string += "<a target=_blank href=" + result[i].social3 + "><div class=ItemIcon><ion-icon class=ItemSocial name=logo-tiktok></ion-icon></div></a>";
            }

            if (result[i].social4 != null)
            {
              string += "<a target=_blank href=" + result[i].social4 + "><div class=ItemIcon><ion-icon class=ItemSocial name=logo-facebook></ion-icon></div></a>";
            }

            string += "</div><div class=Description>" + result[i].description + "</div></div></div></div>";
          }
          document.querySelector('.List').innerHTML = string;
        }
      }

      requestBackendStart(0);

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[11].classList.add('active');

      leftNavButtons[11].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[11].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[11].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));

         window.addEventListener("load",() =>
         [...document.querySelectorAll("a[target=_blank]")]
         .forEach(lnk => lnk.setAttribute("rel", "nofollow noopener noreferrer"))
         );
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
