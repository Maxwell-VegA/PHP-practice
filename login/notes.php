<?php
    require "header.php";
    // require "includes/notes.inc.php";
    require "includes/search.inc.php";
    require "includes/categories.inc.php";

    if ($auth === false) {
        header("Location: login.php");
    }

    $editingMode = false;
    $archiveView = false;
    $showNewNote = true;
    // $notesFound = true;

?>

<?php require "notesnav.php"; ?>

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



<!-- move date up to the category line and view full note can take the full with of the note card -->
<!-- not a necessary feature --- If a note has subtext display a hoverable "s" or an "i" on the card which will show the subtext -->
<!-- The delete toggle may be done using JS -->
<!-- Create a simple toggle for switching between five and three rows on desktop (perhaps place it in the footer) -->
<!-- not a necessary feature --- Clicking on a note's category allows you to change it to a different one. This should be done as a dropdown list. -->
<!-- not a necessary feature --- add in multi category select if it isn't too hard -->
<!-- not a necessary feature --- Ability to add photos to notes? -->
<!-- not a necessary feature --- Options for how to sort categories -->
<!-- create note categories aren't showing up when I'm sorting by a certain category. When in a category that category should be the default for a new note -->
<!-- Create a section for a constant message stream that archives anything older than a week? -->
<!-- The notes come in floating up from the bottom  -->
<!-- Using LIMIT in sql it would be easy to only return a certain amount of notes per load - and load more later -->

<!-- Remember that retro tv design idea? Where on the left side are a bunch of options and on the right there is a viewport into the scene. Could do something like that here. -->
<!-- All dropdown option doesn't work in chrome BUG-->
<!-- The category selector looks rather bad in lightmode and borders aren't enough -->
<!-- Add the option to place the footer as a sidebar on the left / combine with tv layout maybe -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- Sorting, lightmode switch, the footer, the sign up, delete categories -->
<!-- Search, animations, mobile responsive, button lamps gradient/glowing  -->
<!-- Get this thing to a point where it's usable -->
<!-- Deploy on heroku -->
<!-- ======================================================== -->

<!-- <div class="bgdec" id="background-decoration"></div> -->

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