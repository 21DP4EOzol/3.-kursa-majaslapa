<?php
include "conn.php";
$content = 3;
if (isset($_GET['page_no'])){
    $page_no = $_GET['page_no'];
    $offset = ($page_no-1)*$content;
}else{
    $page_no = 1;
    $offset = ($page_no-1)*$content;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Video player</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

    <div class="mai">
        <div class="item">
            <div class="navbar">
            <p><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;Video player</p>
            <div class="customize">
                <a href="edit_video.php"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                <a href="upload_file.php"><i class="fa fa-cloud-upload" aria-hidden="true"></i></a>
            </div>
        </div>     
    </div>

    <?php
        $sql = "SELECT * FROM videos ORDER BY id DESC LIMIT {$offset}, {$content}";

        $result = mysqli_query($conn, $sql) or die('query failed');

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                

    ?>

    <div class="item">
        <div class="video">
        <div class="controlls">
    <a href="player.php?link=<?php echo $row['link'] ?>" class="button">
        <i class="fa fa-play" aria-hidden="true"></i>
    </a>
</div>

            <video src="<?php echo $row['link'] ?>" id="video_player"></video>
        </div>
        <div class="detail">
            <a href="player.php?link=<?php echo $row['link'] ?>" id="title"><?php echo $row['title'] ?></a>
            <p id="desc"><?php echo $row['description'] ?></p>
        </div>
    </div>

    <?php
    }
     }else{
        echo '<p id="center_text">No Videos are Available</p>';

        }
    ?>

 </div>
    
</body>
</html>