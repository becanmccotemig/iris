<!-- pagina que display as infos -->
 <!-- link: https://www.youtube.com/watch?v=0mAL4UuVWbU -->

 <?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login.php");
        exit();
    }

    require_once 'database.php';

    $sql = "SELECT * FROM startups";
    $all_startups = $conn->query($sql);

?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="design/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
 </head>
 <body>
 <h1 class="title-home">Home</h1>
    <section class="section">

        <?php 
            while($row = mysqli_fetch_assoc($all_startups)){
        ?>

        <div class="card">
            <div class="card-container">
                <div class="card-post-header">
                    <h2 class='card-startup-name'> <?php echo $row["nomeStartup"]; ?> </h2>
                    <h4 class='card-startup-area'> <?php echo $row["setor"]; ?> </h4>
                </div>

                <div class=card-startup-container>
                    <p class='card-startup-desc'> <?php echo $row["descricao"]; ?> </p>
                </div>
                
                <div class="card-startup-footer">
                    <p class='card-startup-website'> <?php echo $row["website"]; ?> </p>
                    <p class='card-startup-email'> <?php echo $row["emailStartup"]; ?> </p>
                    <p class='card-startup-contact'> <?php echo $row["contato"]; ?> </p>
                    
                </div>

                <?php 
                        $startup_id = $row['id'];
                        $url = "startup.php?id=" . urlencode($startup_id);
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