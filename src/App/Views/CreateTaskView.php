<?php
use App\Controllers\Controller;

require '../../../vendor/autoload.php';

$controller = new Controller();
if (!empty($_POST)) {
    $controller->createTask($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Task Manager</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="row justify-content-center">
            <form action="../../../index.php" method="POST">
                <div class="form-group">
                    <label>Task title:</label>
                    <input type="text" class="form-control" name="name" value="" placeholder="Enter the task name">
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" class="form-control" cols="40" rows="5" maxlength="140" placeholder="Describe what to do..."></textarea>
                </div>
                <div class="form-group">
                    <label>Deadline:</label>
                    <input type="datetime-local" class="form-control" name="deadline" value="<? echo date('Y-m-d'); ?>T09:00">
                </div>
                <div class="form-group">
                    <label>Priority:</label>
                    <select name="priority" class="form-control">
                        <option value=4>Very high</option>
                        <option value=3>High</option>
                        <option value=2>Medium</option>
                        <option value=1>Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status:</label>
                    <select name="status" class="form-control">
                        <option value=0 selected>Ongoing</option>
                        <option value=1>Done</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="save">Create task!</button>
                </div>
            </form>
        </div>
    </body>
</html>