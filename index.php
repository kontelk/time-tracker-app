<?php
$title = 'TimeTrackerApp';

ob_start();
require 'view/nav.php';

?>
<div class="welcome">
    <h1>Welcome to TimeTrackerApp</h1>

    <p>an app that helps you track time you spend on your favorite tasks</p>
</div>
<?php
$content = ob_get_clean();
include 'view/layout.php';
?>