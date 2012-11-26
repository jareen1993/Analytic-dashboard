<?php

function cURLcheckBasicFunctions()
{
  if( !function_exists("curl_init") &&
      !function_exists("curl_setopt") &&
      !function_exists("curl_exec") &&
      !function_exists("curl_close") ) return false;
  else return true;
}

/*
 * Returns string status information.
 * Can be changed to int or bool return types.
 * @param String URI of file
 * @param String FileName
 * @return
 */
function cURLdownload($url, $file)
{
  if( !cURLcheckBasicFunctions() ) return "UNAVAILABLE: cURL Basic Functions";
  $ch = curl_init();
  if($ch)
  {
    $fp = fopen($file, "w");
    if($fp)
    {
      if( !curl_setopt($ch, CURLOPT_URL, $url) )
      {
        fclose($fp); // to match fopen()
        curl_close($ch); // to match curl_init()
        return "FAIL: curl_setopt(CURLOPT_URL)";
      }
      if( !curl_setopt($ch, CURLOPT_FILE, $fp) ) return "FAIL: curl_setopt(CURLOPT_FILE)";
      if( !curl_setopt($ch, CURLOPT_HEADER, 0) ) return "FAIL: curl_setopt(CURLOPT_HEADER)";
      if( !curl_exec($ch) ) return "FAIL: curl_exec()";
      curl_close($ch);
      fclose($fp);
      return "SUCCESS: $file [$url]";
    }
    else return "FAIL: fopen()";
  }
  else return "FAIL: curl_init()";
}
/*
 * Generate File url
 * @param String FileName
 * @return
 */
function geturlfile($filenum)
{

	$url  = 'http://www.cse.iitd.ernet.in/act4d/csp301/log-comm.' . $filenum . '.out';

	$path = 'log' . $filenum . '.txt';
	cURLdownload($url, $path);
}
//geturlfile('02');
// Download from 'example.com' to 'example.txt'
//echo cURLdownload('http://www.cse.iitd.ernet.in/act4d/csp301/log-comm.10.out', 'D:\acadSOFT\xampp\htdocs\commaactivity\log00.txt');

?>