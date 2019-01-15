<?php

use LostCodes\PeriodDate;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Example - PHP Period Date</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="margin: 20px;">
<div class="row">
    <div class="col-md-12">
        <h1>Sandbox</h1>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php
                require_once "includes/PeriodDate.php";
                $pd = new PeriodDate();
                // Get today.
                echo 'Today is: ' . date("l, jS F Y", strtotime("today")) . "<br><br>";
                // Get current week.
                $date = $pd->firstDayOf('week');
                echo 'The first day of the current week is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('week');
                echo 'The last day of the current week is: ' . $date->format('l, jS F Y') . "<br><br>";

                // Get current month.
                $date = $pd->firstDayOf('month');
                echo 'The first day of the current month is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('month');
                echo 'The last day of the current month is: ' . $date->format('l, jS F Y') . "<br><br>";

                // Get current year.
                $date = $pd->firstDayOf('year');
                echo 'The first day of the current year is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('year');
                echo 'The last day of the current year is: ' . $date->format('l, jS F Y') . "<br><br>";

                // Get yesterday.
                echo 'Yesterday is: ' . date("l, jS F Y", strtotime("yesterday")) . "<br><br>";
                // Get previous week.
                $specifiedDate = new DateTime(date('Y'));
                $date          = $pd->firstDayOf('week', $specifiedDate, "last");
                echo 'The first day of the previous week is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('week', $specifiedDate, "last");
                echo 'The last day of the previous week is: ' . $date->format('l, jS F Y') . "<br><br>";

                // Get previous month.
                $specifiedDate = new DateTime(date('Y'));
                $date          = $pd->firstDayOf('month', $specifiedDate, "last");
                echo 'The first day of the previous month is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('month', $specifiedDate, "last");
                echo 'The last day of the previous month is: ' . $date->format('l, jS F Y') . "<br><br>";

                // Get previous year.
                $specifiedDate = new DateTime(date('Y') - 1);
                $date          = $pd->firstDayOf('year', $specifiedDate, "last");
                echo 'The first day of the previous year is: ' . $date->format('l, jS F Y') . "<br>";
                $date = $pd->lastDayOf('year', $specifiedDate, "last");
                echo 'The last day of the previous year is: ' . $date->format('l, jS F Y') . "<br><br>";

                echo 'Get first day of each week between ' . date('l, jS F Y', strtotime('2018-11-01')) . ' and ' . date('l, jS F Y') . " with first day of week as Monday and custom returned date format: <br><br>";
                // Get first day of each week between two dates with first day of week as Monday and custom returned date format.
                print_r($pd->getWeekFirstDayBetweenDates("2018-01-08", date('Y-m-d'), "1", date('l, jS F Y')));

                echo 'Get all day dates between ' . date('l, jS F Y', strtotime('2018-11-01')) . ' and ' . date('l, jS F Y') . " with an interval and custom returned date format: <br><br>";
                // Get all day dates between two dates with an interval and custom returned date format.
                print_r($pd->getDayDatesBetweenTwoDates("2018-11-01", date('Y-m-d'), 1, date('l, jS F Y')));
                ?>
            </div>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>