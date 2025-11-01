<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if (isset($_POST['add'])) {
    $task = trim($_POST['task']);
    if ($task !== '') {
        $_SESSION['tasks'][] = [
            'text' => $task,
            'done' => false
        ];
    }
        header("Location: index.php");
    exit;
}

if (isset($_GET['toggle'])) {
    $i = (int) $_GET['toggle'];
    if (isset($_SESSION['tasks'][$i])) {
        $_SESSION['tasks'][$i]['done'] = !$_SESSION['tasks'][$i]['done'];
    }
        header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    $i = (int) $_GET['delete'];
    if (isset($_SESSION['tasks'][$i])) {   
        unset($_SESSION['tasks'][$i]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']); 
    }
        header("Location: index.php");
    exit;
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
HTML;


foreach ($_SESSION['tasks'] as $i => $t) {
    $done = $t['done'] ? '✅' : '❌';
    $html .= $t['text'] . ' | ' . $done;
    $html .= <<<HTML
<a href="?toggle=$i">Effectuée</a> 
<a href="?delete=$i">Supprimée</a> <br>

HTML;

}

$html .= <<<HTML
</body>
</html>
HTML;

echo $html;
?>