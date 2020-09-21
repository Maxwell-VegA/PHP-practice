<?php
    require "header.php";
    require "includes/todo.inc.php";

    if ($auth === false) {
            header("Location: login.php");
    }
?>
<!-- <script>
    $(document).ready(function () {
        $('#firstIn').click(function () { 
            var input = $('#firstIn').val();
            alert(input);
            
        });
    });
</script> -->

<h1>Your to-do list:</h1>

<form action="includes/newtodo.inc.php" method="POST" autocomplete="off">
    <p>Item name:</p>
    <input id="firstIn" type="text" name="entryTitle"  placeholder="Today I will...">
    <p>Entry description (optional):</p>
    <input type="text" name="entryContent" placeholder="Go for a walk if...">
    <!-- Perhaps I could add an optional "time when to do" -->
    <br>
    <br>
    <button type="submit" name="createEntry">Create item!</button>
</form>
<br>

<div class="todoItemsContainer">
<?php
    if ($showPosts === true) {
        foreach ($titlesAndContents as $value) {
            ?> 
            <br> 
            <div class='item-container'> 
            <?php
            echo $value['entryTitle'] . "<br>";
            echo $value['entryContent'] . "<br>";
            if ($value['completed'] != 0) {
            ?> <a href="/php_practice/login/includes/modifytodo.inc.php?action=incompleted&item=<?php echo $value['id']; ?>">unmark</a> <?php
            }
            else {
            ?> <a href="/php_practice/login/includes/modifytodo.inc.php?action=completed&item=<?php echo $value['id']; ?>">mark as completed</a> <?php
            }
            ?> 
            <a href="/php_practice/login/includes/modifytodo.inc.php?action=delete&item=<?php echo $value['id']; ?>">delete</a>


            </div> 
            <?php
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

<!-- Create search, date (now()) and tag functionalities for the notes part -->















<?php
    require "footer.php";
?>