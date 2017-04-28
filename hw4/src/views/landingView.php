<?php

namespace mn\hw4\views;

require_once 'View.php';

class landingView extends View {
    public function __construct($logger, $layout) {
        parent::__construct($logger, $layout);
        $logger->info('Visited landing page');
    }
    public function render($data = []){

        ?>
            <h1><a href="index.php">Web Sheets</a></h1>
            <form method="get" id="formID">
                <input type="hidden" name="c" value="api">
                <input type="hidden" name="m" value="edit">
                <input type="text" name = "arg1" id="sheetID" placeholder="New sheet name or code" maxlength="30"/>
                <input type="submit" value="Go" onclick="return verify();"/>
            </form>
            <script type="text/javascript">
                function verify(){
                    var regEx = /^([0-9]|[a-z])+([0-9a-z]+)$/i;
                    var sheetID = document.getElementById("sheetID").value;
                    if(!sheetID){
                        alert("Enter in a sheet name or code!");
                        return false;
                    }
                    else if(!regEx.test(sheetID)){
                        alert("Enter in a valid alphanumeric sheet name or code!");
                        return false;
                    }
                    //else will submit form
                }
            </script>
        <?php
    }
}