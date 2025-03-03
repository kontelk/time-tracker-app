<?php
$title = 'TimeTrackerApp';

ob_start();
require "views/nav.php";
?>
<div class="welcome">
    <h1>Welcome to TimeTrackerApp</h1>

    <p>Track the time you spend on your favorite tasks</p>
</div>
<?php
$content = ob_get_clean();
include 'views/layout.php';
?>