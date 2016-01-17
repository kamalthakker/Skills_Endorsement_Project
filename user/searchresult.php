<?php
$page_title = "Search";
$linkno = 0;
include_once 'includes/header.php';
include_once 'classes/search.php';

$searchby = null;
$num_found_rows = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST' ) {

	if(isset($_POST['searchby'])) {
		$searchby=$_POST['searchby']; 
		
		$objSearch = new search();
		$dbRowsSearchResults = $objSearch->getSearchResults($searchby);

		$num_found_rows = $dbRowsSearchResults->num_rows;
		//echo '<br/><br/><br/><br/><br/><br/>'.$num_rows;
	}
}

?>



<!-- Begin page content -->
<div class="container-fluid">
	
<!-- search by: people, skills, projects -->	
<h2 class="page-header"><?php echo $num_found_rows;?> results for <strong><span class="text-success"><?php echo $searchby;?></span></strong></span></h2>

<div class="table-responsive">
	
  <table class="table table-condensed table-hover">
    <tbody>
	    
<?php 
while ( isset($dbRowsSearchResults) && $dbRow = mysqli_fetch_array($dbRowsSearchResults))
{
	//echo "--->".$dbRow['fname']."<br>";		
?>	    
	   <tr>
		 
		
		<td style="width:120px;">
	        <a href="index.php?search_user_id=<?php echo $dbRow['user_id']?>"> 
            <img src="../images/userdp/<?php echo $dbRow['userdp']?>" class="img-responsive voffset2" alt="img" width="100" height="100"> </a>
		</td>
        
	    <td>
		    
		    <h3>
	            
		            <span class="text-capitalize">
		            	<a href="index.php?search_user_id=<?php echo $dbRow['user_id']?>"> 
			            	<?php echo $dbRow['fname'] . ' ' . $dbRow['lname']; ?>
		            	</a>
		            </span>
		            
		            <br/>
		            <small>
			            <span class="text-capitalize">
			            	<?php echo $dbRow['job_title']; ?>
			            </span>	
		            </small>
	            
					<br/>
	             
		    </h3>
		    
		         <p>    
						 						
						Speciality: <?php echo $dbRow['speciality']; ?> <br/>
						2nd Speciality: <?php echo $dbRow['speciality2']; ?>
				</p>
			
	    </td>
         
	    </tr> 
	    
<?php } ?>	    
	    
    </tbody>
  </table>
</div>
	

	
</div>
<!-- End page content -->

<?php
include_once 'includes/footer.php';
?>