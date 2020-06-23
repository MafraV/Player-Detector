<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>Soccer_Pitch_Simulator</title>
	<link href="index.css" rel="stylesheet"/>
  <script src="https://d3js.org/d3.v4.js"></script>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <style>
  body {
    background-image: url('https://i.ibb.co/L1p1N7h/background.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
  }
</style>
</head>
<body>



<div class = "selectButtons">
	<button onclick="drawPoints(current, 'all')" class="generalButton">Show Players</button>

<button onclick="hidePoints()" class="generalButton">Hide Players</button>

<button onclick="drawVectors(current, 'all')" class="generalButton">Show Vectors</button>

<button onclick="hideVectors()" class="generalButton">Hide Vectors</button>

  <div for="select" id="seletor" >
    Select Player:
    <button onclick="selectPoint('red')" id="red">1</button>
    <button onclick="selectPoint('blue')" id="blue">2</button>
    <button onclick="selectPoint('sblue')" id="sblue">3</button>
    <button onclick="selectPoint('purple')" id="purple">4</button>
    <button onclick="selectPoint('black')" id="black">5</button>
    <button onclick="selectPoint('orange')" id="orange">6</button>
    <button onclick="selectPoint('violet')" id="violet">7</button>
    <button onclick="selectPoint('yellow')" id="yellow">8</button>
    <button onclick="selectPoint('pink', current)" id="pink">9</button>
    <button onclick="selectPoint('lime', current)" id="lime">10</button>
    <button onclick="selectPoint('salmon', current)" id="salmon">11</button>
  </div>

</div>

<div class="selectButtons">

<button onclick="play(current+1)" class="generalButton">Play</button>

<button onclick="pause()" class="generalButton">Pause</button>

<button onclick="updateDots(current+1)" class="generalButton">Next</button>

<button onclick="updateDots(current-1)" class="generalButton">Previous</button>

<button onclick="drawPath(current)" class="generalButton">Draw Path</button>

<button onclick="fullPathSelection()" class="generalButton">Draw Full Path</button>

<button onclick="updateDots(1)" class="doubleButton">Reset</button>
</div>

<div class="sliders">
  <div for="duration" id="slider">
         Duration (ms) = <span id="duration-value"></span>
         <input type="range" min="100" max="999" id="duration" value = 500 step = 1 class="slider">
</div>
  
  <div for="vectorSize" id="size">
         Vector Size Const. = <span id="size-value"></span>
         <input type="range" min="0.5" max="10" id="vectorSize" value = 3.5 step = 0.5 class="slider">
  </div>
  
  <div for="moment" id="momentSlider">
         Moment (s) = <span id="moment-value"></span>
         <input type="range" min="1" max="169" id="moment" value = 1 step = 1 class="biggerSlider">
  </div>
  
</div>


<div id="my_dataviz" style="width: 100%; height: 40%; padding: 10px 0px; text-align:center;"></div>



<script type = "text/javascript">
  {
	var margin = {
    top: 10,
    right: 30,
    bottom: 30,
    left: 60
  },
  width = 720 - margin.left - margin.right,
  height = 448 - margin.top - margin.bottom;
} // Margens

{
	var svg = d3.select("#my_dataviz")
  .append("svg")
  .attr("width", width + margin.left + margin.right)
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", 
  	"translate(" + margin.left + "," + margin.top + ")");
} // SVG

{
var duration = 500;

d3.select("#duration").on("input", function() {
  updateDuration(+this.value);
  duration = +this.value;
});

updateDuration(500)

var k = 3.5;
 
 d3.select("#vectorSize").on("input", function() {
  updateVectorSize(+this.value);
  k = +this.value;
  updateDots(current)
});

updateVectorSize(3.5)

var current = 1;
 
 d3.select("#moment").on("input", function() {
  updateMoment(+this.value);
  current = +this.value;
  updateDots(current)
});

updateMoment(1)

} // Sliders

{ 
	svg.append("rect")
  .attr("x", 0)
  .attr("y", 0)
  .attr("width", width)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "black")
  .style("fill", "#207f19");
  
  svg.append("rect")
  .attr("x", width/14)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#23911e")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*3)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*5)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*7)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*9)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*11)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("rect")
  .attr("x", (width/14)*13)
  .attr("y", 0)
  .attr("width", width/14)
  .attr("height", height)
  .attr("stroke-width", 2)
  .style("stroke", "#239120")
  .style("fill", "#23911e");
  
  svg.append("line")
  .attr("x1", width / 2)
  .attr("y1", 0)
  .attr("x2", width / 2)
  .attr("y2", height)
  .attr("stroke-width", 2)
  .attr("stroke", "white");
  
  
  svg.append("rect")
  .attr("x", 0)
  .attr("y", (height - 120.9) / 2)
  .attr("width", 49.5)
  .attr("height", 120.9)
  .attr("stroke-width", 2)
  .style("stroke", "white")
  .style("fill", "none");

	svg.append("rect")
  .attr("x", width - 49.5)
  .attr("y", (height - 120.9) / 2)
  .attr("width", 49.5)
  .attr("height", 120.9)
  .attr("stroke-width", 2)
  .style("stroke", "white")
  .style("fill", "none");
  
  svg.append("rect")
  .attr("x", 0)
  .attr("y", (height-73.2)/2)
  .attr("width", 22)
  .attr("height", 73.2)
  .attr("stroke-width", 2)
  .style("stroke", "white")
  .style("fill", "none");
  
  svg.append("rect")
  .attr("x", width - 22)
  .attr("y", (height-73.2)/2)
  .attr("width", 22)
  .attr("height", 73.2)
  .attr("stroke-width", 2)
  .style("stroke", "white")
  .style("fill", "none");
  
   var pi = Math.PI
 
	svg.append("line")
  .attr("x1", 0)
  .attr("y1", 0)
  .attr("x2", width)
  .attr("y2", 0)
  .attr("stroke-width", 2)
  .attr("stroke", "white");

	svg.append("line")
  .attr("x1", width)
  .attr("y1", 0)
  .attr("x2", width)
  .attr("y2", height)
  .attr("stroke-width", 2)
  .attr("stroke", "white");

	svg.append("line")
  .attr("x1", 0)
  .attr("y1", 0)
  .attr("x2", 0)
  .attr("y2", height)
  .attr("stroke-width", 2)
  .attr("stroke", "white");

	svg.append("line")
  .attr("x1", 0)
  .attr("y1", height)
  .attr("x2", width)
  .attr("y2", height)
  .attr("stroke-width", 2)
  .attr("stroke", "white");
  
  svg.append("circle")
  .attr("cx", width/2)
  .attr("cy", height/2)
  .attr("r", 36.6)
  .attr("stroke-width", 2)
  .style("stroke", "white")
  .style("fill", "none")
  
   svg.append("circle")
  .attr("cx", width/2)
  .attr("cy", height/2)
  .attr("r", 2)
  .style("fill", "white")
  
  svg.append("circle")
  .attr("cx", (27.5/2)+22)
  .attr("cy", height/2)
  .attr("r", 2)
  .style("fill", "white")
  
  svg.append("circle")
  .attr("cx", 384.25)
  .attr("cy", height/2)
  .attr("r", 2)
  .style("fill", "white")
} // Linhas do Campo

{
	var goon = 1;
	var stoped = 0;
	var vector = 0;
  var full = 1;
  var raio = 9;
} // Variáveis de Controle
 
{
	var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);  
  var xs = svg.append("g")
    .attr("transform", "translate(0," + height + ")")
    .call(d3.axisBottom(x));

    xs.selectAll("line")
    .style("stroke", "black");
    
    xs.selectAll("path")
    .style("stroke", "black");

  xs.selectAll("text")
    .style("stroke", "black");

  var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);
    var ys =	svg.append("g")
    .call(d3.axisLeft(y));

    ys.selectAll("line")
    .style("stroke", "black");
    
    ys.selectAll("path")
    .style("stroke", "black");

  ys.selectAll("text")
    .style("stroke", "black");
} // Eixos

{
	svg.append("svg:defs").append("svg:marker")
    .attr("id", "triangle")
    .attr("refX", 6)
    .attr("refY", 6)
    .attr("markerWidth", 12)
    .attr("markerHeight", 12)
    .attr("markerUnits","userSpaceOnUse")
    .attr("orient", "auto")
    .append("path")
    .attr("d", "M 0 0 8 6 0 12 3 6")
    .style("fill", "black");
} // Cabeça da Flecha

function url(i){
	return "https://raw.githubusercontent.com/MafraV/Player-Detector/master/Momentos/momento%20" + (i) + ".csv";
}

function drawPoints(i, point){

var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);
    
var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);

d3.csv(url(i), function(data1) {

current = i;
updateMoment(current);

if((point=='red' || point=='all') && svg.selectAll(".redDot").size()==0){
  var p1 = [data1[0].X, data1[0].Y]
  svg.selectAll("mycircles")
  .data(p1)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p1[0]);
  })
  .attr("cy", function(d) {
    return y(p1[1]);
  })
  .attr("r", raio)
  .style("fill", "red")
  .attr("class", "redDot")
  }
  
 
if((point=='blue' || point=='all') && svg.selectAll(".blueDot").size()==0){ 
  var p2 = [data1[1].X, data1[1].Y]
  svg.selectAll("mycircles")
  .data(p2)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p2[0]);
  })
  .attr("cy", function(d) {
    return y(p2[1]);
  })
  .attr("r", raio)
  .style("fill", "blue")
  .attr("class", "blueDot")
}

if((point=='sblue' || point=='all') && svg.selectAll(".sblueDot").size()==0){
  var p3 = [data1[2].X, data1[2].Y]
  svg.selectAll("mycircles")
  .data(p3)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p3[0]);
  })
  .attr("cy", function(d) {
    return y(p3[1]);
  })
  .attr("r", raio)
  .style("fill", "steelblue")
  .attr("class", "sblueDot")
}

if((point=='purple' || point=='all') && svg.selectAll(".purpleDot").size()==0){
  var p4 = [data1[3].X, data1[3].Y]
  svg.selectAll("mycircles")
  .data(p4)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p4[0]);
  })
  .attr("cy", function(d) {
    return y(p4[1]);
  })
  .attr("r", raio)
  .style("fill", "purple")
  .attr("class", "purpleDot")
}

if((point=='black' || point=='all') && svg.selectAll(".blackDot").size()==0){
  var p5 = [data1[4].X, data1[4].Y]
  svg.selectAll("mycircles")
  .data(p5)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p5[0]);
  })
  .attr("cy", function(d) {
    return y(p5[1]);
  })
  .attr("r", raio)
  .style("fill", "black")
  .attr("class", "blackDot")
}

if((point=='orange' || point=='all') && svg.selectAll(".orangeDot").size()==0){
  var p6 = [data1[5].X, data1[5].Y]
  svg.selectAll("mycircles")
  .data(p6)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p6[0]);
  })
  .attr("cy", function(d) {
    return y(p6[1]);
  })
  .attr("r", raio)
  .style("fill", "orange")
  .attr("class", "orangeDot")
}

if((point=='violet' || point=='all') && svg.selectAll(".violetDot").size()==0){
  var p7 = [data1[6].X, data1[6].Y]
  svg.selectAll("mycircles")
  .data(p7)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p7[0]);
  })
  .attr("cy", function(d) {
    return y(p7[1]);
  })
  .attr("r", raio)
  .style("fill", "violet")
  .attr("class", "violetDot")
}

if((point=='yellow' || point=='all') && svg.selectAll(".yellowDot").size()==0){
  var p8 = [data1[7].X, data1[7].Y]
  svg.selectAll("mycircles")
  .data(p8)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p8[0]);
  })
  .attr("cy", function(d) {
    return y(p8[1]);
  })
  .attr("r", raio)
  .style("fill", "yellow")
  .attr("class", "yellowDot")
}

if((point=='pink' || point=='all') && svg.selectAll(".pinkDot").size()==0){
  var p9 = [data1[8].X, data1[8].Y]
  svg.selectAll("mycircles")
  .data(p9)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p9[0]);
  })
  .attr("cy", function(d) {
    return y(p9[1]);
  })
  .attr("r", raio)
  .style("fill", "FF33F3")
  .attr("class", "pinkDot")
}

if((point=='lime' || point=='all') && svg.selectAll(".limeDot").size()==0){
  var p10 = [data1[9].X, data1[9].Y]
  svg.selectAll("mycircles")
  .data(p10)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p10[0]);
  })
  .attr("cy", function(d) {
    return y(p10[1]);
  })
  .attr("r", raio)
  .style("fill", "AFFF33")
  .attr("class", "limeDot")
}

if((point=='salmon' || point=='all') && svg.selectAll(".salmonDot").size()==0){
  var p11 = [data1[10].X, data1[10].Y]
  svg.selectAll("mycircles")
  .data(p11)
  .enter()
  .append("circle")
  .attr("cx", function(d) {
    return x(p11[0]);
  })
  .attr("cy", function(d) {
    return y(p11[1]);
  })
  .attr("r", raio)
  .style("fill", "FF5233")
  .attr("class", "salmonDot")
}
  })
}

function drawVectors(i, vector){
	d3.csv(url(i), function(data1) {
  d3.csv(url(i+1), function(dataVector) {
  
var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);
    
var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);

if((vector == 'a' || vector == 'all') && svg.selectAll(".redDot").size()>0) {   
    p1 = [data1[0].X, data1[0].Y]
  	v1 = [dataVector[0].X, dataVector[0].Y]
    norma = modulo(p1[0],p1[1],v1[0],v1[1])
    
    if(norma!=0){
    	vec = [v1[0]-p1[0], v1[1]-p1[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	xf=0
    	yf=0
    	if(vecN[0]<0){
    	xf = p1[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p1[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p1[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p1[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
    
    else{
    	xf = p1[0];
      yf = p1[1];
    }
       
    svg.selectAll(".myLines")
    .data(v1)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(p1[0]);
    })
  	.attr("y1", function(d) {
      return y(p1[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "aLine")
    .attr("marker-end", "url(#triangle)");
    
}

{
if((vector == 'b' || vector == 'all')&&svg.selectAll(".blueDot").size()>0) {  
    p2 = [data1[1].X, data1[1].Y]
		v2 = [dataVector[1].X, dataVector[1].Y]
    norma = modulo(p2[0],p2[1],v2[0],v2[1])
    if(norma!=0){
    	vec = [v2[0]-p2[0], v2[1]-p2[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p2[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p2[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p2[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p2[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p2[0];
      yf = p2[1];
    }
    
    svg.selectAll(".myLines")
    .data(v2)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(p2[0]);
    })
  	.attr("y1", function(d) {
      return y(p2[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "bLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'c' || vector == 'all') && svg.selectAll(".sblueDot").size()>0) {  
    p3 = [data1[2].X, data1[2].Y]
    v3 = [dataVector[2].X, dataVector[2].Y]
    norma = modulo(p3[0],p3[1],v3[0],v3[1])
    
    if(norma!=0){
    vec = [v3[0]-p3[0], v3[1]-p3[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p3[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p3[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p3[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p3[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p3[0];
    yf = p3[1];
    }
    
    svg.append("line")
  	.attr("x1", function(d) {
      return x(p3[0]);
    })
  	.attr("y1", function(d) {
      return y(p3[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "cLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'd' || vector == 'all') && svg.selectAll(".purpleDot").size()>0) {  
    p4 = [data1[3].X, data1[3].Y]
    v4 = [dataVector[3].X, dataVector[3].Y]
    norma = modulo(p4[0],p4[1],v4[0],v4[1])
    
    if(norma!=0){
    vec = [v4[0]-p4[0], v4[1]-p4[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p4[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p4[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p4[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p4[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p4[0];
    yf = p4[1];
    }
    
    svg.append("line")
  	.attr("x1", function(d) {
      return x(p4[0]);
    })
  	.attr("y1", function(d) {
      return y(p4[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "dLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'e' || vector == 'all') && svg.selectAll(".blackDot").size()>0) {  
    p5 = [data1[4].X, data1[4].Y]
  	v5 = [dataVector[4].X, dataVector[4].Y]
    norma = modulo(p5[0],p5[1],v5[0],v5[1])
    
    if(norma!=0){
    vec = [v5[0]-p5[0], v5[1]-p5[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p5[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p5[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p5[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p5[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p5[0];
    yf = p5[1];
    }
    
    svg.append("line")
  	.attr("x1", function(d) {
      return x(p5[0]);
    })
  	.attr("y1", function(d) {
      return y(p5[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "eLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'f' || vector == 'all') && svg.selectAll(".orangeDot").size()>0) {  
    p6 = [data1[5].X, data1[5].Y]
    v6 = [dataVector[5].X, dataVector[5].Y]
    norma = modulo(p6[0],p6[1],v6[0],v6[1])
    
    if(norma!=0){
    vec = [v6[0]-p6[0], v6[1]-p6[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p6[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p6[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p6[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p6[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p6[0]
    yf = p6[1]
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p6[0]);
    })
  	.attr("y1", function(d) {
      return y(p6[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "fLine")
    .attr("marker-end", "url(#triangle)");
}    

if((vector == 'g' || vector == 'all') && svg.selectAll(".violetDot").size()>0) {  
    p7 = [data1[6].X, data1[6].Y]
    v7 = [dataVector[6].X, dataVector[6].Y]
    norma = modulo(p7[0],p7[1],v7[0],v7[1])
    
    if(norma!=0){
    vec = [v7[0]-p7[0], v7[1]-p7[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p7[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p7[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p7[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p7[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p7[0];
    yf = p7[1];
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p7[0]);
    })
  	.attr("y1", function(d) {
      return y(p7[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "gLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'h' || vector == 'all') && svg.selectAll(".yellowDot").size()>0) {  
    p8 = [data1[7].X, data1[7].Y]
    v8 = [dataVector[7].X, dataVector[7].Y]
    norma = modulo(p8[0],p8[1],v8[0],v8[1])
    
    if(norma!=0){
    vec = [v8[0]-p8[0], v8[1]-p8[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p8[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p8[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p8[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p8[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p8[0];
    yf = p8[1];
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p8[0]);
    })
  	.attr("y1", function(d) {
      return y(p8[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "hLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'i' || vector == 'all') && svg.selectAll(".pinkDot").size()>0) {  
    p9 = [data1[8].X, data1[8].Y]
    v9 = [dataVector[8].X, dataVector[8].Y]
    norma = modulo(p9[0],p9[1],v9[0],v9[1])
    
    if(norma!=0){
    vec = [v9[0]-p9[0], v9[1]-p9[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p9[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p9[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p9[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p9[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p9[0];
    yf = p9[1];
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p9[0]);
    })
  	.attr("y1", function(d) {
      return y(p9[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "iLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'j' || vector == 'all') && svg.selectAll(".limeDot").size()>0) {  
    p10 = [data1[9].X, data1[9].Y]
    v10 = [dataVector[9].X, dataVector[9].Y]
    norma = modulo(p10[0],p10[1],v10[0],v10[1])
    
    if(norma!=0){
    vec = [v10[0]-p10[0], v10[1]-p10[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p10[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p10[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p10[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p10[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p10[0];
    yf = p10[1];
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p10[0]);
    })
  	.attr("y1", function(d) {
      return y(p10[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "jLine")
    .attr("marker-end", "url(#triangle)");
}

if((vector == 'k' || vector == 'all') && svg.selectAll(".salmonDot").size()>0) {  
    p11 = [data1[10].X, data1[10].Y]
    v11 = [dataVector[10].X, dataVector[10].Y]
    norma = modulo(p11[0],p11[1],v11[0],v11[1])
    
    if(norma!=0){
    vec = [v11[0]-p11[0], v11[1]-p11[1]]
    vecN = [vec[0]/norma,vec[1]/norma]
    if(vecN[0]<0){
    xf = p11[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    }
    else{
    xf = p11[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    }
    if(vecN[1]<0){
    yf = p11[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    }
    else{
    yf = p11[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    }}
    
    else{
    xf = p11[0];
    yf = p11[1];
    }

    svg.append("line")
  	.attr("x1", function(d) {
      return x(p11[0]);
    })
  	.attr("y1", function(d) {
      return y(p11[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "kLine")
    .attr("marker-end", "url(#triangle)");
}
}


  	})
  })
}

function modulo(x1,y1,x2,y2){
	a = Math.pow(x2-x1, 2)
  b = Math.pow(y2-y1, 2)
  x = Math.sqrt(a+b)
  return Math.floor(x * 1000) / 1000
}

function hidePoints(){
var data = []
	svg.selectAll(".redDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".blueDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".sblueDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".purpleDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".blackDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".orangeDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".violetDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".yellowDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".pinkDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".limeDot")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".salmonDot")
  .data(data)
  .exit()
  .remove()
  
  hideVectors()
}

function hideVectors(){
var data = []
	svg.selectAll(".aLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".aLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".bLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".bLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".cLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".cLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".dLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".dLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".eLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".eLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".fLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".fLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".gLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".gLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".hLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".hLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".iLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".iLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".jLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".jLinePath")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".kLine")
  .data(data)
  .exit()
  .remove()
  
  svg.selectAll(".kLinePath")
  .data(data)
  .exit()
  .remove()
}

function updateDots(i){

d3.csv(url(i), function(data2) {
  d3.csv(url(i+1), function(dataVector) {
  current = i;
  updateMoment(current);

  var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);

  var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);
    
  var norma, vec, vecN, xf, yf;  
    
			p1 = [data2[0].X, data2[0].Y]
    	svg.selectAll(".redDot")
      .data(p1)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p1[0]);
      })
      .attr("cy", function(d) {
        return y(p1[1]);
      })
      
  		v1 = [dataVector[0].X, dataVector[0].Y]
    	norma = modulo(p1[0],p1[1],v1[0],v1[1])
    
    	if(norma!=0){
    	vec = [v1[0]-p1[0], v1[1]-p1[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	xf=0
    	yf=0
    	if(vecN[0]<0){
    	xf = p1[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p1[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p1[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p1[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
    
    else{
    	xf = p1[0];
      yf = p1[1];
    }
       
    svg.selectAll(".aLine")
    .data(v1)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p1[0]);
    })
  	.attr("y1", function(d) {
      return y(p1[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    });
 
  
    
      p2 = [data2[1].X, data2[1].Y]
    svg.selectAll(".blueDot")
      .data(p2)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p2[0]);
      })
      .attr("cy", function(d) {
        return y(p2[1]);
      })
      
		v2 = [dataVector[1].X, dataVector[1].Y]
    norma = modulo(p2[0],p2[1],v2[0],v2[1])
    if(norma!=0){
    	vec = [v2[0]-p2[0], v2[1]-p2[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p2[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p2[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p2[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p2[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p2[0];
      yf = p2[1];
    }
    
    svg.selectAll(".bLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p2[0]);
    })
  	.attr("y1", function(d) {
      return y(p2[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p3 = [data2[2].X, data2[2].Y]
    svg.selectAll(".sblueDot")
      .data(p3)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p3[0]);
      })
      .attr("cy", function(d) {
        return y(p3[1]);
      })
      
      v3 = [dataVector[2].X, dataVector[2].Y]
    norma = modulo(p3[0],p3[1],v3[0],v3[1])
    if(norma!=0){
    	vec = [v3[0]-p3[0], v3[1]-p3[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p3[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p3[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p3[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p3[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p3[0];
      yf = p3[1];
    }
    
    svg.selectAll(".cLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p3[0]);
    })
  	.attr("y1", function(d) {
      return y(p3[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
       
      p4 = [data2[3].X, data2[3].Y]
    svg.selectAll(".purpleDot")
      .data(p4)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p4[0]);
      })
      .attr("cy", function(d) {
        return y(p4[1]);
      })
      
      v4 = [dataVector[3].X, dataVector[3].Y]
    norma = modulo(p4[0],p4[1],v4[0],v4[1])
    if(norma!=0){
    	vec = [v4[0]-p4[0], v4[1]-p4[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p4[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p4[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p4[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p4[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p4[0];
      yf = p4[1];
    }
    
    svg.selectAll(".dLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p4[0]);
    })
  	.attr("y1", function(d) {
      return y(p4[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p5 = [data2[4].X, data2[4].Y]
    svg.selectAll(".blackDot")
      .data(p5)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p5[0]);
      })
      .attr("cy", function(d) {
        return y(p5[1]);
      })
      
      v5 = [dataVector[4].X, dataVector[4].Y]
    norma = modulo(p5[0],p5[1],v5[0],v5[1])
    if(norma!=0){
    	vec = [v5[0]-p5[0], v5[1]-p5[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p5[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p5[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p5[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p5[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p5[0];
      yf = p5[1];
    }
    
    svg.selectAll(".eLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p5[0]);
    })
  	.attr("y1", function(d) {
      return y(p5[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p6 = [data2[5].X, data2[5].Y]
    svg.selectAll(".orangeDot")
      .data(p6)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p6[0]);
      })
      .attr("cy", function(d) {
        return y(p6[1]);
      })
      
      v6 = [dataVector[5].X, dataVector[5].Y]
    norma = modulo(p6[0],p6[1],v6[0],v6[1])
    if(norma!=0){
    	vec = [v6[0]-p6[0], v6[1]-p6[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p6[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p6[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p6[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p6[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p6[0];
      yf = p6[1];
    }
    
    svg.selectAll(".fLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p6[0]);
    })
  	.attr("y1", function(d) {
      return y(p6[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p7 = [data2[6].X, data2[6].Y]
    svg.selectAll(".violetDot")
      .data(p7)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p7[0]);
      })
      .attr("cy", function(d) {
        return y(p7[1]);
      })
      
      v7 = [dataVector[6].X, dataVector[6].Y]
    norma = modulo(p7[0],p7[1],v7[0],v7[1])
    if(norma!=0){
    	vec = [v7[0]-p7[0], v7[1]-p7[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p7[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p7[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p7[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p7[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p7[0];
      yf = p7[1];
    }
    
    svg.selectAll(".gLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p7[0]);
    })
  	.attr("y1", function(d) {
      return y(p7[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p8 = [data2[7].X, data2[7].Y]
    svg.selectAll(".yellowDot")
      .data(p8)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p8[0]);
      })
      .attr("cy", function(d) {
        return y(p8[1]);
      })
      
      v8 = [dataVector[7].X, dataVector[7].Y]
    norma = modulo(p8[0],p8[1],v8[0],v8[1])
    if(norma!=0){
    	vec = [v8[0]-p8[0], v8[1]-p8[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p8[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p8[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p8[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p8[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p8[0];
      yf = p8[1];
    }
    
    svg.selectAll(".hLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p8[0]);
    })
  	.attr("y1", function(d) {
      return y(p8[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p9 = [data2[8].X, data2[8].Y]
    svg.selectAll(".pinkDot")
      .data(p9)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p9[0]);
      })
      .attr("cy", function(d) {
        return y(p9[1]);
      })
      
      v9 = [dataVector[8].X, dataVector[8].Y]
    norma = modulo(p9[0],p9[1],v9[0],v9[1])
    if(norma!=0){
    	vec = [v9[0]-p9[0], v9[1]-p9[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p9[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p9[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p9[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p9[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p9[0];
      yf = p9[1];
    }
    
    svg.selectAll(".iLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p9[0]);
    })
  	.attr("y1", function(d) {
      return y(p9[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
        
      p10 = [data2[9].X, data2[9].Y]
    svg.selectAll(".limeDot")
      .data(p10)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p10[0]);
      })
      .attr("cy", function(d) {
        return y(p10[1]);
      })
      
      v10 = [dataVector[9].X, dataVector[9].Y]
    norma = modulo(p10[0],p10[1],v10[0],v10[1])
    if(norma!=0){
    	vec = [v10[0]-p10[0], v10[1]-p10[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p10[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p10[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p10[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p10[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p10[0];
      yf = p10[1];
    }
    
    svg.selectAll(".jLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p10[0]);
    })
  	.attr("y1", function(d) {
      return y(p10[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
      
      p11 = [data2[10].X, data2[10].Y]
    svg.selectAll(".salmonDot")
      .data(p11)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
        return x(p11[0]);
      })
      .attr("cy", function(d) {
        return y(p11[1]);
      })
      
      v11 = [dataVector[10].X, dataVector[10].Y]
    norma = modulo(p11[0],p11[1],v11[0],v11[1])
    if(norma!=0){
    	vec = [v11[0]-p11[0], v11[1]-p11[1]]
    	vecN = [vec[0]/norma,vec[1]/norma]
    	if(vecN[0]<0){
    	xf = p11[0]-(Math.abs(Math.floor(vecN[0]*k*1000)/1000));
    	}
    	else{
    	xf = p11[0]-((Math.floor(vecN[0]*k*1000)/1000)*-1);
    	}
    	if(vecN[1]<0){
    	yf = p11[1]-(Math.abs(Math.floor(vecN[1]*k*1000)/1000));
    	}
    	else{
    	yf = p11[1]-((Math.floor(vecN[1]*k*1000)/1000)*-1);
    	}}
      
    else{
    	xf = p11[0];
      yf = p11[1];
    }
    
    svg.selectAll(".kLine")
    .data(v2)
    .transition()
    .delay(50)
    .duration(duration)
  	.attr("x1", function(d) {
      return x(p11[0]);
    })
  	.attr("y1", function(d) {
      return y(p11[1]);
    })
  	.attr("x2", function(d) {
      return x(xf);
    })
  	.attr("y2", function(d) {
      return y(yf);
    })
  }) 
	})
}
  
function play(i){

			if(stoped == 1){
  			goon = 1;
  			stoped = 0;
  		}

			updateDots(i);

			if (i < 170) {
      window.setTimeout(function() {
      if(goon == 1){play(i + 1);
      }
      else{
      stoped = 1;
      }
      }, duration);}
}

function pause(){
	goon = 0;
}

function updateDuration(duration){
	d3.select("#duration-value").text(duration);
  d3.select("#duration").property("value", duration);
}

function updateVectorSize(size){
	d3.select("#size-value").text(size);
  d3.select("#vectorSize").property("value", size);
  
}

function updateMoment(moment){
	d3.select("#moment-value").text(moment);
  d3.select("#moment").property("value", moment);
}

function selectPoint(i){
    
	if(i=='red'){
  	drawPoints(current, 'red')
    //drawVectors(current, 'a')
  }
  
  if(i=='blue'){
  	drawPoints(current, 'blue')
    //drawVectors(current, 'b')
  }
  
  if(i=='sblue'){
  	drawPoints(current, 'sblue')
    //drawVectors(current, 'c')
  }
  
  if(i=='purple'){
  	drawPoints(current, 'purple')
    //drawVectors(current, 'd')
  }
  
  if(i=='black'){
  	drawPoints(current, 'black')
    //drawVectors(current, 'e')
  }
  
  if(i=='orange'){
  	drawPoints(current, 'orange')
    //drawVectors(current, 'f')
  }
  
  if(i=='violet'){
  	drawPoints(current, 'violet')
    //drawVectors(current, 'g')
  }
  
  if(i=='yellow'){
  	drawPoints(current, 'yellow')
    //drawVectors(current, 'h')
  }
  
  if(i=='pink'){
  	drawPoints(current, 'pink')
    //drawVectors(current, 'i')
  }
  
  if(i=='lime'){
  	drawPoints(current, 'lime')
    //drawVectors(current, 'j')
  }
  
  if(i=='salmon'){
  	drawPoints(current, 'salmon')
    //drawVectors(current, 'k')
  }
}

function drawPath(i){
d3.csv(url(i+1), function(data2) {
  d3.csv(url(i), function(dataVector) {
  if(stoped == 1){
  			goon = 1;
  			stoped = 0;
  		}
  current = i;
  updateMoment(current);
  var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);
    
	var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);
    
    if(svg.selectAll(".redDot").size()>0){

		p1 = [data2[0].X, data2[0].Y]
    svg.selectAll(".redDot")
      .data(p1)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p1[0]);
      })
      .attr("cy", function(d) {
        return y(p1[1]);
      })
    
  	var v1 = [dataVector[0].X, dataVector[0].Y]
    var norma = modulo(p1[0],p1[1],v1[0],v1[1])
    if(norma>0){
    
    
    var redline = svg.selectAll(".myLines")
    .data(v1)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v1[0]);
    })
  	.attr("y1", function(d) {
      return y(v1[1]);
    })
  	.attr("x2", function(d) {
      return x(v1[0]);
    })
  	.attr("y2", function(d) {
      return y(v1[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "red")
    .attr("class", "aLinePath")
    
    redline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v1[0]);
    })
  	.attr("y1", function(d) {
      return y(v1[1]);
    })
  	.attr("x2", function(d) {
      return x(p1[0]);
    })
  	.attr("y2", function(d) {
      return y(p1[1]);
    })
    }}
    
    if(svg.selectAll(".blueDot").size()>0){
    
    p2 = [data2[1].X, data2[1].Y]
    svg.selectAll(".blueDot")
      .data(p2)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p2[0]);
      })
      .attr("cy", function(d) {
        return y(p2[1]);
      })
    
  	var v2 = [dataVector[1].X, dataVector[1].Y]
    var norma = modulo(p2[0],p2[1],v2[0],v2[1])
    
    if(norma>0){
    var blueline = svg.selectAll(".myLines")
    .data(v2)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v2[0]);
    })
  	.attr("y1", function(d) {
      return y(v2[1]);
    })
  	.attr("x2", function(d) {
      return x(v2[0]);
    })
  	.attr("y2", function(d) {
      return y(v2[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "blue")
    .attr("class", "bLinePath")
    
    blueline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v2[0]);
    })
  	.attr("y1", function(d) {
      return y(v2[1]);
    })
  	.attr("x2", function(d) {
      return x(p2[0]);
    })
  	.attr("y2", function(d) {
      return y(p2[1]);
    })
    }}
    
    if(svg.selectAll(".sblueDot").size()>0){
    
    p3 = [data2[2].X, data2[2].Y]
    svg.selectAll(".sblueDot")
      .data(p3)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p3[0]);
      })
      .attr("cy", function(d) {
        return y(p3[1]);
      })
    
  	var v3 = [dataVector[2].X, dataVector[2].Y]
    var norma = modulo(p3[0],p3[1],v3[0],v3[1])
    
    if(norma>0){
    var sblueline = svg.selectAll(".myLines")
    .data(v3)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v3[0]);
    })
  	.attr("y1", function(d) {
      return y(v3[1]);
    })
  	.attr("x2", function(d) {
      return x(v3[0]);
    })
  	.attr("y2", function(d) {
      return y(v3[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "steelblue")
    .attr("class", "cLinePath")
    
    sblueline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v3[0]);
    })
  	.attr("y1", function(d) {
      return y(v3[1]);
    })
  	.attr("x2", function(d) {
      return x(p3[0]);
    })
  	.attr("y2", function(d) {
      return y(p3[1]);
    })
    }}
    
    if(svg.selectAll(".purpleDot").size()>0){
    
    p4 = [data2[3].X, data2[3].Y]
    svg.selectAll(".purpleDot")
      .data(p4)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p4[0]);
      })
      .attr("cy", function(d) {
        return y(p4[1]);
      })
    
  	var v4 = [dataVector[3].X, dataVector[3].Y]
    var norma = modulo(p4[0],p4[1],v4[0],v4[1])
    
    if(norma>0){
    var purpleline = svg.selectAll(".myLines")
    .data(v4)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v4[0]);
    })
  	.attr("y1", function(d) {
      return y(v4[1]);
    })
  	.attr("x2", function(d) {
      return x(v4[0]);
    })
  	.attr("y2", function(d) {
      return y(v4[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "purple")
    .attr("class", "dLinePath")
    
    purpleline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v4[0]);
    })
  	.attr("y1", function(d) {
      return y(v4[1]);
    })
  	.attr("x2", function(d) {
      return x(p4[0]);
    })
  	.attr("y2", function(d) {
      return y(p4[1]);
    })
    }}
    
    if(svg.selectAll(".blackDot").size()>0){
    
    p5 = [data2[4].X, data2[4].Y]
    svg.selectAll(".blackDot")
      .data(p5)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p5[0]);
      })
      .attr("cy", function(d) {
        return y(p5[1]);
      })
    
  	var v5 = [dataVector[4].X, dataVector[4].Y]
    var norma = modulo(p5[0],p5[1],v5[0],v5[1])
    
    if(norma>0){
    var blackline = svg.selectAll(".myLines")
    .data(v5)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v5[0]);
    })
  	.attr("y1", function(d) {
      return y(v5[1]);
    })
  	.attr("x2", function(d) {
      return x(v5[0]);
    })
  	.attr("y2", function(d) {
      return y(v5[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "black")
    .attr("class", "dLinePath")
    
    blackline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v5[0]);
    })
  	.attr("y1", function(d) {
      return y(v5[1]);
    })
  	.attr("x2", function(d) {
      return x(p5[0]);
    })
  	.attr("y2", function(d) {
      return y(p5[1]);
    })
    }}
    
    if(svg.selectAll(".orangeDot").size()>0){
    
    p6 = [data2[5].X, data2[5].Y]
    svg.selectAll(".orangeDot")
      .data(p6)
      .transition()
      .delay(50)
      .duration(duration)
      .attr("cx", function(d) {
       return x(p6[0]);
      })
      .attr("cy", function(d) {
        return y(p6[1]);
      })
    
  	var v6 = [dataVector[5].X, dataVector[5].Y]
    var norma = modulo(p6[0],p6[1],v6[0],v6[1])
    
    if(norma>0){
    var orangeline = svg.selectAll(".myLines")
    .data(v6)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v6[0]);
    })
  	.attr("y1", function(d) {
      return y(v6[1]);
    })
  	.attr("x2", function(d) {
      return x(v6[0]);
    })
  	.attr("y2", function(d) {
      return y(v6[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", "orange")
    .attr("class", "dLinePath")
    
    orangeline.transition()
    .delay(50)
    .duration(duration)
    .attr("x1", function(d) {
      return x(v6[0]);
    })
  	.attr("y1", function(d) {
      return y(v6[1]);
    })
  	.attr("x2", function(d) {
      return x(p6[0]);
    })
  	.attr("y2", function(d) {
      return y(p6[1]);
    })
    }}
    
    if (i < 170) {
      window.setTimeout(function() {
      if(goon == 1){drawPath(i+1);
      }
      else{
      stoped = 1;
      }
      }, duration);}
 })
 })
}

function fullPathSelection(){
		
    if(svg.selectAll(".redDot").size()>0){
    		drawFullPath(1, 'red', 'red', 'a', 1)
    }
    
    if(svg.selectAll(".blueDot").size()>0){
    		drawFullPath(1, 'blue', 'blue', 'b', 2)
    }
    
    if(svg.selectAll(".sblueDot").size()>0){
    		drawFullPath(1, 'sblue', 'steelblue', 'c', 3)
    }
    
    if(svg.selectAll(".purpleDot").size()>0){
    		drawFullPath(1, 'purple', 'purple', 'd', 4)
    }
    
    if(svg.selectAll(".blackDot").size()>0){
    		drawFullPath(1, 'black', 'black', 'e', 5)
    }
    
    if(svg.selectAll(".orangeDot").size()>0){
    		drawFullPath(1, 'orange', 'orange', 'f', 6)
    }
    
    if(svg.selectAll(".violetDot").size()>0){
    		drawFullPath(1, 'violet', 'violet', 'g', 7)
    }
    
    if(svg.selectAll(".yellowDot").size()>0){
    		drawFullPath(1, 'yellow', 'yellow', 'h', 8)
    }
    
    if(svg.selectAll(".pinkDot").size()>0){
    		drawFullPath(1, 'pink', 'pink', 'i', 9)
    }
    
    if(svg.selectAll(".limeDot").size()>0){
    		drawFullPath(1, 'lime', '#AFFF33', 'j', 10)
    }
    
    if(svg.selectAll(".salmonDot").size()>0){
    		drawFullPath(1, 'salmon', '#FF5233', 'k', 11)
    }
}

function drawFullPath(i, color, colortag, line, p){

	var x = d3.scaleLinear()
    .domain([0, 105])
    .range([0, width]);
    
	var y = d3.scaleLinear()
    .domain([0, 68])
    .range([height, 0]);
    
    if(i<170){

		d3.csv(url(i+1), function(data2) {
  	d3.csv(url(i), function(dataVector) {
    
    var p1 = [data2[p-1].X, data2[p-1].Y]
  	var v1 = [dataVector[p-1].X, dataVector[p-1].Y]
    var norma = modulo(p1[0],p1[1],v1[0],v1[1])
    if(norma>0){
    svg.selectAll(".myLines")
    .data(v1)
    .enter()
    .append("line")
  	.attr("x1", function(d) {
      return x(v1[0]);
    })
  	.attr("y1", function(d) {
      return y(v1[1]);
    })
  	.attr("x2", function(d) {
      return x(p1[0]);
    })
  	.attr("y2", function(d) {
      return y(p1[1]);
    })
  	.attr("stroke-width", 2)
  	.attr("stroke", colortag)
    .attr("class", line+"LinePath")
    }
    })
    })
    
    drawFullPath(i+1, color, colortag, line, p)
    }
    
    else{
    	d3.csv(url(i), function(data2) {
      	var p1 = [data2[p-1].X, data2[p-1].Y]
  			svg.selectAll("mycircles")
  			.data(p1)
  			.enter()
  			.append("circle")
  			.attr("cx", function(d) {
  			  return x(p1[0]);
  			})
  			.attr("cy", function(d) {
  			  return y(p1[1]);
  			})
  			.attr("r", 6)
  			.style("fill", colortag)
  			.attr("class", color+"Dot")
      })
    }
}
</script>
 
</body>
</html>