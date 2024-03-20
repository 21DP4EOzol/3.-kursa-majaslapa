<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Upload file</title>
    <style>

body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #333; /* Dark background */
    font-family: Arial, sans-serif;
    color: white;
}

.main {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.top_bar {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 100%;
    padding: 1rem;
    background-color: #222; /* Darker top bar */
    margin-bottom: 3rem; /* Spacing between top bar and form */
}

.top_bar a {
    color: white;
    text-decoration: none;
    font-size: 1.5rem;
    padding-right: 1rem;
}

.top_bar p {
    font-size: 1.5rem;
}

form {
    width: 100%;
    max-width: 500px; /* Adjust width as needed */
    display: flex;
    flex-direction: column;
}

input[type="text"],
input[type="file"],
input[type="submit"] {
    padding: 1rem;
    margin-bottom: 1rem;
    border: none;
    border-radius: 4px;
}

input[type="text"],
input[type="file"] {
    background-color: #444; /* Slightly lighter background for input */
    color: white;
}

input[type="text"]::placeholder,
input[type="file"]::placeholder {
    color: #aaa; /* Placeholder text color */
}

input[type="submit"] {
    background-color: #27ae60; /* Green background for submit button */
    color: white;
    cursor: pointer;
    border: none;
    font-weight: bold;
}

input[type="submit"]:hover {
    background-color: #218c54; /* Darker green on hover */
}

/* Style adjustments for file input */
input[type="file"] {
    cursor: pointer;
}

/* Style adjustments for the alert message */
.alert {
    text-align: center;
    color: #27ae60; /* Green text for alert messages */
    margin-top: 1rem;
}


    </style>
</head>
<body>

    <div class="main">
        <div class="top_bar">
            <a onclick="window.history.back()"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
            <p><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp;&nbsp;Upload video</p>
        </div>

        <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST" enctype = "multipart/form-data">
            <input type="text" placeholder="Title" name ="title">
            <input type="text" placeholder="Description" name ="desc">
            <input type="file" name ="files">
            <input type="submit" value="Upload Video" name ="submit">
        </form>
    </div>
    
</body>
</html>

<?php 
include "conn.php";
if (isset($_POST['submit'])) {
    $title_val = $_POST['title'];
    $description_val = $_POST['desc'];


    /*uploadot failu kip*/
    if(isset($_FILES['files'])){
        $unique_id = rand(1, 20);

        $file_name = $_FILES['files']['name'];
        $link = "videos/".$unique_id . $file_name;
        $file_tmp = $_FILES['files']['tmp_name'];

            if(move_uploaded_file($file_tmp, $link)){
                if ($title_val && $description_val != "") {
                    $sql = "INSERT INTO videos(title,description,link) VALUES ('$title_val','$description_val','$link')";
                    $result = mysqli_query($conn,$sql) or die('query failed');
                    ?>
                    <script>
                        alert('video uploaded sucessfully');
                    </script>
                    <?php
                }else{
                    echo 'fill all data';
                }
            }
    }
 }

?>