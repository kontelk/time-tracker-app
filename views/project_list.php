<?php
$title = 'Projects list';

//$uri = getRootURI();

ob_start();
require "views/nav.php";
?>

<div class="container">

    <h1><?php echo $title . " (" . $projectCount . ")"  ?></h1>
    <!-- If there's not yet data -->
    <?php if ($projectCount == 0) { ?>
    <div>
        <p>You have not yet added any project </p>
        <p><a href="/projects/add">Add project</a></p>
    </div>
    <?php } ?>

    <ul>
        <?php foreach ($projects as $project) : ?>
        <li>
            <a href=" ./add?id=<?php echo $project['id']; ?>">
                <?php echo escape($project["title"]) ?>
            </a>
            <form method="post" style="display: inline-block; vertical-align: middle;">
                <input type="hidden" value="<?php echo $project["id"]; ?>" name="delete">
                <input style="border: 0;" type="image" src="../public/img/remove.png" width="15px" alt="Delete"
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