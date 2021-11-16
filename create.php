<?php 
 require 'dbConnection.php';
 require 'helpers.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

   $title     = Clean($_POST['title']); 
   $description    = Clean($_POST['description']);
   $startdate = Clean($_POST['startdate']);
   $enddate = Clean($_POST['enddate']);


    # Validate Inputs ..... 
    $errors = [];

    # Title Validate
    if(!validate($title,1)){
       $errors['Title'] = " Field Required";
    }

    if(!validate($description,1)){
      $errors['Description'] = " Field Required";
   }

   if(!validate($startdate,1)){
    $errors['Startdate'] = " Field Required";
 }

 if(!validate($enddate,1)){
  $errors['Enddate'] = " Field Required";
}

     if(count($errors) > 0){
         foreach($errors as $key => $val){
             echo '* '.$key.' : '.$val.'<br>';
         }
     }

        $sql = "insert into users (title,description,startdate,enddate) values ('$title','$description','$startdate','$enddate')";
          
        $op =  mysqli_query($con,$sql);

        if($op){
            $message =  'User Inserted';
        }else{
            $message =  'Error Try Again !!!';
        }

        $_SESSION['message'] = $message;

        header("Location: index.php");

     }


    mysqli_close($con);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>To Do List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>To Do List</h2>
  <br>
	<form method="post" action="index.php" class="input_form">
		<input type="text" name="title" class="task_input" placeholder="Enter Title">
    <input type="text" name="description" class="task_input" placeholder="Enter Description">
    <input type="date" name="startdate" class="task_input">
    <input type="date" name="enddate" class="task_input">
		<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>
	</form>

</body>
</html>