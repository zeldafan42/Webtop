	 <form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
          <div id="drop">
                Drop Here

                <a>Durchsuchen</a>
                <input type="file" name="upl" multiple />
            </div>

            <ul>
                <!-- The file uploads will be shown here -->
           </ul>

	  </form>

<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif');

if(isset($_FILES['upl']) && !$_FILES['upl']['error'] && $_FILES['upl']['size']> 0 && $_FILES['upl']['tmp_name'] && is_uploaded_file($_FILES['upl']['tmp_name']))
{

    $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

    if(!in_array(strtolower($extension), $allowed))
    {
        echo '{"status":"error"}';
        exit;
    }

    if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name']))
    {
        echo '{"status":"success"}';
        exit;
    }
}

echo '{"status":"error"}';
exit;
?>