<?php
include("db.php");
include("balle.php");
$flag=0;
if(isset($_POST['submit']))
{
    foreach($_POST['attendence_status'] as $id=>$attendence_status)	
    {
    	$student_name=$_POST['student_name'][$id];
    	$roll_number=$_POST['roll_number'][$id];
    	$date=date("Y-m-d H:i:s");
    	$query="INSERT INTO attendence_records('student_name','roll_number','attendence_status','date') values ('$student_name','$roll_number','$attendence_status','$date')";
    	$result=mysqli_query($link,$query);
    	if($result)
    	{
    		$flag=1;
    	}
    }
}
?>

<div class="panel panel-default">
	<div class="panel panel-heading">
    <h2>
    <a class="btn btn-success" href="add.php">Add Student</a>
    <a class="btn btn-info pull-right" href="viewall.php">View All</a>
    </h2>
    <?php if($flag) { ?>
    <div class="alert alert-success">
    ATTENDENCE DATE INSERT SUCCESSFULLY
    </div>
    <?php } ?>
    <h3><div class="well text-center">DATE: <?php echo date("Y-m-d"); ?> </div></h3>
    <div class="panel panel-body">
    <form action="index.php" method="Post">
    <table class="table table-stripped">
    <th>SERIAL NUMBER</th><th>STUDENT NAME</th><th>ROLL NUMBER</th><th>ATTENDENCE</th>	
    <?php 
    $result=mysqli_query($link,"select * from attendence");
    $serialnumber=0;
    $counter=0;
    while($row=mysqli_fetch_array($result))
    {
    $serialnumber++;
    ?>
    <tr>
    <td> <?php echo $serialnumber; ?></td>
    <td> <?php echo $row['student_name']; ?>
    <input type="hidden" value="<?php echo $row['student_name']; ?>" name="student_name[]">	
    </td>
    <td> <?php echo $row['roll_number']; ?>
    <input type="hidden" value="<?php echo $row['roll_number']; ?>" name="roll_number[]">	
    </td>
    <td>
    <input type="radio" name="attendence_status[<?php echo $counter; ?>]" value="Present">Present
    <input type="radio" name="attendence_status[<?php echo $counter; ?>]" value="Absent">Absent
    </td>
    </tr>
    <?php
       $counter++;
      }
    ?> 	
</table>
<input type="submit" name="submit" value="Submit" class="btn btn-primary"> 
</form>
</div>
</div>
</div>
