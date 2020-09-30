

    <footer>
        <div id="search">
            <span>Search notes:</span>
            <!-- <label for="searchByTitle">title</label>
            <input type="checkbox" name="searchByTitle" id="searchByTitle">
            <label for="searchByText">text</label>
            <input type="checkbox" name="searchByText" id="searchByText"> -->
            <input type="text" name="searchbox" id="searchbox">
        </div>
        <script>
            $(document).ready(function () {
                $("#searchbox").keyup(function (e) { 
                    var input = $(this).val();
                    if (input.length > -1) {
                        $.ajax({
                            type: "post",
                            url: "innernotes.php",
                            data: {search:input},
                            dataType: "text",
                            success: function (data) {
                                $('#notes-main-section').html(data);
                            }
                        });
                    }
                });
            });
        </script>
        <!-- ======================================================================== -->
        <form action="includes/logout.inc.php" method="POST" id="logout">
            <button type="submit" name="logout-submit">Log Out</button>
            <div id="permissions">
                <?php
                    if ($adminPermissions === true) {
                        echo "<span>User Class - Admin</span>";
                    }
                    else {
                        echo "<span>User Class - User</span>";
                    }
                ?>
            </div>
        </form> 
        <!-- ======================================================================== -->
        <div id="darkmode">
            <?php
                if ($darkmode === true) {
                    echo "<button>Darkmode</button>";
                }
                else {
                    echo "<button>Lightmode</button>";
                }
                // darkmode is warm, lightmode is cool
                // if user darkmode = d {require darkmode.sass}
                // All buttons have a kind of glowing bar underneeth them which activates when they are toggled
            ?>
        </div>  
        <!-- ======================================================================== -->
        <div id="archive">
            <?php
                if ($editingMode === true) {
                    ?> <a href="notes.php">Archiving mode: on</a> <?php
                    // The exit btn should likely be highlighted when in archiving mode
                }
                else {
                    ?> <a href="archive.php?a">Archiving mode: off</a> <?php
                }
                if ($archiveView === false) {
                    ?> <a href="archivednotes.php?b">Viewing: active notes</a> <?php
                }
                else {
                    ?> <a href="notes.php">Viewing: archived notes</a> <?php
                }

?>

            
        </div>
        <!-- ======================================================================== -->
        <!-- <form action="includes/deletecategory.inc.php" id="category" method="POST"> -->
        <div>
            <select id="category-to-delete" name="category">
                <?php 
                    foreach ($categoryArr as $aCategory) {
                        if ($aCategory['categoryName'] !== "unsorted") {
                            echo "<option class='category-in-options' style='color: " . $aCategory['color'] . ";' value=" . $aCategory['categoryName'] . ">" . $aCategory['categoryName'] . "</option>";  
                        }
                    }
                ?>
            </select>
            <button id="deleteCategory">Delete Selected Category</button>
            <script>
                $(document).ready(function () {
                    selectedCategory = "";
                    $(".category-in-options").click(function (e) { 
                        // Change the underline of the delete button to an active state
                    });
                    $('#deleteCategory').click(function (e) {
                        var selectedCategory = $("#category-to-delete").val();
                        $.ajax({
                            type: "POST",
                            url: "includes/deletecategory.inc.php",
                            data: {category:selectedCategory},
                            dataType: "text",
                            success: function (response) {
                                var input = "";
                                $.ajax({
                                    type: "post",
                                    url: "innernotes.php",
                                    data: {search:input},
                                    dataType: "text",
                                    success: function (data) {
                                        $('#notes-main-section').html(data);
                                    }
                                });
                                // That manages to update the main section however the navigation and footer should be updated as well somehow.
                            }
                        });
                    });
                });
            </script>
        </div>
        <!-- </form> -->
    </footer>
</body>
</html>

<!-- Signout, color switch, archive switch, archive page,  -->