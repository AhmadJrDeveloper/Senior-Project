<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../" href="../pictures/pc.webp" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../CSS/home.css" rel="stylesheet">
    <title>JAVA</title>
</head>

<body>

    <?php
    require_once 'config.php';

    $result = mysqli_query($conn, "SELECT * FROM blocks WHERE category_id = 1");

    foreach ($result as $row) {
        $title = $row['title'];
        $content = nl2br($row['content']); // Apply nl2br() to preserve line breaks
        $notes = nl2br($row['notes']); // Apply nl2br() to preserve line breaks

        echo '<ul class="list-group">';
        echo '<li class="list-group-item active">'  . $title . '</li>';
        echo '<li class="list-group-item">'  . $content . '</li>';
        echo '<li class="list-group-item">'  . $notes . '</li>';
        echo '</ul>';
    }

    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
