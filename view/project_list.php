<?php
$title = 'Projects list';

ob_start();
require 'nav.php';
require '../controller/common.php';
?>

<div class="container">

    <h1><?php echo $title . " (" . $projectCount . ")"  ?></h1>
    <!-- If there's not yet data -->
    <?php if ($projectCount == 0) { ?>
        <div>
            <p>You have not yet added any project </p>
            <p><a href='../controller/project.php'>Add project</a></p>
        </div>
    <?php } ?>

    <ul>
        <?php foreach ($projects as $project) : ?>
            <li>
                <a href="../controller/project.php?id= <?php echo $project['id']; ?>">
                    <?php echo escape($project["title"]) ?>
                </a>
                <form method="post" style="display: inline-block; vertical-align: middle;">
                    <input type="hidden" value="<?php echo $project["id"]; ?>" name="delete">
                    <input style="border: 0;" type="image" src="../public/img/remove.png" width="20px" alt="Delete"
                        title="Delete project">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>