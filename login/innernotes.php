<?php
    // if (isset($_GET['categoryname'])) {
        // header("href='notes.php?categoryname=" . $_GET['categoryname']);
        // exit();
    // }
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        require "includes/notes.inc.php";
    }
    // require "includes/notes.inc.php";
?>

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