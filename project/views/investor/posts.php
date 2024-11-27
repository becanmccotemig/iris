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
    <link rel="stylesheet" href="../../components/header/investor/header.css">
    <link rel="stylesheet" href="../../components/header/investor/footer.css">
    <link rel="stylesheet" href="../../design/investors/posts.css">
    <link rel="stylesheet" href="../../design/global/global.css">

    <!-- // Fonte -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Jost:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Investor Startup Details Post</title>
</head>

<body>
    <?php
    include_once '../../components/header/investor/header.php';
    ?>
    <h1 class="title-home">POSTS</h1>
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
                        <p class='card-post-post_startup_name'><span class='title-bolder'> Startup: </span>
                            <?php echo htmlspecialchars($row["post_category"]); ?></p>
                        <p class='card-post-post_startup_author'><span class='title-bolder'> Autor: </span>
                            <?php echo htmlspecialchars($row["post_author"]); ?></p>

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
    <?php
    include_once '../../components/header/investor/footer.php';
    ?>
</body>

</html>