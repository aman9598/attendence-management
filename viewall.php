<?php
include("db.php");
include("balle.php");

?>
<div class="panel panel-default">
	<div class="panel panel-heading">
    <h2>
    <a class="btn btn-success" href="add.php">Add Student</a>
    <a class="btn btn-info pull-right" href="secondpage.php">Back</a>
    </h2>
    <h3><div class="well text-center">DATE: <?php echo date("Y-m-d"); ?> </div></h3>
    <div class="panel panel-body">
    <form action="secondpage.php" method="Post">
    <table class="table table-stripped">
    <th>SERIAL NUMBER</th><th>Date</th>	
    <?php 
    $result=mysqli_query($link,"select distinct date from attendence_record");
    $serialnumber=0;
    while($row=mysqli_fetch_array($result))
    {
    $serialnumber++;
    ?>
    <tr>
    <td> <?php echo $serialnumber; ?></td>
    <td> <?php echo $row['date']; ?></td>
    </tr>
<?php
}
?> 	
</table> 
</form>
</div>
</div>
</div>
