<?php 
session_start();

if(!isset($_SESSION['task'])){
    $_SESSION['task'] = [];
}


$html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>To-Do List</title>
</head>
<body>
  <h1>Ma To-Do List</h1>
  
  <form method="post">
    <input type="text" name="task" placeholder="Nouvelle tâche..." required>
    <button type="submit" name="add">Ajouter</button>
  </form>
</body>
</html>
HTML;


if (isset($_POST['add'])) {
    $task = trim($_POST['task']); 
    if ($task !== '') {
        $_SESSION['tasks'][] = [
            'text' => $task,
            'done' => false
        ];
    }
}



?>