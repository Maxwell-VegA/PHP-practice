<?php
    require "header.php";
    require "includes/categories.inc.php";

    if ($auth === false) {
        header("Location: login.php");
    }

    $searchStrLength = 0;

    require "includes/viewmodes.inc.php";

?>

<?php 
    require "notesnav.php"; 
?>
<main>
    <?php 
        if ($editingMode === true) {}
        elseif ($archiveView === true) {}
        else {
            // require "newnote.php";
        }
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
        require "includes/latestid.inc.php";
        $noteId = $row['id'];
    ?>
    <script>
    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "fullnoteside.php",
            data: {note:<?php echo $noteId ?>},
            dataType: "text",
            success: function (response) {
                $('#fullnote-insert').html(response);
            }
        });
    });
    </script>
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
<!-- not a necessary feature --- Using LIMIT in sql it would be easy to only return a certain amount of notes per load - and load more later -->
<!-- The category selector looks rather bad in lightmode and borders aren't enough -->
<!-- An empty archive displays the wrong message BUG -->
<!-- Set a min height for the sidebar and test it on less tall displays -->
<!-- Would it be possible for you to make the table per user upgrade? -->
<!-- Active category styling -->
<!-- A button for switching the side on which the sidebar appears -->
<!-- Hide the toggles in lg mode to reduce footer footprint -->
<!-- On login or first time load display a short loading screen consisting of a slide with the logo of the application sliding up -->
<!-- Research anti-aliasing -->
<!-- Either I try to fix order by or remove it -->
<!-- Fix the 1px offset on new note bottom (log note btn) -->
<!-- Will need to improve the behaviour of the options toggle on page reoload -->
<!-- Style header active states and responsive border widths -->
<!-- integrate variable shadows depending on time of day? -->
<!-- To wrap up I could mvoe all JS to a seperate file -->
<!-- When the options for a note are opened and then closed by opening them for a different note they will need to be double clicked to open again -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- Sorting, lightmode switch, the sign up -->
<!-- animations, mobile responsive, -->
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