<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mTaghadosi Filemanager</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
<header class="header">
    Welcome to my personal file manager
</header>

<div class="container">
    <?php
    $ParentDir = '';
    function DiscoverParentDirectory()
    {
        $p_dir = '';
        $currentDir = $_GET['dir'];
        $splited = explode('/', $currentDir);
        array_pop($splited);

        foreach ($splited as $i) {
            $p_dir .= $i;
            $p_dir .= '/';
        }
        if(substr($p_dir,-1) == "/")
        {
            $p_dir = substr($p_dir,0,-1);
        }
//        echo 'Parent DIR is: ';
        return $p_dir;
    }

    if (isset($_GET['dir']) && !empty($_GET['dir'])) {
        $CurrentDir = $_GET['dir'] . '/';
        $ParentDir = DiscoverParentDirectory();
    } else {
        $CurrentDir = 'myComputer/';
    }
    $FilesList = glob("$CurrentDir*");
    echo "<div class='clearfix'></div>";
    echo "<div class='IconMask'><a href='?dir=$ParentDir'><img src='images/parent_icon.png'></a></div>";

    foreach ($FilesList as $CurrentFile) {
        if (is_dir($CurrentFile)) {
            echo "<a href='?dir=$CurrentFile'>";
            echo '<div class="IconMask">';
            echo '<div class="DirectoryImage"></div>';
            echo '<div class="DirectoryTitle">' . str_replace($CurrentDir, "", $CurrentFile) . '</div>';
            echo '</div>';
            echo '</a>';
        } else {
            echo "<a href='?dir=$CurrentFile'>";
            echo '<div class="IconMask">';
            echo '<div class="FileImage"></div>';
            echo '<div class="FileTitle">' . str_replace($CurrentDir, '', $CurrentFile) . '</div>';
            echo '</div>';
            echo '<a/>';
        }
    }

    ?>
</div>
</body>
</html>