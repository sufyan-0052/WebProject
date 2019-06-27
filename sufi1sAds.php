<?php
$con = mysqli_connect("localhost","root","","1sdb");
if(!$con)
    die("Connection failed");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUFI 1's Advertisement</title>
    <link rel="icon" type="image/png" href="images/icons/sufi1icon.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <link rel="stylesheet" type="text/css" href="css/min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">




</head>
<body>
<div class="body">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Ads</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $get_ads = "select * from ads";
                $run_ads = mysqli_query($con,$get_ads);
                $count_ads = mysqli_num_rows($run_ads);
                if($count_ads==0){
                    echo "<h2 align='center'> No ads found<br> Advertise your Company
                           <a href='insertads.php'> 
                            <div class=\"button\">
                             <button type=\"submit\" name=\"insert_ads\" class=\"insert_btn\">
                                Insert Now
                             </button>
                            </div>
                           </a>
                          </h2>
                    ";
                }
                else {
                    $i = 0;
                    while ($row_ads = mysqli_fetch_array($run_ads)) {
                        $ads_id = $row_ads['ads_id'];
                        $ads_cat = $row_ads['ads_cat'];
                        $ads_brand = $row_ads['ads_brand'];
                        $ads_image = $row_ads['ads_image'];
                        ?>
                        <tr>
                            <th scope="row"><?php echo ++$i; ?></th>
                            <td><?php echo $ads_title; ?></td>
                            <td><img class="img-thumbnail" src='product_images/<?php echo $ads_image;?>' width='80' height='80'></td>
                            <td><?php echo $ads_price; ?>/-</td>
                            <td><a href="index.php?edit_pro=<?php echo $ads_id?>" class="btn btn-primary">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a href="index.php?del_pro=<?php echo $ads_id?>" class="btn btn-danger">
                                    <i class="fa fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>