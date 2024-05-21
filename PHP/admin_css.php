<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="../" href="../pictures/pc.webp" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../CSS/home.css" rel="stylesheet">
    <title>Admin CSS Page</title>
</head>

<body>

    <?php
    require_once 'config.php';

    // Delete block if block_id is set
    if (isset($_POST['delete_block'])) {
        $blockId = $_POST['id'];

        // Perform the deletion query
        $deleteQuery = "DELETE FROM blocks WHERE id = '$blockId'";
        mysqli_query($conn, $deleteQuery);
    }

    // Modify block if form is submitted
    if (isset($_POST['update_block'])) {
        $blockId = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $notes = $_POST['notes'];

        // Update block in the database
        $updateQuery = "UPDATE blocks SET title = '$title', content = '$content', notes = '$notes' WHERE id = '$blockId'";
        mysqli_query($conn, $updateQuery);
    }

    $result = mysqli_query($conn, "SELECT * FROM blocks WHERE category_id = 3");

    foreach ($result as $row) {
        $blockId = $row['id'];
        $title = $row['title'];
        $content = nl2br($row['content']); // Apply nl2br() to preserve line breaks
        $notes = nl2br($row['notes']); // Apply nl2br() to preserve line breaks

        echo '<ul class="list-group">';
        echo '<li class="list-group-item active">' . $title . '</li>';
        echo '<li class="list-group-item">' . $content . '</li>';
        echo '<li class="list-group-item">' . $notes . '</li>';
        echo '<li class="list-group-item">
                <form action="" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="' . $blockId . '">
                    <button type="submit" name="delete_block" class="btn btn-danger">Delete</button>
                </form>
                <a href="?edit_id=' . $blockId . '" class="btn btn-primary">Edit</a>
            </li>';
        echo '</ul>';

        // Display edit form if edit_id matches the current block
        if (isset($_GET['edit_id']) && $_GET['edit_id'] == $blockId) {
            echo '<form action="" method="POST" class="mt-3">
                    <input type="hidden" name="id" value="' . $blockId . '">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="' . $title . '">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="3">' . $content . '</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3">' . $notes . '</textarea>
                    </div>
                    <button type="submit" name="update_block" class="btn btn-primary">Update</button>
                </form>';
        }
    }

    mysqli_close($conn);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
