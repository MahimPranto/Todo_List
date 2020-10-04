<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>Assignment 6</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">    
   
    <script src='main.js'></script>
</head>
<body>
    <section class="todo"> 
    <?php require_once'data.php';?>

    <div class="container-fluid">
        
        <div class="row head justify-content-center">
            <h1 class="top">To-Do List</h1>
        </div>

        <!-- session message for confirming -->
        <?php if(isset($_SESSION['message'])):  ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>"> 
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']); ?>
            </div>  
         <?php endif ?>  <!-- session message ends -->

        <div class="container">

            <!-- todo list form starts -->
            <div class="form">
                <form action="data.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="row upper justify-content-center">
                            <div class="col-md-9 col-sm-first">
                                <input type="text" value="<?php echo $info; ?>" autocomplete="off" autofocus placeholder="Add to the List" class="form-control" name="list" value=""/>
                            </div>
                            <div class="col-md-3 col-sm-last">
                                <?php if ($update==true):?>
                                <button type="submit" onclick="updated()" class="btn btn-info" name="update">Update</button>
                                <?php else: ?>
                                <button type="submit" onclick="added()" class="btn btn-primary" name="add">Add</button>
                                <?php endif ?>
                            </div>
                        </div>
                </form> 
            </div>  <!-- todo list form ends -->

             <!-- showing todolist in table format for sfav list -->
            <div class="row">
                <h3>Favourites</h3>
            </div>
                <div class="row justify-content-center ">
                    <?php
                    // get data from the database 
                    $mysqli=new mysqli($host,$user,$password,$db) or die(mysqli_error($mysqli));
                    $result= $mysqli->query("Select * From listtable") or die($mysqli->error); 
                    while($row=$result->fetch_assoc()):
                        $type = $row['type'];

                    // checking if Favourite
                    if ($type==1) {
                    ?>
                    <div class="col-lg-8 col-md-8 col-sm-6">
                        <table class="table table-bordered table-dark table-responsive-sm">
                            <tbody>
                                <td>
                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                    <?php echo $row['info'];?> 
                                </td>
                           </tbody>
                        </table>   
                    </div>

                    <!-- edit & delete button -->
                    <div class="col-lg-4 col-md-4 col-sm-6 buttons"> 

                        <a href="data.php?notfavourite=<?php echo $row['id'];?>" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="Remove From Favourites" data-placement="bottom"><i class="fa fa-star" aria-hidden="true"></i></a>      

                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info" data-toggle="tooltip" data-html="true" title="Edit" data-placement="bottom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        <a href="data.php?delete=<?php echo $row['id'];?>" class="btn btn-danger"  data-toggle="tooltip" data-html="true" title="Delete" data-placement="bottom" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> 

                    </div> <?php } endwhile;  ?><!-- edit & delete button ends-->
                     
                </div>  <!-- info row ends -->
                <br>
            <!-- showing todolist in table format for non-fav list -->
            <div class="row">
                <h3>Your List</h3>
            </div>
            <div class="row justify-content-center ">
                <?php
                // get data from the database 
                $mysqli=new mysqli($host,$user,$password,$db) or die(mysqli_error($mysqli));
                $result= $mysqli->query("Select * From listtable") or die($mysqli->error); 
                while($row=$result->fetch_assoc()):
                    $type = $row['type'];

                // checking if not Favourite
                if ($type==0) {
                ?>
                <div class="col-lg-8 col-md-8 col-sm-6">
                    <table class="table table-bordered table-dark table-responsive-sm">
                        <tbody>
                            <td>
                                <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                                <?php echo $row['info'];?> 
                            </td>
                       </tbody>
                    </table>   
                </div>

                <!-- edit & delete button -->
                <div class="col-lg-4 col-md-4 col-sm-6 buttons">  

                    <a href="data.php?favourite=<?php echo $row['id'];?>" class="btn btn-warning" data-toggle="tooltip" data-html="true" title="Add to Favourites" data-placement="bottom"><i class="fa fa-star-o" aria-hidden="true"></i></a>   

                    <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info" data-toggle="tooltip" data-html="true" title="Edit" data-placement="bottom"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                    <a href="data.php?delete=<?php echo $row['id'];?>" class="btn btn-danger"  data-toggle="tooltip" data-html="true" title="Delete" data-placement="bottom" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> 

                </div> <!-- edit & delete button ends-->
                 <?php } endwhile; ?> 
            </div> <!-- info row ends -->
        

        </div>
    </div>
</section>
    <script >
        <?php    
            function pre_r($array){
                echo '<pre>';
                print_r($array);   
                echo '</pre>'; 
            }
        ?>
    </script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

