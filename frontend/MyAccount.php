<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/MyAccount.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <TITLE>My Account | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Fill your account details so we can get better in touch with you.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Account, Details.">
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
          <div class="AccountBox">
            <div class="DiscordInfo">
              <h1>Discord Information</h1>
              <hr>
              <div class="DiscordFill">
                <div class="DiscordLabel">
                  <div class="Name">
                    Name:
                  </div>
                  <div class="Example">
                    (Elliot#1209)
                  </div>
                </div>
                <div class="textInputWrapper">
                  <input id="discordName" type="text" class="textInput" value="">
                </div>
              </div>
              <div class="ButtonDiv">
                <button type="button" name="button" onclick="insertDiscord()">Ok</button>
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
      <script>
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


      let requestBackend = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/getDiscord',{
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
          if (result.length > 0)
            discordName.value = result[0].discordName
        }
      }

      let insertDiscord = async function ()
      {
        let response = await fetch('https://cryptotrackers.io/insertDiscord',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:
            {
              "discordName": discordName.value
            },
          }),
          headers: {
            "Content-Type": "application/json",
            'Authorization': "Bearer " + jwtCookie,
          }
        });

        const { result } = await response.json();
      }
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
