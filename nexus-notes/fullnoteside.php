<?php
    require "includes/viewmodes.inc.php";
    if ($editingMode === false) {

    require "includes/categories.inc.php";
    if(isset($_GET['note'])) {
        $noteId = $_GET['note'];
        if ($noteId === 'new') {
            require "includes/latestid.inc.php";
            $redirect = $row['id'];
            header("Location: fullnoteside.php?note=$redirect");
        }
        else {
            require "includes/notes.inc.php";
        }
    }
    else {
        require "includes/latestid.inc.php";
        $noteId = $row['id'];
        // $noteId = 41;
    }
    if (isset($_GET['last'])) {
        echo "last";
    }

    // require "includes/latestid.inc.php";
    // $noteId = $row['id'];


    // if(isset($_GET['new'])) {

    // }

?>
<div id="fullnote-sidebar">
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
        $dateSrc = date_parse($note['lastModified']);
        $date = $dateSrc['day'] . "/" . $dateSrc['month'] . "/" . $dateSrc['year'];
        // if ($date === $today) {
        //     $date = "today";
        // }

        ?> 
        <div class="full-note"> 
            <form action="includes/modifynote.inc.php?note=<?php echo $_GET['note']; ?>" method="POST" autocomplete="off">
                
        <?php
        echo "<input type='text' name='noteTitle' maxlength='40' required placeholder='Title' value='" . $title . "'>";
        echo "<textarea id='text' type='text' name='noteText' placeholder='Note text'>" . $text . "</textarea>";
        echo "<textarea id='subtext' type='text' name='noteSubText' placeholder='Hidden text'>" . $subText . "</textarea>";
        echo "<i>Last edited: " . $date . "</i>";
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
                <button id="save-btn" type="submit" name="saveNote">Save</button>
                <div>
                    <?php 
                    if ($note['pinned'] === "yes") {
                        $pinYN = "no";
                        $pinValue = "Unpin";
                    }
                    else {
                        $pinYN = "yes";
                        $pinValue = "Pin";
                    }
                    ?>
                    <a href="includes/archivenote.inc.php?note=<?php echo $note['id']; ?>&update=archived">Archive</a>
                    <a href="includes/deletenote.inc.php?note=<?php echo $note['id']; ?>&update=deleted">Delete</a>
                    <a href="includes/pinnote.inc.php?note=<?php echo $note['id'] ?>&pinNote=<?php echo $pinYN ?>"><?php echo $pinValue ?></a>
                </div>
            </form>
        </div> <!-- closes the full-note div --> 
        <?php
    }
?>
<!-- return without saving. JS alert asking are you sure, don't ask me again -->
</div>    

<?php }