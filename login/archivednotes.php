<?php
    require "header.php";
    require "includes/categories.inc.php";
    require "includes/viewarchive.inc.php";

    if ($auth === false) {
        header("Location: login.php");
    }

    $editingMode = false;
    $archiveView = true;


?>

<section id="notes-main-section">
    <?php
    require "innernotes.php";
    ?>
</section>
<!-- <div class="bgdec" id="background-decoration"></div> -->
<div class="bgdec" id="background-decoration0"></div>
<div class="bgdec" id="background-decoration1"></div>


<?php
    require "footer.php";
?>