<?php

namespace views;

require_once 'View.php';
require_once(ROOT.'/src/views/layouts/indexLayout.php');

class indexView extends View{
    public  function render($data = []){
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