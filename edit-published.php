<?php
session_start();
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
	$coAuthor		= $_POST['coAuthor'];
	$nationalType	= $_POST['nationalType'];
	$title			= $_POST['title'];
	$journalName    = $_POST['journalName'];
	$datePublished	= $_POST['datePublished'];
	$yearPublished	= $_POST['yearPublished'];
	$issnNo			= $_POST['issnNo'];
	$volume			= $_POST['volume'];
	$page			= $_POST['page'];
	$impact			= $_POST['impact'];
	$citation		= $_POST['citation'];
	$description	= $_POST['description'];
	$status			= $_POST['status'];

	// $attachment			= $_POST['attachment'];


	if(move_uploaded_file($file_loc,$folder.$final_file))
	{
		// $attachment=$final_file;

	}

	$sql="UPDATE author_details SET first_author=(:firstAuthor), co_author=(:coAuthor), national_type=(:nationalType), title=(:title),  journal_name=(:journalName),  date_published=(:datePublished), year_published=(:yearPublished), issn=(:issnNo), volume=(:volume), page=(:page), impact=(:impact), citation=(:citation), description=(:description), status=(:status) WHERE author_id=(:idedit)";
	// $sql="UPDATE author_details SET first_author=(:firstAuthor), co_author=(:coAuthor), national_type=(:nationalType), title=(:title),  journal_name=(:journalName),  date_published=(:datePublished), year_published=(:yearPublished), issn=(:issnNo), volume=(:volume), page=(:page), impact=(:impact), citation=(:citation), description=(:description), status=(:status),  attachment=(:attachment) WHERE id=(:idedit)";
	// $sql="UPDATE users SET name=(:name), email=(:email), gender=(:gender), mobile=(:mobileno), designation=(:designation), Image=(:image) WHERE id=(:idedit)";
	$query = $dbh->prepare($sql);
	//   echo $idedit;die;

	$query-> bindParam(':firstAuthor', $firstAuthor, PDO::PARAM_STR);
	$query-> bindParam(':coAuthor', $coAuthor, PDO::PARAM_STR);
	$query-> bindParam(':nationalType', $nationalType, PDO::PARAM_STR);
	$query-> bindParam(':title', $title, PDO::PARAM_STR);
	$query-> bindParam(':journalName', $journalName, PDO::PARAM_STR);
	$query-> bindParam(':datePublished', $datePublished, PDO::PARAM_STR);
	$query-> bindParam(':yearPublished', $yearPublished, PDO::PARAM_STR);
	$query-> bindParam(':issnNo', $issnNo, PDO::PARAM_STR);
	$query-> bindParam(':volume', $volume, PDO::PARAM_STR);
	$query-> bindParam(':page', $page, PDO::PARAM_STR);
	$query-> bindParam(':impact', $impact, PDO::PARAM_STR);
	$query-> bindParam(':citation', $citation, PDO::PARAM_STR);
	$query-> bindParam(':description', $description, PDO::PARAM_STR);
	$query-> bindParam(':status', $status, PDO::PARAM_STR);
	// $query-> bindParam(':attachment', $attachment, PDO::PARAM_STR);
	$query-> bindParam(':idedit', $idedit, PDO::PARAM_STR);
	$query->execute();
	$msg="Information Updated Successfully";
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
						<h3 class="page-title">Edit Publications <?php echo htmlentities($result->name); ?></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
																	
								<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
												else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
										
											<div class="form-group">
												<label class="col-sm-2 control-label">Author Name<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="firstAuthor" class="form-control" required value="<?php echo htmlentities($result->first_author);?>">
												</div>
												
												<label class="col-sm-2 control-label">Co Author<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="coAuthor" class="form-control" required value="<?php echo htmlentities($result->co_author);?>">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Nationalty<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="nationalType" class="form-control" required value="<?php echo htmlentities($result->national_type);?>">
												</div>
												
												<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="title" class="form-control" required value="<?php echo htmlentities($result->title);?>">
												</div>
											</div>	
											<div class="form-group">
												<label class="col-sm-2 control-label">Journal Name<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="journalName" class="form-control" required value="<?php echo htmlentities($result->journal_name);?>">
												</div>
												
												<label class="col-sm-2 control-label">Date of Pulication<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="date" name="datePublished" class="form-control" required value="<?php echo htmlentities($result->date_published);?>">
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">Year of Publication<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="yearPublished" id="yearPublished"  class="date-own form-control" required value="<?php echo htmlentities($result->year_published);?>">
												</div>
												
												<label class="col-sm-2 control-label">ISSN No. <span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="issnNo" class="form-control" required value="<?php echo htmlentities($result->issn);?>">
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">Volume<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="volume" class="form-control" required value="<?php echo htmlentities($result->volume);?>">
												</div>
												
												<label class="col-sm-2 control-label">Page<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="page" class="form-control" required value="<?php echo htmlentities($result->page);?>">
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">Impact Factor<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="impact" class="form-control" required value="<?php echo htmlentities($result->impact);?>">
												</div>
												
												<label class="col-sm-2 control-label">Citation Index<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="citation" class="form-control" required value="<?php echo htmlentities($result->citation);?>">
												</div>
											</div>	

											<div class="form-group">
												<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<textarea class="form-control" rows="2" name="description"><?php echo htmlentities($result->description); ?></textarea>
													<!-- <input type="text" name="firstAuthor" class="form-control" required value="<?php echo htmlentities($result->first_author);?>"> -->
												</div>
												
												<label class="col-sm-2 control-label">Status<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<select name="status" class="form-control" required>
													<option value="">Select</option>
														<option value="active" <?php echo ($result->status == 'active' ? " selected='selected'" : ""); ?>>Active</option>
													<option value="inactive" <?php echo ($result->status == 'inactive' ? " selected='selected'" : ""); ?>>Inactive</option>
													<!-- <option value="active">Active</option>
													<option value="inactive">In Active</option> -->
													</select>
												</div>
											</div>

											<div class="form-group">
												<!-- <label class="col-sm-2 control-label">Attachement<span style="color:red">*</span></label> -->

												<div class="col-sm-8 col-sm-offset-2">
													<!-- <img src="../attachment-document/<?php echo htmlentities($result->attachment);?>" width="150px"/> -->
													<input type="hidden" name="attachment" value="<?php echo htmlentities($result->attachment);?>" >
													<input type="hidden" name="idedit" value="<?php echo htmlentities($result->author_id);?>" >
												</div>
											<!-- </div> -->
									</div>  

											<!-- </div>	 -->
											

											<!-- <div class="form-group">
											<label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<select name="gender" class="form-control" required>
													<option value="">Select</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													</select>
											</div>
											<label class="col-sm-2 control-label">Designation<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<input type="text" name="designation" class="form-control" required value="< ?php echo htmlentities($result->designation);?>">
											</div>
											</div>


											<div class="form-group">
											<label class="col-sm-2 control-label">Image<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<input type="file" name="image" class="form-control">
											</div>

											<label class="col-sm-2 control-label">Mobile No.<span style="color:red">*</span></label>
											<div class="col-sm-4">
											<input type="number" name="mobileno" class="form-control" required value="<?php echo htmlentities($result->mobile);?>">
											</div>
											</div>

											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<img src="../images/<?php echo htmlentities($result->image);?>" width="150px"/>
													<input type="hidden" name="image" value="<?php echo htmlentities($result->image);?>" >
													<input type="text" name="idedit" value="<?php echo htmlentities($result->author_id);?>" >
											</div>
											</div> -->


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