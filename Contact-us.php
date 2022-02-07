<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'form1')
{
   $mailto = 'unitedvidsic@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Contact Information';
   $message = 'Values submitted from web site form:';
   $success_url = './thank-you-contact.html';
   $error_url = './error-contact.html';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response", "h-captcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }
      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 17 Trial Version - https://www.wysiwygwebbuilder.com">
<link href="css/darkmode.css" rel="stylesheet">
<link href="css/Contact-us.css" rel="stylesheet">
<script>   
   function submitContant_Form()
   {
      var regexp;
      var Editbox2 = document.getElementById('Editbox2');
      if (!(Editbox2.disabled || Editbox2.style.display === 'none' || Editbox2.style.visibility === 'hidden'))
      {
         regexp = /^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i;
         if (Editbox2.value.length != 0 && !regexp.test(Editbox2.value))
         {
            alert("Invalid Email");
            Editbox2.focus();
            return false;
         }
      }
      return true;
   }
</script>
<meta name="a.validate.02" content="NdOCnfF58krpOQbzACBrcDf2cmM32cgMViA0"/>
</head>
<body>
   <a href="https://www.wysiwygwebbuilder.com" target="_blank"><img src="images/builtwithwwb17.png" alt="WYSIWYG Web Builder" style="position:absolute;left:441px;top:967px;margin:0;border-width:0;z-index:250" width="16" height="16"></a>
   <div id="wb_Form1" style="position:absolute;left:318px;top:185px;width:432px;height:267px;z-index:8;">
      <form name="Contant_Form" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="Form1" onsubmit="return submitContant_Form()">
         <input type="hidden" name="formid" value="form1">
         <label for="Editbox1" id="Label1" style="position:absolute;left:10px;top:15px;width:56px;height:16px;line-height:16px;z-index:0;">Name:</label>
         <input type="text" id="Editbox1" style="position:absolute;left:84px;top:15px;width:190px;height:16px;z-index:1;" name="name" value="Name" spellcheck="false">
         <label for="Editbox2" id="Label2" style="position:absolute;left:10px;top:46px;width:56px;height:16px;line-height:16px;z-index:2;">Email:</label>
         <input type="email" id="Editbox2" style="position:absolute;left:84px;top:46px;width:190px;height:16px;z-index:3;" name="email" value="Email Adress " spellcheck="false">
         <label for="TextArea1" id="Label3" style="position:absolute;left:10px;top:77px;width:56px;height:16px;line-height:16px;z-index:4;">FeedBack</label>
         <textarea name="TextArea1" id="TextArea1" style="position:absolute;left:84px;top:77px;width:190px;height:90px;z-index:5;" rows="5" cols="21" spellcheck="false">Comments</textarea>
         <input type="submit" id="Button1" name="" value="Send" style="position:absolute;left:84px;top:182px;width:96px;height:25px;z-index:6;">
      </form>
   </div>
</body>
</html>