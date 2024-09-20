<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="col-md-4">
        <div class="card">
          <div class="card-header bg-light fw-bold">
            SEARCH
          </div>
          <div class="card-body">
            <form action="search.php" method="get">
            <div class="input-group mb-3"> 
            <input type="text" class="form-control" name="search" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
            <a href="search.php">
            <button type="submit" class="btn btn-primary">SEARCH</button>
          </a>
          </div>
            </form>
          
          </div>
        </div>
        <br><br>
        <div class="card">
          <div class="card-header fw-bold">
            RECENT POST
            <?php 
          include 'config.php';

          $limit = 3;

          $sql = "SELECT post.post_id, post.title,post.post_date,category.category_name,post.category,post.post_img FROM post 
          LEFT JOIN category ON post.category = category.category_id
          ORDER BY post.post_id DESC LIMIT {$limit}";

            $result= mysqli_query($conn, $sql) or die("Query Failed. :Recent Post");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
          ?>
          </div>
          <div class="card-body" style="border-bottom: 1px solid #E5E5E5">
            <div class="row">
              <div class="col-md-3">
                <a href="single.php?id=<?php echo $row['post_id']; ?>">
                <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" width="100%" style="width: 93px ">
                </a>
              </div>
              <div class="col-md-9">
                <a href="single.php?id=<?php echo $row['post_id']; ?>" class="content">
                <?php echo $row['title']; ?>
                </a>
            <ul class="link1">
              <li class="">
              <a href="category.php?cid=<?php echo $row['category']; ?>">
              <i class="fa-solid fa-tag tag"></i><?php echo $row['category_name']; ?>
              </a>  
              </li>
              <li class="date"><i class="fa-solid fa-calendar-days tag"></i><?php echo $row['post_date']; ?></li>
            </ul>
              </div>
              <div class="readmore">
                <a href="single.php?id=<?php echo $row['post_id']; ?> ">
                <button class="btn btn-primary" type="submit">Read More</button>
                </a>
              </div>
            </div>
            <?php 
          }
          }
          ?>
          </div>
        </div>
      </div>
</body>
</html>