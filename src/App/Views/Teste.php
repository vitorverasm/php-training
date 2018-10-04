<?php

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
        <form action="" method="POST">
            <div>
                <br>Task title: <input type="text" name="name" value="Enter the task name">
            </div>
            <div>
                <br>Description: <input type="text" name="description" value="Describe what to do">
            </div>
            <div>
                <br>Deadline: <input type="datetime-local" name="deadline" value="<? echo date('Y-m-d'); ?>T09:00">
            </div>
            <div>
                <br>Priority: 
                <select name="priority">
                    <option value="4">Very high</option>
                    <option value="3">High</option>
                    <option value="2">Medium</option>
                    <option value="1">Low</option>
                </select>
            </div>
            <div>
                <br>Task done ? 
                <select name="done">
                    <option value="0" selected> No</option>
                    <option value="1"> Yes</option>
                </select>
            </div>
            <br>
            <input type="submit" value="Create Task!">
        </form>
    </body>
</html>