<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/roadmap.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <TITLE>Project Roadmap | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Check our RoadMap and what features and tools we are currently building and developing.">
      <META NAME="KEYWORDS" CONTENT="Crypto, RoadMap, Coming Soon, Next To Come.">
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
           <div class="tittleCon">
             <h1>Project Roadmap</h1>
           </div>

           <div class="tittleCon">
             <h2>In this section you will find upcoming feautre/tools that are being developed.</h2>
           </div>

           <div class="Overflow">
             <div class="Boxie">
               <div class="col left">
               </div>
               <div class="col right">
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
      requestBackend = async function ()
      {

      }

      let requestBackendStart = async function (direction)
      {
        let response = await fetch('https://cryptotrackers.io/RoadMap',{
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
          let string = '';

          document.querySelector('.col.left').innerHTML = '';
          document.querySelector('.col.right').innerHTML = '';

          for (var i = 0; i < result.length; i++)
          {
            string = "<div class = Phase><div class=Date>" + result[i].Phase + "</div><div class=Actions>" + result[i].Actions +"</div></div>";

            if (i % 2 == 0)
            {
              document.querySelector('.col.left').innerHTML += string;
            }
            else {
              document.querySelector('.col.right').innerHTML += string;
            }
          }
          if (i % 2 == 0)
          {
            document.querySelector('.col.left').innerHTML += "<div class = Phase><div class=Date>More To Come...</div></div>";
          }
          else
          {
            document.querySelector('.col.right').innerHTML += "<div class = Phase><div class=Date>More To Come...</div></div>";
          }
        }
      }

      requestBackendStart(0);


      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[15].classList.add('active');

      leftNavButtons[15].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[15].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[15].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
