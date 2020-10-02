<div class="sidebar-container">

    <!-- ======================================================================== -->

<div id="search">
    <input type="text" name="searchbox" placeholder="Search..." id="searchbox" autocomplete="off">
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

<div class="categories-container">
    <div class="inner-categories-container">
        <a class='category c-all'>All</a>
        <script>
            $(document).ready(function () {
                $(".c-all").click(function (e) { 
                    $.get("innernotes.php",
                        function(data, status) {
                        $("#notes-main-section").html(data);
                    })
                });
            });
        </script>

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

    <!-- ======================================================================== -->

<div class="dropdown-category-select">
    <label for="select-category-dropdown">Category:</label>
    <select name="" id="select-category-dropdown">
        <option id="cio-1" class="category-in-options cio-1">All</option>
        <script>
            $(document).ready(function () {
                $(".cio-1").click(function (e) { 
                    // window.location = "notes.php";
                    $.get("innernotes.php",
                        function(data, status) {
                        $("#notes-main-section").html(data);
                    })
                });
            });
        </script>
        <?php 
        foreach ($categoryArr as $aCategory) {
            echo "<option class='category-in-options' style='color: " . $aCategory['color'] . ";'>" . $aCategory['categoryName'] . "</option>";
            ?>
                <script>
                    $(document).ready(function () {
                        $('#select-category-dropdown').on('change', function() {
                            var value = $(this).val();
                            $.get("innernotes.php?categoryname=" + value, function(data, status) {
                                $("#notes-main-section").html(data);
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
                $.get("includes/notes.inc.php?sort=" + result, {
                },function(data, status) {
                    $("#notes-main-section").html(data);
                })
            })
        });
    </script>
</div>

    <!-- ======================================================================== -->

<div class="new-category">
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

    <!-- ======================================================================== -->

<div id="delete-category">
    <select id="category-to-delete" name="category">
            <option value=""></option>
        <?php 
            foreach ($categoryArr as $aCategory) {
                if ($aCategory['categoryName'] !== "unsorted") {
                    echo "<option class='category-in-options' style='color: " . $aCategory['color'] . ";' value=" . $aCategory['categoryName'] . ">" . $aCategory['categoryName'] . "</option>";  
                }
            }
        ?>
    </select>
    <button id="deleteCategory">Delete Selected <br> Category</button>
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
                    }
                });
            });
        });
    </script>
</div>

    <!-- ======================================================================== -->

<div id="toggles">
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
        if (false) {
            ?> <a class='a-btn-off' href="#"><b>Darkmode</b><i></i><div></div></a> <?php
        }
        else {
            ?> <a class='a-btn-on' href="#"><b>Darkmode</b><i></i><div></div></a> <?php
        }
    ?>            
</div>

    <!-- ======================================================================== -->

<form action="includes/logout.inc.php" method="POST" id="logout">
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


</div>
