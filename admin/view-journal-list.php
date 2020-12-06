<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else
{

    if(isset($_GET['view']))
    {
        $viewid=$_GET['view'];
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
	
	<title>Edit User</title>

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
		$sql = "SELECT * from author_details where author_id = :viewid";
		$query = $dbh -> prepare($sql);
		$query->bindParam(':viewid',$viewid,PDO::PARAM_INT);
		$query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        


		$cnt=1;	
?>
	<?php include('includes/header.php');?>
    <div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">View Journals Publications : <?php echo htmlentities($result->name); ?></h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">View Info</div>
                                        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                    else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
                                            <div class="form-group">
                                                <label class="col-sm-2 ">Author Name</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->first_author));?>
                                                </div>
                                                <label class="col-sm-2 ">Co-Author Name</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->co_author));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Nationality</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->national_type));?>
                                                </div>
                                                <label class="col-sm-2 ">Title</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->title));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Journal Name</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords( htmlentities($result->journal_name));?>
                                                </div>
                                                <label class="col-sm-2 ">Date of Pulication</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->date_published));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Year of Publication</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords( htmlentities($result->year_published));?>
                                                </div>
                                                <label class="col-sm-2 ">ISSN No.</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->issn));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Volume</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->volume));?>
                                                </div>
                                                <label class="col-sm-2 ">Page</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords( htmlentities($result->page));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Impact Factor</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords( htmlentities($result->impact));?>
                                                </div>
                                                <label class="col-sm-2 ">Citation Index</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->citation));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 ">Description</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->description));?>
                                                </div>
                                                <label class="col-sm-2 ">Status</label>
                                                <div class="col-sm-4" >
                                                    <?php echo ucwords(htmlentities($result->status));?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">

                                                    <a href="dashboard.php">
                                                    <input  class="btn btn-primary" type="button" value=" Go Back " />
                                                    </a>
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
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>

</body>
</html>
<?php } ?>