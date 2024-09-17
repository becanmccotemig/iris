<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }

    require_once 'database.php';

    $sql = "SELECT * FROM post";
    $all_posts = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Home</title>
</head>
<body>
    <h1 class="title-home">Home</h1>
    <section class="section">

        <?php 
            while($row = mysqli_fetch_assoc($all_posts)){
        ?>

        <div class="card">
            <div class="card-container">
                <div class="card-post-header">
                    <h2 class='card-post-post_title'> <?php echo $row["post_title"]; ?> </h2>
                    <h4 class='card-post-post_desc'> <?php echo $row["post_description"]; ?> </h4>
                </div>

                <div class=card-post-container>
                    <p class='card-post-post_body'> <?php echo $row["post_body"]; ?> </p>
                </div>
                
                <div class="card-post-footer">
                    <p class='card-post-post_startup_name'> Startup Name </p>
                    <p class='card-post-post_category'> <?php echo $row["post_category"]; ?> </p>
                    <p class='card-post-post_author'> <?php echo $row["post_author"]; ?> </p>
                    
                </div>

                <?php 
                        $post_id = $row['id'];
                        $url = "post.php?id=" . urlencode($post_id);
                        echo "<a href='$url' class='btn btn-primary'>Ver mais</a>";
                ?>
            </div>
        </div>
        <?php 
            }
        ?>

    </section>
</body>
</html>