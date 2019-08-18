<?php 
$file="text"; // enter the name of your text file with rights 666
$posting=false;
$url = "";
$name = "";
$nameConf="autofocus";
$msgConf="";
if(isset($_GET["user"])){
	$url = "?user=".$_GET["user"];
	$name=htmlspecialchars($_GET["user"]);
	$nameConf="";
	$msgConf="autofocus";
}
if(isset($_POST["name"])&&isset($_POST["msg"])) {
	$posting=true;
	$url = "?user=".$_POST["name"];
	$name=htmlspecialchars($_POST["name"]);
	$nameConf="";
	$msgConf="autofocus";
}
?>
<!DOCTYPE html>
<html lang="en">
<head><title>ANONCHAT</title><META http-equiv="refresh" content="5; URL=<?php echo $url;?>"><meta charset="UTF-8"><style>body{background:#272822}form{background:#272822;position:fixed;left:0;top:0;height:30px;width:100%;margin:0;padding:0}#chat{background:#272822;position:absolute;width:100%;top:30px;left:0;display:block;overflow-y:visible;margin:0;padding:0;overflow-x:hidden;display:flex;flex-direction:column-reverse;margin-bottom:20px;font-family:monospace;font-size:14px;background:#272822;color:#fff}c{display:block;margin-left:6px}d{color:gray;display:ruby-text-container;float:left;width:76px}m{position:absolute;padding:0;margin-left:8px}na{white-space:nowrap;color:red;width:100px;display:inline-block;text-align:right;border-right:1px gray solid;padding-right:10px;overflow:hidden;text-overflow:ellipsis}input{margin:0;border:none;height:20px;position:absolute;top:1px;font-family:monospace;font-size:14px;background:#fff;color:#272822;font-weight:700;padding-left:8px}#iname{width:173px;text-align:right;padding-right:10px;left:1px}#imsg{left:193px;width:calc(100% - 203px)}</style></head>
<body>
<?php 
	 	if($posting) {
			$str='<c><d>'.date('H:i:s').'</d> <na>'.htmlspecialchars($_POST['name']).'</na> <m>'.htmlspecialchars($_POST['msg']).'</m></c>';			
			$content=file($file);
			$content[]=$str."\n";
			$file_content=array_slice($content,-1000,1000);
			file_put_contents($file,$file_content);
	 	}
	 $fh = fopen($file, 'r'); 
	 $pageText = fread($fh, 25000); 
	 echo "<div id='chat'>".nl2br($pageText)."</div>"; 
?> 
<form action="<?php echo $url; ?>" method="post"> 
<input id="iname" type="text" placeholder = "Name" name="name" <?php echo $nameConf;?> required value="<?php echo $name; ?>"/>
<input id="imsg" type="text" name="msg" <?php echo $msgConf;?> required />
<input style="display:none;" type="submit" value="SEND">
</form>
</body>
</html>