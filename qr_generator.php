<?php
    include('phpqrcode/qrlib.php'); //mga dinownload ko lang to
     //eto link niyan kung gusto mo tingnan documentation https://phpqrcode.sourceforge.net/examples/index.php?example=005

    // how to save PNG codes to server
    
    $tempDir = 'qr_codes/';
    
    $codeContents = uniqid("user", true); //nagcreate lang ako ng uniqid para sa laman ng qr code, pwede mo palitan to
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = 'sample_code.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        echo 'File generated at ' . $urlRelativeFilePath;
        echo $codeContents;
    } else {
        echo 'file already exists';
    }
    
    echo 'Server PNG File: '.$pngAbsoluteFilePath;
    echo '<hr />';
    
    // displaying
    echo '<img src="'.$urlRelativeFilePath.'" />';
?>