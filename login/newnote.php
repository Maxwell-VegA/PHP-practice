<?php 
    require "includes/categories.inc.php";
    if(isset($_POST['sortingByCategory'])) {
        $category = $_POST['sortingByCategory'];
    }
        ?>
            <form class="note-input span3" action="includes/createnote.inc.php" method="POST" autocomplete="off">
                <input type="text" name="noteTitle" placeholder="Note Title" maxlength="40">
                <textarea name="noteText" placeholder="Note text"></textarea>
                <input type="text" name="noteSubtext" placeholder="Note hidden text">
                <select name="categoryAndColor">
                    <?php 
                    foreach ($categoryArr as $aCategory) {
                            if ($category !== "all") { 
                                if ($category === $aCategory['categoryName']) {
                                    echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                                }
                            }
                            elseif ($category === "all") {
                                echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                            }
                        }
                    if ($category !== "all") { 
                        foreach ($categoryArr as $aCategory) {
                            if ($category !== $aCategory['categoryName']) {
                                echo "<option class='category-in-options'" . " style='color: " . $aCategory['color'] . ";' value='" . $aCategory['categoryName'] . "," . $aCategory['color'] . "'>" . $aCategory['categoryName'] . "</option>";
                            }
                        }
                    }
                    ?>
                </select>
                
                <button type="submit" name="createNote">Log note!</button>
            </form>    
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>
    <div class="pointer-events-none"></div>