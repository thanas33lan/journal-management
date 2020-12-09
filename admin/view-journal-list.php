<?php
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
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: transparent;
            opacity: 1;
            border: none;
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
                                                    <input type="text" class="form-control" value="<?php echo ucwords(htmlentities($result->journal_type)); ?>">
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
                                                    <input type="text" class="form-control" value="<?php echo ucwords(htmlentities($result->status)); ?>">
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
                                                <?php if(isset($result->attachment) && $result->attachment != ""){ ?>
                                                <label class="col-md-2 label-control" for="attachment">Attachment</label>
                                                <div class="col-sm-4">
                                                    <a href="/attachment-document/<?php echo htmlentities($result->attachment);?>" target="_blank">Open Attachement</a>
                                                </div>
                                                <?php } ?>
											</div>
											<hr>

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
            $('input').prop("disabled", true);         
            $('select').prop("disabled", true);         
            $('textarea').prop("disabled", true);         
            setTimeout(function() {
                $('.succWrap').slideUp("slow");
            }, 3000);
        });
	</script>

</body>
</html>
<?php } ?>