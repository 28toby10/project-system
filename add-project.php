<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$user = $task = $project = "";
$user_err = $task_err = $project_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate user
    if(empty(trim($_POST["user"]))){
        $user_err = "Voer een gebruikersnaam in.";     
    } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["user"]))){
        $user_err = "De gebruikersnaam mag alleen letters bevatten.";
    } else{
        $user = trim($_POST["user"]);
    }

    // Validate task
    if(empty(trim($_POST["task"]))){
        $task_err = "Voer een taak in.";     
    } else{
        $task = trim($_POST["task"]);
    }

    // Validate project
    if(empty(trim($_POST["project"]))){
        $project_err = "Geen project? voer 'n.v.t.' in.";     
    } else{
        $project = trim($_POST["project"]);
    }

    // Check input errors before inserting in database
    if(empty($user_err) && empty($task_err) && empty($project_err)){
            
        // Prepare an insert statement
        $sql = "INSERT INTO projects (user, task, project) VALUES (?, ?, ?)";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_user, $param_task, $param_project);
            
            // Set parameters
            $param_user = $user;
            $param_task = $task;
            $param_project = $project;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: projects.php");
            } else{
                echo "Oops! Er is iets fout gegaan. Probeer het later opnieuw.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Taak maken</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Taak maken</h2>
        <h9>Vul dit in om een taak toe te voegen.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Gebruiker</label>
                <input type="text" name="user" class="form-control <?php echo (!empty($user_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $user; ?>">
                <span class="invalid-feedback"><?php echo $user_err; ?></span>
            </div>
            <div class="form-group">
                <label>Taak</label>
                <input type="text" name="task" class="form-control <?php echo (!empty($task_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $task; ?>">
                <span class="invalid-feedback"><?php echo $task_err; ?></span>
            </div>
            <div class="form-group">
                <label>Project</label>
                <input type="text" name="project" class="form-control <?php echo (!empty($project_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $project; ?>">
                <span class="invalid-feedback"><?php echo $project_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Taak toevoegen">
                <a class="btn btn-link ml-2" href="projects.php">Annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>