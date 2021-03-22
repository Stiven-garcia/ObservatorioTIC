<?php
include 'presentacion/home/menu.php';
?>
<script type="text/javascript"> 
var url = 'https://newsapi.org/v2/everything?' + 
'q=ict&' + 
'language=es&'+ 
'sortBy=relevancy&' + 
'pageSize=20&' + 
'excludeDomains=ryukoku.ac.jp&' + 
'apiKey=ea0b79dd56af456ca84083f6fc66e269'; 
 
var req = new Request(url); 
function limitar_cadena(cadena,i){ 
	if(i==1){ 
    var indice = cadena.indexOf("["); 
	}else{ 
     if(i==2){ 
    	 var indice = cadena.indexOf("T"); 
     } 
	} 
     
    return cadena.substr(0,indice); 
} 
 
fetch(req) 
    .then(function(response) { 
    	response.json().then(data => { 
    		console.log(data.articles); 
  		   
    		 var codigo =''; 
    		for(var i=0; i<data.articles.length; i++){ 
    			  codigo += '<div class="column  is-narrow"><div class="animacion"><div class="card" style="width: 400px"><a href="'+data.articles[i].url+'" style="color:hsl(0, 0%, 21%)"><div class="card-image"><figure class="image is-4by3"><img src="'+data.articles[i].urlToImage+'" alt="Placeholder image"></figure></div><div class="card-content"><div class="media"><div class="media-content"><p class="title is-4">'+data.articles[i].title+'</p></div></div><div class="content">'+limitar_cadena(data.articles[i].content,1)+'<br><time datetime="2016-1-1">'+limitar_cadena(data.articles[i].publishedAt,2)+'</time></div></div></a></div></div></div>'; 
 
    	     } 
    		   
    		  document.getElementById('noticias').innerHTML=codigo; 
    		   
    		}) 
    }) 
</script> 
<div class="columns"> 
  <div class="column is-half is-offset-one-quarter"> 
<h1 class="title" style="text-align:center; margin-top: 20px"><?php echo utf8_encode("Noticias Más Relevantes")?></h1> 
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr> 
</div> 
</div>	 
<div id="noticias" class="columns is-mobile is-multiline is-centered" style="margin-top: 10px"> 
</div>
