<?php 
// echo "<h1>" .  . "</h1>";
include 'config.php';
$page = basename($_SERVER['PHP_SELF']);
switch($page){
    case "single.php":
      if(isset($_GET['id'])){
        $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
        $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed");
        $row_title = mysqli_fetch_assoc($result_title);
        $page_title = $row_title['title'];
      }else{
        $page_title = "No post Found";
      }
      break;
      case "category.php":
        if(isset($_GET['cid'])){
          $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
          $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed");
          $row_title = mysqli_fetch_assoc($result_title);
          $page_title = $row_title['category_name'];
        }else{ 
          $page_title = "No post Found";
        }
        break;
        case "author.php":
          if(isset($_GET['aid'])){
            $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $result_title = mysqli_query($conn,$sql_title) or die("Title Query Failed");
            $row_title = mysqli_fetch_assoc($result_title);
            $page_title =  " News By " . $row_title['first_name'] . " " . $row_title['last_name'];
          }else{
            $page_title = "No post Found";
          }
          break;
          case "search.php":
            if(isset($_GET['search'])){
              $page_title = $_GET['search'];
            }else{
              $page_title = "No search Found";
            }
            break;
          default :  
          $page_title = "News Site";
            break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $page_title; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="./css/style.css">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="collapse navbar-collapse justify-content-center bg-primary" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
      <?php
          include "config.php";
          $sql = "SELECT * FROM settings";
          $result = mysqli_query($conn, $sql) or die("Query Failed.");
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)) {
              if($row['logo'] == ""){
                  echo '<a href="index.php"><h1>'.$row['websitename'] .'</h1></a>';
              }else{
                  echo '<a href="index.php"><img src="./images/'.  $row['logo'] . '" class="logo" alt="" width="100%"></a>';
              }

        }
      }
        ?>
      </li>
    </ul>
  </div>
</div>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <?php 
  include 'config.php';

  $cat_id = (isset($_GET['cid']) ? $_GET['cid'] : '');

  $sql = "SELECT * FROM category WHERE post > 0";

  $result= mysqli_query($conn, $sql) or die("Query Failed. : Category");
  if(mysqli_num_rows($result) > 0){
    $active = "";
  ?>
<div class="collapse navbar-collapse justify-content-center bg-dark" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
      <a class="navbar-brand"  href="./admin/index.php">
      <img src="./images/img_avatar1.png" alt="Avatar Logo" style="width:40px;" class="rounded-pill"> 
    </a>
      <li class='nav-item'>
        <a class='nav nav-link active fw-bold text-white' aria-current='page' href='<?php echo $hostname; ?>'>HOME</a>
        </li>
        <?php 
            while($row = mysqli_fetch_assoc($result)){
              if(isset($_GET['cid'])){
                if($row['category_id'] == $cat_id){
                  $active = "active";
                }else{
                  $active = "";
                }
              }
        
              $category_name_uppercase = strtoupper($row['category_name']);
              echo "<li class='nav-item'>
                      <a class='nav nav-link active fw-bold text-white {$active}' aria-current='page' href='category.php?cid={$row['category_id']}'>{$category_name_uppercase}</a>
                    </li>";
         } ?> 
      </ul> 
      <?php  }  ?>
    </div>
</nav>
</body>
</html>