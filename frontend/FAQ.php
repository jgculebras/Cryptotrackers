<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/faq.css">
      <title>CryptoTrackers</title>
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

            <div class = "FAQTittle">
              <h1>Frequently Ask Questions</h1>
            </div>

            <hr class="divsSeparation">
            <div class="FullBox">
              <div class="Question">
                <h2 class="QuestionText"> What is Cryptools? </h2>
              </div>
              <div class="Answer">
                <h3> It's a project with the aim of helping visitors and members of the site by offering them services that are not available to everyone,
                  such as finding nft collections in trend, analysis of new projects to come...</h3>
              </div>

              <div class="Question">
                <h2> What is Hall Of Fame? </h2>
              </div>
              <div class="Answer">
                <h3> It's a section where the vips that have been with us the longest or have contributed the most will be detailed.
                  In it, the vips listed will be given a site where they can detail who they are, services they offer, social networks,
                  links to nfts they have for sale or anything they can think of and we give consent. </h3>
              </div>

              <div class="Question">
                <h2> Do I need to be VIP to benefit from the website? </h2>
              </div>
              <div class="Answer">
                <h3> No, we offer services to all users without the need to log in.
                  However, since the site took a lot of work to get to this point and has an associated cost,
                   we reserve some advantages and perks for Vips users. </h3>
              </div>
              <div class="Question">
                <p>...</p>
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
      let leftNavButtons = document.querySelectorAll('.LeftNav');

      leftNavButtons[12].classList.add('active');

      leftNavButtons[12].children[0].href = "#";

         let navigation = document.querySelector('.navigation');
         let main = document.querySelector('.main');
         let cards = document.querySelectorAll('.cardBox');


         let list = document.querySelectorAll('.navigation li');
         function activeLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[12].classList.remove('active');
           this.classList.add('hovered');
         }

         list.forEach((item) =>
         item.addEventListener('mouseover', activeLink));

         function deleteLink(){
           list.forEach((item) =>
           item.classList.remove('hovered'));
           leftNavButtons[12].classList.add('active');
         }

         list.forEach((item) =>
         item.addEventListener('mouseleave', deleteLink));
      </script>
      <script src="/js/Metamask.js"></script>
   </body>
</html>
