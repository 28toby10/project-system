
<?php
// Include config file
require_once "config.php";

if (isset($_GET['rm'])) {
    $id = $_GET['rm'];
    mysqli_query($link, "INSERT INTO `projects-delte` SELECT user,user,task,project,created_at FROM projects WHERE id=$id");
    mysqli_query($link, "DELETE FROM projects WHERE id=$id");
    header('location: projects.php');
}

if (isset($_GET['mv'])) {
    $id = $_GET['mv'];
    mysqli_query($link, "INSERT INTO `projects-done` SELECT user,user,task,project,created_at FROM projects WHERE id=$id");
    mysqli_query($link, "DELETE FROM projects WHERE id=$id");
    header('location: projects.php');
}

$select = mysqli_query($link, "SELECT * FROM projects");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Taken</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
        table{ font: 14px sans-serif; text-align: center; }
        table { width: 50%; margin: 30px auto; border-collapse: collapse; }
        tr { border-bottom: 1px solid #cbcbcb; }
        p { text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Huidige taken</h2>
        <p>Als een taak is afgerond kan je die afvinken</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <a href="add-project.php" class="btn btn-primary">Taak maken</a>
            </div>
        </form>
    </div>
    <p>
        <a href="finished.php" class="btn btn-success">Afgemaakte taken</a>
        <a href="deleted.php" class="btn btn-danger">Verwijderde taken</a>
    </p>
    <table>
        <thead>
        <tr>
            <th>id</th>
            <th>gebruiker</th>
            <th>taak</th>
            <th>project</th>
            <th>Aangemaakt op</th>
        </tr>
        <thead>
        
        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($select)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td class="user"><?php echo $row['user']; ?></td>
            <td class="task"><?php echo $row['task']; ?></td>
            <td class="project"><?php echo $row['project']; ?></td>
            <td class="created_at"><?php echo $row['created_at']; ?></td>
            <td class="delete">
            <a href="projects.php?rm=<?php echo $row['id']; ?>" class="btn btn-danger">✘</a>
            <a href="projects.php?mv=<?php echo $row['id']; ?>" class="btn btn-success">✔</a>
            </td>
        </tr>
        
        <?php $i++; } ?>
    
        </tbody>
    </table>

</body>

</html>