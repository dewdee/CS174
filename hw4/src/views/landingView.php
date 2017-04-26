<?php

namespace mn\hw4\views;

require_once 'View.php';

class landingView extends View {
    public function render($data = []){
        ?>
            <h1><a href="index.php">Web Sheets</a></h1>
            <form method="get" id="formID">
                <input type="hidden" name="c" value="main">
                <input type="hidden" name="m" value="edit">
                <input type="text" name = "arg1" id="sheetID" placeholder="New sheet name or code" maxlength="30"/>
                <input type="submit" value="Go" onclick="return verify();"/>
            </form>
            <script type="text/javascript">
                function verify(){
                    var sheetID = document.getElementById("sheetID").value;
                    if(!sheetID){
                        alert("Enter in a sheet name or code!");
                        return false;
                    }
                    //else will submit form
                }
            </script>
        <?php
    }
}