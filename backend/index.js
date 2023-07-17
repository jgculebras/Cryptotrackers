const bs58 = require("bs58")
const Web3 = require("@solana/web3.js");
const express = require('express');
const cors = require('cors');
const supabasex = require('@supabase/supabase-js')
const ethers = require('ethers')
const jwt = require('jsonwebtoken')
const mysql = require('mysql2')
const axios = require('axios');
const web3 = require('web3')
require("dotenv").config();
const https = require('https');
const fs = require('fs');

const app = express();
const port = 8443;

const supabase = supabasex.createClient(process.env.SUPABASEURL, process.env.SUPABASEKEY)

//const connection = mysql.createConnection({
  //host     : process.env.HOST,
  //user     : process.env.USER,
  //password : process.env.PASSWORD,
  //database : process.env.DATABASE
//});

const pool = mysql.createPool({
  connectionLimit: 1,
  host     : process.env.HOST,
  user     : process.env.USER,
  password : process.env.PASSWORD,
  database : process.env.DATABASE,
});

//CHECK VIP FUNCTION

async function checkVip(address, callback)
{
  let selectQuery = "SELECT vipType, vipExp FROM vips where address=?";
  let query = mysql.format(selectQuery, address);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function getMainCoinPrice(params, callback)
{
  console.log(params);
  let coin = "";
  if (params.chainId == "0x1")
  {
    coin = "ETH"
  }
  else if (params.chainId == "0x38")
  {
    coin = "BNB"
  }
  else if (params.chainId == "0x89")
  {
    coin = "MATIC"
  }

  let selectQuery = "SELECT CurrentPrice from cryptospricechange where Crypto = ?"
  let query = mysql.format(selectQuery, coin);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);
      console.log(query);

      connection.release();
    });
  });
}

//  PORTFOLIO QUERYS

async function getCoinPrice(params, callback)
{
  let selectQuery = "SELECT CurrentPrice FROM cryptospricechange Where Crypto = ?";
  let query = mysql.format(selectQuery, params.CryptoToAdd);
  pool.getConnection(function(err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);
      connection.release();
    })
  })
}

async function getPortfolio(address, params, callback)
{
  let resultCallback = [];
  let selectQuery = "SELECT * FROM cryptoportfolio cp inner join cryptospricechange cc on cc.Crypto = cp.crypto Where user = ? order by qty*CurrentPrice desc LIMIT ?,5";
  let query = mysql.format(selectQuery, [address, ((parseInt(params.PageSumm) + parseInt(params.directionSumm)) * 5) - 5]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result);
      selectQuery = "SELECT COUNT(*) as totalRows FROM cryptoportfolio cp inner join cryptospricechange cc on cc.Crypto = cp.crypto Where user = ?"
      query = mysql.format(selectQuery, address);
      connection.query(query, function (err, result, fields){
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);
        selectQuery = "SELECT * FROM cryptoportfolio cp inner join cryptospricechange cc on cc.Crypto = cp.crypto Where user = ? order by qty*CurrentPrice desc";
        query = mysql.format(selectQuery, address);
        connection.query(query, function (err, result, fields){
          if (err) {console.log(err); connection.release(); callback([]); return;}
          resultCallback.push(result);
          callback(resultCallback);
        })
      })
      connection.release();
    });
  });
}

async function getPortfolioCoins(params, callback)
{
  let resultCallback = [];

  let selectQuery = "SELECT Crypto FROM cryptospricechange where Crypto like ? LIMIT ?,40";
  let query = mysql.format(selectQuery, ['%' + params.like + '%', (parseInt(params.Page-1) + parseInt(params.direction)) * 40]);
  await pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result);

      selectQuery = "SELECT COUNT(*) as totalRows FROM cryptospricechange where Crypto like ?";
      query = mysql.format(selectQuery, ['%' + params.like + '%', (parseInt(params.Page-1) + parseInt(params.direction)) * 40]);
      connection.query(query, function (err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);
        callback(resultCallback);
      });
      connection.release();
    });
  });
}

async function getPortfolioCoinsToSell(address, params, callback)
{
  resultCallback = [];

  let selectQuery = "SELECT * FROM cryptoportfolio cp inner join cryptospricechange cc on cc.Crypto = cp.crypto  Where user = ? and cp.crypto like ? LIMIT ?,40";
  let query = mysql.format(selectQuery, [address, '%' + params.like + '%', (parseInt(params.Page-1) + parseInt(params.direction)) * 40]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result)

      selectQuery = "SELECT * FROM cryptoportfolio cp inner join cryptospricechange cc on cc.Crypto = cp.crypto  Where user = ? and cp.crypto like ?";
      query = mysql.format(selectQuery, [address, '%' + params.like + '%']);
      connection.query(query, function (err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);
        callback(resultCallback);
      });

      connection.release();
    });
  });
}

async function getPortfolioCoinAmount(address, params, callback)
{
  let selectQuery = "SELECT qty FROM cryptoportfolio  Where user = ? and crypto = ?";
  let query = mysql.format(selectQuery, [address, params.CryptoToSell]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result)

      connection.release();
    });
  });
}

async function insertCoinToPortfolio(address, params, callback)
{
  let withdraw = 0;
  //  ADD COIN TO PORTFOLIO
  let insertQuery = "INSERT INTO cryptoportfolio(user, crypto, qty, cryptoDeposit) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE qty=qty + ?";
  let query = mysql.format(insertQuery, [address, params.CryptoToAdd, params.qty, 0, params.qty]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      //  GET COIN PRICE
      let selectQuery = "SELECT CurrentPrice FROM cryptospricechange Where Crypto = ?"
      query = mysql.format(selectQuery, params.CryptoToAdd);
      connection.query(query, function (err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}

        let amountToAdd = (result[0].CurrentPrice+0) * params.qty;

        let updateQuery = "UPDATE cryptoportfolio SET cryptoDeposit = cryptoDeposit + ? Where user = ? and crypto = ?";
        query = mysql.format(updateQuery, [amountToAdd, address, params.CryptoToAdd]);
        connection.query(query, function(err, result, fields){
          if (err) {console.log(err); connection.release(); callback([]); return;}
          //  GET WITHDRAW AMOUNT FROM ADDRESS
          selectQuery = "SELECT withdraw FROM portfoliodeposit Where address = ?"
          query = mysql.format(selectQuery, address);
          connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}

          if (result.length > 0)
          {
            withdraw = result[0].withdraw;
          }
              //  IF WITHDRAW LESS THAN AMOUNT TO ADD WITHDRAW = 0 AND THE REST DEPOSIT
          if (withdraw < amountToAdd)
          {
            insertQuery = "INSERT INTO portfoliodeposit(address, deposit, withdraw) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE deposit=coalesce(deposit+?, ?, deposit), withdraw = 0";
            query = mysql.format(insertQuery, [address, amountToAdd, 0, amountToAdd - withdraw, amountToAdd - withdraw]);
            connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}
              callback(result);
            });
          }
              //  ELSE WITHDRAW - AMOUNT TO ADD
          else
          {
            insertQuery = "INSERT INTO portfoliodeposit(address, deposit, withdraw) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE withdraw=coalesce(withdraw-?, ?, withdraw)";
            query = mysql.format(insertQuery, [address, amountToAdd, 0, amountToAdd, amountToAdd]);
            connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}
              callback(result);

            });
          }
        });
        });
      });
      connection.release();
    });
  });
}

async function insertFixedCoinToPortfolio(address, params, callback)
{
  let withdraw = 0;
  //  ADD COIN TO PORTFOLIO
  let insertQuery = "INSERT INTO cryptoportfolio(user, crypto, qty, cryptoDeposit) VALUES(?, ?, ?, ?) ON DUPLICATE KEY UPDATE qty=qty + ?";
  let query = mysql.format(insertQuery, [address, params.CryptoToAdd, params.qty, 0, params.qty]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}

      let amountToAdd = (params.qty * params.price)

      let updateQuery = "UPDATE cryptoportfolio SET cryptoDeposit = cryptoDeposit + ? Where user = ? and crypto = ?";
      query = mysql.format(updateQuery, [amountToAdd, address, params.CryptoToAdd]);
      connection.query(query, function (err, result, fields){
        if (err) {console.log(err); connection.release(); callback([]); return;}

        //  GET WITHDRAW AMOUNT FROM ADDRESS
        selectQuery = "SELECT withdraw FROM portfoliodeposit Where address = ?"
        query = mysql.format(selectQuery, address);
        connection.query(query, function (err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}

        if (result.length > 0)
        {
          withdraw = result[0].withdraw;
        }
        //  IF WITHDRAW LESS THAN AMOUNT TO ADD WITHDRAW = 0 AND THE REST DEPOSIT
        if (withdraw < amountToAdd)
        {
          insertQuery = "INSERT INTO portfoliodeposit(address, deposit, withdraw) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE deposit=coalesce(deposit+?, ?, deposit), withdraw = 0";
          query = mysql.format(insertQuery, [address, amountToAdd, 0, amountToAdd - withdraw, amountToAdd - withdraw]);
          connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
            callback(result);
          });
        }
        //  ELSE WITHDRAW - AMOUNT TO ADD
        else
        {
          insertQuery = "INSERT INTO portfoliodeposit(address, deposit, withdraw) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE withdraw=coalesce(withdraw-?, ?, withdraw)";
          query = mysql.format(insertQuery, [address, amountToAdd, 0, amountToAdd, amountToAdd]);
          connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
            callback(result);
            });
          }
        });
      })
      connection.release();
    });
  });
}

async function sellCoinPortfolio(address, params, callback)
{
  let resultCallback = 0;
  let selectQuery = "SELECT qty, cryptoDeposit, CurrentPrice From cryptoportfolio cp inner join cryptospricechange cc on cp.crypto = cc.Crypto Where cp.crypto = ? and cp.user = ?";
  let query = mysql.format(selectQuery, [params.CryptoToSell, address]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}

      let qtyBefore = result[0].qty;

      if (parseFloat(params.qty) <= result[0].qty)
      {
        let qtyAfter = qtyBefore - params.qty;
        resultCallback = qtyAfter;

        let medium = qtyBefore / params.qty;

        let deposit = result[0].cryptoDeposit;

        let updateQuery = "UPDATE cryptoportfolio SET cryptoDeposit = ? Where user = ? and crypto = ?";
        query = mysql.format(updateQuery, [deposit - (deposit / medium), address, params.CryptoToSell]);
        connection.query(query, function (err, result, fields){
          if (err) {console.log(err); connection.release(); callback([]); return;}
          let updateQuery = "UPDATE cryptoportfolio SET qty = qty - ? Where crypto = ? and user = ?";
          query = mysql.format(updateQuery, [params.qty, params.CryptoToSell, address]);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            if (qtyBefore - parseFloat(params.qty) == 0)
            {
              let deleteQuery = "DELETE From cryptoportfolio Where crypto = ? and user = ?";
              query = mysql.format(deleteQuery, [params.CryptoToSell, address]);

              connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

                });
            }

              selectQuery = "SELECT CurrentPrice FROM cryptospricechange Where Crypto = ?";
              query = mysql.format(selectQuery, params.CryptoToSell);
              connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

                let amountToAdd = (result[0].CurrentPrice+0) * params.qty;

                let insertQuery = "INSERT INTO portfoliodeposit(address, withdraw) VALUES(?, ?) ON DUPLICATE KEY UPDATE withdraw=coalesce(withdraw+?, ?, withdraw)";
                query = mysql.format(insertQuery, [address, amountToAdd, amountToAdd, amountToAdd]);
                connection.query(query, function (err, result, fields) {
                  if (err) {console.log(err); connection.release(); callback([]); return;}
                  callback(resultCallback);
                });
              });
            });
        })
        };
        connection.release();
      });
    });
}

async function sellFixedCoinToPortfolio(address, params, callback)
{
  let resultCallback = 0;
  let selectQuery = "SELECT qty, cryptoDeposit From cryptoportfolio Where crypto = ? and user = ?";
  let query = mysql.format(selectQuery, [params.CryptoToSell, address]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}

      let qtyBefore = result[0].qty;

      if (parseFloat(params.qty) <= result[0].qty)
      {
        let qtyAfter = qtyBefore - params.qty;

        resultCallback = qtyAfter;

        let medium = qtyBefore / params.qty;

        let deposit = result[0].cryptoDeposit;

        let updateQuery = "UPDATE cryptoportfolio SET cryptoDeposit = ? Where user = ? and crypto = ?";
        query = mysql.format(updateQuery, [deposit - (deposit / medium), address, params.CryptoToSell]);
        connection.query(query, function (err, result, fields){
          if (err) {console.log(err); connection.release(); callback([]); return;}
          let updateQuery = "UPDATE cryptoportfolio SET qty = qty - ? Where crypto = ? and user = ?";
          query = mysql.format(updateQuery, [params.qty, params.CryptoToSell, address]);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            if (qtyBefore - parseFloat(params.qty) == 0)
            {
              let deleteQuery = "DELETE From cryptoportfolio Where crypto = ? and user = ?";
              query = mysql.format(deleteQuery, [params.CryptoToSell, address]);

              connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

                });
            }
            let amountToAdd = params.price * params.qty;

            let insertQuery = "INSERT INTO portfoliodeposit(address, withdraw) VALUES(?, ?) ON DUPLICATE KEY UPDATE withdraw=coalesce(withdraw+?, ?, withdraw)";
            query = mysql.format(insertQuery, [address, amountToAdd, amountToAdd, amountToAdd]);
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}
              callback(resultCallback);
            });
          });
        })
        };
	connection.release();
      });
    });
}

async function getPriceAlerts(params, callback)
{
  let coins = [10, 25, 100, 2500];

  let resultCallback = [];

  let today = new Date();

  let day = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);

  let timeframe = (today.getHours() * 60 + today.getMinutes()) - (today.getHours() * 60 + today.getMinutes()) % 5;

  if (params.xCoins < 5)
  {
    let selectQuery = "SELECT x.Crypto, price, CurrentPrice FROM (SELECT * FROM cryptospricebytime WHERE Crypto IN (SELECT Crypto FROM (SELECT Crypto FROM cryptospricechange ORDER BY MarketCap Desc LIMIT ?) as t) and day = ? and daymins = ?) as c JOIN ( SELECT * FROM cryptospricechange) AS x ON c.Crypto = x.Crypto ORDER BY price/CurrentPrice;"
    let query = mysql.format(selectQuery, [coins[params.xCoins], day, timeframe - 5]);
    pool.getConnection(function (err, connection){
      if (err) {console.log(err); connection.release(); callback([]); return;}
      connection.query(query, function (err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}
        console.log(query)
        console.log(result)
        if (result.length > 0)
        {
          resultCallback.push(result)
        }
        else
        {
          resultCallback.push([]);
        }

        selectQuery =  "SELECT x.Crypto, price, CurrentPrice FROM (SELECT * FROM cryptospricebytime WHERE Crypto IN (SELECT Crypto FROM (SELECT Crypto FROM cryptospricechange ORDER BY MarketCap Desc LIMIT ?) as t) and day = ? and daymins = ?) as c JOIN ( SELECT * FROM cryptospricechange) AS x ON c.Crypto = x.Crypto ORDER BY price/CurrentPrice;"
        query = mysql.format(selectQuery, [coins[params.xCoins], day, timeframe - 15]);
        connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
          if (result.length > 0)
          {
            resultCallback.push(result)
          }
          else
          {
            resultCallback.push([]);
          }

          selectQuery =  "SELECT x.Crypto, price, CurrentPrice FROM (SELECT * FROM cryptospricebytime WHERE Crypto IN (SELECT Crypto FROM (SELECT Crypto FROM cryptospricechange ORDER BY MarketCap Desc LIMIT ?) as t) and day = ? and daymins = ?) as c JOIN ( SELECT * FROM cryptospricechange) AS x ON c.Crypto = x.Crypto ORDER BY price/CurrentPrice;"
          query = mysql.format(selectQuery, [coins[params.xCoins], day, timeframe - 60]);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}
            if (result.length > 0)
            {
              resultCallback.push(result)
            }
            else
            {
              resultCallback.push([]);
            }
            callback(resultCallback)
          })

        })
        connection.release();
      })
    })
  }
  else
  {
    callback(false);
  }
}

async function resetWallet(address, callback)
{
  resultCallback = [];

  let deleteQuery = "DELETE FROM portfoliovips where address=?";
  let query = mysql.format(deleteQuery, address);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result);

      deleteQuery = "DELETE FROM cryptoportfolio where user=?";
      query = mysql.format(deleteQuery, address);
        connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
          resultCallback.push(result);

          deleteQuery = "DELETE FROM portfoliodeposit where address=?";
          query = mysql.format(deleteQuery, address);
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}
              resultCallback.push(result);
              callback(resultCallback);
          });
      });
      connection.release();
    });
  });
}

async function getWalletValueByDay(address, callback)
{
let selectQuery = "SELECT * FROM portfoliovips pv inner join portfoliodeposit pd on pd.address = pv.address Where pv.address = ? order by day desc LIMIT 30";
let query = mysql.format(selectQuery, address);
pool.getConnection(function (err, connection){
  if (err) {console.log(err); connection.release(); callback([]); return;}
  connection.query(query, function (err, result, fields) {
    if (err) {console.log(err); connection.release(); callback([]); return;}
    callback(result);

    connection.release();
  });
});
}

//  HALLOFFAME QUERY

async function getHallOfFame(callback)
{
  let selectQuery = "SELECT * FROM halloffame order by vipPoints desc LIMIT 20";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(selectQuery, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    })
  })
}

//  ROADMAP QUERY

async function getRoadmap(callback)
{
  let selectQuery = "SELECT * FROM roadmap ORDER BY Phase asc";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(selectQuery, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    })
  })
}

// MEDIA QUERY

async function getMedia(callback)
{
  let selectQuery = "SELECT * FROM media LIMIT 9";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(selectQuery, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    })
  })
}

//  CHARTS QUERYS

async function getCoinCharts(params,callback)
{
  let resultCallback = [];

  let selectQuery = "SELECT Crypto FROM cryptospricechange where Crypto Like ? LIMIT ?,35";
  let query = mysql.format(selectQuery, ["%" + params.like + "%" , ((params.PageNumber + params.Direction) - 1) *35])
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result)

      selectQuery = "SELECT COUNT(*) as totalRows FROM cryptospricechange where Crypto Like ?"
      query = mysql.format(selectQuery, "%" + params.like + "%");
      connection.query(query, function (err, result, fields){
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);

        callback(resultCallback);
      })

      connection.release();

    })
  })
}

async function getChart(params,callback)
{
  let resultCallback = [];

  let selectQuery;
  let query;

  if (params.time != 1440)
  {
    selectQuery = "SELECT ct.Crypto, ct.day, ct.daymins, ct.price, cp.MarketCap, cp.Volume, cp.CurrentPrice FROM cryptospricebytime ct inner join cryptospricechange cp on ct.Crypto = cp.Crypto WHERE ct.Crypto = ? and (ct.daymins % ?) = 0 order by ct.day desc, ct.daymins desc LIMIT ?";
    query = mysql.format(selectQuery, [params.Crypto, params.time, params.points])
  }

  else
  {
    selectQuery = "SELECT ct.Crypto, ct.day, ct.daymins, ct.price, cp.MarketCap, cp.Volume, cp.CurrentPrice FROM cryptospricebytime ct inner join cryptospricechange cp on ct.Crypto = cp.Crypto WHERE ct.Crypto = ? and ct.daymins = ? order by ct.day desc, ct.daymins desc LIMIT ?";
    query = mysql.format(selectQuery, [params.Crypto, 0, params.points])
  }
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}

      resultCallback.push(result);

      setQuery = "SET @rownum = 0"
      connection.query(setQuery, function(err, result, fields){
        if (err) {console.log(err); connection.release(); callback([]); return;}

          selectQuery = "SELECT Crypto, rowid, PriceChangePercent FROM (SELECT Crypto, @rownum := @rownum + 1 as rowid, PriceChangePercent FROM cryptospricechange ORDER by MarketCap desc) as t WHERE Crypto = ?"
          query = mysql.format(selectQuery, params.Crypto);
          connection.query(query, function (err, result, fields){
            if (err) {console.log(err); connection.release(); callback([]); return;}

            resultCallback.push(result);

            selectQuery = "SELECT exchange FROM cryptoinexchanges Where crypto = ?"
            query = mysql.format(selectQuery, params.Crypto);

            connection.query(query, function (err, result, fields){
              if (err) {console.log(err); connection.release(); callback([]); return;}

              resultCallback.push(result);

              callback(resultCallback);
            })
        })
      })
      connection.release();
    })
  })
}

//  NEWS QUERYS

async function getNews(params ,callback)
{
  resultCallback = []
  let selectQuery = "SELECT * FROM news ORDER BY id desc LIMIT ?, 12";
  let query = mysql.format(selectQuery, ((params.PageNumber + params.Direction) - 1) * 12)
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result);

      selectQuery = "SELECT Count(*) as totalRows from news";
      connection.query(selectQuery, function(err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);

        callback(resultCallback);
      })
      connection.release();
    })
  })
}

async function getNewsArticle(params, callback)
{
  let selectQuery = "SELECT * FROM newsarticle Where id = ?";
  let query = mysql.format(selectQuery, params.id);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    })
  })
}

//  WHITELISTS QUERYS

async function getWhitelists(params, callback)
{
  let selectQuery = "SELECT * from whitelists where day >= ? order by day";
  let query = mysql.format(selectQuery, params.Date);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    })
  })
}

//  PREVIEWS QUERY

async function getPReviews(params ,callback)
{
  resultCallback = []
  let selectQuery = "SELECT * FROM previews ORDER BY id desc LIMIT ?, 12";
  let query = mysql.format(selectQuery, ((params.PageNumber + params.Direction) - 1) * 12)
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function(err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      resultCallback.push(result);

      selectQuery = "SELECT Count(*) as totalRows from previews";
      connection.query(selectQuery, function(err, result, fields) {
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result);

        callback(resultCallback);
      })
      connection.release();
    })
  })
}

//  GAS QUERYS

async function getChains(callback)
{
  let query = "SELECT chain FROM gastracker"
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}

      callback(result);

      connection.release();
    })
  })
}

async function getChainGas(params, callback)
{
  let selectQuery = "SELECT c.CurrentPrice, g.low, g.median, g.fast from cryptospricechange as c inner join gastracker as g on g.coin = c.Crypto where g.chain = ?";
  let query = mysql.format(selectQuery, params.chain);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query , function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}

      callback(result)

      connection.release();
    })
  })
}

async function getChainAvgGas(params, callback)
{
  let resultCallback = [];
  let selectQuery = "SELECT * FROM gastrackerbydayhour where chain = ? order by hour asc, day asc";
  let query = mysql.format(selectQuery, params.chain);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query , function (err, result, fields){
      if (err) {console.log(err); connection.release(); callback([]); return;}

      resultCallback.push(result)

      selectQuery = "SELECT MAX(fast) as HigherGas, MIN(fast) as LowerGas FROM gastrackerbydayhour where chain = ?";
      let query = mysql.format(selectQuery, params.chain);
      connection.query(query, function (err, result, fields){
        if (err) {console.log(err); connection.release(); callback([]); return;}
        resultCallback.push(result)

        callback(resultCallback)
      })

      connection.release();
    })
  })
}

//  WHALETRACKER QUERYS

async function whaleMovesQuery(params, callback)
{
  let selectQuery = "SELECT * from whales where day = ? order by hour desc, mins desc";
  let query = mysql.format(selectQuery, params.day);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function whalesNamesQuery(params, callback)
{
  let query = "SELECT Count(whaleName), whaleName from whales group by whaleName";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function whalesMovesMinDay(params, callback)
{
  let query = "SELECT Count(day), day from whales group by day order by day asc LIMIT 1";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

//  VIP BUY QUERY (SELECT, INSERT IF BUY)

async function addHallOfFame(address, params, callback)
{
  const vipPoints = ["", 1, 2, 3]

  let selectQuery = "SELECT * from halloffame where address = ?";
  let query = mysql.format(selectQuery, address);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      if (result.length > 0)
      {
        let updateQuery = "UPDATE halloffame SET vipPoints = ? + ? where address = ?"
        query = mysql.format(updateQuery, [result[0].vipPoints, vipPoints[params.vipType], address])
        connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
          callback(true);
        })
      }

      else
      {
        let insertQuery = "INSERT INTO halloffame(address, avatar, displayName, vipPoints, description) VALUES (?,?,?,?,?)"
        let query = mysql.format(insertQuery, [address, "img/Default.png", "Anonymous", vipPoints[params.vipType], "Not defined yet."]);
        connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
          callback(true);
        });
      }

      connection.release();
    });
  });
}

async function verifyVipAndAddToDB(address, params, callback)
{
  let resultCallback = false;

  //  VERIFY TXHASH IS NOT ALREADY USED.
  let selectQuery = "SELECT * from subcriptionstx where txHash = ?";
  let query = mysql.format(selectQuery, params.txHash);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      if (result.length > 0)
      {
        console.log(result);
        callback(false);
      }

      else
      {
        //  INSERT txHash
        let insertQuery = "INSERT INTO subcriptionstx(txHash, address) VALUES (?,?)"
        let query = mysql.format(insertQuery, [params.txHash, address]);
        connection.query(query, function (err, result, fields) {
          if (err) {console.log(err); connection.release(); callback([]); return;}
        });

        //  VERIFY CHAINID
        verifyChainWithCoin(address, params, result =>{
          if (result == true)
          {
            callback(true);
          }
          else
          {
            callback(resultCallback);
          }
        })
      }

      connection.release();
    });
  });
}

async function verifyChainWithCoin (address, params, callback)
{
  const vipPrices = ["", 19, 44, 89]

  console.log("Verifying Transaction");

  /*  ROPSTEN NETWROK

  if (params.chainId == "0x3")
  {
    axios.get('https://api-ropsten.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
    .then(response => {

      //  TRANSACTION WITH OTHER COIN NOT MAIN

      if (response.data.result.input != "0x")
      {

        // First 34bits (10 chars (0x + 8 bytes)) is signature "" Then 256 bit is address TO have to add 0x and next 256 is x tokens

        let input = response.data.result.input;
        let hexAddress = input.substring(10,74);
        let hexQty = input.substring(74, 138);

        let address = "0x" + hexAddress.substring(24,64);
        let qty = (parseInt("0x" + hexQty)) / 1000000000000000000;

        //  CHECK IF ADDRESS IS USDT

        if (address == process.env.ME && qty >= vipPrices[params.vipType])
        {

          //  CHECK IF USER IS ALREADY VIP

          let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
          let query = mysql.format(selectQuery, address);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            const interval = setInterval(function() {
              console.log("Attempting to get transaction receipt...");
              axios.get('https://api-ropsten.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
              .then(rec => {
                if (rec.data.result != null)
                {
                  if (result.length == 0)
                  {

                    //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                    console.log("ADD TO DATABASE");

                    let today = new Date();
                    today.setDate(today.getDate() + 30);
                    let vipExp = today;
                    let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                    query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}
                    });
                  }

                  else if (result[0].vipType == params.vipType)
                  {

                    //  IF SAME EXTEND MEMBERSHIP

                    console.log("Extend Membership");

                    selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                    query = mysql.format(selectQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let vipExp = result[0].vipExp;

                      let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                      let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                      query = mysql.format(updateQuery, [newDate, address]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });
                  }

                  else if (result[0].vipType < params.vipType)
                  {

                    //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                    console.log("UPGRADE MEMBERSHIP");

                    deleteQuery = "DELETE FROM vips WHERE address = ?"
                    query = mysql.format(deleteQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let today = new Date();
                      today.setDate(today.getDate() + 30);
                      let vipExp = today;
                      let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                      query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });
                  }

                  clearInterval(interval);

                  callback(true);
                }

                else
                {
                  axios.get('https://api-ropsten.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                  .then(responseCancelled => {
                    if (responseCancelled.data.result == null)
                    {
                      console.log("Transaction Cancelled.");
                      clearInterval(interval);
                      callback(false);
                    }
                  });
                }
              });
            }, 1000);
          });
        }
        else
        {
          //  NOT ENOUGH AMOUNT OR COIN NOT SUPPORTED

          callback(false);
        }
      }
      else
      {

        //  TRANSACTION IN MAIN COIN OF CHAIN

        if (response.data.result.to == process.env.ME)
        {
          let ethValue = 0;

          //  GET COIN VALUE ON DBB AND MULTPIPLY BY parseInt(response.data.result.value) / 1000000000000000000

          let query = "SELECT * FROM cryptospricechange where Crypto = 'ETH'";
          pool.getConnection(function (err, connection){
            if (err) {console.log(err); connection.release(); callback([]); return;}
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

              ethValue = result[0].CurrentPrice;

              //  COMPARE VALUE $ WITH VIPTYPE PRICE (GIVE 5% CUT FOR EXAMPLE IF PRICE IS 400, ADMITIR 380)

              if (ethValue * (parseInt(response.data.result.value) / 1000000000000000000) >= vipPrices[params.vipType])
              {

                //  CHECK IF USER IS ALREADY VIP

                let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
                let query = mysql.format(selectQuery, address);
                connection.query(query, function (err, result, fields) {
                  if (err) {console.log(err); connection.release(); callback([]); return;}

                  const interval = setInterval(function() {
                    console.log("Attempting to get transaction receipt...");
                    axios.get('https://api-ropsten.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                    .then(rec => {
                      if (rec.data.result != null)
                      {
                        if (result.length == 0)
                        {

                          //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                          console.log("ADD TO DATABASE");

                          let today = new Date();
                          today.setDate(today.getDate() + 30);
                          let vipExp = today;
                          let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                          query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}
                          });
                        }

                        else if (result[0].vipType == params.vipType)
                        {

                          //  IF SAME EXTEND MEMBERSHIP

                          console.log("Extend Membership");

                          selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                          query = mysql.format(selectQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let vipExp = result[0].vipExp;

                            let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                            let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                            query = mysql.format(updateQuery, [newDate, address]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });
                        }

                        else if (result[0].vipType < params.vipType)
                        {

                          //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                          console.log("UPGRADE MEMBERSHIP");

                          deleteQuery = "DELETE FROM vips WHERE address = ?"
                          query = mysql.format(deleteQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let today = new Date();
                            today.setDate(today.getDate() + 30);
                            let vipExp = today;
                            let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                            query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });
                        }

                        clearInterval(interval);

                        callback(true);
                      }

                      else
                      {
                        axios.get('https://api-ropsten.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                        .then(responseCancelled => {
                          if (responseCancelled.data.result == null)
                          {
                            console.log("Transaction Cancelled.");
                            clearInterval(interval);
                            callback(false);
                          }
                        });
                      }
                    });
                  }, 1000);
                });
              }

              else
              {
                //  NOT ENOUGH AMOUNT

                callback(false);
              }

              connection.release();
            });
          });

        }
        else
        {
          //  ADDRESS NOT ME

          callback(false);
        }
      }
    })
    .catch(error => {
      console.log(error);
    });
  }
  */
  if (params.chainId == "0x1")
  {
    //  Params.Coin.ETH

    console.log("ETH Network");


    axios.get('https://api.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
    .then(response => {

      //  TRANSACTION WITH OTHER COIN NOT MAIN

      if (response.data.result.input != "0x")
      {

        // First 34bits (10 chars (0x + 8 bytes)) is signature "" Then 256 bit is address TO have to add 0x and next 256 is x tokens

        let input = response.data.result.input;
        let hexAddress = input.substring(10,74);
        let hexQty = input.substring(74, 138);

        let address = "0x" + hexAddress.substring(24,64);
        console.log(address);
        let qty = (parseInt("0x" + hexQty)) / 1000000;
        console.log(qty);

        //  CHECK IF ADDRESS IS USDT

        if (response.data.result.to != "0xdac17f958d2ee523a2206206994597c13d831ec7")
        {
          callback(false);
        }

        else if (address == process.env.ME && qty >= vipPrices[params.vipType])
        {

          console.log("Payment with USDT");

          //  CHECK IF USER IS ALREADY VIP

          let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
          let query = mysql.format(selectQuery, address);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            const interval = setInterval(function() {
              console.log("Attempting to get transaction receipt...");
              axios.get('https://api.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
              .then(rec => {
                if (rec.data.result != null)
                {
                  if (result.length == 0)
                  {

                    //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                    console.log("ADD TO DATABASE");

                    let today = new Date();
                    today.setDate(today.getDate() + 30);
                    let vipExp = today;
                    let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                    query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType == params.vipType)
                  {

                    //  IF SAME EXTEND MEMBERSHIP

                    console.log("Extend Membership");

                    selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                    query = mysql.format(selectQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let vipExp = result[0].vipExp;

                      let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                      let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                      query = mysql.format(updateQuery, [newDate, address]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType < params.vipType)
                  {

                    //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                    console.log("UPGRADE MEMBERSHIP");

                    deleteQuery = "DELETE FROM vips WHERE address = ?"
                    query = mysql.format(deleteQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let today = new Date();
                      today.setDate(today.getDate() + 30);
                      let vipExp = today;
                      let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                      query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  clearInterval(interval);

                  callback(true);
                }

                else
                {
                  axios.get('https://api.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                  .then(responseCancelled => {
                    if (responseCancelled.data.result == null)
                    {
                      console.log("Transaction Cancelled.");
                      clearInterval(interval);
                      callback(false);
                    }
                  });
                }
              });
            }, 1000);
          });
        }
        else
        {
          //  NOT ENOUGH AMOUNT OR COIN NOT SUPPORTED

          console.log("address not ok");

          callback(false);
        }
      }
      else
      {

        //  TRANSACTION IN MAIN COIN OF CHAIN

        if (response.data.result.to == process.env.ME)
        {
          let ethValue = 0;

          //  GET COIN VALUE ON DBB AND MULTPIPLY BY parseInt(response.data.result.value) / 1000000000000000000

          let query = "SELECT * FROM cryptospricechange where Crypto = 'ETH'";
          pool.getConnection(function (err, connection){
            if (err) {console.log(err); connection.release(); callback([]); return;}
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

              ethValue = result[0].CurrentPrice;

              //  COMPARE VALUE $ WITH VIPTYPE PRICE (GIVE 5% CUT FOR EXAMPLE IF PRICE IS 400, ADMITIR 380)

              if (ethValue * (parseInt(response.data.result.value) / 1000000000000000000) >= vipPrices[params.vipType])
              {

                //  CHECK IF USER IS ALREADY VIP

                let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
                let query = mysql.format(selectQuery, address);
                connection.query(query, function (err, result, fields) {
                  if (err) {console.log(err); connection.release(); callback([]); return;}

                  const interval = setInterval(function() {
                    console.log("Attempting to get transaction receipt...");
                    axios.get('https://api.etherscan.io/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                    .then(rec => {
                      if (rec.data.result != null)
                      {
                        if (result.length == 0)
                        {

                          //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                          console.log("ADD TO DATABASE");

                          let today = new Date();
                          today.setDate(today.getDate() + 30);
                          let vipExp = today;
                          let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                          query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}
                          });

                          addHallOfFame(address, params, callback);

                        }

                        else if (result[0].vipType == params.vipType)
                        {

                          //  IF SAME EXTEND MEMBERSHIP

                          console.log("Extend Membership");

                          selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                          query = mysql.format(selectQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let vipExp = result[0].vipExp;

                            let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                            let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                            query = mysql.format(updateQuery, [newDate, address]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        else if (result[0].vipType < params.vipType)
                        {

                          //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                          console.log("UPGRADE MEMBERSHIP");

                          deleteQuery = "DELETE FROM vips WHERE address = ?"
                          query = mysql.format(deleteQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let today = new Date();
                            today.setDate(today.getDate() + 30);
                            let vipExp = today;
                            let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                            query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        clearInterval(interval);

                        callback(true);
                      }

                      else
                      {
                        axios.get('https://api.etherscan.io/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=7SHMJPM3EKJ5UQJQ6GDU7JYCC7KEY8F2F1")
                        .then(responseCancelled => {
                          if (responseCancelled.data.result == null)
                          {
                            console.log("Transaction Cancelled.");
                            clearInterval(interval);
                            callback(false);
                          }
                        });
                      }
                    });
                  }, 1000);
                });
              }

              else
              {
                //  NOT ENOUGH AMOUNT

                callback(false);
              }

              connection.release();
            });
          });

        }
        else
        {
          //  ADDRESS NOT ME

          callback(false);
        }
      }
    })
    .catch(error => {
      console.log(error);
    });
  }

  else if (params.chainId == "0x38")
  {
    //  Params.Coin.BSC

    console.log("BSC Network");

    axios.get('https://api.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=Q39KSQRYGQHKQZASVJRWYESRQ2MJTGWGH1")
    .then(response => {

      //  TRANSACTION WITH OTHER COIN NOT MAIN

      if (response.data.result.input != "0x")
      {

        // First 34bits (10 chars (0x + 8 bytes)) is signature "" Then 256 bit is address TO have to add 0x and next 256 is x tokens

        let input = response.data.result.input;
        let hexAddress = input.substring(10,74);
        let hexQty = input.substring(74, 138);

        let address = "0x" + hexAddress.substring(24,64);
        console.log(address);
        let qty = (parseInt("0x" + hexQty)) / 1000000;
        console.log(qty);

        //  CHECK IF ADDRESS IS USDT

        if (response.data.result.to != "0xdac17f958d2ee523a2206206994597c13d831ec7")
        {
          callback(false);
        }

        else if (address == process.env.ME && qty >= vipPrices[params.vipType])
        {

          console.log("Payment with USDT");

          //  CHECK IF USER IS ALREADY VIP

          let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
          let query = mysql.format(selectQuery, address);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            const interval = setInterval(function() {
              console.log("Attempting to get transaction receipt...");
              axios.get('https://api.bscscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=Q39KSQRYGQHKQZASVJRWYESRQ2MJTGWGH1")
              .then(rec => {
                if (rec.data.result != null)
                {
                  if (result.length == 0)
                  {

                    //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                    console.log("ADD TO DATABASE");

                    let today = new Date();
                    today.setDate(today.getDate() + 30);
                    let vipExp = today;
                    let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                    query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType == params.vipType)
                  {

                    //  IF SAME EXTEND MEMBERSHIP

                    console.log("Extend Membership");

                    selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                    query = mysql.format(selectQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let vipExp = result[0].vipExp;

                      let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                      let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                      query = mysql.format(updateQuery, [newDate, address]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType < params.vipType)
                  {

                    //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                    console.log("UPGRADE MEMBERSHIP");

                    deleteQuery = "DELETE FROM vips WHERE address = ?"
                    query = mysql.format(deleteQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let today = new Date();
                      today.setDate(today.getDate() + 30);
                      let vipExp = today;
                      let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                      query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  clearInterval(interval);

                  callback(true);
                }

                else
                {
                  axios.get('https://api.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=Q39KSQRYGQHKQZASVJRWYESRQ2MJTGWGH1")
                  .then(responseCancelled => {
                    if (responseCancelled.data.result == null)
                    {
                      console.log("Transaction Cancelled.");
                      clearInterval(interval);
                      callback(false);
                    }
                  });
                }
              });
            }, 1000);
          });
        }
        else
        {
          //  NOT ENOUGH AMOUNT OR COIN NOT SUPPORTED

          console.log("address not ok");

          callback(false);
        }
      }
      else
      {

        //  TRANSACTION IN MAIN COIN OF CHAIN

        if (response.data.result.to == process.env.ME)
        {
          let ethValue = 0;

          //  GET COIN VALUE ON DBB AND MULTPIPLY BY parseInt(response.data.result.value) / 1000000000000000000

          let query = "SELECT * FROM cryptospricechange where Crypto = 'ETH'";
          pool.getConnection(function (err, connection){
            if (err) {console.log(err); connection.release(); callback([]); return;}
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

              ethValue = result[0].CurrentPrice;

              //  COMPARE VALUE $ WITH VIPTYPE PRICE (GIVE 5% CUT FOR EXAMPLE IF PRICE IS 400, ADMITIR 380)

              if (ethValue * (parseInt(response.data.result.value) / 1000000000000000000) >= vipPrices[params.vipType])
              {

                //  CHECK IF USER IS ALREADY VIP

                let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
                let query = mysql.format(selectQuery, address);
                connection.query(query, function (err, result, fields) {
                  if (err) {console.log(err); connection.release(); callback([]); return;}

                  const interval = setInterval(function() {
                    console.log("Attempting to get transaction receipt...");
                    axios.get('https://api.bscscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=Q39KSQRYGQHKQZASVJRWYESRQ2MJTGWGH1")
                    .then(rec => {
                      if (rec.data.result != null)
                      {
                        if (result.length == 0)
                        {

                          //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                          console.log("ADD TO DATABASE");

                          let today = new Date();
                          today.setDate(today.getDate() + 30);
                          let vipExp = today;
                          let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                          query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}
                          });

                          addHallOfFame(address, params, callback);

                        }

                        else if (result[0].vipType == params.vipType)
                        {

                          //  IF SAME EXTEND MEMBERSHIP

                          console.log("Extend Membership");

                          selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                          query = mysql.format(selectQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let vipExp = result[0].vipExp;

                            let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                            let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                            query = mysql.format(updateQuery, [newDate, address]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        else if (result[0].vipType < params.vipType)
                        {

                          //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                          console.log("UPGRADE MEMBERSHIP");

                          deleteQuery = "DELETE FROM vips WHERE address = ?"
                          query = mysql.format(deleteQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let today = new Date();
                            today.setDate(today.getDate() + 30);
                            let vipExp = today;
                            let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                            query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        clearInterval(interval);

                        callback(true);
                      }

                      else
                      {
                        axios.get('https://api.bscscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=Q39KSQRYGQHKQZASVJRWYESRQ2MJTGWGH1")
                        .then(responseCancelled => {
                          if (responseCancelled.data.result == null)
                          {
                            console.log("Transaction Cancelled.");
                            clearInterval(interval);
                            callback(false);
                          }
                        });
                      }
                    });
                  }, 1000);
                });
              }

              else
              {
                //  NOT ENOUGH AMOUNT

                callback(false);
              }

              connection.release();
            });
          });

        }
        else
        {
          //  ADDRESS NOT ME

          callback(false);
        }
      }
    })
    .catch(error => {
      console.log(error);
    });
  }

  else if (params.chainId == "0x89")
  {
    //  Params.Coin.Polygon

    console.log("Polygon Network");

    axios.get('https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=DDERSF9RM5EYSFY4U3DEU2PJNXBRKX1FN6")
    .then(response => {

      //  TRANSACTION WITH OTHER COIN NOT MAIN

      if (response.data.result.input != "0x")
      {

        // First 34bits (10 chars (0x + 8 bytes)) is signature "" Then 256 bit is address TO have to add 0x and next 256 is x tokens

        let input = response.data.result.input;
        let hexAddress = input.substring(10,74);
        let hexQty = input.substring(74, 138);

        let address = "0x" + hexAddress.substring(24,64);
        console.log(address);
        let qty = (parseInt("0x" + hexQty)) / 1000000;
        console.log(qty);

        //  CHECK IF ADDRESS IS USDT

        if (response.data.result.to != "0xdac17f958d2ee523a2206206994597c13d831ec7")
        {
          callback(false);
        }

        else if (address == process.env.ME && qty >= vipPrices[params.vipType])
        {

          console.log("Payment with USDT");

          //  CHECK IF USER IS ALREADY VIP

          let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
          let query = mysql.format(selectQuery, address);
          connection.query(query, function (err, result, fields) {
            if (err) {console.log(err); connection.release(); callback([]); return;}

            const interval = setInterval(function() {
              console.log("Attempting to get transaction receipt...");
              axios.get('https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=DDERSF9RM5EYSFY4U3DEU2PJNXBRKX1FN6")
              .then(rec => {
                if (rec.data.result != null)
                {
                  if (result.length == 0)
                  {

                    //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                    console.log("ADD TO DATABASE");

                    let today = new Date();
                    today.setDate(today.getDate() + 30);
                    let vipExp = today;
                    let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                    query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType == params.vipType)
                  {

                    //  IF SAME EXTEND MEMBERSHIP

                    console.log("Extend Membership");

                    selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                    query = mysql.format(selectQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let vipExp = result[0].vipExp;

                      let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                      let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                      query = mysql.format(updateQuery, [newDate, address]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  else if (result[0].vipType < params.vipType)
                  {

                    //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                    console.log("UPGRADE MEMBERSHIP");

                    deleteQuery = "DELETE FROM vips WHERE address = ?"
                    query = mysql.format(deleteQuery, address);
                    connection.query(query, function (err, result, fields) {
                      if (err) {console.log(err); connection.release(); callback([]); return;}

                      let today = new Date();
                      today.setDate(today.getDate() + 30);
                      let vipExp = today;
                      let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                      query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                      connection.query(query, function (err, result, fields) {
                        if (err) {console.log(err); connection.release(); callback([]); return;}
                      });
                    });

                    addHallOfFame(address, params, callback);

                  }

                  clearInterval(interval);

                  callback(true);
                }

                else
                {
                  axios.get('https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=DDERSF9RM5EYSFY4U3DEU2PJNXBRKX1FN6")
                  .then(responseCancelled => {
                    if (responseCancelled.data.result == null)
                    {
                      console.log("Transaction Cancelled.");
                      clearInterval(interval);
                      callback(false);
                    }
                  });
                }
              });
            }, 1000);
          });
        }
        else
        {
          //  NOT ENOUGH AMOUNT OR COIN NOT SUPPORTED

          console.log("address not ok");

          callback(false);
        }
      }
      else
      {

        //  TRANSACTION IN MAIN COIN OF CHAIN

        if (response.data.result.to == process.env.ME)
        {
          let ethValue = 0;

          //  GET COIN VALUE ON DBB AND MULTPIPLY BY parseInt(response.data.result.value) / 1000000000000000000

          let query = "SELECT * FROM cryptospricechange where Crypto = 'ETH'";
          pool.getConnection(function (err, connection){
            if (err) {console.log(err); connection.release(); callback([]); return;}
            connection.query(query, function (err, result, fields) {
              if (err) {console.log(err); connection.release(); callback([]); return;}

              ethValue = result[0].CurrentPrice;

              //  COMPARE VALUE $ WITH VIPTYPE PRICE (GIVE 5% CUT FOR EXAMPLE IF PRICE IS 400, ADMITIR 380)

              if (ethValue * (parseInt(response.data.result.value) / 1000000000000000000) >= vipPrices[params.vipType])
              {

                //  CHECK IF USER IS ALREADY VIP

                let selectQuery = "SELECT vipType FROM vips WHERE address = ?";
                let query = mysql.format(selectQuery, address);
                connection.query(query, function (err, result, fields) {
                  if (err) {console.log(err); connection.release(); callback([]); return;}

                  const interval = setInterval(function() {
                    console.log("Attempting to get transaction receipt...");
                    axios.get('https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionReceipt&txhash=' + params.txHash + "&apikey=DDERSF9RM5EYSFY4U3DEU2PJNXBRKX1FN6")
                    .then(rec => {
                      if (rec.data.result != null)
                      {
                        if (result.length == 0)
                        {

                          //  ADD TO DATABASE WITH PARAMS.VIPTYPE
                          console.log("ADD TO DATABASE");

                          let today = new Date();
                          today.setDate(today.getDate() + 30);
                          let vipExp = today;
                          let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                          query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}
                          });

                          addHallOfFame(address, params, callback);
                        }

                        else if (result[0].vipType == params.vipType)
                        {

                          //  IF SAME EXTEND MEMBERSHIP

                          console.log("Extend Membership");

                          selectQuery = "SELECT vipExp FROM vips WHERE address = ?"
                          query = mysql.format(selectQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let vipExp = result[0].vipExp;

                            let newDate = new Date(vipExp.getFullYear(), vipExp.getMonth(), vipExp.getDate()+31);

                            let updateQuery = "UPDATE vips SET vipExp = ? WHERE address = ?"
                            query = mysql.format(updateQuery, [newDate, address]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        else if (result[0].vipType < params.vipType)
                        {

                          //  IF VIP HIGHER THEN UPGRADE MEMBERSHIP

                          console.log("UPGRADE MEMBERSHIP");

                          deleteQuery = "DELETE FROM vips WHERE address = ?"
                          query = mysql.format(deleteQuery, address);
                          connection.query(query, function (err, result, fields) {
                            if (err) {console.log(err); connection.release(); callback([]); return;}

                            let today = new Date();
                            today.setDate(today.getDate() + 30);
                            let vipExp = today;
                            let insertQuery = "INSERT INTO vips(address, vipType, vipExp) VALUES (?,?,?)"
                            query = mysql.format(insertQuery, [address, params.vipType, vipExp]);
                            connection.query(query, function (err, result, fields) {
                              if (err) {console.log(err); connection.release(); callback([]); return;}
                            });
                          });

                          addHallOfFame(address, params, callback);

                        }

                        clearInterval(interval);

                        callback(true);
                      }

                      else
                      {
                        axios.get('https://api.polygonscan.com/api?module=proxy&action=eth_getTransactionByHash&txhash=' + params.txHash + "&apikey=DDERSF9RM5EYSFY4U3DEU2PJNXBRKX1FN6")
                        .then(responseCancelled => {
                          if (responseCancelled.data.result == null)
                          {
                            console.log("Transaction Cancelled.");
                            clearInterval(interval);
                            callback(false);
                          }
                        });
                      }
                    });
                  }, 1000);
                });
              }

              else
              {
                //  NOT ENOUGH AMOUNT

                callback(false);
              }

              connection.release();
            });
          });

        }
        else
        {
          //  ADDRESS NOT ME

          callback(false);
        }
      }
    })
    .catch(error => {
      console.log(error);
    });
  }

  else
  {
    callback(false)
  }
}

//  DASHBOARD QUERYS

async function getDashboardStats(callback)
{
  let query = "SELECT totalMC, totalVolume, btcDominance FROM cryptomarket LIMIT 1";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}


async function dashboardQueryGainers(params, callback)
{
  let query = "SELECT * FROM cryptospricechange ORDER BY PriceChangePercent DESC LIMIT " + params.nCoins;
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    // callback();
    // return;
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function dashboardQueryTop(params, callback)
{
  let query = "SELECT * FROM cryptospricechange ORDER BY MarketCap DESC LIMIT " + params.nCoins;
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function dashboardQueryLowers(params, callback)
{
  let query = "SELECT * FROM cryptospricechange ORDER BY PriceChangePercent ASC LIMIT " + params.nCoins;
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

// PERSONAL INVESTMENT QUERYS

async function pInvestmentQuery(params, callback)
{
  let query = "SELECT * from pinvestment order by day desc Limit " + (params.Page-1+params.direction)*40 +",40";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function pInvestmentRows(params, callback)
{
  let query = "SELECT COUNT(*) as totalRows from pinvestment";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function pInvestmentProfit(callback)
{
  let query = "SELECT * from pinvestmentprofit where id = 1";
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

// MY ACCOUNT QUERYS

async function getDiscord(returnedAddress, callback)
{
  let selectQuery = "SELECT discordName from discordusers Where address = ?";
  let query = mysql.format(selectQuery, returnedAddress);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

async function insertDiscord(returnedAddress, params, callback)
{
  let selectQuery = "INSERT Into discordusers(address, discordName) VALUES(?, ?) ON DUPLICATE KEY UPDATE discordName = ?";
  let query = mysql.format(selectQuery, [returnedAddress, params.discordName, params.discordName]);
  pool.getConnection(function (err, connection){
    if (err) {console.log(err); connection.release(); callback([]); return;}
    connection.query(query, function (err, result, fields) {
      if (err) {console.log(err); connection.release(); callback([]); return;}
      callback(result);

      connection.release();
    });
  });
}

const { v4: uuidv4 } = require('uuid');

app.use(
  express.urlencoded({
    extended: true
  })
)

app.use(express.json({
  type: "*/*"
}))

app.use(cors());

  //  DASHBOARD ENDPOINTS

app.post('/dashboardStats' , (req, res) => {
  const verifyCookieDashboardStats = async (req, res) =>
  {
  try {
    getDashboardStats(result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieDashboardStats(req,res);
})

app.post('/dashboard', (req, res) => {

    const verifyCookieDashboard = async (req, res) =>
    {
      let dataReturned = [];
      const { address, params } = req.body;

    if (params.nCoins == 10)
    {
      dashboardQueryGainers(params, result => {
        dataReturned.push(result);

        dashboardQueryTop(params, result => {
          dataReturned.push(result);

          dashboardQueryLowers(params, result => {
            dataReturned.push(result);
            res.status(200).json({  dataReturned })
          });
        });
      });
    }
    else {
      try {
        let authHeader = req.headers['authorization'];

        if (authHeader.startsWith("Bearer ")){
          jwtCookie = authHeader.substring(7, authHeader.length);
        } else if (params.nCoins != 10){
          res.status(401).json({ error: "No token sent." });
        }

        if (jwtCookie == "null")
        {
          res.status(404).json({ error: "Connect to Metamask." });
        }

        else
        {
          const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

          let userId = tokenData.user_metadata.id;

          let { data, error } = await supabase
          .from("users")
          .select("walletAddress")
          .eq('id', userId)
          .single()

          let returnedAddress = data.walletAddress.toLowerCase();

          if (returnedAddress != address.toLowerCase() && params.nCoins != 10)
          {
            res.status(401).json({ error: "Addresses don't match with signature." });
          }

          else if (typeof params.nCoins != 'number' || params.nCoins > 100 || params.nCoins < 1)
          {
            res.status(400).json({ error: "Not valid inputs." })
          }

          else
          {
            checkVip(returnedAddress, result => {
              if (result.length != 0 || params.nCoins <= 10){
                dashboardQueryGainers(params, result => {
                  dataReturned.push(result);

                  dashboardQueryTop(params, result => {
                    dataReturned.push(result);

                    dashboardQueryLowers(params, result => {
                      dataReturned.push(result);
                      res.status(200).json({  dataReturned })
                    });
                  });
                });
              }
              else {
                res.status(403).json({ error: "You are not vip" });
              }
            })
          }
        }

      } catch (err) {
        res.status(400).json({ error: err.message });
      }
    }
    }
    verifyCookieDashboard(req,res);

})

//  WHALE TRACKER ENDPOINTS

app.post('/whaleTracker', (req, res) => {

  const verifyCookieWhales = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(400).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(400).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.day != 'string') {
      res.status(400).json({ error: "Not valid inputs." })
    }

    else
    {
      checkVip(returnedAddress, result => {
        if (result.length != 0){
          whaleMovesQuery(params, result => {
            dataReturned.push(result);

            whalesNamesQuery(params, result => {
              dataReturned.push(result);

              whalesMovesMinDay(params, result => {
                dataReturned.push(result);
                res.status(200).json({  dataReturned })
              });
            });
          });
        }
        else {
          res.status(400).json({ error: "You are not vip" });
        }
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieWhales(req,res);
})

app.post('/whaleTrackerMoves', (req, res) => {

  const verifyCookieWhalesMoves = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(400).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(400).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.day != 'string') {
      res.status(400).json({ error: "Not valid inputs." })
    }

    else
    {
      checkVip(returnedAddress, result => {
        if (result.length != 0){
          whaleMovesQuery(params, result => {
            dataReturned.push(result);
            res.status(200).json({  dataReturned })
          });
        }
        else {
          res.status(400).json({ error: "You are not vip" });
        }
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieWhalesMoves(req,res);
})

//  HALL OF FAME ENDPOINT

app.post('/hallOfFame' , (req, res) => {
  const verifyCookieHallOfFame = async (req, res) =>
  {
  try {
    getHallOfFame(result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieHallOfFame(req,res);
})

//  CHARTS ENDPOINTS

app.post('/coinCharts' , (req, res) => {
  const verifyCookieCoinCharts = async (req, res) =>
  {
  try {

    const { address, params } = req.body;


    if (typeof params.Direction != 'number' || typeof params.PageNumber != 'number')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }
    else {
      getCoinCharts(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieCoinCharts(req,res);
})

app.post('/chart' , (req, res) => {
  const verifyCookieChart = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    if (typeof params.time != 'number' || typeof params.points != 'number' || typeof params.Crypto != 'string' || (params.time != 5 && params.time != 15 && params.time != 60 && params.time != 480 && params.time != 1440) || (params.points < 10 || params.points > 90))
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else {
      getChart(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieChart(req,res);
})

//  NEWS ENDPOINTS

app.post('/news' , (req, res) => {
  const verifyCookieNews = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    if (typeof params.Direction != 'number' || typeof params.PageNumber != 'number')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else {
      getNews(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieNews(req,res);
})

app.post('/NewsArticle' , (req, res) => {
  const verifyCookieNewsArticle = async (req, res) =>
  {
  try {

    const { address, params } = req.body;


    if (typeof params.id != 'number')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else {
      getNewsArticle(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieNewsArticle(req,res);
})

//  WHITELISTS ENDPOINT

app.post('/whitelists' , (req, res) => {
  const verifyCookieNews = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    if (typeof params.Date != 'string')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else {
      getWhitelists(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieNews(req,res);
})

//  ROADMAP ENDPOINT

app.post('/RoadMap' , (req, res) => {
  const verifyCookieRoadMap = async (req, res) =>
  {
  try {
    getRoadmap(result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieRoadMap(req,res);
})

//  MEDIA ENDPOINT

app.post('/media' , (req, res) => {
  const verifyCookieMedia = async (req, res) =>
  {
  try {
    getMedia(result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieMedia(req,res);
})

//  PREVIEWS ENDPOINT

app.post('/PReviews' , (req, res) => {
  const verifyCookiePReviews = async (req, res) =>
  {
  try {

    const { address, params } = req.body;


    if (typeof params.Direction != 'number' || typeof params.PageNumber != 'number')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else {
      getPReviews(params, result => {
        res.status(200).json({  result  });
      })
    }
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookiePReviews(req,res);
})

// GAS ENDPOINTS

app.post('/gasChains' , (req, res) => {
  const verifyCookieGasChains = async (req, res) =>
  {
  try {

    getChains(result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieGasChains(req,res);
})


app.post('/chainGas' , (req, res) => {
  const verifyCookieChainGas = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    getChainGas(params, result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieChainGas(req,res);
})

app.post('/chainAvgGas' , (req, res) => {
  const verifyCookieChainAvgGas = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    getChainAvgGas(params, result => {
      res.status(200).json({  result  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieChainAvgGas(req,res);
})


//  VIP BUY ENDPOINTS

app.post('/vipBuy' , (req, res) => {
  const verifyCookieBuyVip = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(400).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(400).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.txHash != 'string' || typeof params.vipType != 'number' || typeof params.chainId != 'string' || params.vipType < 0 || params.vipType > 3 || (params.chainId != "0x38" && params.chainId != "0x1" || params.chainId != "0x89")) {
      res.status(400).json({ error: "Not valid Inputs." })
    }

    else
    {
      verifyVipAndAddToDB(address, params, result => {
        res.status(200).json({  result })
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieBuyVip(req,res);
})

app.post('/vipCheck' , (req, res) => {
  const verifyCookieCheckVip = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(401).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else
    {
      checkVip(address, result => {
        res.status(200).json({  result })
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieCheckVip(req,res);
})

app.post('/getMainCoinPrice' , (req, res) => {
  const mainCoinPrice = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(401).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.vipType != 'number' || typeof params.chainId != 'string')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else
    {
      getMainCoinPrice(params, result => {
        res.status(200).json({  result })
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  mainCoinPrice(req,res);
})

//  PRICE ALERTS ENDPOINTS

app.post('/alertsCheck', (req, res) => {

  const verifyAlertsCheck = async (req, res) =>
  {
  try {
    let dataReturned = [];
    const { address, params } = req.body;

    if (typeof params.xCoins != 'number' || params.xCoins < 0 || params.xCoins > 3)
    {
      res.status(400).json({
        error: "Not valid inputs."
      })
    }

    else if (params.xCoins <= 1)
    {
      getPriceAlerts(params, result => {
        res.status(200).json({  result })
      });
    }
    else {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(400).json({ error: "No token sent." });
      }

      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(400).json({ error: "Addresses don't match with signature." });
      }

      else
      {
        checkVip(returnedAddress, result => {
          if (result.length != 0)
          {
            getPriceAlerts(params, result => {
              res.status(200).json({  result })
            });
          }
          else {
            res.status(400).json({ error: "You are not vip" });
          }
        })
      }
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyAlertsCheck(req,res);
})


//  PORTFOLIO ENDPOINTS

app.post('/getCoinPrice' , (req, res) => {
  const verifyCookieCoinPrice = async (req, res) =>
  {
  try {

    const { address, params } = req.body;

    getCoinPrice(params, result2 => {
      res.status(200).json({  result2  });
    })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieCoinPrice(req,res);
})

app.post('/portfolio' , (req, res) => {

    const verifyCookiePortfolio = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.Page != 'number' || typeof params.PageSumm != 'number' || typeof params.directionSumm != 'number' || typeof params.direction != 'number')
      {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        getPortfolioCoins(params, result => {
          dataReturned.push(result);
          getPortfolio(address, params, result => {
            dataReturned.push(result);
            checkVip(returnedAddress, result => {
              if (result.length != 0){
                getWalletValueByDay(address, result => {
                  dataReturned.push(result);
                  res.status(200).json({  dataReturned })
                });
              }
              else {
                res.status(200).json({  dataReturned })
              }
            })
          })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolio(req,res);
})

app.post('/portfolioSell' , (req, res) => {

    const verifyCookiePortfolioSell = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.Page != 'number' || typeof params.direction != 'number')
      {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        getPortfolioCoinsToSell(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioSell(req,res);
})

app.post('/portfolioCoinAmount' , (req, res) => {

    const verifyCookiePortfolioCoinAmount = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else
      {
        getPortfolioCoinAmount(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioCoinAmount(req,res);
})

app.post('/portfolioAddCoin' , (req, res) => {

    const verifyCookiePortfolioAddCoin = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.qty != 'number')
      {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        insertCoinToPortfolio(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioAddCoin(req,res);
})


app.post('/portfolioAddFixedCoin' , (req, res) => {

    const verifyCookiePortfolioAddFixedCoin = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.qty != 'number' || typeof params.price != 'number')
      {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        insertFixedCoinToPortfolio(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioAddFixedCoin(req,res);
})


app.post('/portfolioSellCoin' , (req, res) => {

    const verifyCookiePortfolioSellCoin = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.qty != 'number') {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        sellCoinPortfolio(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioSellCoin(req,res);
})

app.post('/portfolioSellFixedCoin' , (req, res) => {

    const verifyCookiePortfolioSellFixedCoin = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address, params } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else if (typeof params.qty != 'number' || typeof params.price != 'number') {
        res.status(400).json({ error: "Not valid inputs." });
      }

      else
      {
        sellFixedCoinToPortfolio(address, params, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioSellFixedCoin(req,res);
})

app.post('/portfolioReset' , (req, res) => {

    const verifyCookiePortfolioSellCoin = async (req, res) =>
    {
    try {
      let authHeader = req.headers['authorization'];

      if (authHeader.startsWith("Bearer ")){
        jwtCookie = authHeader.substring(7, authHeader.length);
      } else {
        res.status(401).json({ error: "No token sent." });
      }

      const { address } = req.body;
      const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

      let userId = tokenData.user_metadata.id;

      let dataReturned = [];

      let { data, error } = await supabase
      .from("users")
      .select("walletAddress")
      .eq('id', userId)
      .single()

      let returnedAddress = data.walletAddress.toLowerCase();

      if (returnedAddress != address.toLowerCase())
      {
        res.status(401).json({ error: "Addresses don't match with signature." });
      }

      else
      {
        resetWallet(address, result => {
          res.status(200).json({  result })
        })
      }

    } catch (err) {
      res.status(400).json({ error: err.message });
    }
    }
    verifyCookiePortfolioSellCoin(req,res);
})

//  PERSONAL INVESTMENT ENDPOINTS

app.post('/pInvestment', (req, res) => {

  const verifyCookieWallet = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(401).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.Page != 'number' || typeof params.direction != 'number')
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else
    {
      checkVip(returnedAddress, result => {
        if (result.length != 0 && result[0].vipType >= 2){
          pInvestmentQuery(params, result => {
            dataReturned.push(result);

            pInvestmentRows(params, result => {
              dataReturned.push(result);
              res.status(200).json({  dataReturned })
            });
          });
        }
        else {
          res.status(400).json({ error: "You are not vip" });
        }
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieWallet(req,res);
})

app.post('/pInvestmentProfit', (req, res) => {

  const verifyCookieWalletProfit = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(400).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let profitData = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else
    {
      pInvestmentProfit(result => {
        profitData.push(result);
        res.status(200).json({  profitData })
      });
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
}

verifyCookieWalletProfit(req, res);
})

//  MY ACCOUNT ENDPOINTS

app.post('/getDiscord', (req, res) => {

  const verifyCookieDiscord = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(401).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else
    {
      getDiscord(returnedAddress, result => {
        res.status(200).json({ result });
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieDiscord(req,res);
})

app.post('/insertDiscord', (req, res) => {

  const verifyCookieInsDiscord = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(401).json({ error: "No token sent." });
    }

    const { address, params } = req.body;
    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let dataReturned = [];

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress.toLowerCase();

    if (returnedAddress != address.toLowerCase())
    {
      res.status(401).json({ error: "Addresses don't match with signature." });
    }

    else if (typeof params.discordName != 'string' || params.discordName.length == 0 || params.discordName.length > 40 || params.discordName.split('#')[1].length != 4)
    {
      res.status(400).json({ error: "Not valid inputs." });
    }

    else
    {
      insertDiscord(returnedAddress, params, result => {
        res.status(200).json({ result });
      })
    }

  } catch (err) {
    res.status(400).json({ error: err.message });
  }
  }
  verifyCookieInsDiscord(req,res);
})

// SIGNATURE ENDPOINTS

app.post('/nonce', (req, res) => {
  //Generar Nonce
  const nonceApi = async (req, res) => {

    const { walletAddr } = req.body;
    var newNonce = uuidv4();

    let { data, error } = await supabase
    .from('users')
    .select('nonce')
    .eq('walletAddress', walletAddr)

    if (data.length > 0)
    {
      //New User Nonce
      let { data, error } = await supabase.from('users')
      .update({ nonce: newNonce })
      .match({  walletAddress: walletAddr })
    }
    else
    {
      //Create user record + nonce
      let { data, error } = await supabase
      .from('users')
      .insert({ nonce:newNonce, walletAddress:walletAddr })
    }

    if (error)
    {
      res.status(400).json({
        error: error.message
      })
    }
    else {
      res.status(200).json({
        newNonce
      })
    }
  }

  nonceApi(req,res);

})

app.post('/wallet', (req, res) => {
  const verifySign = async (req, res) =>
  {
  try {
    const { walletAddr, newNonce, signature } = req.body;
    const signerAddres = ethers.utils.verifyMessage(newNonce, signature);

    if(signerAddres !== walletAddr){
      console.log("wrong Signature");
    }

    let { data, error } = await supabase
    .from("users")
    .select("*")
    .eq('walletAddress', walletAddr)
    .eq('nonce', newNonce)
    .single()

    const token = jwt.sign({
      "aud": "authenticated",
      "expiresIn": Math.floor((Date.now() / 1000) + (60*60*24*365)),
      "sub": data.id,
      "user_metadata" : {
        id: data.id,
      },
      "role": "authenticated"
    }, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus")


    res.status(200).json({ token })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
}

  verifySign(req,res);
})

app.post('/needSign', (req, res) => {
  const verifyCookie = async (req, res) =>
  {
  try {
    let authHeader = req.headers['authorization'];

    if (authHeader.startsWith("Bearer ")){
      jwtCookie = authHeader.substring(7, authHeader.length);
    } else {
      res.status(400).json({ error: "No token sent." });
    }

    const tokenData = jwt.verify(jwtCookie, "HpC3UARRh1QQhIfLn1MQmFXl7MhyOXus");

    let userId = tokenData.user_metadata.id;

    let { data, error } = await supabase
    .from("users")
    .select("walletAddress")
    .eq('id', userId)
    .single()

    let returnedAddress = data.walletAddress

    res.status(200).json({ returnedAddress })
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
}

  verifyCookie(req,res);
})

app.post('/DepositMe' , (req, res) => {
  const verifyDeposit = async (req, res) =>
  {

  const bearerToken = "Put-Your-API-Key-Here"
  console.log(123)

  let secretKey = "36kGQRDzyoWJpcVAbUW39dQWQaNu2wvW8sVXPcP5tFzJbRnsrNAjyM3VBDynFL6ztVmBTtxSpBLduCVwuiMAR3Vh"

  let keypair = Web3.Keypair.fromSecretKey(bs58.decode(secretKey));

  const connection = new Web3.Connection(Web3.clusterApiUrl("mainnet-beta"), "confirmed");

  const wallet = keypair.publicKey.toBase58();

  axios.get('https://api-devnet.magiceden.io/v2/instructions/deposit', {
    params: {
        'auctionHouseAddress': 'E8cU1WiRWjanGxmn96ewBgk9vPTcL6AEZ1t6F6fkgUWe',
        'buyer': '5XDHKACetPHhromFgWaEHuTQpzQFffqyTgbzVLtcyrwh',
        'amount': '1'
    },
    headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
        'Accept': 'application/json, text/plain',
        'Accept-Language': 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
        'Accept-Encoding': 'gzip, deflate, br',
        'Referer': 'https://magiceden.io/',
        'Origin': 'https://magiceden.io',
        'Alt-Used': 'api-mainnet.magiceden.io',
        'Connection': 'keep-alive',
        'Cookie': '_ga_VF47PCBD53=GS1.1.1672767978.19.1.1672768001.0.0.0; _ga=GA1.1.146940053.1669737382; jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJhdXRoZW50aWNhdGVkIiwiZXhwaXJlc0luIjoxNzAyNDgwODgxLCJzdWIiOiI4NDc2MDE4Mi0yYmI5LTQzNTktYTQwYy05MjM3NmI3NTk1YzAiLCJ1c2VyX21ldGFkYXRhIjp7ImlkIjoiODQ3NjAxODItMmJiOS00MzU5LWE0MGMtOTIzNzZiNzU5NWMwIn0sInJvbGUiOiJhdXRoZW50aWNhdGVkIiwiaWF0IjoxNjcwOTQ0ODgxfQ.IixGzcfSHXWZTtFK5uiSayzvTAmSghVSOrK_tn3iJ6k',
        'Sec-Fetch-Dest': 'empty',
        'Sec-Fetch-Mode': 'cors',
        'Sec-Fetch-Site': 'same-site',
        'Pragma': 'no-cache',
        'Cache-Control': 'no-cache',
        'TE': 'trailers'
    }
    }).then((res) => {
    const txSigned = res.data.txSigned
    const txn = Web3.Transaction.from(Buffer.from(txSigned.data))
    const signature = Web3.sendAndConfirmTransaction(
        connection,
        txn,
        [keypair]
    ).catch(err => console.log("Error Deposit"))
})
}
verifyDeposit(req, res);
})

app.post('/WithdrawMe' , (req, res) => {
  const verifyWithdraw = async (req, res) =>
  {
  try
  {
  const bearerToken = "Put-Your-API-Key-Here"
  console.log(123)

  let secretKey = "36kGQRDzyoWJpcVAbUW39dQWQaNu2wvW8sVXPcP5tFzJbRnsrNAjyM3VBDynFL6ztVmBTtxSpBLduCVwuiMAR3Vh"

  let keypair = Web3.Keypair.fromSecretKey(bs58.decode(secretKey));

  const connection = new Web3.Connection(Web3.clusterApiUrl("mainnet-beta"), "confirmed");

  const wallet = keypair.publicKey.toBase58();

  axios.get('https://api-devnet.magiceden.io/v2/instructions/withdraw', {
    params: {
        'auctionHouseAddress': 'E8cU1WiRWjanGxmn96ewBgk9vPTcL6AEZ1t6F6fkgUWe',
        'buyer': '5XDHKACetPHhromFgWaEHuTQpzQFffqyTgbzVLtcyrwh',
        'amount': '1'
    },
    headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
        'Accept': 'application/json, text/plain',
        'Accept-Language': 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
        'Accept-Encoding': 'gzip, deflate, br',
        'Referer': 'https://magiceden.io/',
        'Origin': 'https://magiceden.io',
        'Alt-Used': 'api-mainnet.magiceden.io',
        'Connection': 'keep-alive',
        'Cookie': '_ga_VF47PCBD53=GS1.1.1672767978.19.1.1672769236.0.0.0; _ga=GA1.1.146940053.1669737382; jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhdWQiOiJhdXRoZW50aWNhdGVkIiwiZXhwaXJlc0luIjoxNzA0MzA1MjMwLCJzdWIiOiI4NDc2MDE4Mi0yYmI5LTQzNTktYTQwYy05MjM3NmI3NTk1YzAiLCJ1c2VyX21ldGFkYXRhIjp7ImlkIjoiODQ3NjAxODItMmJiOS00MzU5LWE0MGMtOTIzNzZiNzU5NWMwIn0sInJvbGUiOiJhdXRoZW50aWNhdGVkIiwiaWF0IjoxNjcyNzY5MjMwfQ.CkDwAWEkV7VNWnh8xyb28xKCIF9BGbsspumvlnl4HsI',
        'Sec-Fetch-Dest': 'empty',
        'Sec-Fetch-Mode': 'cors',
        'Sec-Fetch-Site': 'same-site',
        'Pragma': 'no-cache',
        'Cache-Control': 'no-cache',
        'TE': 'trailers'
    }
    }).then((res) => {
    const txSigned = res.data.txSigned
    const txn = Web3.Transaction.from(Buffer.from(txSigned.data))
    const signature = Web3.sendAndConfirmTransaction(
        connection,
        txn,
        [keypair]
    ).catch(err => console.log("Error withdrawing"))
})
}
catch (err) {
    console.log(err)
  }

}
verifyWithdraw(req, res);
})

app.post('/BidMe' , (req, res) => {
  const verifyBidMe = async (req, res) =>
  {
  try
  {
  const bearerToken = "Put-Your-API-Key-Here"

  let { NftMint, price } = req.body

  let secretKey = "36kGQRDzyoWJpcVAbUW39dQWQaNu2wvW8sVXPcP5tFzJbRnsrNAjyM3VBDynFL6ztVmBTtxSpBLduCVwuiMAR3Vh"

  let keypair = Web3.Keypair.fromSecretKey(bs58.decode(secretKey));

  const connection = new Web3.Connection(Web3.clusterApiUrl("mainnet-beta"), "confirmed");

  const wallet = keypair.publicKey.toBase58();

  axios.get('https://api-devnet.magiceden.io/v2/instructions/buy', {
    params: {
        'price': price,
        'buyer': '5XDHKACetPHhromFgWaEHuTQpzQFffqyTgbzVLtcyrwh',
        'auctionHouseAddress': 'E8cU1WiRWjanGxmn96ewBgk9vPTcL6AEZ1t6F6fkgUWe',
        'tokenMint': NftMint,
        'expiry': '1673206400',
        'useV2': 'false'
    },
    headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
        'Accept': 'application/json, text/plain',
        'Accept-Language': 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
        'Accept-Encoding': 'gzip, deflate, br',
        'Origin': 'https://magiceden.io',
        'Alt-Used': 'api-mainnet.magiceden.io',
        'Connection': 'keep-alive',
        'Referer': 'https://magiceden.io/',
        'Cookie': 'rl_anonymous_id=RudderEncrypt%3AU2FsdGVkX19qCY2Mb8AVJfaLW8VHGszTzTkj9h7g0ux1KygVA7d%2B4zrbXO5ll2evgxAevribP9u1DWgz%2BIR57g%3D%3D; rl_page_init_referrer=RudderEncrypt%3AU2FsdGVkX188DCekaddPKDYAu0dOSWfyYVzPV31cow8%3D; rl_page_init_referring_domain=RudderEncrypt%3AU2FsdGVkX1%2B5AKejomeoqpi8mOHuXfqSTkTZS%2F7JnWc%3D; _ga=GA1.2.831978200.1655699490; _clck=9sm8pq|1|f4u|0; intercom-id-htawnd0o=63c3bcd8-5c08-4342-adef-0aef90d496d4; __stripe_mid=1d353833-7cc9-4957-8a00-d94b8facb5671dc95f; intercom-device-id-htawnd0o=39c016e2-e83b-466f-b918-fd8cc60ee96b; intercom-session-htawnd0o=; browser_session_id=ukh69CzWTifnK1xK8QaArLTrrKY87gOpe-uv20mSOGU; _ga_8BCG117VGT=GS1.1.1673117231.173.1.1673119998.2.0.0; _ga_2MTNXEBQ7Y=GS1.1.1671151897.1.1.1671151921.0.0.0; rl_session=RudderEncrypt%3AU2FsdGVkX19hlZWMXnXmuhfc1sKOAt95%2BqYPuvhZ0M2uJzzREySLQACaO5bBhhlFDRt1%2FUco78SJor1A6QnUYWwHzJPxL0XQYZHS%2BeE3HQ34cuIlyQu265sstcgl2kFF0oXJKjDtTafjZKgdDVeK8A%3D%3D; _gcl_au=1.1.1977451363.1671279540; _gid=GA1.2.857256691.1672587804; session_id=Q0bieKpEMmUPjBvb-lyb5HIBt427bytcxAbdbpwbCiU; rl_user_id=RudderEncrypt%3AU2FsdGVkX1%2BmfAKerwneXZg0djCVdqH4TV4TyHDtw888Nme6jf5qaQSTd9EgiNK8a%2F7FFVXzaPY8e1Y3JUJIVQ%3D%3D; rl_trait=RudderEncrypt%3AU2FsdGVkX18%2BmC5%2FowlbOsuQKshC5Ar5FkFFgI%2BHrnFLx5SAoSan1sCgKg92vlZBeFNqgRpkNCRdk3U6Q0mZdlVthe5Ci%2F3as5oqA8wm9oY339pok7ji2qBrcEO89G6rJEiSuph86MMho%2B5kP32akPDhTIMZ0NbaqoQfe6QWOUfMNFCKFXS4YTiqfBH3uuzzrywFcTghk%2FDbDjer%2BLEJt8L7NrE1GUXEfqcVzbMbin0pZVxUNNjOpkfAFO%2BK8gsWL2w5gLl5VMT%2FeCHEH%2B5NQg%3D%3D; rl_group_id=RudderEncrypt%3AU2FsdGVkX1%2Bz%2FsYJxwKXEUauxr4HnaqHdfJrv7J%2Bcz0%3D; rl_group_trait=RudderEncrypt%3AU2FsdGVkX1%2FOa7TfNBkvJDA1Ztpwm3%2FNn8U1fXndIPU%3D; __cf_bm=Yw5EkbYkXG0ct5Qh_DoKQbV.IKaUwg0iZeMHqFce2vc-1673119971-0-AX7QWCH3d77JhdDkvc69bpI+hrmR6+O6r0PaxdcuHmrMoBxppbnt6Pm+WxoOZl28CB6i0oLO6TjeyN3z/lBL853mZgP/QF46064gOmT61SDttJsfjOs3CYyEUkE4MFoXYoiFFBHk5xPCFnCY95EthGBcMm/r0pHEk3NvADLnoc21+Uax1YnbMGWL2E7KT57vxQ==; _cfuvid=t._tgC9kLHLM35pgg2_uSyq3b4Q89oA5YkXw.PpKnRQ-1673117229553-0-604800000; __stripe_sid=0f75de8b-3c1a-42a9-90a6-318b9e8bacb4f42011; connect.sid=s%3A7_L6CYu6viphDVkmUPXZgBmw4_y4F-Mq.tp5Nnqv4BovDVoNXJ753cLUkXIrtd4RXAssWsNgmIPg; _gat_UA-217792783-1=1',
        'Sec-Fetch-Dest': 'empty',
        'Sec-Fetch-Mode': 'cors',
        'Sec-Fetch-Site': 'same-site',
        'Pragma': 'no-cache',
        'Cache-Control': 'no-cache',
        'TE': 'trailers'
    }
}).then((res) => {
    const txSigned = res.data.txSigned
    const txn = Web3.Transaction.from(Buffer.from(txSigned.data))
    const signature = Web3.sendAndConfirmTransaction(
        connection,
        txn,
        [keypair]
    ).catch(err => console.log("Error bidding"))
}).catch(err => console.log(err.response.data))
res.status(200).json({  "result":"OK"  });
}
catch (err) {
    console.log(err)
  }

}
verifyBidMe(req, res);
})

app.post('/CancelBids' , (req, res) => {
  const verifyCancelBids = async (req, res) =>
  {

  const bearerToken = "Put-Your-API-Key-Here"
  console.log(123)

  let secretKey = "36kGQRDzyoWJpcVAbUW39dQWQaNu2wvW8sVXPcP5tFzJbRnsrNAjyM3VBDynFL6ztVmBTtxSpBLduCVwuiMAR3Vh"

  let keypair = Web3.Keypair.fromSecretKey(bs58.decode(secretKey));

  const connection = new Web3.Connection(Web3.clusterApiUrl("mainnet-beta"), "confirmed");

  const wallet = keypair.publicKey.toBase58();

  axios.get('https://api-devnet.magiceden.io/v2/instructions/buy_change_price', {
    params: {
        'buyer': '5XDHKACetPHhromFgWaEHuTQpzQFffqyTgbzVLtcyrwh',
        'auctionHouseAddress': 'E8cU1WiRWjanGxmn96ewBgk9vPTcL6AEZ1t6F6fkgUWe',
        'price': '0.05',
        'newPrice': '0.15',
        'tokenMint': 'B6igA3KemS4gXF8xQxkmZzoPXPUB7sdAwF75uxssuznF',
        'expiry': '0'
    },
    headers: {
        'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:108.0) Gecko/20100101 Firefox/108.0',
        'Accept': 'application/json, text/plain',
        'Accept-Language': 'es-ES,es;q=0.8,en-US;q=0.5,en;q=0.3',
        'Accept-Encoding': 'gzip, deflate, br',
        'Referer': 'https://magiceden.io/',
        'Origin': 'https://magiceden.io',
        'Alt-Used': 'api-mainnet.magiceden.io',
        'Connection': 'keep-alive',
        'Cookie': 'rl_anonymous_id=RudderEncrypt%3AU2FsdGVkX1%2Bt%2BgB2j0Gmg6%2FxZYBhyEJFh3vLk3Qbag%2FqCVHypQzLTqevCB%2FHe%2B8EfCIcQZwaZNpTw%2BXQ%2FAKqUA%3D%3D; rl_page_init_referrer=RudderEncrypt%3AU2FsdGVkX188DCekaddPKDYAu0dOSWfyYVzPV31cow8%3D; rl_page_init_referring_domain=RudderEncrypt%3AU2FsdGVkX1%2B5AKejomeoqpi8mOHuXfqSTkTZS%2F7JnWc%3D; _ga=GA1.2.831978200.1655699490; _clck=9sm8pq|1|f4u|0; intercom-id-htawnd0o=63c3bcd8-5c08-4342-adef-0aef90d496d4; __stripe_mid=1d353833-7cc9-4957-8a00-d94b8facb5671dc95f; intercom-device-id-htawnd0o=39c016e2-e83b-466f-b918-fd8cc60ee96b; intercom-session-htawnd0o=; browser_session_id=ukh69CzWTifnK1xK8QaArLTrrKY87gOpe-uv20mSOGU; _ga_8BCG117VGT=GS1.1.1672851166.152.1.1672853448.42.0.0; _ga_2MTNXEBQ7Y=GS1.1.1671151897.1.1.1671151921.0.0.0; rl_session=RudderEncrypt%3AU2FsdGVkX19hlZWMXnXmuhfc1sKOAt95%2BqYPuvhZ0M2uJzzREySLQACaO5bBhhlFDRt1%2FUco78SJor1A6QnUYWwHzJPxL0XQYZHS%2BeE3HQ34cuIlyQu265sstcgl2kFF0oXJKjDtTafjZKgdDVeK8A%3D%3D; _gcl_au=1.1.1977451363.1671279540; _gid=GA1.2.857256691.1672587804; session_id=Q0bieKpEMmUPjBvb-lyb5HIBt427bytcxAbdbpwbCiU; rl_user_id=RudderEncrypt%3AU2FsdGVkX1%2FASny%2FWCbRnDBrsp%2FtAgFbd71DbeFRXpnJGPb%2BMhXigZnKSf1ZHVKZX5GZCj2e1aGebOd%2BvMZS2Q%3D%3D; rl_trait=RudderEncrypt%3AU2FsdGVkX1%2B0Aq26wMCdK92lPvde7D6MVl6ef7vZum3jMUP8c4Qmd3Dll8TPEDaWEa2Q5%2BBL6lJZbd41wTpuwo022fP2EwmcmqDfQmZryW15srEEMD7sEfrwjHlIhubmSbtpSJZ9fFZL4u3dRY3HYflaoGdYqudaUJwRF7Ranve%2FJ6hoZnyasIxdVKyiK3dJJ3mfXWhI%2FH2jnFqMp35pg4lyirxTeP8igTFZQEvWoq5l34OLznLAufbykraY%2Bq99Iqr9CYZnhJdFAsVk7gtgSQ%3D%3D; rl_group_id=RudderEncrypt%3AU2FsdGVkX19MBm5fmI4q9NxReRDlcSVXgVAotOTV2ow%3D; rl_group_trait=RudderEncrypt%3AU2FsdGVkX1%2B%2FC2lktVKhwDLYYgQQKBNdfwqyB%2Bnv6Rs%3D; _cfuvid=9GHtZAg6lOqxGuh5l3S8NSBXzTQvmCIVa0lhnJZCNmw-1672841677365-0-604800000; __cf_bm=HJqIZvDfNnwkxzXTlYtrP0Hxh.6YnI5Rm2u8RIJcH9s-1672852795-0-AfVsXDisX1PxW5kiV/iFq7fu9GPu7toYDzLjrxv3WgNFovfO1tGu8MzRqANmHp0iZ2Bpl5FL4M37ydi7PoSAbkwp2MA0lTtS6MZj7EgEiFPUqXl3l8I+D2yUd8I2umy/n7mxOHtSoJh8AoJri0t2b1EFMQ9cdsKk9Dt4OyheXIZ1T5AAvk5oe8uI7BVDuVm8xw==; __stripe_sid=0ca2348c-40be-4322-b65a-332fc29501db1f0fc7; connect.sid=s%3Ai6siDWekIH6In7qaEojRdQdkIUQ5oFSI.zNDprDn0NOooe7YOY6Ee3cqIuVFNgHiVc60ZJ78bgGA; _gat_UA-217792783-1=1',
        'Sec-Fetch-Dest': 'empty',
        'Sec-Fetch-Mode': 'cors',
        'Sec-Fetch-Site': 'same-site',
        'Pragma': 'no-cache',
        'Cache-Control': 'no-cache',
        'TE': 'trailers'
    }
    }).then((res) => {
    const txSigned = res.data.txSigned
    const txn = Web3.Transaction.from(Buffer.from(txSigned.data))
    const signature = Web3.sendAndConfirmTransaction(
        connection,
        txn,
        [keypair]
    ).catch(err => console.log("Error Changing Bid"))
})
}

verifyCancelBids(req, res);
})



// START SERVER
app.listen(port, () => {
  //setInterval(bidME, 10000)
  console.log("Estoy funcionando.");
  
  //  GET FROM Params:  Chain ID, Vip Type
    //  Chain Id:
      // Bsc: 0x38.
      // Eth: 0x1.
      // Polygon: 0x89.

    // Vip Type:
      // 1.
      // 2.
      // 3.

  //  Coins Accecpted:
    // Bsc: Bnb (Later), Busd (0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56), Usdt (0x55d398326f99059ff775485246999027b3197955).
    // Eth: Eth (Later), Usdt (0xdAC17F958D2ee523a2206206994597C13D831ec7).
    // Polygon: Matic (Later), USDT (0xc2132D05D31c914a87C6611C10748AEb04B58e8F).

  //  Api Call Depending On Chain ID.
    // Bsc: Bscscan.
    // Eth: Etherscan.
    // Polygon: Polygonscan.

  //  CHECK IF COIN IS ON CHAIN COINS [] ACCEPTED.
  //  MAKE API CALL TO THE CHAIN RESPECTED.
  //  VALIDATE PARAMS FROM THE SIGNATURE.
  //  PROCESS.ENV.MYADDRESS.

  //  CHECK IF VIP BOUGHT IS ALREADY THAT VIP
  //  IF NEW VIP ADD TO DATABASE, IF VIP LOWER RETURN MONEY ADD TO DATABASE QUERY, IF NOT UPGRADE TO THAT VIP.


  //verifyVipAndAddToDB("0x43975f192e5b3b74ebb890ab4d58c43df9ffa8d6", {"txHash" : "0x2c4af7b7d1bb6ad340b7b8fab7a637833efe056205a13c46c773b4f6f74d458e", "chainId": "0x89", "vipType": 1}, result => {
    //console.log(result);
  //});

})
