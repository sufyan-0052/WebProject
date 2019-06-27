<?php
if(!isset($_SESSION['user_email'])){
    header('location: login.php?not_user=You are not a User!');
}

if (isset($_POST['insert_ads'])) {
    //getting text data from the fields
    $ads_title = test_input($_POST['ads_title']);
    $ads_cat = test_input($_POST['ads_cat']);
    $ads_brand = test_input($_POST['ads_brand']);
    //getting image from the field
    $ads_image_name = $_FILES['ads_image']['name'];
    $ads_image_tmp = $_FILES['ads_image']['tmp_name'];
    $ads_image_size = $_FILES['ads_image']['size'];

    if (!preg_match("/[a-zA-Z0-9]+/", $ads_title) || strlen($ads_title) < 2) {
        $response = array(
            "type" => "warning",
            "message" => "Enter Valid Product title."
        );
    } else if ($ads_cat == "Select Category") {
        $response = array(
            "type" => "warning",
            "message" => "Select Product Category."
        );
    } else if ($ads_brand == "Select Brand") {
        $response = array(
            "type" => "warning",
            "message" => "Select Product Brand."
        );
    } else if (file_exists($ads_image_tmp)) {

        $image_info = getimagesize($ads_image_tmp);
        $width = $image_info[0];
        $height = $image_info[1];
        $target_directory = "ads_images/";
        $allowed_image_extension = array("png", "jpg", "jpeg");

        // Get image file extension
        $image_extension = pathinfo($ads_image_name, PATHINFO_EXTENSION);

        // Validate file input to check if is not empty
        // Validate file input to check if is with valid extension
        if (!in_array($image_extension, $allowed_image_extension)) {
            $response = array(
                "type" => "warning",
                "message" => "Upload valid images. Only PNG and JPEG are allowed."
            );
            //echo $result;
        }    // Validate image file size
        else if ($ads_image_size > 2000000) {
            $response = array(
                "type" => "warning",
                "message" => "Image size exceeds 2MB"
            );
        }    // Validate image file dimension
        else if ($width > "1000" || $height > "800") {
            $response = array(
                "type" => "warning",
                "message" => "Image dimension should be within 1000X800"
            );
        } else {
            $updated_img_name = "user_" . time() . "_" . $ads_image_name;
            $target = $target_directory . $updated_img_name;
            if (move_uploaded_file($ads_image_tmp, $target)) {

                $insert_ads = "insert into ads (adscat, adsbrand,adstitle,adsimage) 
                  VALUES ('$adscat','$adsbrand','$adstitle','$updated_img_name');";
                $insert_ad = mysqli_query($con, $insert_ads);
                if ($insert_ad) {
                    //header("location: ".$_SERVER['PHP_SELF']);
                    $response = array(
                        "type" => "success",
                        "message" => "Product uploaded successfully."
                    );
                }


            } else {
                $response = array(
                    "type" => "warning",
                    "message" => "Problem in uploading image files."
                );
            }
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUFI 1's Insert_Advertisement</title>
    <link rel="icon" type="image/png" href="images/icons/sufi1icon.png"/>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/icons.css">
    <link rel="stylesheet" type="text/css" href="css/min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">




</head>
<body>
<div class="body">
<h1 class="text-center my-4"><span class="d-none d-sm-inline"> Add New </span>
    Product </h1>
<?php if (!empty($response)) { ?>
    <div class="alert alert-<?php echo $response["type"]; ?>">
        <?php echo $response["message"]; ?>
    </div>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="ads_title" class="float-md-right"> <span class="d-sm-none d-md-inline"> ADS </span>
                Title:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"></div>
                </div>
                <input type="text" class="form-control" id="ads_title" name="ads_title"
                       placeholder="Enter Ads Title"
                    <?php
                    if (@$response["type"] == "warning") {
                        echo "value='$ads_title'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="ads_cat" class="float-md-right"><span class="d-sm-none d-md-inline"> Ads </span>
                Category:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"></div>
                </div>
                <input type="text" class="form-control" id="ads_cat" name="ads_cat"
                       placeholder="Enter Ads category"
                    <?php
                    if (@$response["type"] == "warning") {
                        echo "value='$ads_cat'";
                    }
                    ?>
                >
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="pro_brand" class="float-md-right"> <span class="d-sm-none d-md-inline"> Product </span>
                Brand:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"></div>
                </div>
                <input type="text" class="form-control" id="ads_brand" name="ads_brand"
                       placeholder="Enter Ads Brand"
                    <?php
                    if (@$response["type"] == "warning") {
                        echo "value='$ads_brand'";
                    }
                    ?>
                >
            </div>
        </div>
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="pro_img" class="float-md-right"><span class="d-sm-none d-md-inline"> Ads </span>
                Image:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"></div>
                </div>
                <input class="form-control" type="file" id="pro_image" name="pro_image">
            </div>
        </div>
    </div>

        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto">
            <label for="pro_kw" class="float-md-right"><span class="d-sm-none d-md-inline"> Product </span>
                Keyword:</label>
        </div>
        <div class="col-sm-9 col-md-8 col-lg-4 col-xl-4 mt-3 mt-lg-0">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"></div>
                </div>
                <input class="form-control" type="text" id="pro_keywords" name="pro_keywords"
                       placeholder="Enter Product Keywords">
            </div>
        </div>
    <div class="row my-3">
        <div class="d-none d-sm-block col-sm-3 col-md-4 col-lg-2 col-xl-2 mt-auto"></div>
        <div class="button">
            <button type="submit" name="insert_ads" class="insert_btn">
                Insert Now
            </button>
        </div>
    </div>
</form>
</div>
</body>
</html>