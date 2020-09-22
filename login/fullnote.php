<?php
    require "header.php";
    require "includes/categories.inc.php";
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
<main id="fullnote">
<?php
    foreach ($noteArr as $note) {
        ?> 
        <div class="full-note"> 
            <form action="includes/modifynote.inc.php" method="POST" autocomplete="off">
                <select name="" id="select-category-dropdown">
                    <option class="category-in-options cio-1" >All</option>
                    <?php 
                    foreach ($categoryArr as $aCategory) {
                        echo "<option class='category-in-options' style='background-color: " . $aCategory['color'] . ";'>" . $aCategory['categoryName'] . "</option>";
                        ?>
                            <script>
                                $(document).ready(function () {
                                    $('#select-category-dropdown').on('change', function() {
                                        var value = $(this).val();
                                        $.get("innernotes.php?categoryname=" + value, function(data, status) {
                                            $("#notes-main-section").html(data);
                                            console.log(status);
                                        })
                                    });
                                });
                            </script>
                        <?php
                    }
                    ?>
                </select>
            <br>
        <?php
        echo "<input type='text' name='noteTitle' value='" . $note['noteTitle']     . "'><br>";
        echo "<textarea type='text' name='noteText'>" . $note['noteText'] . "</textarea><br>";
        echo "<input type='text' name='noteSubText' value='" . $note['noteSubText']   . "'><br>";
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
</main>
<?php
    require "footer.php";
?>