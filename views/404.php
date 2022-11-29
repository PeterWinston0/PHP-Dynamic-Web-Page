<?php echo $_SERVER['REQUEST_URI']; ?> does not exist, sorry.<br>
<?php
if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
$refuri = parse_url($_SERVER['HTTP_REFERER']); // use the parse_url() function to create an array containing information about the domain
if($refuri['host'] == "localhost"){
echo "You should email me and tell me I have a dead link on this site.";
}
else{
echo "You should email someone over at " . $refuri['host'] . " and let them know they have a dead link to this site.";
}
}
else{
echo "If you got here from Angola, you took a wrong turn at Catumbela. And if you got here by typing randomly in the address bar, stop doing that. You're filling my error logs with unnecessary junk.";
}
?>

<?php 
session_start();
//$title = "Home Page";
require "../includes/layout/frontHeader.php";
?>

<style>
/* *{
    transition: all 0.6s;
}

html {
    height: 100%;
}

body{
    font-family: 'Lato', sans-serif;
    color: #888;
    margin: 0;
}

#main{
    display: table;
    width: 100%;
    height: 100vh;
    text-align: center;
}

.fof{
	  display: table-cell;
	  vertical-align: middle;
}

.fof h1{
	  font-size: 50px;
	  display: inline-block;
	  padding-right: 12px;
	  animation: type .5s alternate infinite;
}

@keyframes type{
	  from{box-shadow: inset -3px 0px 0px #888;}
	  to{box-shadow: inset -3px 0px 0px transparent;}
} */
</style>
<!-- <div id="main">
    	<div class="fof">
        		<h1>Error 404</h1>
    	</div>
</div> -->


<?php require "../includes/layout/frontFooter.php";?>