

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
        <div class="options-logout-container">
            <button id="options-btn">Options</button>
<!-- on click change archive from display none to display some -->
            <script>
                $(document).ready(function () {
                    var optionsOpen = false;
                    $("#options-btn").click(function (e) { 
                        if (optionsOpen === false) {
                            $("#archive").css({
                                'display': 'grid'
                            });
                            $("#options-btn").toggleClass("options-btn-active");
                            optionsOpen = true;
                        }
                        else {
                            $("#archive").css({
                                'display': 'none'
                            });
                            $("#options-btn").toggleClass("options-btn-active");
                            optionsOpen = false;
                        }
                    });
                });
            </script>
            <form action="includes/logout.inc.php" method="POST" id="logout-b">
                <button type="submit" name="logout-submit">Log Out</button>
            </form> 
        </div>
        <!-- ======================================================================== -->
        <div id="archive">
            <?php
                if ($editingMode === true) {
                    ?><a class="a-btn-on" href="notes.php"><b>Archiving mode</b><i></i><div></div></a> <?php
                }
                else {
                    ?><a class="a-btn-off" href="notes.php?a"><b>Archiving mode</b><i></i><div></div></a> <?php
                }

                if ($archiveView === false) {
                    ?> <a class='a-btn-off' href="notes.php?b"><b>Archived notes</b><i></i><div></div></a> <?php
                }
                else {
                    ?> <a class='a-btn-on' href="notes.php"><b>Archived notes</b><div></div></a> <?php
                }
                if ($_SESSION['darkmode'] === 'd') {
                    ?> <a class='a-btn-on' href="includes/togglecolor.inc.php"><b>Golden night</b><i></i><div></div></a> <?php
                }
                else {
                    ?> <a class='a-btn-on' href="includes/togglecolor.inc.php"><b>Fuschia light</b><i></i><div></div></a> <?php
                }
            ?>            
        </div>
        <!-- ======================================================================== -->
        <form id="category" action="includes/deletecategory.inc.php" method="POST">
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