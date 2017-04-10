<?php
/*
Determines what activity we will perform and calls the corresponding controller
*/
$activity = (isset($_REQUEST['a']) && in_array($_REQUEST['a'], 
	["main", "create", "edit", "save", "delete", "read", "confirm"])) 
	? $_REQUEST['a'] . "Controller" : "mainController";
$activity();
/*
getTextFiles
Fetch all text files from subfolder /text_files/ and enter them into array
@param array $entries contains an empty array
@return array $entries contains all .txt files in subfolder /text_files/
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
/*
noteController
Controls all functionality of the main page
*/
function mainController(){
	$data["FILE_ENTRIES"] = [];
	$data["FILE_ENTRIES"] = getTextFiles($data["FILE_ENTRIES"]);

	$layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "landingView");
}
/*
createController
Fetch filename and compare with existing values to create new unique file and goes to edit page. The file will not save until it the save button is pressed. If there is a filename that already exists, stay on the landing page.
*/
function createController(){
	$data["name"] = (isset($_GET['fileName'])) ? 
		filter_var($_GET['fileName'], FILTER_SANITIZE_STRING) : "";
	$data["content"] = "";
	//fetch text files so we can check for duplicates
	$entries = [];
	$entries = getTextFiles($entries);
	//change all keys to lowercase for duplicates
	$entries = array_change_key_case($entries, CASE_LOWER);
	//check for duplicate filenames, if filename is empty or the same, stay on landing page
	if($data["name"] == "" || isset($entries[$data["name"]])){
		mainController();
		return;
	}

	//Send data to editView
    $layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "editView");
}
/*
editController
Determine if new text file was created. Create new file, and then add it to list of entries after editing.
*/
function editController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ? 
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
	$entries = [];
	$entries = getTextFiles($entries);

	//Send data to editView
	$data["content"] = $entries[$data["name"]];
    $layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "editView");
}
/*
saveController
Fetch filename from $_REQUEST and text from <textarea> and creates a new file or overwrites an already existing file.
*/
function saveController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ? 
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
	$data["content"] = (isset($_REQUEST['fileContent'])) ? 
		filter_var($_REQUEST['fileContent'], FILTER_SANITIZE_STRING) : "";

	//Save new information to file. file_put_contents overwrites existing files, fwrite appends.
	file_put_contents("text_files/".$data["name"].".txt", $data["content"]);
	mainController();
}
/*
readController
Fetch filename from $_REQUEST and fetch the contents of the file to send to readView
*/
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
/*
deleteController
Fetch filename from $_REQUEST to send to confirmView
*/
function deleteController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ?
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";

	$layout = (isset($_REQUEST['f']) && in_array($_REQUEST['f'], [
    "html"])) ? $_REQUEST['f'] . "Layout" : "htmlLayout";
    $layout($data, "confirmView");
}
/*
confirmController

*/
function confirmController(){
	$data["name"] = (isset($_REQUEST['fileName'])) ?
		filter_var($_REQUEST['fileName'], FILTER_SANITIZE_STRING) : "";
	//Save new information to file. filt_put_contents overrides existing files, fwrite appends.
	if(unlink("text_files/".$data["name"].".txt")){
		mainController();
		return;
	}
}
/*
htmlLayout
Deals with all of the initial HTML information and draws the current views.
@param array $data contains the name and content of a file to possibly be echo'd to title or by 	the views
@param string $views is the name of the views function to call to draw body of web page
*/
function htmlLayout($data, $view){
	?><!DOCTYPE html>
	<html>
	    <head><title>Simple Text Editor
	    <?php 
		    if(!empty($data['name'])){
		    	echo ": " . $data['name'];
		    }
	    ?></title></head>
		<body>
		<h1><a href="index.php">Simple Text Editor</a></h1>
		<?php
			$view($data);
		?>
		</body>
	</html><?php
}
/*
landingView
Draw main landing page with all of the file names, edit, delete, and create buttons
@param array $data has data of all files
*/
function landingView($data){
	?>
	<form method="get">
		<input type="hidden" name="a" value="create">
		<input type="text" name="fileName" placeholder="Text File Name" maxlength="20">
		<input type="submit" value="Create">
	</form>

	<h2>My Files</h2>
	<table>
	<tr><th>Filename</th><th colspan="2">Actions</th></tr>
	<?php
    if(!empty($data["FILE_ENTRIES"])){
		foreach($data["FILE_ENTRIES"] as $name => $content){
            ?><div>
            	<tr>
	            	<td><a href="index.php?a=read&fileName=<?=urlencode($name)?>"><?=$name?></a></td>
					<td>
						<form method="get">
							<input type="hidden" name="a" value="edit">
							<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($name)?>">
							<input type="submit" value="Edit">
						</form>
					</td>
					<td>
						<form method="get">
							<input type="hidden" name="a" value="delete">
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
/*
editView
Draw edit page with the filename and a textarea for submitting any changes
@param array $data has data of the file being edited
*/
function editView($data){
	?>
	<h2>Edit: <?php echo $data['name']; ?>.txt</h2>
	<form method="get">
		<input type="hidden" name="a" value="save">
		<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($data['name'])?>">
		<textarea name="fileContent" rows="30" cols="80" style="width:10in;height:5in;" rows="3" cols="50"><?php echo $data['content']?></textarea><br>
		<!--<input type="hidden" name="fileContent" value="<?php //echo htmlspecialchars($data['content'])?>">-->
		<input type="submit" value="Save">
	</form>
	<form method="get">
		<input type="hidden" name="a" value="main">
		<input type="submit" value="Return">
	</form>
	<!-- <textarea> tag should be in the same line to prevent unwanted indentation -->
	<?php
}
/*
readView
Draw read page with the filename and displays the text content of the file.
@param array $data has data of the file being read
*/
function readView($data){
	?>
	<h2>Read: <?=$data['name'] ?></h2>
	<div><?=$data['content'] ?></div>
	<?php
}
/*
confirmView
Draw confirm page with the filename and two buttons, one for confirmation and the other to go back to landing page
@param array $data has data of the file being deleted
*/
function confirmView($data){
	?>
	<p>Are you sure you want to delete the file: <b> <?= $data['name'];?></b> ?</p>
	<form method="get">
		<input type="hidden" name="a" value="confirm">
		<input type="hidden" name="fileName" value="<?php echo htmlspecialchars($data['name'])?>">
		<input type="submit" name="buttonDelete" value="Confirm">
	</form>
	<form method="get">
		<input type="hidden" name="a" value="main">
		<input type="submit" name="buttonCancel" value="Cancel">
	</form>
	<?php
}