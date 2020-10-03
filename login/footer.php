

    <footer>
        <div id="search">
            <input type="text" name="searchbox" id="searchbox-b" placeholder="Search..." autocomplete="off">
        </div>
        <script>
            $(document).ready(function () {
                var width = $( window ).width();
                if (width < 1481) {
                    $("#searchbox-b").keyup(function (e) { 
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
                }
            });
        </script>
        <!-- ======================================================================== -->
        <form action="includes/logout.inc.php" method="POST" id="logout-b">
            <button type="submit" name="logout-submit">Log Out</button>
            <div id="permissions">
                <?php
                    if ($adminPermissions === true) {
                        echo "<span>User Class - Admin</span>";
                    }
                    else {
                        echo "<span>Signed in as: " . $_SESSION['userUid'] . "</span>";
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
                    ?><a class="a-btn-on" href="notes.php"><b>Archiving mode</b><i></i><div></div></a> <?php
                }
                else {
                    ?><a class="a-btn-off" href="archive.php?a"><b>Archiving mode</b><i></i><div></div></a> <?php
                }

                if ($archiveView === false) {
                    ?> <a class='a-btn-off' href="archivednotes.php?b"><b>Archived notes</b><i></i><div></div></a> <?php
                }
                else {
                    ?> <a class='a-btn-on' href="notes.php"><b>Archived notes</b><div></div></a> <?php
                }
                if (true) {
                    ?> <a class='a-btn-off' href="#"><b>Lightmode</b><i></i><div></div></a> <?php
                }
                else {
                    ?> <a class='a-btn-on' href="#"><b>Lightmode</b><i></i><div></div></a> <?php
                }
            ?>            
        </div>
        <!-- ======================================================================== -->
        <form id="category">
            <select id="category-to-delete-b" name="category">
                    <option value=""></option>
                    <?php 
                        foreach ($categoryArr as $aCategory) {
                            if ($aCategory['categoryName'] !== "unsorted") {
                                echo "<option class='category-in-options' style='color: " . $aCategory['color'] . ";' value=" . $aCategory['categoryName'] . ">" . $aCategory['categoryName'] . "</option>";  
                            }
                        }
                    ?>
            </select>
            <button id="deleteCategory-b">Delete Selected <br> Category</button>
        </form>

    </footer>
</body>
</html>

<!-- Signout, color switch, archive switch, archive page,  -->