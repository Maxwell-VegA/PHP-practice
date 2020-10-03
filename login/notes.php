<?php
    require "header.php";
    require "includes/categories.inc.php";

    if ($auth === false) {
        header("Location: login.php");
    }

    $editingMode = false;
    $archiveView = false;
    $singleCategory = false;
    $searchStrLength = 0;

?>

<?php 
    require "notesnav.php"; 
?>
<main>
    <?php 
        require "newnote.php";
    ?>
</main>

<section id="notes-main-section">
    <?php
        require "innernotes.php";
    ?>
</section>

<aside>
    <?php
        require "sidebar.php";
    ?>
</aside>

<div id="fullnote-insert">
    <?php
        require "fullnoteside.php";
    ?>
</div>
<!-- <div class="bgdec" id="background-decoration"></div> -->
<div class="bgdec" id="background-decoration0"></div>
<div class="bgdec" id="background-decoration1"></div>


<?php
    require "footer.php";
?>



<!-- not a necessary feature --- Clicking on a note's category allows you to change it to a different one. This should be done as a dropdown list. -->
<!-- not a necessary feature --- add in multi category select -->
<!-- not a necessary feature --- Ability to add photos to notes? -->
<!-- The notes come in floating up from the bottom  -->
<!-- Using LIMIT in sql it would be easy to only return a certain amount of notes per load - and load more later -->
<!-- The category selector looks rather bad in lightmode and borders aren't enough -->
<!-- Add the option to place the footer as a sidebar on the left / combine with tv layout maybe -->
<!-- An empty archive displays the wrong message BUG -->
<!-- Perhaps the ability to insert html in a note can be a strength instead of a bug? -->
<!-- Set a min height for the sidebar and test it on less tall displays -->
<!-- Would it be possible for you to make the table per user upgrade? -->
<!-- Active category styling -->
<!-- A button for switching the side on which the sidebar appears -->
<!-- Add a character counter in fullnotes?, a, b, i tags. -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- Sorting, lightmode switch, the sign up -->
<!-- animations, mobile responsive, -->
<!-- Deploy on heroku -->
<!-- Category delete full refresh, lightmode switch, layout switch -->
<!-- ======================================================== -->

<div class="bgdec" id="background-decoration"></div>

<!-- 
    CREATE TABLE notes (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    createdBy TINYTEXT NOT NULL,
    noteTitle TINYTEXT NOT NULL,
    noteText LONGTEXT,
    noteSubText LONGTEXT,
	created DATETIME NOT NULL,
    lastModified DATETIME NOT NULL
);

    ALTER TABLE notes
    ADD category TINYTEXT NOT NULL,
    ADD allCategories TINYTEXT
;

    ALTER TABLE `notes` 
    DROP `allCategories`
;
 -->

 <!-- 
    Sort by:
    Last modified (default)
    First created / reverse
    By title alphabetically / reverse
    By text length?
    

  -->