<?php 

/**
 * Outputs the specified file to the browser.
 *
 * @param string $filePath the path to the file to output
 * @param string $fileName the name of the file
 * @param string $mimeType the type of file
 */
function outputContent($content, $fileName, $mimeType = '') {
    // Setup
    $mimeTypes = array(
    	'pdf' => 'application/pdf',
    	'txt' => 'text/plain',
    	'html' => 'text/html',
    	'exe' => 'application/octet-stream',
    	'zip' => 'application/zip',
    	'doc' => 'application/msword',
    	'xls' => 'application/vnd.ms-excel',
    	'ppt' => 'application/vnd.ms-powerpoint',
    	'gif' => 'image/gif',
    	'png' => 'image/png',
    	'jpeg' => 'image/jpg',
    	'jpg' => 'image/jpg',
    	'php' => 'text/plain'
    );

    $fileSize = filesize($filePath);
    $fileName = rawurldecode($fileName);
    $fileExt = '';

    // Determine MIME Type
    if($mimeType == '') {
    	$fileExt = strtolower(substr(strrchr($filePath, '.'), 1));

    	if(array_key_exists($fileExt, $mimeTypes)) {
    		$mimeType = $mimeTypes[$fileExt];
    	}
    	else {
    		$mimeType = 'application/force-download';
    	}
    }

    // Disable Output Buffering
    @ob_end_clean();

    // IE Required
    if(ini_get('zlib.output_compression')) {
    	ini_set('zlib.output_compression', 'Off');
    }

    // Send Headers
    header('Content-Type: ' . $mimeType);
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    // Send Headers: Prevent Caching of File
    header('Cache-Control: private');
    header('Pragma: private');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

    // Multipart-Download and Download Resuming Support
    if(isset($_SERVER['HTTP_RANGE'])) {
    	list($a, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    	list($range) = explode(',', $range, 2);
    	list($range, $rangeEnd) = explode('-', $range);

    	$range = intval($range);

    	if(!$rangeEnd) {
    		$rangeEnd = $fileSize - 1;
    	}
    	else {
    		$rangeEnd = intval($rangeEnd);
    	}

    	$newLength = $rangeEnd - $range + 1;

    	// Send Headers
    	header('HTTP/1.1 206 Partial Content');
    	header('Content-Length: ' . $newLength);
    	header('Content-Range: bytes ' . $range - $rangeEnd / $size);
    }
    else {
    	$newLength = $size;
    	header('Content-Length: ' . $size);
    }

    // Output File
    $chunkSize = 1 * (1024*1024);
    $bytesSend = 0;

	echo $content;
	flush();
}
?>