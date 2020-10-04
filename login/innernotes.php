<?php
    // if (isset($_GET['categoryname'])) {
        // header("href='notes.php?categoryname=" . $_GET['categoryname']);
        // exit();
    // }
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($archiveView)) {
        $archiveView = false;
    }
    
    $notesFound = true;
    $searchStrLength = 0;
    if (!$archiveView) {
        if (isset($_POST['search'])) {
            $searchStrLength = strlen($_POST['search']);
            if ($searchStrLength > 0) {
                require "includes/search.inc.php";
            }
            else {
                require "includes/notes.inc.php";
            }
        }
        else {
            require "includes/notes.inc.php";
        }
    }

    if (isset($_GET['a'])) {
        $editingMode = true;
        $archiveView = false;
    }
    elseif (isset($_GET['b'])) {
        $editingMode = false;
        $archiveView = true;
    }
    else {
        $editingMode = false;
        $archiveView = false;

    }
    if (isset($_GET['categoryname'])) {
        $category = $_GET['categoryname'];
        ?>
            <script>
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "newnote.php",
                        data: {sortingByCategory:'<?php echo $category ?>'},
                        dataType: "text",
                        success: function (response) {
                            $('main').html(response);
                        }
                    });
                });
            </script>       
        <?php        
    }
    else {
        ?>
            <script>
                $(document).ready(function () {
                    $.ajax({
                        type: "post",
                        url: "newnote.php",
                        data: {sortingByCategory:'all'},
                        dataType: "text",
                        success: function (response) {
                            $('main').html(response);
                        }
                    });
                });
            </script>       
        <?php        
    }

?>

    

<?php 
    if ($editingMode === false && $archiveView === false) {
        ?> <div class="span3"></div> <?php
    }
?>

<?php
    if ($notesFound === false) {
        echo "no notes found";
    }
    elseif ($showNotes === false) {
        echo "Notes will be displayed here. <br> Create one to get started!";
    }
    elseif (empty($noteArr)) {
        echo "Category empty!";
    }
    else {
        $index = 0;
        foreach ($noteArr as $note) {
            $noteTextLength = strlen($note['noteText']);
            if ($noteTextLength > 0 && $noteTextLength <= 200) {
                $spanRows = 'span3';
            }
            elseif ($noteTextLength > 200 && $noteTextLength <= 410) {
                $spanRows = 'span4';
            }
            elseif ($noteTextLength > 410 && $noteTextLength <= 540) {
                $spanRows = 'span5';
            }           
            elseif ($noteTextLength > 540) {
                $spanRows = 'span6';
            }      
            elseif ($noteTextLength === 0) {
                $spanRows = 'span2';
            }
            else {
                $spanRows = 'span3';
            }

            if ($editingMode === false) {
                $borderClass = "borderFalse";
            }
            elseif ($editingMode === true) {
                $borderClass = "borderTrue";
            }

            if ($note['pinned'] === 'yes') {
                // $notePinned = true;
                $pinnedTitle = 'pinned-title';
            }
            else {
                // $notePinned = false;
                $pinnedTitle = '';
            }

            $dateSrc = date_parse($note['lastModified']);
            $date = $dateSrc['day'] . "/" . $dateSrc['month'] . "/" . $dateSrc['year'];

            echo "<div id='open-fn-" . $note['id'] . "' class='note-container $spanRows $borderClass'>";
            echo "<h2 class='i-title " . $pinnedTitle . "'>" . $note['noteTitle'] . "</h2>";
            echo "<p class='i-text'>" . $note['noteText'] . "</p>";
            // =====
            echo "<b class='i-options' id='card$index'>"      . "..." . "</b>"; 
            ?>
            <div class="expanded-options">
                <button>Pin</button>
                <button>Archive</button>
                <button>Delete</button>
            </div>
            <?php
            // =====
            echo "<span class='i-date'>" . $date . "</span>";
            echo "<div class='i-category'><i style='border-color: " . $note['categoryColor'] . ";'>" . $note['category'] . "</i></div>";
            if ($editingMode === false && $archiveView === false) {
                ?> 
                <b><a class='i-btn' href="fullnote.php?note=<?php echo $note['id']; ?>">View note</a></b>
                <!-- <b><a class='i-btn' id="open-fn-<?php echo $note['id']; ?>">View full note</a></b> -->
                <script>
                    $(document).ready(function () {
                        $("#open-fn-<?php echo $note['id']; ?>").click(function (e) { 
                            $.ajax({
                                type: "get",
                                url: "fullnoteside.php",
                                data: {note:<?php echo $note['id']; ?>},
                                dataType: "text",
                                success: function (response) {
                                    $('#fullnote-insert').html(response);
                                }
                            });
                        });
                    });
                </script>
                <?php
            }
            elseif ($editingMode === true) {
                ?> <b><a class='i-btn' href="includes/archivenote.inc.php?note=<?php echo $note['id']; ?>">Archive note</a></b><?php
            }
            elseif ($archiveView === true) {
                ?> <b><a class='i-btn' href="includes/archivenote.inc.php?note=<?php echo $note['id'];?>&restore=true">Restore note</a></b><?php
            }
            ?>
                <script>
                    $(document).ready(function () {
                        $('#card<?php echo $index; ?>').click(function (e) { 
                            // This will open a menu. Before I get into opening it I should probably create it and restyle the card template in css.
                        });
                    });
                </script>
            <?php
            ?> </div> <?php

            $index++;
        }
    }
?>
<?php 
    if ($editingMode === false && $archiveView === false) {
        ?> <div class="span3"></div> <?php
    }