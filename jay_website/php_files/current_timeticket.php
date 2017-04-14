<?php
        $query = "SELECT `time_in`, `time_out`, `job`, `description`, `lunch` FROM `timeticket` WHERE `id` = '$id' AND `pay_period` = 'CURRENT_PAY_PERIOD'";
        $query = mysqli_query($dbc, $query) or die ('Could not insert data because: ' . mysqli_error($dbc));