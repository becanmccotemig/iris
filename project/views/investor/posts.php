<?php
    include "../../model/investor.php";
    include "../../database/database.php"; 

    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }

    $all_posts = getPosts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Investor Startup Details Post</title>
</head>
<body>
    <h1 class="title-home">Home</h1>
    <section class="section">

        <?php 
            foreach ($all_posts as $row) { 
        ?>

        <div class="card">
            <div class="card-container">
                <div class="card-post-header">
                    <h2 class='card-post-post_title'> <?php echo htmlspecialchars($row["post_title"]); ?> </h2>
                    <h4 class='card-post-post_desc'> <?php echo htmlspecialchars($row["post_description"]); ?> </h4>
                </div>

                <div class="card-post-container">
                    <p class='card-post-post_body'> <?php echo htmlspecialchars($row["post_body"]); ?> </p>
                </div>
                
                <div class="card-post-footer">
                    <p class='card-post-post_startup_name'> Startup name </p>
                    <p class='card-post-post_category'> <?php echo htmlspecialchars($row["post_category"]); ?> </p>
                    <p class='card-post-post_author'> <?php echo htmlspecialchars($row["post_author"]); ?> </p>
                </div>

                <?php 
                    $post_id = $row['id'];
                    $url = "details-post-startup.php?id=" . urlencode($post_id);
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
