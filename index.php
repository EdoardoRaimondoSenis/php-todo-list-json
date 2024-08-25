<?php

session_start();

if (!isset($_SESSION['todo_list'])) {
    $_SESSION['todo_list'] = [];
}

if (isset($_POST['new_item'])) {
    $_SESSION['todo_list'][] = ['text' => $_POST['new_item'], 'completed' => false];
}

if (isset($_POST['delete_item'])) {
    unset($_SESSION['todo_list'][$_POST['delete_item']]);
}

if (isset($_POST['toggle_complete'])) {
    $index = $_POST['toggle_complete'];
    $_SESSION['todo_list'][$index]['completed'] = !$_SESSION['todo_list'][$index]['completed'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Todo List</title>
</head>
<body>
    
<h1>Todo List</h1>
<div>
    <ul class="todo-list">
        <?php foreach ($_SESSION['todo_list'] as $index => $item): ?>
            <li class="<?= $item['completed'] ? 'completed' : '' ?>">
                <?= htmlspecialchars($item['text']) ?>
                <form method="POST" class="inline-form">
                    <button type="submit" name="toggle_complete" value="<?= $index ?>" class="complete-btn">✔</button>
                    <button type="submit" name="delete_item" value="<?= $index ?>" class="delete-btn">🗑</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<form method="POST" class="add-item-form">
    <input type="text" name="new_item" placeholder="Inserisci elemento..." required>
    <button type="submit">Inserisci</button>
</form>

</body>
</html>