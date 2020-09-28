<?php
    require "header.php";
    require "includes/notes.inc.php";
    require "includes/categories.inc.php";

    if ($auth === false) {
        header("Location: login.php");
    }

    $editingMode = false;
    $archiveView = false;
    $showNewNote = true;

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
<!-- Sublime notes / Nexus -->
<!-- The delete toggle may be done using JS -->
<!-- Create a simple toggle for switching between five and three rows on desktop (perhaps place it in the footer) -->
<!-- Create a button for going straight into fullnote editing mode to create a new note so that it isn't necessary to first create a small note then edit it if you want to create a big nore straight from the beginning. -->
<!-- Clicking on a note's category allows you to change it to a different one. This should be done as a dropdown list. -->
<!-- add in the html date picker thing somewhere to showcase your ability there perhaps? on the fullnote section?-->
<!-- not a necessary feature --- add in multi category select if it isn't too hard -->
<!-- figure out a relevant way to order those categories. The best would likely be sorting by the latest categories that were used on a note. -->
<!-- Do some research to see what it would take to add a search function (this is a low priority feature) -->
<!-- I probably should create that pin function -->
<!-- create note categories aren't showing up when I'm sorting by a certain category. When in a category that category should be the default for a new note -->
<!-- When the all category is selected through the leftside dropdown menu it displays nothing - BUG -->
<!-- Create a section for a constant message stream that archives anything older than a week? -->
<!-- The delte categories and notes feature is to be implemented thusly - there is a switch which toggles the user's mode in a database and if the mode is turned on certain buttons will appear in the category taggs and on the notes. Note class - active / archived / deleted. The new design must integrate these buttons and gradient/glowing/animated aspects. Use the sidespace? -->
<!--  change note category by clicking on it -->
<!-- The notes come in floating up from the bottom  -->
<!-- How hard would it be to integrate a search functionality? -->
<!-- Wouldn't be very hard to add pinning. Simply add an order by and a 1 or 0 pinned column in the db. Add an options button on the note card for these things - pin, archive, delete, change category, . -->
<!-- not a necessary feature --- Ability to add photos to notes? -->
<!-- Remember that retro tv design idea? Where on the left side are a bunch of options and on the right there is a viewport into the scene. Could do something like that here. -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- Sorting, the fullnote page, archived page, archiving switch, lightmode switch, the footer, the sign up  -->
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