<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/previews.css">
      <TITLE>NFT, P2E Project Reviews | CryptoTrackers</TITLE>
      <meta http-equiv="Content-Type" content="text/html; ISO-8859-1">
      <META NAME="DC.Language" SCHEME="RFC1766" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Check our last reviews about interesting projects with a brief description and calification about what they aim to contribute to the CryptoCurrency ecosystem.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Reviews, NFT, Play2Earn, DeFi.">
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
              Project Reviews: NFT, P2E Games, DeFi...
            </h1>
            <h2>In this section you will find reviews about interesting projects with a brief description about what they aim to contribute to the CryptoCurrency ecosystem.</h2>


            <div class="ReviewsBox">
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
     </div>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
      let requestBackend = async function ()
      {

      }

      let requestBackendStart = async function(direction)
      {
        let response = await fetch('https://cryptotrackers.io/PReviews',{
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
          document.querySelector('.ReviewsBox').innerHTML = '';

          for (let i = 0; i < result[0].length; i++)
          {
            var TokenCalif = '';
            var ProjectCalif = '';
            var CommunityCalif = '';
            var EconomyCalif = '';
            var ArtCalif = '';
            var ListingsCalif = '';
            var ArrayCalifs = [];
            var Califs = [];

            for (var l = 1; l <= result[0][i].TokenCalif; l++)
            {
              if (l + 1 > result[0][i].TokenCalif && l%2 != 0)
              {
                TokenCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                TokenCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              TokenCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            for (var l = 1; l <= result[0][i].ProjectCalif; l++)
            {
              if (l + 1 > result[0][i].ProjectCalif && l%2 != 0)
              {
                ProjectCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                ProjectCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              ProjectCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            for (var l = 1; l <= result[0][i].CommunityCalif; l++)
            {
              if (l + 1 > result[0][i].CommunityCalif && l%2 != 0)
              {
                CommunityCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                CommunityCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              CommunityCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            for (var l = 1; l <= result[0][i].EconomyCalif; l++)
            {
              if (l + 1 > result[0][i].EconomyCalif && l%2 != 0)
              {
                EconomyCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                EconomyCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              EconomyCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            for (var l = 1; l <= result[0][i].ArtCalif; l++)
            {
              if (l + 1 > result[0][i].ArtCalif && l%2 != 0)
              {
                ArtCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                ArtCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              ArtCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            for (var l = 1; l <= result[0][i].ListingsCalif; l++)
            {
              if (l + 1 > result[0][i].ListingsCalif && l%2 != 0)
              {
                ListingsCalif += "<ion-icon name=star-half></ion-icon>";
              }
              else if (l % 2 == 0)
              {
                ListingsCalif += "<ion-icon name=star></ion-icon>";
              }
            }

            for (var o = 0; o < (10 - l)/2; o++) {
              ListingsCalif += "<ion-icon name=star-outline></ion-icon>"
            }

            if (result[0][i].TokenCalif != null)
            {
              ArrayCalifs.push(TokenCalif);
              Califs.push("Token");
            }
            if (result[0][i].EconomyCalif != null)
            {
              ArrayCalifs.push(EconomyCalif);
              Califs.push("Economy");
            }
            if (result[0][i].CommunityCalif != null)
            {
              ArrayCalifs.push(CommunityCalif);
              Califs.push("Community");
            }
            if (result[0][i].ProjectCalif != null)
            {
              ArrayCalifs.push(ProjectCalif);
              Califs.push("Project");
            }
            if (result[0][i].ArtCalif != null)
            {
              ArrayCalifs.push(ArtCalif);
              Califs.push("Art");
            }
            if (result[0][i].ListingsCalif != null)
            {
              ArrayCalifs.push(ListingsCalif);
              Califs.push("Listings");
            }


            var string = "<div class = Review><div class = LeftSide><div class = TopDiv><div class = Img><img src=" + result[0][i].img + "></div><h3 class = ProjectName>" + result[0][i].ProjectName + "</h3></div><div class = BottomDiv><div class = ItemSocials><div class = ItemIcon><a target=_blank href=https://twitter.com/" + result[0][i].Twitter + "><div class=ItemIcon><ion-icon name = logo-twitter></ion-icon></div></a><div class = IconName>Twitter</div></div><div class = ItemIcon><a target=_blank href=" + result[0][i].Whitepaper + "><div class=ItemIcon><ion-icon name = newspaper></ion-icon></div></a><div class = IconName>Whitepaper</div></div><div class = ItemIcon><a target=_blank href=" + result[0][i].Web + "><div class=ItemIcon><ion-icon name = earth></ion-icon></div></a><div class = IconName>Web</div></div></div><h4 class = Description>" + result[0][i].Description + "</h4></div></div><div class = RightSide><div class = Stars><div class = Calif><span class = Name>" + Califs[0] + ":</span><span class = Stars>" + ArrayCalifs[0] + "</span></div><div class = Calif><span class = Name>" + Califs[1] + ":</span><span class = Stars>" + ArrayCalifs[1] + "</span></div><div class = Calif><span class = Name>" + Califs[2] + ":</span><span class = Stars>"+ ArrayCalifs[2] + "</span></div><div class = Calif><span class = Name>" + Califs[3] + ":</span><span class = Stars>" + ArrayCalifs[3] + "</span></div></div></div></div>";

            document.querySelector('.ReviewsBox').innerHTML += string;
          }

          document.querySelector('.PageNow').innerHTML = parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction);
          if (result[1][0].totalRows / 12 > parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction)){
            document.querySelector('.Right').classList.remove('hide');
          }
          else {
            document.querySelector('.Right').classList.add('hide');
          }
          if (parseInt(document.querySelector('.PageNow').textContent) + parseInt(direction) != 1){
            document.querySelector('.Left').classList.remove('hide');
          }
          else {
            document.querySelector('.Left').classList.add('hide');
          }
        }

      }


      requestBackendStart(0);

      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[4].classList.add('active');

      leftNavButtons[4].children[0].href = "#";

      let navigation = document.querySelector('.navigation');
      let main = document.querySelector('.main');
      let cards = document.querySelectorAll('.cardBox');


      let list = document.querySelectorAll('.navigation li');
        function activeLink(){
          list.forEach((item) =>
          item.classList.remove('hovered'));
          leftNavButtons[4].classList.remove('active');
          this.classList.add('hovered');
        }

       list.forEach((item) =>
       item.addEventListener('mouseover', activeLink));

       function deleteLink(){
         list.forEach((item) =>
        item.classList.remove('hovered'));
        leftNavButtons[4].classList.add('active');
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
