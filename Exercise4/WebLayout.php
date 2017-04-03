<?php
//WebLayout.php
require_once "layout.php";

class WebLayout extends layout
{
    public function renderHeader($data){
    	?>
    		<!DOCTYPE html>
    		<head>
                <title><?php 
                    if(!empty($data['title'])){
                        echo $data['title'];
                        }
                    ?>
                </title>
            </head>
            <body>   
    	<?php
    }
    public function renderFooter($data){
    	?>
    		</p>
    		</body>
    		</html>
    	<?php
    }
}