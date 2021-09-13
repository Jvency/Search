<?php
    session_start();
    include('dbconfig.php');
    $flag = false;
        $q = "Select * from keywords";
        $select = $db->query($q);
        if($select->num_rows > 0)
        {    
            $flag = true;
            while($temp = $select->fetch_assoc())
            {    
                $data[] = $temp;
            }

        }
        else 
        {
            
            $_SESSION['msgkey'] = "<div class='alert alert-danger'> Keyword Table is Empty.</div>";
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
                             <a href="index.php" style="background-color: rgba(255, 255, 255, 0.2);" class="link btn text-right">Home</a>
                            </div>
                        </div>

                        <div class="container form">

                        <?php if(isset($_SESSION['msgkey']))
                                {
                                    echo $_SESSION['msgkey'];
                                    $_SESSION['msgkey'] = '';
                                }   
                        ?>
                        <h3>Keywords List</h3><br>
                            <?php
                            if($flag)
                            {
                            ?>
                            <div class="container">
                                <table class="table">
                                    <tr>
                                        <th>Keyword</th>
                                        <th>Table Name</th>
                                        <th>Column Name</th>
                                    </tr>
                                    <?php
                                    foreach($data as $d)
                                    {
                                        echo "<tr>";
                                        echo "<td>".$d['keyword']."</td>";
                                        echo "<td>".$d['table_name']."</td>";
                                        echo "<td>".$d['column_name']."</td>";  
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