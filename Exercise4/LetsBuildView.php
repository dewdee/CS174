<?php
// LetsBuildView.php
require_once "view.php";

class LetsBuildView extends View
{
    public function render($data = []){
        ?>
            <h1><?php 
                    if(!empty($data['title'])){
                        echo $data['title'];
                        }?>
            </h1>
            <p><?php
                if(!empty($data['content'])){
                    echo $data['content'];
                }?>
                
        <?php
    }
}
