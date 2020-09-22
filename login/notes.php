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
            <label for="clr">Color:</label>
            <input id="clr" type="color" name="newCategoryColor" value="#ff0000">
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
        <br>
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
<!-- All category names should be italicised -->
<!-- move date up to the category line and view full note can take the full with of the note card -->
<!-- style the color picker -->
<!-- Perhaps I can deal with the category bacground color problem by simply aplying a darkening filter which will allow the white to always pop off -->
<!-- Sort by options (default - last modified) -->
<!-- a color theme picker in the top right of the nav bar -->
<!-- Remove the nav bar? Place what remains in the footer -->
<!-- Import fonts and import the normalize sass stylesheet (used in the shirt editor project) -->
<!-- We'll need to limit how wide the main notes section can get on big displays so that it doesn't get too overwhelming -->
<!-- If a note has subtext display a hoverable "s" or an "i" on the card which will show the subtext -->
<!-- Sublime notes -->
<!-- To delete categories create a toggle which shortens the 10000% width of the category container compressing them all into one window and then adding an x to the side for deleting -->
<!-- The delete toggle may be done using JS -->
<!-- Create a simple toggle for switching between five and three rows on desktop (perhaps place it in the footer) -->
<!-- Create a button for going straight into fullnote editing mode to create a new note so that it isn't necessary to first create a small note then edit it if you want to create a big nore straight from the beginning. -->
<!-- Clicking on a note's category allows you to change it to a different one -->
<!-- Consider how many of these features do you actually need to just push out a good looking portfolio project -->
<!-- add in the html date picker thing somewhere to showcase your ability there -->
<!-- not a necessary feature --- add in multi category select if it isn't too hard -->
<!-- Add scrolling buttons for the categories selector and figure out a relevant way to order those categories. The best would likely be sorting by the latest categories that were used on a note. -->
<!-- Do some research to see what it would take to add a search function (this is a low priority feature) -->
<!-- I probably should create that pin function -->
<!-- create note categories aren't showing up when I'm sorting by a certain category. When in a category that category should be the default for a new note -->
<!-- The all category is still reloding the whole page -->
<!-- A neumorphic inset bed for all the categories -->
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