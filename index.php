<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TO-DO LIST</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="projectcss.css?v=<?php echo time(); ?>">

</head>
<body>
    
  <div class="heading">
    <h3 style="font-size:50px;">TO-DO LIST</h3>
  </div>

  <div class="nb">
    <ul>
      <?php if (!empty($_SESSION['tasks'])): ?>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
          <li>
            <?php echo htmlspecialchars($task['name']); ?>
            <a href="todo.php?toggle=<?php echo $index; ?>">
              <button style="background-color: <?php echo $task['status'] === 'Completed' ? '#4CAF50' : '#f0ad4e'; ?>"> 
              <?php echo $task['status']; ?>
              </button>
            </a>
            <a href="todo.php?delete=<?php echo $index; ?>">
              <button style="background-color: red; color: white;">Delete</button>
            </a>
          </li>
        <?php endforeach; ?>
      <?php else: ?>
        <li>No tasks yet.</li>
      <?php endif; ?>
    </ul>
  </div>

  <div class="input">
    <form class="form" action="todo.php" method="POST">
      <input type="text" name="task" id="task" placeholder="Enter Your Tasks" required />
      <button type="submit" id="submit">ADD</button>
    </form>
  </div>
  <div class="look">

  </div>
</body>
</html>
