<?php
    $singleCategory = false;

    if (isset($_GET['a'])) {
        $editingMode = true;
        $archiveView = false;
    }
    elseif (isset($_GET['b'])) {
        $editingMode = false;
        $archiveView = true;
    }
    else {
        $editingMode = false;
        $archiveView = false;
    }