<?php
    session_start();
    include('dbconfig.php');
    $flag = false;
    if(isset($_GET['source']))
    {
        $key = trim(strtolower($_GET['source']));
        unset($GET);
        $q = "Select * from keywords where keyword = '$key'";
        $select = $db->query($q);
        if($select->num_rows > 0)
        {
            $temp = $select->fetch_assoc();
            $table = $temp['table_name'];
            $columns = $temp['column_name'];

            $q = "select $columns from $table where true";
            $get = $db->query($q);
            if($get)
            {
                $flag = true;
                $data = array();
                while($temp = $get->fetch_assoc())
                {    
                    $data[] = $temp;
                }

            }
            else
            {
                $_SESSION['msg'] = "<div class='alert alert-danger'> Operation Failed! Please Try Again. </div>";
            }
        }
        else 
        {
            
            $_SESSION['msg'] = "<div class='alert alert-danger'> Keyword does not match with any records in database.</div>";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="assets/style.css">
        <link rel="stylesheet" type="text/css" href="assets/app.css">
    </head>

    <body>
    	<div id="app">
    		<div class="container-fluid">
                <div class="row panel indigo">
                    <div class="row ml-2 mt-2">
                        <div class="col-md-2 text-right">
                            <a href="keylist.php" style="background-color: rgba(255, 255, 255, 0.2);" class="link btn text-right">List Of Keywords</a>
                        </div>
                    </div>

                        <div class="container form">
                            

                        <?php if(isset($_SESSION['msg']))
                                {
                                    echo $_SESSION['msg'];
                                    $_SESSION['msg'] = '';
                                }   
                        ?>
                        
                            <h3> Enter Keyword to Search</h3><br>
                            <form name="search" method="GET" action="">
                                <div class="form-group row mx-5">
                                    <div class="col-md-2 text-right">
                                        <label style="font-size: 17pt;">Search:</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="source" id="source" placeholder="Enter Keyword..." class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn signup" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                            <?php
                            if($flag)
                            {
                            ?>
                            <div class="container">
                                <table class="table">
                                    <tr>
                                    <?php
                                        $column = explode(',', $columns);
                                        foreach ($column as $col) 
                                        {    
                                        echo "<th>$col</th>";
                                        }
                                    ?>
                                    </tr>
                                    <?php
                                    foreach($data as $d)
                                    {
                                        echo "<tr>";
                                        foreach ($column as $col) 
                                        {  
                                            echo "<td>".$d[$col]."</td>";
                                        }  
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                            
                            <?php
                            }
                        
                            ?>

                        </div>

                    </div>
       		</div>
    	</div>
    </body>
</html>