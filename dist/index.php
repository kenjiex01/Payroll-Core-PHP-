<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>Index | PAYROLL</title>

        <meta name="description" content="AppUI - Admin Dashboard Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" />
        <!-- End Stylesheets -->
</head>
<body>
<div class="row" style="margin-top: 5%;margin-left: 25%;">
	
<!-- Login card -->
    <div class="col-md-8">
        <div class="card">
            <h3 class="card-header h4">Choose Company</h3>
            <div class="card-block">
                <form action="functions/company_session.php" method="post">
                    <div class="form-group">
                        <select id="company_select" name="company_select" class="form-control">
                        	<?php 
                        	include('connection.php');

                        	$sql = "SELECT * from company";
                        	$result = $conn->query($sql);

                        	if($result->num_rows > 0){
                        		while($row = $result->fetch_assoc()){
                        			echo "<option value='".$row['company_name']."''>".$row['company_name']."</option>";
                        		}
                        	}
                        	else{
                        		echo "Erro fetching data...";
                        	}
                        	?>
                        </select>
                        <br>
                        <a style="margin-left: 37%;" data-toggle="modal" data-target="#modal-new_company">Add New Company</a>
                    </div>
                    <button type="submit" class="btn btn-app btn-block">Proceed</button>
                </form>
            </div>
            <!-- .card-block -->
        </div>
        <!-- .card -->
    </div>
<!-- .col-md-6 -->




<!-- =========================================== Modal =============================================-->
        <!--Start modals -->
        <!-- Pop Out Modal -->
        <div class="modal fade" id="modal-new_company" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="card-header bg-green bg-inverse">
                        <h4>Company Form</h4>
                        <ul class="card-actions">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    <form method="POST" action="functions/add_new_company.php">
                    <div class="card-block">
                    	<div class="form-group">
                    	<label>Compnay Name</label>
                       <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Enter Company Name ..." />
                    	<br>
                    	<input type="submit" class="form-control btn btn-app" name="submit_company" />
                    	</div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Pop Out Modal -->
        <!--End modals -->
<!-- =========================================== Modal =============================================-->

 </div>

</body>

<!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.placeholder.min.js"></script>
        <script src="assets/js/app.js"></script>
        <script src="assets/js/app-custom.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
        <script src="assets/js/plugins/dropzonejs/dropzone.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/base_tables_datatables.js"></script>




</html>