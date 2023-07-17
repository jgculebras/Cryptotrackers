let width, height, gradient2, gradient3, gradient4;
function getGradient(ctx, price0, maxPrice, minPrice) {

  let x = price0 - minPrice;
  let x2 = maxPrice - minPrice;

  let percent = x/x2;

  if (percent < 0)
  {
    percent = 0;
  }
  else if (percent > 1) {
    percent = 1;
  }

  const chartWidth = 899;
  const chartHeight = 539;

  width = chartWidth;
  height = chartHeight;
  gradient2 = ctx.createLinearGradient(0, 0, 0, 350);
  gradient2.addColorStop(1, 'rgb(220, 0, 0)');
  gradient2.addColorStop(1 - percent, 'rgb(179, 179, 0)');
  gradient2.addColorStop(0, 'rgb(0, 200, 25)');



return gradient2;
}

function getGradient(ctx, price0, maxPrice, minPrice, chartArea) {

  let x = price0 - minPrice;
  let x2 = maxPrice - minPrice;

  let percent = x/x2;

  if (percent < 0)
  {
    percent = 0;
  }
  else if (percent > 1) {
    percent = 1;
  }

  const chartWidth = 899;
  const chartHeight = 539;

  width = chartWidth;
  height = chartHeight;
  if (typeof chartArea === 'undefined')
  {
    return;
  }
  gradient2 = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
  gradient2.addColorStop(1, 'rgb(220, 0, 0)');
  gradient2.addColorStop(1 - percent, 'rgb(179, 179, 0)');
  gradient2.addColorStop(0, 'rgb(0, 200, 25)');



return gradient2;
}

function getGradientBackAbove(ctx, price0, maxPrice, minPrice) {

let x = price0 - minPrice;
let x2 = maxPrice - minPrice;

let percent = x/x2;

if (percent < 0)
{
  percent = 0;
}
else if (percent > 1) {
  percent = 1;
}

const chartWidth = 899;
const chartHeight = 539;
  // Create the gradient because this is either the first render
  // or the size of the chart has changed
  width = chartWidth;
  height = chartHeight;
  gradient3 = ctx.createLinearGradient(0, 0, 0, 350);
  gradient3.addColorStop(1 - percent, 'rgb(179, 179, 0, 0.1)');
  gradient3.addColorStop(0.1, 'rgb(0, 255, 0, 0.2)');


return gradient3;
}

function getGradientBackAbove(ctx, price0, maxPrice, minPrice, chartArea) {

let x = price0 - minPrice;
let x2 = maxPrice - minPrice;

let percent = x/x2;

if (percent < 0)
{
  percent = 0;
}
else if (percent > 1) {
  percent = 1;
}

const chartWidth = 899;
const chartHeight = 539;
  // Create the gradient because this is either the first render
  // or the size of the chart has changed
width = chartWidth;
height = chartHeight;
gradient3 = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
gradient3.addColorStop(1 - percent, 'rgb(179, 179, 0, 0.1)');
gradient3.addColorStop(0.1, 'rgb(0, 255, 0, 0.2)');


return gradient3;
}

function getGradientBackBelow(ctx, price0, maxPrice, minPrice) {

let x = price0 - minPrice;
let x2 = maxPrice - minPrice;

let percent = x/x2;

if (percent < 0)
{
  percent = 0;
}
else if (percent > 1) {
  percent = 1;
}

const chartWidth = 899;
const chartHeight = 539;
  // Create the gradient because this is either the first render
  // or the size of the chart has changed
  width = chartWidth;
  height = chartHeight;
  gradient4 = ctx.createLinearGradient(0, 0, 0, 350);
  gradient4.addColorStop(0.9, 'rgb(255, 0, 0, 0.2)');
  gradient4.addColorStop(1 - percent, 'rgb(179, 179, 0, 0.1)');

return gradient4;
}

function getGradientBackBelow(ctx, price0, maxPrice, minPrice, chartArea) {

let x = price0 - minPrice;
let x2 = maxPrice - minPrice;

let percent = x/x2;

if (percent < 0)
{
  percent = 0;
}
else if (percent > 1) {
  percent = 1;
}

const chartWidth = 899;
const chartHeight = 539;
  // Create the gradient because this is either the first render
  // or the size of the chart has changed
  width = chartWidth;
  height = chartHeight;
  gradient4 = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
  gradient4.addColorStop(0.9, 'rgb(255, 0, 0, 0.2)');
  gradient4.addColorStop(1 - percent, 'rgb(179, 179, 0, 0.1)');

return gradient4;
}
