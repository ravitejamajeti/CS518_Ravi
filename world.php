
<!DOCTYPE html>
<meta charset="utf-8">
<title>ODU Hangouts</title>
<?php include 'header.php' ?>
<style>
body { 
  color: #666; 
  background: #f3f3f3; 
}
#map {
    position: relative;
    left: 230px;
  border:2px solid #000;
  width:965px;
  height:555px;
}
.country:hover{
  stroke: #fff;
  stroke-width: 1.5px;
}
.selected {
    fill: red;
}
.country {
  fill: #ccc;
  stroke: #fff;
  stroke-width: .5px;
  stroke-linejoin: round;
}

.hidden { 
  display: none; 
}
 
div.tooltip {
  color: #222; 
  background: #fff; 
  padding: .5em; 
  text-shadow: #f5f5f5 0 1px 0;
  border-radius: 2px; 
  box-shadow: 0px 0px 2px 0px #a6a6a6; 
  opacity: 0.9; 
  position: absolute;
}

.line {
  fill: none;
  stroke: steelblue;
  stroke-width: 1.5px;
}


</style>
<body>
<?php include 'config.php'; include 'db_connect.php'; include 'navbar.php'; ?>

<br>


<h3 style="position:relative; left:550px">Live Questions Visualization</h3>
<div id="map"></div>
<div id="countryy" style = "display : none">India</div>
<div id="CMCount" style = "display : none">0</div>




<div id="tagsname" style = "display : none">Computer Science</div>
<div class="wrapper">
    <div id="slider6"></div>
	<div id="year" style = "display : none">2015</div>
  </div>
 

<script src="js/d3.v3.min.js"></script>
<script src="js/queue.v1.js"></script>
<script src="js/topojson.js"></script>

	<!--<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.1/typeahead.bundle.min.js"></script>-->

<script>
	var prev;


drawMap()


function drawMap(){

var width  = 960,
    height = 550;

var color = d3.scale.category10();

var projection = d3.geo.mercator()
                .translate([480, 300])
                .scale(970);

var path = d3.geo.path()
    .projection(projection);

	d3.select("#worldmap").remove();
	//d3.select("#ID1").remove();
var svg = d3.select("#map").append("svg").attr("id", "worldmap")
    .attr("width", width)
    .attr("height", height);

var tooltip = d3.select("#map").append("div")
    .attr("class", "tooltip");
    tooltip.classed("hidden", true)
	
var dataset = [];

queue()
    .defer(d3.json, "data/world-110m.json")
    .defer(d3.tsv, "data/world-country-names.tsv")
    .await(ready);

function ready(error, world, names) {

  var countries = topojson.object(world, world.objects.countries).geometries,
      neighbors = topojson.neighbors(world, countries),
      i = -1,
      n = countries.length;

  countries.forEach(function(d) { 
    d.name = names.filter(function(n) { return d.id == n.id; })[0].name; 
  });

  



var country = svg.selectAll(".country").data(countries);

  country
   .enter()
    .insert("path")
    .attr("class", "country")    
      .attr("title", function(d,i) { return d.name; })
      .attr("d", path);
	  
	  //colorMap();
	  
	  function colorMap(cntry_pass) {
          
          
          
          country.transition().duration(1000).delay(function(d, i) {return i * 10;})
              .style("fill", 
                     function(d,i) {
              console.log(cntry_pass.length)
                for (k=0; k < cntry_pass.length; k++){
                    
                    if(d.name == cntry_pass[k].country)
                        return "#08306B";
                }
              });
          
          country.attr("onclick", 
                     function(d,i) {
              console.log(cntry_pass.length)
                for (k=0; k < cntry_pass.length; k++){
                    
                    if(d.name == cntry_pass[k].country) {
                        d3.select("#countryy").text(d.name)
                        return "open_win()";
                    }
                }
              });

//          function colorize() { 
//            
//            var filtered=["India","Russia","Canada"].filter(function(e){return this.indexOf(e)<0;},["India","Russia"]);
//              
//              console.log(filtered)
//
//
//            var m = cntry_pass.filter(function(cntry_pass) {  console.log("here"); return cntry_pass.name == obj.name; } )
//
//            //console.log(m)
//            if(filtered.length>0) {  return "#08306B" }
//
//            }
          
//          var split = [50, 100, 150, 200, 250, 300, 350, 400];
//          var colors = ["#F7FBFF","#DEEBF7","#C6DBEF","#9ECAE1","#6BAED6","#4292C6","#2171B5","#08519C","#08306B"];
//          
//          var color = d3.scale.threshold()
//              .domain(split)
//              .range(colors);
//          console.log(countries)
//          country.transition().duration(1000).delay(function(d, i) {return i * 10;}).style("fill", function(d,i) { console.log (d.name,cntry_pass.name); if(d.name == cntry_pass.name) return "#08306B"; });
//          
//          country.attr("onclick", function(d,i) { if(d.name == cntry_pass) return "open_win()"; });
          
//          function colorize(data) { 
//
//            var m = cntry_pass.filter(function(FiltData) { return cntry_pass == data.name; } )
//            
//            if(m.length>0) {  return color(m[0].value) }
//
//            }
          
//          d3.csv("bar-data.csv", function(error, data) {
//            data.forEach(function(d) {
//                d.value = +d.value;
//            });
//
//        var SelYear = d3.select("#year").text();
//        var SelMajor = d3.select("#tagsname").text();
//
//        var FiltData = data.filter(function(d, i) { if(d.date == SelYear && d.major == SelMajor) return d;})
//
//        var split = [50, 100, 150, 200, 250, 300, 350, 400];
//        var colors = ["#F7FBFF","#DEEBF7","#C6DBEF","#9ECAE1","#6BAED6","#4292C6","#2171B5","#08519C","#08306B"];
//
//          var color = d3.scale.threshold()
//              .domain(split)
//              .range(colors);
//
//        country.transition().duration(1000).delay(function(d, i) {return i * 10;}).style("fill", colorize);
//
//        function colorize(data) { 
//
//            var m = FiltData.filter(function(FiltData) { return FiltData.countryName == data.name; } )
//            
//            if(m.length>0) {  return color(m[0].value) }
//
//        }
//
//        });

    }
    
    country
      .on("mousemove", function(d,i) {
        var mouse = d3.mouse(svg.node()).map( function(d) { return parseInt(d); } );
		
		
        tooltip
          .classed("hidden", false)
          .attr("style", "left:"+(mouse[0]+25)+"px;top:"+mouse[1]+"px")
		  //.attr("style", "position: relative")
          .html(d.name)
      })
      .on("mouseout",  function(d,i) {
        tooltip.classed("hidden", true);
		d3.select("#CMCount").text("0");
      })
	  .on("click", function(d,i) {
	  

	  var Selcountry = d.name;
	  
	  d3.select("#countryy").text(Selcountry);
	  
	
			d3.select(prev).style("stroke", null).style("stroke-width", ".5px");
			current = this;
			console.log(this);
			d3.select(current).style("stroke","red").style("stroke-width", "2px");
			prev=current;
			console.log(prev);
        });

drawMap.colorMap = colorMap;

}
}// end of draw map
    
    function open_win(name) {
        var name = d3.select("#countryy").text()
        location.replace("live_question.php?cname="+name);
    }
 
//    function dummy(cntry_pass) {
//        drawMap.colorMap(cntry_pass)
//        var cntry = d3.select("#countryy").text()
//        setTimeout(function () {
//            dummy(cntry);
//        }, 3000);
//    }
//    
//    setTimeout(function () {
//        dummy("India");
//    }, 3000);
    
    
    function dummy(cntry_pass) {
        //console.log(cntry_pass)
        drawMap.colorMap(cntry_pass)
        
        setTimeout(function () {
            
            $.post('./live.php', {'answer': 1}, function(response){
            dummy(response);
        }, 'json');
            
            
        }, 3000);
    }
    
    var obj1 = new Array();
    
    setTimeout(function () {
        
        
        obj1.name = []
   
    
        $.post('./live.php', {'answer': 1}, function(response){
            dummy(response);
        }, 'json');
        
        
    }, 3000);
    
</script>

</body>