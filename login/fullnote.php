<?php
    require "header.php";

    if ($auth === false) {
            header("Location: login.php");
    }
    if(isset($_GET['note'])) {
        $noteId = $_GET['note'];
        require "includes/notes.inc.php";
        

    }
    else {
        header("Location: notes.php");
        exit();
    }
?>

<?php
    foreach ($noteArr as $note) {
        ?> 
        <div class="full-note"> 
            <form action="includes/modifynote.inc.php" method="POST" autocomplete="off">
            <select name="category">
                <option value="ideas">Ideas</option>
                <option value="meditations">Meditations</option>
                <option value="recipies">Recipies</option>
            </select>
            <br>
        <?php
        echo "<input type='text' name='noteTitle' value='" . $note['noteTitle']     . "'><br>";
        echo "<input type='text' name='noteTitle' value='" . $note['noteText']      . "'><br>";
        echo "<input type='text' name='noteTitle' value='" . $note['noteSubText']   . "'><br>";
        echo "" . $note['lastModified'] . "<br>";
        echo "" . $note['category']     . "<br>";
        ?> <button type="submit" name="saveNote">Save</button>
        </form><?php
        echo "<br>";
        ?> <a href="/php_practice/login/includes/modifynote.inc.php?action=delete&note=<?php echo $note['id']; ?>">Delete</a> </div> <?php
    }
?>
<!--
    make the whole page a form and the save button a submit button. The actual text is placed inside the form as value

    <a href="/php_practice/login/includes/modifynote.inc.php?action=save&note=<?php echo $note['id']; ?>">Save</a> 
-->

<?php
    require "footer.php";
?>