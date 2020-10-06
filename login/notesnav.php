<header>
    <div class="notes-leftside-options-container">
        <form action="includes/createcategory.inc.php" method="POST" autocomplete="off">
            <input type="text" name="newCategoryName" placeholder="New category..." maxlength="14">
            <label class="color-example" for="clr-b">color</label>
            <input id="clr-b" type="color" name="newCategoryColor" value="#ffffff">
            <button id="category-create-btn-b" type="submit" name="newCategorySubmit">Create</button>
            <script>
                $(document).ready(function () {
                    $("#clr-b").change(function (e) { 
                        var currentColor = $(this).val();
                        // console.log(currentColor);
                        $(".color-example").css("border-color", currentColor);
                    });
                });
            </script>
        </form>
    </div>

    <!-- <div class="categories-bar-overlay">
        <div></div>
        <div class="categories-overlay-middle"></div>
        <div></div>
    </div> -->
    
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
    
    <div class="notes-rightside-options-container">
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
                    // alert("includes/notes.inc.php?sort=" + result);
                    // current issue seems to be that the include isn't picking up the sort variable

                    $.get("includes/notes.inc.php?sort=" + result, {
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