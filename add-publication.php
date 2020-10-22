<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$file 			= $_FILES['attachment']['name'];
		$file_loc 		= $_FILES['attachment']['tmp_name'];
		$folder			= "attachment-document/";
		$new_file_name  = strtolower($file);
		$final_file		= str_replace(' ', '-', $new_file_name);

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

		$user			= $_SESSION['alogin'];
		$reciver		= 'Admin';
		$notitype		= 'Send Feedback';
		$attachment		= ' ';

		if (move_uploaded_file($file_loc, $folder . $final_file)) {
			$attachment = $final_file;
		}
		$notireciver = 'Admin';
		$sqlnoti	 = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
		$querynoti = $dbh->prepare($sqlnoti);
		$querynoti->bindParam(':notiuser', $user, PDO::PARAM_STR);
		$querynoti->bindParam(':notireciver', $notireciver, PDO::PARAM_STR);
		$querynoti->bindParam(':notitype', $notitype, PDO::PARAM_STR);
		$querynoti->execute();

		$sql = "insert into author_details 

	(first_author, co_author, national_type, title, journal_name,  date_published, year_published, issn, volume, page, impact, citation, description, status, attachment ) values 
	(:firstAuthor, :coAuthor, :nationalType, :title, :journalName, :datePublished, :yearPublished, :issnNo, :volume, :page, :impact, :citation, :description, :status, :attachment)";

		$query = $dbh->prepare($sql);
		// $query-> bindParam(':user', $user, PDO::PARAM_STR);
		// $query-> bindParam(':reciver', $reciver, PDO::PARAM_STR);

		$query->bindParam(':firstAuthor', $firstAuthor, PDO::PARAM_STR);
		$query->bindParam(':coAuthor', $coAuthor, PDO::PARAM_STR);
		$query->bindParam(':nationalType', $nationalType, PDO::PARAM_STR);
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
		$query->bindParam(':attachment', $attachment, PDO::PARAM_STR);
		$query->execute();
		$msg = "Feedback Send";
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

		<title>Add Journals</title>

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

		<!-- <script type= "text/javascript" src="../vendor/countries.js"></script> -->
		<title>Bootstrap - year picker only example</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #dd3d36;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #5cb85c;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>


	</head>

	<body>
		<?php
		$sql = "SELECT * from users;";
		$query = $dbh->prepare($sql);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		$cnt = 1;
		?>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="row">

								<div class="col-md-12">
									<h2>Publishing Details</h2>
									<div class="panel panel-default">
										<div class="panel-heading">Add Info</div>

										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<!-- <div class="form-group"> -->
												<input type="hidden" name="user" value="<?php echo htmlentities($result->email); ?>">
												<!-- <div class="row">		 -->

												<!-- <div class="form-group">
												<label class="col-sm-2 control-label">Author Name<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="firstAuthor" class="form-control" required value="<?php echo htmlentities($result->first_author); ?>">
												</div>
												
												<label class="col-sm-2 control-label">Co Author<span style="color:red">*</span></label>
												<div class="col-sm-4">
													<input type="text" name="coAuthor" class="form-control" required value="<?php echo htmlentities($result->co_author); ?>">
												</div>
											</div> -->


												<div class="form-group">
													<label class="col-md-2 label-control" for="hours">Author Name<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="firstAuthor" class="form-control" required>
													</div>

													<label class="col-md-2 label-control">Co-Author<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="coAuthor" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 label-control">Nationalty<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="nationalType" class="form-control" required>
													</div>
													<label class="col-md-2 label-control">Title <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="title" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 label-control">Journal Name<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="journalName" class="form-control" required>
													</div>
													<label class="col-md-2 label-control">Date of Pulication<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="date" name="datePublished" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 label-control">Year of Publication<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input class="date-own form-control" type="text" placeholder="click to show datepicker" id="yearPublished" name="yearPublished" required>
														<!-- <input type="text" name="yearPublished" class="form-control" required> -->
													</div>
													<label class="col-md-2 label-control">ISSN No. <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="issnNo" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 label-control">Volume <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="volume" class="form-control" required>
													</div>
													<label class="col-md-2 label-control">Page <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="page" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 label-control">Impact Factor<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="impact" class="form-control" required>
													</div>
													<label class="col-md-2 label-control">Citation Index<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="citation" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 label-control">Description<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<textarea class="form-control" rows="2" name="description"></textarea>
													</div>

													<label class="col-md-2 label-control">Status <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select name="status" class="form-control" required>
															<option value="">Select</option>
															<option value="active">Active</option>
															<option value="inactive">Inactive</option>
														</select>
													</div>
												</div>

												<div class="form-group">
													<label class="col-md-2 control-label">Attachment<span style="color:red"></span></label>
													<div class="col-sm-4">
														<input type="file" name="attachment" class="form-control">
													</div>
												</div>
												<hr>
												<div class="form-group text-center">
													<button class="btn btn-primary" name="submit" type="submit">Save </button>
													<a class="btn btn-default" href="authorlist.php">Back to Journals</a>
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
			$(document).ready(function() {

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