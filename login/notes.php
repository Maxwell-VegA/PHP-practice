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
    <div class="notes-leftside-options-container">
        <form action="includes/createcategory.inc.php" method="POST" autocomplete="off">
            <input type="text" name="newCategoryName" placeholder="New category..." maxlength="14">
            <label class="color-example" for="clr">color</label>
            <input id="clr" type="color" name="newCategoryColor" value="#8f8f8f">
            <button id="category-create-btn" type="submit" name="newCategorySubmit">Create</button>
            <script>
                $(document).ready(function () {
                    $("#clr").change(function (e) { 
                        var currentColor = $(this).val();
                        // console.log(currentColor);
                        $(".color-example").css("border-color", currentColor);
                    });
                });
            </script>
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
            }
            else {
                $index = 0;
                foreach ($categoryArr as $aCategory) {
                    // echo "<a class='category categoryBtn'" . " style='background-color: " . $aCategory['color'] . ";'" . "href='notes.php?categoryname=" . $aCategory['categoryName'] . "'>" . $aCategory['categoryName'] . "</a>";
                    $index++;
                    $cName = $aCategory['categoryName'];
                    echo "<a class='category categoryBtn categoryBtn$index' ";
                    echo "style='border-color: " . $aCategory['color'] . ";'>";
                    echo $cName;
                    echo "</a>";
                    echo "<script>var valueCategory$index = '$cName';</script>";
                    ?>
                        <script>
                            $(document).ready(function () {
                                $('.categoryBtn<?php echo $index ?>').click(function() {
                                    $.get("innernotes.php?categoryname=" + valueCategory<?php echo $index ?>, function(data, status) {
                                        $("#notes-main-section").html(data);
                                        // console.log(status);
                                    })
                                });
                            });
                        </script>
                    <?php
                }
            }
        
        ?>
        </div>
    </div>
    
    <div class="notes-rightside-options-container">
        <label for="select-category-dropdown">Category:</label>
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

        <label for="order-by">Order by:</label>
        <select name="" id="order-by">
            <option value="0">Last modified</option>
            <option value="1">Last created</option>
            <option value="2">First created</option>
            <option value="3">Alphabetically</option>
        </select>
        <script>
            $(document).ready(function () {
                $('#order-by').on('change', function() {
                    var result = $(this).val();
                    alert(result);
                    // current issue seems to be that the include isn't picking up the sort variable
                    $.post("includes/notes.inc.php", {
                        sort: result   
                    },function(data, status) {
                        $("#notes-main-section").html(data);
                    })

                })

            });
            // using the gets might cause conflicts to arise because one get is setting the sort and the category gets are ignoring it and reseting it to their own thing. We'll see.
        </script>
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
<!-- move date up to the category line and view full note can take the full with of the note card -->
<!-- a color theme picker in the top right of the nav bar -->
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
<!-- The all category is still reloding the whole page -->
<!-- When the all category is selected through the leftside dropdown menu it displays nothing - BUG -->
<!-- Create a section for a constant message stream that archives anything older than a week? -->
<!-- The delte categories and notes feature is to be implemented thusly - there is a switch which toggles the user's mode in a database and if the mode is turned on certain buttons will appear in the category taggs and on the notes. Note class - active / archived / deleted. The new design must integrate these buttons and gradient/glowing/animated aspects. Use the sidespace? -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- ======================================================== -->
<!-- Sorting, subtext hover, the fullnote page, change note category by clicking on it-->
<!-- ======================================================== -->

<!-- <div class="bgdec" id="background-decoration"></div> -->
<section id="notes-main-section">
    <?php
    require "innernotes.php";
    ?>
</section>
<div class="bgdec" id="background-decoration0"></div>
<div class="bgdec" id="background-decoration1"></div>

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

 <!-- 
    Sort by:
    Last modified (default)
    First created / reverse
    By title alphabetically / reverse
    By text length?
    

  -->