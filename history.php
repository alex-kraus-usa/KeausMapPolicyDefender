
<html>
<head>

<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="js/jquery-1-4-2.min.js"></script> 
 
<script type="text/javascript" src="js/jquery-ui.min.js"></script> 
<script type="text/javascript" src="js/showhide.js"></script> 
<script type="text/JavaScript" src="js/jquery.mousewheel.js"></script> 

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">



</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", 
	orientation: 'h', 
	classname: 'ddsmoothmenu', 
	
	contentsource: "markup"
})

</script> 

<link href="css/TBLCSS.css" rel="stylesheet" type="text/css" />
<link href="css/div.css" rel="stylesheet" type="text/css" />
<title>Violation History</title>
</head>

<body id="home" onload="tableSearch.init();">

<div id="templatemo_main">
<div id="divp">
<h3 align="center"	>History</h3>
<table align="center" >
<tr>
<td>
  
  <div align="right"><input  type="text" size="30" width="300" hight="40" maxlength="1000" value="" id="textBoxSearch" onkeyup="tableSearch.search(event);"  style="background-image:url(images/sr.png) no-repeat 4px 4px;
	
	border:2px solid #456879;
	border-radius:10px;
	height: 22px;
	width: 230px; "/> <a href="" onclick="tableSearch.runSearch();"><img src="images/sr.png" style="height:20; width:20;"></a>
     <a class="button_example"  href="export_history.php"> <img src="images/dn.png" width="20" height="20" /> </a>
               
</div>
	</td>
</tr>
<tr>
<td>
 
    <div class="GrayBlack">
  		<table align="center">
        	<tbody id="data">
 		<tr> 
 			 <td>
 		 <strong>Product</strong>
 		  </td>	
   
 		 <td>
  		<strong>SKU</strong>
 		  </td>
   <td>
 		 <strong>Seller</strong>
 		  </td>	
   
 		 <td>
  		<strong>Vendor Price</strong>
 		  </td>
           <td>
  		<strong>MAP Price</strong>
 		  </td>
            <td>
  		<strong>Violation Amt</strong>
 		  </td>
            <td>
  		<strong>Screenshot</strong>
 		  </td>
		</tr>
       


					
<?php
include('db.php');
       
$sql="select catalog_product_flat_1.sku,
catalog_product_flat_1.name as pname,
website.name as wname, 
crawl_results.vendor_price,
crawl_results.map_price,
crawl_results.violation_amount,
crawl_results.website_product_url,
crawl.date_executed
from website
inner join
prices.crawl_results
on prices.website.id = prices.crawl_results.website_id
inner join catalog_product_flat_1
on catalog_product_flat_1.entity_id=crawl_results.product_id
inner join
crawl 
on crawl.id=crawl_results.crawl_id
where crawl_results.violation_amount>0.05 
and
crawl.id = 
(select max(crawl.id) from crawl)
order by sku asc";
$result=mysql_query($sql);
      
  
        while($row = mysql_fetch_array($result)) 
       
	   { 
	        echo "<tr>";
            ?>
        	<td ><?php echo $row['pname']; ?></td>
            <td ><?php echo $row['sku']; ?></td>
     	 	<td ><?php echo $row['wname']; ?></td>
     	    <td ><?php echo $row['vendor_price']; ?></td>
			 <td ><?php echo $row['map_price']; ?></td>
     	 	<td ><?php echo $row['violation_amount']; ?></td>
     	  <td ><?php echo "<a target=".'_blank'." href =".$row['website_product_url']. ">"."Screenshot". "</a>" ?></td>
        <?php echo "</tr>";
            
	   }
		 echo "</table>";
      
     //  mysql_close($con); 
 ?>
 
</div>

</td>  
       
   
</tr>       
 </tbody></table> 
 </div>   
</div>

</body>
</html>