<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/whitelists.css">
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js"></script>
      <TITLE>Whitelists | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Find interesting upcoming projects of which you can benefit gaining access to its whitelist where you can get access to presale round for example.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Whitelists, IDO, Projects.">
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
             <h1>Whitelists: Cryptocurrencies IDO, NFT, Upcoming projects...</h1>
             <h2>In this section you will find interesting upcoming projects of which you can benefit gaining access to its whitelist where you can get access to presale round for example.</h2>


             <div class="DaysGrid">
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
      var day = new Date();

      var date = day.getFullYear() + "-" + (day.getMonth()+1) + "-" + day.getDate();

      requestBackend = async function ()
      {

      }

      let requestBackendStart = async function (direction)
      {
        let response = await fetch('https://cryptotrackers.io/whitelists',{
          method : 'POST',
          body: JSON.stringify({
            address,
            params:{
              "Date" : date,
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
          document.querySelector('.DaysGrid').innerHTML = '';
          for (let i = 0; i < result.length; i++)
          {
            let day = new Date(result[i].day.split("T")[0]);
            day.setDate(day.getDate() + 1);
            let parseDate = (String(day.getDate()).padStart(2, '0') + "/" + String(day.getMonth() + 1).padStart(2, '0')+ "/" + day.getFullYear());
            if (document.getElementById(result[i].Day) == null)
            {
              document.querySelector(".DaysGrid").innerHTML += "<div class = dayDiv id = " + result[i].day + "></div>";
              document.getElementById(result[i].day).innerHTML += "<div class=Date>" + parseDate + "</div>";
              document.getElementById(result[i].day).innerHTML += "<div class= DayHeader><div class = projectTittle>Project</div><div class = Reward>Reward</div><div class = Link>Link</div></div>";
            }
            document.getElementById(result[i].day).innerHTML += "<div class = ListItem><div class = Name>• " + result[i].projectTittle + "</div><div class = Reward> " + result[i].Reward + "</div><a class = Link target = _blank href = " + result[i].link + ">Link</a></div>";
          }
        }
      }

      requestBackendStart(0);

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[8].classList.add('active');

      leftNavButtons[8].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[8].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[8].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));

         window.addEventListener("load",() =>
         [...document.querySelectorAll("a[target=_blank]")]
         .forEach(lnk => lnk.setAttribute("rel", "nofollow noopener noreferrer"))
         );
      </script>
      <script src="/js/Metamask.js"></script>
   </body>
</html>
