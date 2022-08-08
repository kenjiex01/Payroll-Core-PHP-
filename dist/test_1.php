<!DOCTYPE html>
<html>
<head>
	<title></title>
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

<table class="table table-bordered table-striped table-vcenter js-dataTable-full">
	<thead>
		<tr>
			<td>Employee Name</td>
			<td>Date</td>
			<td>In</td>
			<td>Out</td>
			<td>In</td>
			<td>Out</td>
		</tr>
	</thead>
	<tbody id="bodyyy">
		
	</tbody>
</table>


<br><br>

<form id="time_form">
	<input type="text" name="employee_id" id="employee_id" placeholder="ID"><br>
	<input type="text" name="employee_name" id="employee_name" placeholder="Name"><br>
	<input type="text" name="date_in" id="date_in" placeholder="Date"><br>
	<input type="text" name="time_in" id="time_in" placeholder="Time"><br>
	<button>Submit</button>
</form>


</body>
<!-- Page JS Plugins -->
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
<script>
	$(document).ready(function(){
		$.ajax({         
          type: 'POST',                             
          url: './12.php',                  //the script to call to get data 
          success: function(res)         
          {
    	// alert(end_date);
            $("#bodyyy").html(res);       
          } 
    	});

    	$("#bodyyy").on("click",".edit_time", function(){
    		var time_id = $(this).attr("data-time_id");
    		alert(time_id);
    	});
	});

</script>
</html>