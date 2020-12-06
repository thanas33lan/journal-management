<?php
error_reporting(0);
include('includes/config.php');

require('fpdf/fpdf.php');
$pdf = new FPDF();

if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_GET['del']) && isset($_GET['name'])) {
		$id = $_GET['del'];
		$name = $_GET['name'];

		$sql   = "delete from users WHERE id=:id";
		$query = $dbh->prepare($sql);
		$query->bindParam(':id', $id, PDO::PARAM_STR);
		$query->execute();

		$sql2 = "insert into deleteduser (email) values (:name)";
		$query2 = $dbh->prepare($sql2);
		$query2->bindParam(':name', $name, PDO::PARAM_STR);
		$query2->execute();

		$msg = "Data Deleted successfully";
	}

	if (isset($_REQUEST['unconfirm'])) {
		$aeid = intval($_GET['unconfirm']);
		$memstatus = 1;
		$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $memstatus, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Changes Sucessfully";
	}

	if (isset($_REQUEST['confirm'])) {
		$aeid = intval($_GET['confirm']);
		$memstatus = 0;
		$sql = "UPDATE users SET status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $memstatus, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();
		$msg = "Changes Sucessfully";
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

		<title>Manage Journals</title>

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

			/* body{width:610px;} */
			.frmSearch {
				border: 1px solid #a8d4b1;
				background-color: #c6f7d0;
				margin: 2px 0px;
				padding: 25px;
				border-radius: 4px;
			}

			#autocomplete-list {
				float: left;
				list-style: none;
				margin-top: -3px;
				padding: 0;
				width: 190px;
				position: absolute;
			}

			#autocomplete-list li {
				padding: 10px;
				background: #f0f0f0;
				border-bottom: #bbb9b9 1px solid;
			}

			#autocomplete-list li:hover {
				background: #ece3d2;
				cursor: pointer;
			}

			#search-box {
				padding: 10px;
				border: #a8d4b1 1px solid;
				border-radius: 4px;
			}
		</style>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Manage Journals</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">List of Published Journal Editions by Authors</div>
								<div class="panel-body">

									<?php if ($error) { ?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>

									<div st1yle=" text-align: right; " class="frmSearch">
										<input type="text" id="search-box" placeholder="Book Name" />
										<div id="suggesstion-box"></div>
									</div>
									<br>
									<br>
									<br>
									<br>

									<table id="zctb" class="display table   table-striped table-bordered table-responsive" cellspacing="0" width="100%">

										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Email</th>
												<th>Gender</th>
												<th>Author</th>
												<th>Title</th>
												<th>Book Name</th>
												<th>Year</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>

										<tbody>


											<?php

											if (isset($_POST['keyword1'])) {
												$keyword1 =  $_POST['keyword1'];
												$sql   		  = 'SELECT author_details.author_id,author_details.first_author,author_details.title,author_details.journal_name,author_details.year_published,author_details.status, author_details.created_by, users.id,users.name, users.email, users.gender from author_details LEFT JOIN users ON author_details.created_by = users.id where author_details.journal_name LIKE  :keyword1';
												$keywordvalue = "%" . $keyword1 . "%";
												$query  	  = $dbh->prepare($sql);
												$query->bindParam(':keyword1', $keywordvalue, PDO::PARAM_STR);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
											} else {
												$sql = 'SELECT author_details.author_id,author_details.first_author,author_details.title,author_details.journal_name,author_details.year_published,author_details.status, author_details.created_by, users.id,users.name, users.email, users.gender from author_details LEFT JOIN users ON author_details.created_by = users.id';
												$query = $dbh->prepare($sql);
												$query->execute();
												$results = $query->fetchAll(PDO::FETCH_OBJ);
											}
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {
											?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo ucwords(htmlentities($result->name)); ?></td>
														<td><?php echo ucwords(htmlentities($result->email)); ?></td>
														<td><?php echo ucwords(htmlentities($result->gender)); ?></td>
														<td><?php echo ucwords(htmlentities($result->first_author)); ?></td>
														<td><?php echo ucwords(htmlentities($result->title)); ?></td>
														<td><?php echo ucwords(htmlentities($result->journal_name)); ?></td>
														<td><?php echo htmlentities($result->year_published); ?></td>
														<td><?php echo ucwords(htmlentities($result->status)); ?>
														</td>

														<td>
															<a href="view-journal-list.php?view=<?php echo $result->author_id; ?>"><i class="fa fa-eye" style="color:grey"></i></a>&nbsp;&nbsp;

															<!-- <a href="edit-user.php?edit=< ?php echo $result->author_id;?>" onclick="return confirm('Do you want to Edit');">&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
												<a href="userlist.php?del=< ?php echo $result->author_id;?>&name=< ?php echo htmlentities($result->email);?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp; -->
															<!-- <a href="pdf.php?pdf=< ?php echo $result->author_id;?>" onclick="return confirm('Do you want to print');">&nbsp; <i class="fa-file"></i></a>&nbsp;&nbsp; -->

														</td>
													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>
											<!-- <div id="countryList"></div>  -->
										</tbody>
									</table>
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

		<script type="text/javascript">
			$(document).ready(function() {

				$("#search-box").keyup(function() {
					$.ajax({
						type: "POST",
						url: "readAutoComplete.php",
						data: 'keyword=' + $(this).val(),
						beforeSend: function() {
							$("#search-box").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
						},
						success: function(data) {
							$("#suggesstion-box").show();
							$("#suggesstion-box").html(data);
							$("#search-box").css("background", "#FFF");
						}
					});
				});


				setTimeout(function() {
					$('.succWrap').slideUp("slow");
				}, 3000);

			});

			function selectAutoSearch(val) {
				$.ajax({
					type: "POST",
					data: 'keyword1=' + val,

				});

				$("#search-box").val(val);
				$("#suggesstion-box").hide();
			}
		</script>

	</body>

	</html>
<?php } ?>