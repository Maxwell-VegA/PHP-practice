<?php
    // if (isset($_GET['categoryname'])) {
        // header("href='notes.php?categoryname=" . $_GET['categoryname']);
        // exit();
    // }
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        require "includes/notes.inc.php";
    }


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
        if (!isset($showNewNote)) {
            $showNewNote = false;
            // Disabling the new note while under a category works but the optimal version would be to instead leave the new note there and auto set the category to the one the user is currently inside of.
        }
    }
    if (isset($_GET['categoryname'])) {
        $category = $_GET['categoryname'];
        require "includes/categories.inc.php";
    }

?>
<?php 
    if ($editingMode === false && $archiveView === false) {
        ?>
        <form class="note-input span3" action="includes/createnote.inc.php" method="POST" autocomplete="off">
            <input type="text" name="noteTitle" placeholder="Note Title" maxlength="40" required>
            <textarea name="noteText" placeholder="Note text"></textarea>
            <input type="text" name="noteSubtext" placeholder="Note hidden text">
            <select name="categoryAndColor">
                <?php 
                if ($showNewNote === true) {
                    foreach ($categoryArr as $aCategory) {
                        echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                    } 
                }
                elseif ($showNewNote === false) {
                    foreach ($categoryArr as $aCategory) {
                        if ($category === $aCategory['categoryName']) {
                            echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                        }
                    }
                }
                ?>
            </select>
            <button type="submit" name="createNote">Log note!</button>
        </form>    
        <?php 
    }
?>
    


<?php
    if ($showNotes === false) {
        echo "Notes will be displayed here. <br> Create one to get started!";
    }
    elseif (empty($noteArr)) {
        echo "Category empty!";
    }
    else {
        $index = 0;
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
            }      
            elseif ($noteTextLength === 0) {
                $spanRows = 'span2';
            }
            else {
                $spanRows = 'span3';
            }

            if ($editingMode === false) {
                $borderClass = "borderFalse";
            }
            elseif ($editingMode === true) {
                $borderClass = "borderTrue";
            }
            $index++;
            echo "<div class='note-container $spanRows $borderClass'>";
            echo "<h2>" . $note['noteTitle']    . "</h2>";
            echo "<b id='card$index'>"      . "..."                 . "</b>"; //archive, delete, pin, date created
            echo "<p>"      . $note['noteText']     . "</p>";
            echo "<span>"   . $note['lastModified'] . "</span>";
            echo "<div><i style='border-color: " . $note['categoryColor'] . ";'>" . $note['category'] . "</i></div>";
            if ($editingMode === false && $archiveView === false) {
                ?> <b><a href="fullnote.php?note=<?php echo $note['id']; ?>">View full note</a></b><?php
            }
            elseif ($editingMode === true) {
                ?> <b><a href="includes/archivenote.inc.php?note=<?php echo $note['id']; ?>">Archive note</a></b><?php
            }
            elseif ($archiveView === true) {
                ?> <b><a href="includes/archivenote.inc.php?note=<?php echo $note['id'];?>&restore=true">Restore note</a></b><?php
            }
            ?>
                <script>
                    $(document).ready(function () {
                        $('#card<?php echo $index; ?>').click(function (e) { 
                            e.preventDefault();
                            // This will open a menu. Before I get into opening it I should probably create it and restyle the card template in css.
                        });
                    });
                </script>
            <?php
            ?> </div> <?php
        }
    }
?>