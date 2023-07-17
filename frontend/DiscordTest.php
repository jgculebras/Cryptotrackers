<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/generalStyle.css">
      <link rel="stylesheet" href="css/dashboard.css">
      <TITLE>Cryptocurrency Prices, Volume, Market Caps | CryptoTrackers</TITLE>
      <META NAME="DC.Language" CONTENT="English">
      <META NAME="DESCRIPTION" CONTENT="Top cryptocurrencies winners and losers in the last 24 hours. Free access to cryptocurrencies market data and movements.">
      <META NAME="KEYWORDS" CONTENT="Crypto, Btc Dominance, Top 10 Winners, Top 10 Losers, Cryptocurrencies.">
      <META NAME="Resource-type" CONTENT="Document">
      <META NAME="robots" content="ALL">
      <link rel="canonical" href="https://cryptotrackers.io/">
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
   </div>

   <script>
   requestBackend = async function (direction)
   {
   let response = await fetch('https://cryptotrackers.io/dashboardStats',{
       method : 'POST',
       body: JSON.stringify({
           address,
       }),
       headers: {
           "Content-Type": "application/json",
           'Authorization': "Bearer " + jwtCookie,
       }
   });
   </script>
      <script src="js/Metamask.js"></script>
   </body>
</html>
