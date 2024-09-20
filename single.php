<!DOCTYPE html>
<?php 
include 'header.php';
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
            <?php 
          include 'config.php';

          $host_id = $_GET['id'];

          $sql = "SELECT post.post_id, post.title,post.description,post.post_date,category.category_name,user.username,post.category,post.post_img,post.author FROM post 
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          WHERE post.post_id = {$host_id}";

            $result= mysqli_query($conn, $sql) or die("Query Failed.");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
              
          ?>
                <div class="card-header">
                    <h1><a href="" class="fw-bold">
                    <?php echo $row['title']; ?>
            </a></h1>
                
            <a href="">
            <ul class="link">
              <li class="">
                <a href="category.php?cid=<?php echo $row['category']; ?>">
                <i class="fa-solid fa-tag tag"></i>
                <?php echo $row['category_name']; ?>
                </a>
              </li>
              <li class="admin">
              <a href="author.php?aid=<?php echo $row['author']; ?>">
                <i class="fa-solid fa-user tag">
                </i><?php echo $row['username']; ?>
                </a>
              </li>
              <li class="date"><i class="fa-solid fa-calendar-days tag"></i><?php echo $row['post_date']; ?></li>
            </ul>
            </a>
                </div>
                <div class="card-body">
                    <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" class="text-center" width="100%" style="width: 588px; margin-left: 108px ">
                    <br><br>
                    <p>
                    <?php echo $row['description']; ?>
                    </p>
                </div>
                <?php 
             }
           }else{
            echo "<h2>No Record Found</h2>";
          } 
            ?>
            </div>

        </div>
        <?php 
        include 'sidebar.php';
        ?>
    </div>
  </div>  
  <br><br><br><br>
  <?php 
    include 'footer.php';
    ?>
</body>
</html>