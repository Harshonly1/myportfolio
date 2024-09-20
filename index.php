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
          <div class="card-body" style="border-bottom: 1px solid #E5E5E5">
          <?php 
          include 'config.php';

          $limit = 3;
          if (isset($_GET['page'])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $offset = ($page - 1) * $limit;

          $sql = "SELECT post.post_id, post.title,post.description,post.post_date,category.category_name,user.username,post.category,post.post_img,post.author FROM post 
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

            $result= mysqli_query($conn, $sql) or die("Query Failed.");
            if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
          ?>
            <div class="row">
            <div class="col-md-4 my-3">
              <a href="single.php?id=<?php echo $row['post_id']; ?>">
              <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" class="post_1" width="98%">
              </a>
            </div>
            <div class="col-md-8">
            <a href="single.php?id=<?php echo $row['post_id']; ?>" class="fw-bold text-1">
           <?php echo $row['title']; ?>
            </a>
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
              <p>
              <?php echo substr($row['description'],0,130) . "...."; ?>
              </p>
              <div class="readmore">
                <a href="single.php?id=<?php echo $row['post_id']; ?> ">
                <button class="btn btn-primary " type="submit">Read More</button>
                </a>
              </div>
            </div>
            </div>
            <?php 
              }
            }else{
              echo "<h2>No Record Found</h2>";
            }
            ?>
          </div>
          <br>
          <?php 
          $sql1 = "SELECT * FROM post";
          $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");
          
          if(mysqli_num_rows($result1) > 0){
          
            $total_records = mysqli_num_rows($result1);
          
            $total_page = ceil($total_records / $limit);
            echo '<nav aria-label="...">
            <ul class="pagination pagination-sm">';
            if($page > 1){
              echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 1).'">Prev</a></li>';
            }
            for($i = 1; $i <= $total_page; $i++){
              if($i == $page){
              $active = "active";  
              }else{
                $active = ""; 
              }
              echo '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
            } 
            if($total_page > $page){
              echo '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 1).'">Next</a></li>';
            }
          
            echo "</ul>
                  </nav>";
          }
          ?>
          <!-- <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>    -->
          <br>         
        </div>
      </div>
        <?php 
        
        include 'sidebar.php';
        
        ?>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <?php 
    include 'footer.php';
    ?>
</body>
</html>