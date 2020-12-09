<?php
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{

if(isset($_GET['edit']))
	{
		$editid=$_GET['edit'];
	}
	
if(isset($_POST['submit']))
  {
	$file 			= $_FILES['attachment']['name'];
	$file_loc 		= $_FILES['attachment']['tmp_name'];
	$folder			= "attachment-document/";
	$new_file_name  = strtolower($file);
	$final_file		= str_replace(' ','-',$new_file_name);
	$idedit			= $_POST['idedit'];

	
	$firstAuthor	= $_POST['firstAuthor'];
	$coAuthor		= $_POST['coAuthor1'];
	$journalType	= $_POST['journalType'];
	$title			= $_POST['title'];
	$journalName    = $_POST['journalName'];
	$datePublished	= $_POST['monthPublished'];
	$yearPublished	= $_POST['yearPublished'];
	$issnNo			= $_POST['issnNo'];
	$volume			= $_POST['volume'];
	$page			= $_POST['page'];
	$impact			= $_POST['impact'];
	$citation		= $_POST['citation'];
	$description	= $_POST['description'];
	$status			= $_POST['status'];
	$createdBy   	= $_SESSION['id'];

	$attachment			= $_POST['attachment'];


	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		$attachment=$final_file;

	}

	$sql="UPDATE author_details SET first_author=(:firstAuthor), co_author=(:coAuthor), co_author2=(:coAuthor2), co_author3=(:coAuthor3), co_author4=(:coAuthor4), journal_type=(:journalType), title=(:title),  journal_name=(:journalName),  date_published=(:datePublished), year_published=(:yearPublished), issn=(:issnNo), volume=(:volume), page=(:page), impact=(:impact), citation=(:citation), description=(:description), status=(:status), created_by=(:createdBy) WHERE author_id=(:idedit)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':firstAuthor', $firstAuthor, PDO::PARAM_STR);
	$query->bindParam(':coAuthor', $_POST['coAuthor1'], PDO::PARAM_STR);
	$query->bindParam(':coAuthor2', $_POST['coAuthor2'], PDO::PARAM_STR);
	$query->bindParam(':coAuthor3', $_POST['coAuthor3'], PDO::PARAM_STR);
	$query->bindParam(':coAuthor4', $_POST['coAuthor4'], PDO::PARAM_STR);
	$query->bindParam(':journalType', $journalType, PDO::PARAM_STR);
	$query->bindParam(':title', $title, PDO::PARAM_STR);
	$query->bindParam(':journalName', $journalName, PDO::PARAM_STR);
	$query->bindParam(':datePublished', $datePublished, PDO::PARAM_STR);
	$query->bindParam(':yearPublished', $yearPublished, PDO::PARAM_STR);
	$query->bindParam(':issnNo', $issnNo, PDO::PARAM_STR);
	$query->bindParam(':volume', $volume, PDO::PARAM_STR);
	$query->bindParam(':page', $page, PDO::PARAM_STR);
	$query->bindParam(':impact', $impact, PDO::PARAM_STR);
	$query->bindParam(':citation', $citation, PDO::PARAM_STR);
	$query->bindParam(':description', $description, PDO::PARAM_STR);
	$query->bindParam(':status', $status, PDO::PARAM_STR);
	$query->bindParam(':createdBy', $createdBy, PDO::PARAM_STR);
	$query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
	if($query->execute()){
		$msg="Information Updated Successfully";
	} else {
		$error = "Something went wrong please try again";
	}
}    
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Edit Journals</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">

	<title>Bootstrap - year picker only example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  


	<script type= "text/javascript" src="../vendor/countries.js"></script>
	<style>
.errorWrap {
	padding: 10px;
	margin: 0 0 20px 0;
	background: #dd3d36;
	color:#fff;
	-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
	padding: 10px;
	margin: 0 0 20px 0;
	background: #5cb85c;
	color:#fff;
	-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
	box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
<?php
		$sql = "SELECT * from author_details where author_id = :editid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':editid',$editid,PDO::PARAM_INT);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		// echo $result;die;
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Edit Publications for <b><?php echo htmlentities($result->title); ?></b></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
																	
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
												else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
										
											<div class="form-group">
												<label class="col-md-2 label-control" for="firstAuthor">Author Name<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->first_author); ?>" name="firstAuthor" placeholder="Enter the author name" class="form-control" required>
												</div>
												<label class="col-md-2 label-control" for="volume">Volume</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->volume); ?>" name="volume" id="volume" class="form-control" placeholder="Enter the volume">
												</div>

											</div>
											<div class="form-group">
												<label class="col-md-2 label-control" for="coAuthor1">Co-Author 1</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->co_author); ?>" name="coAuthor1" id="coAuthor1" placeholder="Enter co-author 1 name" class="form-control">
												</div>
												<label class="col-md-2 label-control" for="pages">Pages<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->page); ?>" name="pages" id="pages" placeholder="Enter pages" class="form-control" required>
												</div>
												
											</div>

											<div class="form-group">
												<label class="col-md-2 label-control" for="coAuthor2">Co-Author 2</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->co_author2); ?>" name="coAuthor2" id="coAuthor2" placeholder="Enter co-author 2 name" class="form-control">
												</div>
												<label class="col-md-2 label-control" for="issnNo">ISSN No</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->issn); ?>" name="issnNo" id="issnNo" class="form-control">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 label-control" for="coAuthor3">Co-Author 3</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->co_author3); ?>" name="coAuthor3" id="coAuthor3" placeholder="Enter co-author 3 name" class="form-control">
												</div>
												<label class="col-md-2 label-control" for="yearPublished">Year of Publication<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input class="date-year form-control" type="text" value="<?php echo htmlentities($result->year_published); ?>" placeholder="click to show year picker" id="yearPublished" name="yearPublished" required>
												</div>
												
											</div>
											<div class="form-group">
												<label class="col-md-2 label-control" for="coAuthor4">Co-Author 4</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->co_author4); ?>" name="coAuthor4" id="coAuthor4" placeholder="Enter co-author 4 name" class="form-control">
												</div>
												<label class="col-md-2 label-control" for="monthPublished">Month of Publication<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input class="date-month form-control" type="text" value="<?php echo htmlentities($result->date_published); ?>" placeholder="click to show month picker" id="monthPublished" name="monthPublished" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 label-control" for="journalType">Journal Type</label>
												<div class="col-sm-4">
													<select name="journalType" id="journalType" class="form-control" title="Please select the journal type">
														<option value="">--Select--</option>
														<option value="national" <?php echo (isset($result->journal_type) && htmlentities($result->journal_type) == 'national')?"selected='selected'" : "";?>>National</option>
														<option value="international" <?php echo (isset($result->journal_type) && htmlentities($result->journal_type) == 'international')?"selected='selected'" : "";?>>International</option>
														<option value="conference" <?php echo (isset($result->journal_type) && htmlentities($result->journal_type) == 'conference')?"selected='selected'" : "";?>>Conference</option>
													</select>
												</div>
												<label class="col-md-2 label-control" for="citation">Citation Index</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->citation); ?>" placeholder="Enter the citation index" name="citation" id="citation" class="form-control" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 label-control" for="journalName">Journal Name</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->journal_name); ?>" placeholder="Enter the journal name" name="journalName" id="journalName" class="form-control" required>
												</div>
												<label class="col-md-2 label-control" for="status">Status</label>
												<div class="col-sm-4">
													<select name="status" id="status" class="form-control" title="Please select the status">
														<option value="">--Select--</option>
														<option value="active" <?php echo (isset($result->status) && htmlentities($result->status) == 'active')?"selected='selected'" : "";?>>Active</option>
														<option value="inactive" <?php echo (isset($result->status) && htmlentities($result->status) == 'inactive')?"selected='selected'" : "";?>>Inactive</option>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 label-control" for="title">Research topic <span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->title); ?>" placeholder="Enter the title of the book" name="title" id="title" class="form-control" required>
												</div>
												<label class="col-md-2 label-control" for="description">Description</label>
												<div class="col-sm-4">
													<textarea class="form-control" placeholder="Enter the description" id="description" name="description"><?php echo htmlentities($result->description); ?></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-2 label-control" for="impact">Impact Factor</label>
												<div class="col-sm-4">
													<input type="text" value="<?php echo htmlentities($result->impact); ?>" placeholder="Enter the Impact factor" name="impact" id="impact" class="form-control">
												</div>
												<label class="col-md-2 label-control" for="attachment">Attachment</label>
												<div class="col-sm-4">
													<input type="file" name="attachment" id="attachment" class="form-control" title="Please upload the document">
												</div>
											</div>
											<hr>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
												</div>
											</div>

											</form>
									</div>
								</div>
							</div>
						</div>
						
					

					</div>
				</div>
				
			

			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


	<script type="text/javascript">
				 $(document).ready(function () {         
					$('.date-own').datepicker({
						minViewMode: 2,
						format: 'yyyy'
					});

					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>

</body>
</html>
<?php } ?>