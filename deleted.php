
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
    <p>
        <a href="finished.php" class="btn btn-success">Afgemaakte taken</a>
        <a href="projects.php" class="btn btn-warning">Taken</a>
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
            </td>
        </tr>
        
        <?php $i++; } ?>
    
        </tbody>
    </table>

</body>

</html>