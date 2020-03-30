<?php 
include "lib/Session.php";
include "inc/header.php"; 
include "lib/Database.php"; 
?>

<?php
Session::init();
 $msg = Session::get('msg');
 if (!empty($msg)) {
    echo '<h2 class="alert alert-info text-center">'.$msg.'</h2> ';
    Session::unset();
 } 
 
?>


<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Student List<a class="btn btn-success pull-right" href="addstudent.php">Add Student Data</a></h2>
	</div>
   <table class="table table-striped">
   	<tr>
   		<th>Serial</th>
   		<th>Name</th>
   		<th>Email</th>
   		<th>Phone</th>
   		<th>Action</th>
   	</tr>
     <?php
        $db  = new Database();
        $table = "tbl_std";
        $order_by = array('order_by' => 'id DESC');


        /* $selectcond = array('select' => 'name');
        $wherecond = array(
             'where' =>array('id' => '2', 'email' => 'abid@gmail.com'),
             'return_type' => 'single'
        );

         $limit = array('start' =>'2', 'limit'=>'4')
          $limit = array('limit'=>'4')
         
        */


        $studentData = $db->select($table, $order_by);
        if (!empty($studentData)) {
           $i = 0;
           foreach ($studentData as $data) { $i++;  ?>
             



   	<tr>
   		<td><?php echo $i; ?></td>
   		<td><?php echo $data['name']; ?></td>
   		<td><?php echo $data['email']; ?></td>
   		<td><?php echo $data['phone']; ?></td>
   		<td>
   			<a class="btn btn-default" href="editstudent.php?id=<?php echo $data['id']; ?>">Edit</a> 
   			<a class="btn btn-danger" href="lib/process_student.php?action=delete&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure to delete')">Delete</a>
   		</td>
   	</tr>
   <?php  } } else { ?>
   <tr><td colspan="5"><h2>No student Data found...</h2></td></tr>
 <?php } ?>
   </table>

</div>

  


<?php include "inc/footer.php"; ?>