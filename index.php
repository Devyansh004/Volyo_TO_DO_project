<?php session_start(); 
date_default_timezone_set('Asia/Kolkata'); 
function getFriendlyTimeLabel($timestamp) {
    $today = strtotime("today");
    $yesterday = strtotime("yesterday");

    if ($timestamp >= $today) {
        return "Today";
    } elseif ($timestamp >= $yesterday) {
        return "Yesterday";
    } else {
        return date("d M Y", $timestamp);
    }
}
?>
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
        <?php 
        $pending=[];
        $completed=[];
          foreach ($_SESSION['tasks'] as $i => $t){
            if ($t['status'] === 'Pending') {
              $pending[$i] = $t;
            } else {
              $completed[$i] = $t;
            }
          }
           $sortedTasks = $pending + $completed;
           foreach ($sortedTasks as $index => $task): 
          ?>
          <li>
          <div style="<?php echo $task['status'] === 'Completed' ? 'text-decoration: line-through; color: #333;' : ''; ?>">
            <?php echo htmlspecialchars($task['name']); ?>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 4px;">
            <small style="font-size: 14px; color: #333; font-weight:bold;">
              Added: <?php echo getFriendlyTimeLabel($task['timestamp']) . ' at ' . date('h:i A', $task['timestamp']); ?>
            </small>
          <div style="display: flex; gap: 5px;">
            <a href="todo.php?toggle=<?php echo $index; ?>">
              <button style="background-color: <?php echo $task['status'] === 'Completed' ? '#a5be8c' : '#c8b6a6'; ?>; color: white; border: none; padding: 5px 10px; border-radius: 4px;"> 
                <?php echo $task['status']; ?>
              </button>
            </a>
            <a href="todo.php?delete=<?php echo $index; ?>">
              <button style="background-color: #8d6e63; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Delete</button>
            </a>
          </div>
          </div>
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
      <input type="submit" value="ADD" name="submit" id="submit">
    </form>
  </div>
  <div class="look"></div>
</body>
</html>