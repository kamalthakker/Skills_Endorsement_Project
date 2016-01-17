<?php
$page_title = "Search";
$linkno = 0;
include_once 'includes/header.php';
//include_once 'classes/user.php';

$searchby = null;

if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if(isset($_POST['searchby'])) {
		$searchby=$_POST['searchby']; 
	}
}

?>



<!-- Begin page content -->
<div class="container-fluid">
	
<!-- search by: people, skills, projects -->	
<h2 class="page-header">?? results for <strong><span class="text-success"><?php echo $searchby;?></span></strong></span></h2>

<div class="table-responsive">
	
  <table class="table table-condensed table-hover">
    <tbody>
	   <tr>
		 
		
		<td style="width:120px;">
	        <a href="#"> 
            <img src="../images/userdp/kamal.jpg" class="img-responsive voffset2" alt="img" width="100" height="100"> </a>
		</td>
        
	    <td>
		    
		    <h3>
	            
		            <span class="text-capitalize">
		            	<a href="#"> Kamal Thakker</a>
		            </span>
		            
		            <br/>
		            <small>
		            	Group Leader
		            </small>
	            
					<br/>
	             
		    </h3>
		    
		         <p>    
						 						
						Speciality: aaaaaa <br/>
						2nd Speciality: bbbb
				</p>
			
	    </td>
         
	    </tr> 
	    
	    
	    
	    <tr>
		 
		
		<td style="width:120px;">
	        <a href="#"> 
            <img src="../images/userdp/kamal.jpg" class="img-responsive" alt="img" width="100" height="100"> </a>
		</td>
        
	    <td>
		    
		    <h3>
	            
		            <span class="text-capitalize">
		            	<a href="#"> Kamal Thakker</a>
		            </span>
		            
		            <br/>
		            <small>
		            	Group Leader
		            </small>
	            
					<br/>
	             
		    </h3>
		    
		         <p>    
						 						
						Speciality: aaaaaa <br/>
						2nd Speciality: bbbb
				</p>
			
	    </td>
         
	    </tr> 
    </tbody>
  </table>
</div>
	

	
</div>
<!-- End page content -->

<?php
include_once 'includes/footer.php';
?>