<?php
 
 include("balle.php");
 include("db.php");
 $flag=0;
 if(isset($_POST['submit']))
 {
 	$query="INSERT INTO attendence (student_name,roll_number) VALUES ('".mysqli_real_escape_string($link, $_POST['name'])."','".mysqli_real_escape_string($link, $_POST['roll'])."')";
 	if(mysqli_query($link,$query))
 	{
 		$flag=1;
 	}
 }
 ?>
 <div class="panel panel-default">
 	<?php if($flag){ ?>
 	<div class="alert alert-success">
 	<strong>SUCCESS! </strong>ATTENDENCE DATA SUCCESSFULLY INSERTED;
    </div>
    <?php } ?>
 	<h2>
 	<div class="panel-heading">
 	<a class="btn btn-success" href="add.php">ADD STUDENT</a>
 	<a class="btn btn-info pull-right" href="firstpage.php">BACK</a>
    </h2>
    </div>
    <div class="panel-body">
    <form action="" method="post">
    <div class="form-group">
    <label for="name">Student Name</label>
    <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
    <label for="roll">Roll Number</label>
    <input type="text" name="roll" id="roll" class="form-control" required>
    </div>
    <div class="form-group">
    <input type="submit" name="submit" class="btn btn-primary" required>
    </div>


</div>