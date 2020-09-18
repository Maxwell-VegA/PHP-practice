<?php
    require "header.php";
    require "includes/todo.inc.php";

    if ($auth === false) {
            header("Location: login.php");
    }
?>

<h1>Your to-do list:</h1>

<form action="includes/newtodo.inc.php" method="POST">
    <p>Item name:</p>
    <input type="text" name="entryTitle" placeholder="Today I will...">
    <p>Entry description (optional):</p>
    <input type="text" name="entryContent" placeholder="Go for a walk if...">
    <!-- Perhaps I could add an optional "time when to do" -->
    <br>
    <br>
    <button type="submit" name="createEntry">Create item!</button>
</form>


<div class="todoItemsContainer">
<?php
    if ($showPosts === true) {
        foreach ($titlesAndContents as $value) {
            ?> <div class='anItem'> <?php
            foreach ($value as $v) {
                echo "<h3 class='itemTitle'>$v</h3>";
            }
            ?> </div> <?php
        }
    }
    else {
        echo "<span class='noItemsMsg'>Your to-do items will be displayed here.</span>";
    }
?>
</div>


<!-- delete entry, edit entry, complete entry (on click without some confirm btn, I wonder how would it be done without a reload?) -->

<!-- Perhaps a new table of entries should be created for each user -->

<!-- Theres an issue creating discription-less entries - check newtodo.inc.php -->

<!-- Create search and tag functionalities for the notes part -->















<?php
    require "footer.php";
?>

<!-- Perhaps we can add classes to the to-do items? Or should I leave that just for notes. -->