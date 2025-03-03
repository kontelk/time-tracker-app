<?php
$title = 'Reports';

ob_start();
require "views/nav.php";
?>

<div class="container">

    <h1><?php echo $title ?></h1>

    <div class="filter">
        <p>Filter by</p>
        <form method="get">
            <select name="filter" id="project">
                <option value="">Select one</option>

                <optgroup label="Projects">
                    <?php foreach ($projects as $project) : ?>
                        <option value="<?php echo 'project:' . $project["id"] ?>"><?php echo escape($project["title"]) ?>
                        </option>

                    <?php endforeach; ?>

                </optgroup>
                <optgroup label="Category">
                    <?php
                    $categories = ["Personal", "Professional", "Business"];
                    foreach ($categories as $categorie) :
                    ?>

                        <option value="<?php echo 'category:' . $categorie ?>">
                            <?php echo escape($categorie); ?>
                        </option>
                    <?php endforeach; ?>
                </optgroup>
                <optgroup label="Date">
                    <option value="date:<?php
                                        echo date('m/d/y', strtotime("last week monday"));
                                        echo ":";
                                        echo date('m/d/y', strtotime("last week sunday"));
                                        ?>
                    ">Last Week</option>
                    <option value="date:<?php
                                        echo date('m/d/y', strtotime("this week monday"));
                                        echo ":";
                                        echo date('m/d/y', strtotime("this week sunday"));
                                        ?>
                    ">This Week</option>
                    <option value="date:<?php
                                        echo date('m/d/y', strtotime("first day of last month"));
                                        echo ":";
                                        echo date('m/d/y', strtotime("last day of last month"));
                                        ?>
                    ">Last Month</option>
                    <option value="date:<?php
                                        echo date('m/d/y', strtotime("first day of this month"));
                                        echo ":";
                                        echo trim(date('m/d/y')); ?>
                    ">This Month</option>
                </optgroup>
            </select>
            <input type="submit" value="Run">
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Date</th>
                <th>Duration</th>
            </tr>
        </thead>
        <?php
        $time_total = $project_id = $project_total = 0;

        foreach ($tasks as $task) :
            // Add a row for each project title
            if ($project_id != $task["project_id"]) {
                if ($project_id > 0) {

        ?>
                    <tr>
                        <th colspan=" 2" class="total">
                            Subtotal
                        </th>
                        <th>
                        <?php
                        echo  $project_total . " mn";
                        $project_total = 0;
                    }
                        ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3">
                        <?php
                        echo $task['project'];
                        $project_id = $task["project_id"];
                    }
                        ?>
                        </th>
                    </tr>

                    <tr>
                        <td>
                            <?php echo escape($task["title"]) ?>
                        </td>
                        <td>
                            <?php echo $task["date_task"] ?>
                        </td>
                        <td>
                            <?php echo  $task["time_task"] . " mn" ?>
                        </td>
                    </tr>
                <?php
                $time_total += $task["time_task"];
                $project_total += $task["time_task"];

            endforeach;
                ?>
                <tr>
                    <th class="highlight total" colspan="2">
                        Grand total
                    </th>
                    <th class="highlight">
                        <?php echo  $time_total . " mn" ?>
                    </th>
                </tr>
    </table>

</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>