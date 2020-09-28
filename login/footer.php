

    <footer>
        <form action="search.inc.php" id="search">
            <span>Search by:</span>
            <label for="searchByTitle">title</label>
            <input type="checkbox" name="searchByTitle" id="searchByTitle">
            <label for="searchByText">text</label>
            <input type="checkbox" name="searchByText" id="searchByText">
            <input type="text" id="searchbox">
        </form>
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
        <form action="deletecategory.inc.php" id="category">
            <!-- dropdown category selector, -->
            <select name="" id=""></select>    
            <input type="submit" name="delete category" id="">
        </form>
    </footer>
</body>
</html>

<!-- Signout, color switch, archive switch, archive page,  -->