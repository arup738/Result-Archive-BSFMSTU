
	
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <link href="css/toastr.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/toastr.js"></script>
        <script src="js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="css/select.min.css" rel="stylesheet">
        <script src="js/select.min.js"></script>
        <title>Result Archive | Bangamata Sheikh Fojilatunnesa Mujib Science & Technology University</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- App favicon -->
        <link rel="shortcut icon" href="images/logo.png">
        <!-- Plugins css-->
        <link href="css/sweetalert.min.css" rel="stylesheet" type="text/css">
        <!-- App css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet">
        <link href="css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet">
		<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .my_div {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            font-size: 14px;
        }

        input, select {
            width: 100%;
			height: 45px;
            padding: 12px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input:focus, select:focus {
            border-color: #4CAF50;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
        }

        input[type="submit"], input[type="reset"] {
            width: 48%;
            padding: 12px 0;
            cursor: pointer;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
        }

        input[type="reset"] {
            background-color: #ccc;
            color: #333;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="reset"]:hover {
            background-color: #bbb;
        }
		
		 @media only screen and (max-width: 700px) {
  /* Mobile-specific styles go here */

  /* Change the content of h2 tag for mobile devices */
  .my_div {
            width: 350px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
}
    </style>
    </head>
    <body data-layout="horizontal" data-new-gr-c-s-check-loaded="14.1149.0" data-gr-ext-installed="">
        <!-- Begin page -->
		<header class="" style="background-color: #265077;height: 50px;    position: sticky;    top: 0;    z-index: 1000;">
			<div class="container-fluid" style="max-width: 100%;">
				<div class="row">
					<nav class="navbar navbar-expand-lg navbar-dark bg-custom" style="margin-top: -9px;">
						<a class="navbar-brand" href="http://bsfmstu.ac.bd/">
							 <img src="https://profile.bsfmstu.ac.bd/img/logo.png" width="40" height="40" alt="">
							 <span class="ml-2">Result Archive, BSFMSTU</span>


						</a>
        
					</nav>
				</div>
			</div>
		</header>
			
			
        <div id="wrapper" style=" margin-top: -12px;">

            <div class="ggcontent-page" data-select2-id="select2-data-11-2xcl">
                <div class="ggcontent" data-select2-id="select2-data-10-pyh3">
                    <!-- Start Content-->
                    <div class="ggcontainer-fluid" data-select2-id="select2-data-9-qbm6">
                        <div class="ddcol-12 " data-select2-id="select2-data-8-dz71">
							<div class="my_div">
								<h2 id="check_result_header">Search Result</h2>
								<form action="result.php" method="post">
									<label for="Reg_Number">Student ID No.</label>
									<input type="text" required="" name="student_id" placeholder="Enter your ID number"><br>
									
									<label for="Semester">Semester</label>
									<select id="department" name="current_semester">
										<option value="1">1st Year - 1st Semester</option>
										<option value="2">1st Year - 2nd Semester</option>
										<option value="3">2nd Year - 1st Semester</option>
										<option value="4">2nd Year - 2nd Semester</option>
										<option value="5">3rd Year - 1st Semester</option>
										<option value="6">3rd Year - 2nd Semester</option>
										<option value="7">4th Year - 1st Semester</option>
										<option value="8">4th Year - 2nd Semester</option>
									</select><br><br>

									<div class="button-container">
										<input type="submit" value="Search">
										<input type="reset" value="Reset">
									</div>
								</form>
							</div>
						
                            
                        </div>
                        <!-- end container-fluid -->
                    </div>
                    <!-- end content -->
                </div>
            </div>
            <!-- END wrapper -->
            <footer class="footer" style="position: fixed; background-color: #265077;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" style="color:white">
                            2024 © Result Archive | Developed and Maintaing By <a href="" style="color:#a7a6a6">Office of the controller of Examinations, BSFSTMU </a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
    </body>
</html>


