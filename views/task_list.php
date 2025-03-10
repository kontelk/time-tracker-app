<?php
$title = 'Tasks list';

ob_start();
require "views/nav.php";
?>

<div class="container">

    <h1><?php echo $title . " (" . $taskCount . ")"  ?></h1>
    <!-- If there's not yet data -->
    <?php if ($taskCount == 0) { ?>
        <div>
            <p>You have not yet added any project </p>
            <p><a href="/tasks/add">Add task</a></p>
        </div>
    <?php } ?>

    <ul>
        <?php foreach ($tasks as $task) : ?>
            <li>

                <a href=" ./add?id=<?php echo $task['id']; ?>">
                    <?php echo escape($task["title"]) ?>
                </a>
                <form method="post" style="display: inline-block; vertical-align: middle;">
                    <input type="hidden" value="<?php echo $task["id"]; ?>" name="delete">
                    <input style="border: 0;" type="image" src="../public/img/remove.png" width="15px" alt="Delete"
                        title="Delete task">
                </form>

            </li>
        <?php endforeach; ?>
    </ul>
</div>


<?php
$content = ob_get_clean();
include 'layout.php';
?>