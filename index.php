<?php
  
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File System</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <h2>Current Directory</h2>
        <table>
            <th>NAME</th>
            <th>EXTENSION</th>
            <th>SIZE(b)</th>
            <th>DATE CREATED</th>
            <pre>
        <?php
            include 'FSystem.class.php';
            $files = FSystem::getInstance();
            $dir_list = $files->getList();

            if(isset($_GET['name']))
                $dir_list = $files->sortByName();
            
            if(isset($_GET['ext']))
                $dir_list = $files->sortByExt();
            
            if(isset($_GET['size']))
                $dir_list = $files->sortBySize();
             
            if(isset($_GET['date']))
                $dir_list = $files->sortByDate();
             
            
            foreach($dir_list as $value){
                echo '<tr><td><a href=\'http://fs.com/?content='.$value['fname'].'\'>' . $value['fname'] . '</td>';
                echo '<td>' . $value['fext'] . '</td>';
                echo '<td>' . $value['fsize'] . '</td>';
                echo '<td>' . $value['fdate'] . '</td><tr>'; 
            }

        ?>
            </table>
        <br/>
        <form action="#" method="get">
            <input type="checkbox" name="name" id="name" />
            <label for="name">NAME</label><br/>
            <input type="checkbox" id="ext" name="ext"/>
            <label for="ext">EXTENSION</label><br/>
            <input type="checkbox" id="size" name="size"/>
            <label for="size">SIZE(b)</label><br/>
            <input type="checkbox" id="date" name="date" />
            <label for="date">DATE CREATED</label><br/>
            <input type="submit" name="sort" value="Sort" />
        </form>
        <hr/>
        <?php
            echo "<h3>Read file: <i>".$_GET['content']."</i></h3>";
            if(isset($_GET['content'])){
                if(is_)
                $file = $files->getContent($_GET['content']);
                    echo $file;
            } else {
                echo 'Choose file';
            }
        ?>
    </body>
</html>
