<?php
    require "header.php";
    require "includes/categories.inc.php";
    if ($auth === false) {
            header("Location: login.php");
    }
    else {
        if(isset($_GET['note'])) {
            $noteId = $_GET['note'];
            require "includes/notes.inc.php";
        }
        else {
            header("Location: notes.php");
            exit();
        }
    }

    



?>

<main id="fullnote">
<?php
    foreach ($noteArr as $note) {
        $title   = $note['noteTitle'];
        
        if (!isset($_GET['error'])) {
            $text    = $note['noteText'];
            $subText = $note['noteSubText'];
        }
        elseif ($_GET['error'] === "emptytitle") {
            $text    = $_GET['notetext'];
            $subText = $_GET['notesubtext'];
        }
        ?> 
        <div class="full-note"> 
            <form action="includes/modifynote.inc.php?note=<?php echo $_GET['note']; ?>" method="POST" autocomplete="off">
                
        <?php
        echo "<input type='text' name='noteTitle' maxlength='40' required placeholder='Title' value='"  . $title    . "'>";
        echo "<textarea type='text' name='noteText' placeholder='Note text'>"                           . $text     . "</textarea>";
        echo "<textarea type='text' name='noteSubText' placeholder='Hidden text'>"                      . $subText  . "</textarea>";
        echo "" . $note['lastModified'] . "";
        ?>
                <select name="categoryAndColor">
                    <?php
                    echo "<option class='category-in-options'" . " style='color: " . $note['categoryColor'] . ";' value='" . $note['category'] . "," . $note['categoryColor'] . "'>" . $note['category'] . "</option>";
                    foreach ($categoryArr as $aCategory) {
                        if ($note['category'] != $aCategory['categoryName']) {
                            echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <button type="submit" name="saveNote">Save</button>
            </form>
        <a href="includes/archivenote.inc.php?note=<?php echo $note['id']; ?>&update=archived">Archive</a>
        <a href="includes/deletenote.inc.php?note=<?php echo $note['id']; ?>&update=deleted">Delete</a>
        <a href="notes.php?update=discarded">Return</a>
        </div> <!-- closes the full-note div --> 
        <?php
    }
?>
<!-- return without saving. JS alert asking are you sure, don't ask me again -->
</main>    
</body>
</html>