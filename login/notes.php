<?php
    require "header.php";
    require "includes/notes.inc.php";
    require "includes/categories.inc.php";

    if ($auth === false) {
            header("Location: login.php");
    }
?>

<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->

<header>
    <!-- <div class="notes-title-container">
        <h1 class="notes-title">Notes</h1>
    </div> -->
    <div class="notes-leftside-options-container">
        <form action="includes/createcategory.inc.php" method="POST" autocomplete="off">
            <label for="newCategoryName">New category:</label>
            <input type="text" name="newCategoryName" placeholder="Category Name" maxlength="14">
            <label for="newCategoryColor">Color:</label>
            <input type="color" name="newCategoryColor" value="#ff0000">
            <button type="submit" name="newCategorySubmit">Create</button>
        </form>
    </div>

    <div class="categories-bar-overlay">
        <div></div>
        <div class="categories-overlay-middle"></div>
        <div></div>
    </div>
    
    <div class="categories-container">
        <div class="inner-categories-container">
            <a class='category' href="notes.php">All</a>
        <?php 
            if ($showCategories === false) {
                echo "no categories";
                // figure out how to deal with the default unsorted category
            }
            else {
                foreach ($categoryArr as $aCategory) {
                    echo "<a class='category'" . " style='background-color: " . $aCategory['color'] . ";'" . "href='notes.php?categoryname=" . $aCategory['categoryName'] . "'>" . $aCategory['categoryName'] . "</a>";
                }
            }
        
        ?>
        </div>
    </div>
    
    <div class="notes-rightside-options-container">
    <!-- select from all categories -->
        <select name="" id="">
            <option class="category-in-options cio-1" >All</option>
            <?php 
            foreach ($categoryArr as $aCategory) {
                echo "<option class='category-in-options'" . " style='background-color: " . $aCategory['color'] . ";'>" . $aCategory['categoryName'] . "</option>";
            }
            ?>
        </select>
        <!-- 
            All categories.
            Sort by. 
            Color theme?
            Delete categories?
            Quick delete toggle.
            Trashed notes page.
        How do I make this as few clicks as possible? -->
    </div>
</header>

<!-- add a toggle which allows quickly deleting multiple notes from the main screen instead of going into the full note -->
<!-- Add a trash functionality so that notes are not deleted fully -->
<!-- All category names should be italicised -->
<!-- Categories will also need to be deleted somehow -->
<!-- simply fade out the category bar at some point (perhaps with the ability to horizontally scroll it) and then place a drop down menu with all categories -->
<!-- on the right (opposite to the "notes" title) a dropdown menu for creating new categories (category name - 14 char max - and a color picker) 
<input maxlength="14">
-->
<!-- move date up to the category line and view full note can take the full with of the note card -->
<!-- Sort by options (default - last modified) -->
<!-- a color theme picker in the top right of the nav bar -->
<!-- Remove the nav bar? Place what remains in the footer -->
<!-- Import fonts and import the normalize sass stylesheet (used in the shirt editor project) -->
<!-- We'll need to limit how wide the main notes section can get on big displays so that it doesn't get too overwhelming -->
<!-- If a note has subtext display a hoverable "s" or an "i" on the card which will show the subtext -->
<!-- Sublime notes -->
<!-- The slight issue with doing colors inline is that I can't change them later. Perhaps I can by updating the db. Would be better to do them as classes but that doesn't allow me infinate flexibility... -->
<!-- To delete categories create a toggle which shortens the 10000% width of the category container compressing them all into one window and then adding an x to the side for deleting -->
<!-- The delete toggle may be done using JS -->
<!-- Create a simple toggle for switching between five and three rows on desktop (perhaps place it in some settings section or in the footer) -->
<!-- Create a button for going straight into fullnote editing mode to create a new note so that it isn't necessary to first create a small note then edit it if you want to create a big nore straight from the beginning. -->
<!-- Clicking on a note's category allows you to change it to a different one -->
<!-- Consider how many of these features do you actually need to just push out a good looking portfolio project -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- expand -->
<!-- ======================================================== -->
<section>
    <form class="note-input span3" action="includes/createnote.inc.php" method="POST" autocomplete="off">
        <input type="text" name="noteTitle" placeholder="Note Title" maxlength="40" required>
        <textarea name="noteText" placeholder="Note text"></textarea>
        <input type="text" name="noteSubtext" placeholder="Note hidden text">
        <select name="categoryAndColor">
            <!-- <option class="category-in-options cio-1" value="Unsorted,#ff0000">Unsorted</option> -->
            <?php 
            foreach ($categoryArr as $aCategory) {
                echo "<option class='category-in-options'" . " style='background-color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" name="createNote">Log note!</button>
    </form>


<?php
    if ($showNotes === false) {
        echo "Notes will be displayed here. <br> Create one to get started!";
    }
    elseif (empty($noteArr)) {
        echo "Category empty!";
    }
    else {
        foreach ($noteArr as $note) {
            $noteTextLength = strlen($note['noteText']);
            if ($noteTextLength > 0 && $noteTextLength <= 140) {
                $spanRows = 'span3';
            }
            elseif ($noteTextLength > 140 && $noteTextLength <= 290) {
                $spanRows = 'span4';
            }
            elseif ($noteTextLength > 290 && $noteTextLength <= 440) {
                $spanRows = 'span5';
            }           
            elseif ($noteTextLength > 440) {
                $spanRows = 'span6';
                // append three dots at the place before the text becomes hidden
            }      
            elseif ($noteTextLength === 0) {
                $spanRows = 'span2';
            }
            else {
                $spanRows = 'span3';
            }
            echo "<div class='note-container $spanRows'>";
            echo "<h2>" . $note['noteTitle']    . "</h2>";
            echo "<p>"  . $note['noteText']     . "</p>";
            echo "<span>" . $note['lastModified'] . "</span>";
            echo "<div><i style='background-color: " . $note['categoryColor'] . ";'>" . $note['category'] . "</i></div>";
            ?> <b><a href="/php_practice/login/fullnote.php?note=<?php echo $note['id']; ?>">View full note</a></b> </div> <?php
        }
    }
?>
</section>

<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->

<?php
    require "footer.php";
?>

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