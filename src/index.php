<?php

ob_start('ob_gzhandler');
header ("Expires: Thu, 17 May 2001 10:17:17 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
header ("Content-type: application/javascript");

$fp = @fsockopen('tcp://172.17.0.1', 64737);

if (!$fp)
{
	die();
}
else
{
	fwrite($fp, "json\n");
	$content = "";
	while (!feof($fp))
	{
		$content .= fgets($fp, 1024);
		//$stream_meta_data = stream_get_meta_data($fp);
		//if($stream_meta_data['unread_bytes'] <= 0) break;
	}
	fclose($fp);

    if( isset($_GET['callback']) )
	{
		$callback = $_GET['callback'];
	}
else
{
$callback = '';
}
    $callback = preg_replace("/[^a-zA-Z0-9_-]+/", "", $callback);
    if(!empty($callback)) {
      echo $callback . "(" . $content . ");";
    } else {
      echo $content;
    }
}
