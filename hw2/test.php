<?php

$activity = (isset($_REQUEST['a']) && in_array($_REQUEST['a'], 
	["main", "create", "edit", "save", "delete", "cancel", "read", "confirm"])) 
	? $_REQUEST['a'] . "Controller" : "mainController";
$activity();
function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';

}
/*
Controls all functionality of the main page
*/
function mainController(){
	$data["FILE_ENTRIES"] = [];
	$data["FILE_ENTRIES"] = getTextFiles($data["FILE_ENTRIES"]);
	//test purposes
	echo '<pre>'; print_r($data); echo '</pre>';
	$layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "landingView");
}
/*
Fetch all text files from subfolder /files/ and enter them into array
@param array $entries contains an empty array
*/
function getTextFiles($entries){
	$text_files = glob("text_files/*.txt");
	if(!empty($text_files)){
		foreach($text_files as $file_name){
			$name = basename($file_name, ".txt");
			$content = file_get_contents($file_name);
			$entries = array_merge([$name => $content], $entries);
		}
	}
    return $entries;
}
function createController(){
	$data["name"] = (isset($_GET['fileName'])) ? 
		filter_var($_GET['fileName'], FILTER_SANITIZE_STRING) : "";
	$content = "";
	$entries = [];
	$entries = getTextFiles($entries);
	if($data["name"] == "" || isset($entries[$data["name"]])){
		mainController();
		return $entries;
	}
	$entries = array_merge([$data["name"] => $content], $entries);
	//Open file, if it doesn't exist create new empty file
	$newFile = fopen("text_files/".$data["name"].".txt", "w");
	fclose($newFile);

	//Send data to editView
	$data["content"] = $entries[$data["name"]];
    $layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "editView");
}
/*
Determine if new text file was created. Create new file, and then add it to list of entries after editing.
*/
function editController(){
	$data["name"] = (isset($_GET['fileName'])) ? 
		filter_var($_GET['fileName'], FILTER_SANITIZE_STRING) : "";
	$entries = [];
	$entries = getTextFiles($entries);

	//Send data to editView
	$data["content"] = $entries[$data["name"]];
    $layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "editView");
}
function readController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ?
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
	$entries = [];
	$entries = getTextFiles($entries);
	if(!isset($entries[$data["name"]])){
		mainController();
		return;
	}
	$data["content"] = $entries[$data["name"]];
    $layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "readView");
}
function confirmController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ?
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";

	$layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "confirmView");
}
/*
Deals with all of the header information
*/
function htmlLayout($data, $view){
	?><!DOCTYPE html>
	<html>
	    <head><title>Simple Text Editor
	    <?php 
		    if(!empty($data['TITLE'])){
		    	echo ": " . $data['TITLE'];
		    }
	    ?></title></head>
		<body>
		<h1><a href="test.php">Simple Text Editor</a></h1>
		<?php
			$view($data);
		?>
		</body>
	</html><?php
}
/*
Draw main landing page with all of the file names, edit, delete, and create buttons
@param array $data has data of all files
*/
function landingView($data){
	?>
	<form method="get">
		<input type="hidden" name="a" value="create">
		<input type="text" name="fileName" placeholder="Text File Name" maxlength="20">
		<input type="submit" value="Create">
	<!--<button>Create</button>-->
	</form>

	<h2>My Files</h2>
	<table>
	<tr><th>Filename</th><th colspan="2">Actions</th></tr>
	<?php
    if(!empty($data["FILE_ENTRIES"])){
		foreach($data["FILE_ENTRIES"] as $name => $content){
            ?><div>
            	<tr>
	            	<td><a href="test.php?a=read&fileName=<?=urlencode($name)?>"><?=$name?></a></td>
					<td>
						<form method="get">
							<input type="hidden" name="a" value="edit">
							<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($name)?>">
							<input type="submit" value="Edit">
						</form>
					</td>
					<td>
						<form method="get">
							<input type="hidden" name="a" value="confirm">
							<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($name)?>">
							<input type="submit" value="Delete">
						</form>
					</td>
            	</tr>
            </div><?php
        }
    }
    ?>
	</table>
	<?php
}
function editView($data){
	?>
	<h2>Edit: <?php echo $data['name']; ?></h2>
	<div><button>Save</button><button>Return</button></div>
	<!-- <textarea> tag should be in the same line to prevent unwanted indentation -->
    <textarea id='edit-body' name="content" rows="30" cols="80" style="width:10in;height:5in;" rows="3" cols="50"><?php echo $data['content']?></textarea>
	<?php
}
function readView($data){
	?>
	<h2>Read: <?=$data['name'] ?></h2>
	<div><?=$data['content'] ?></div>
	<?php
}
function confirmView($data){
	?>
	<p>Are you sure you want to delete the file: <b> <?= $data['name'];?></b> ?</p>
	<form method="get">
		<input type="hidden" name="a" value="delete">
		<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($name)?>">
		<input type="submit" name="buttonDelete" value="Confirm">
	</form>
	<form method="get">
		<input type="hidden" name="a" value="cancel">
		<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($name)?>">
		<input type="submit" name="buttonDelete" value="Cancel">
	</form>
	<?php
}