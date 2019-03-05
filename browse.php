<?php 
    include 'assets/php/_connect.php';
    include 'assets/php/_browse.php';
    if (session_status() == PHP_SESSION_NONE) session_start();
    $user = isset($_SESSION['token'])?$_SESSION['token']:"";
    if (isset($_SESSION['token'])){
        include 'assets/php/account/edit.php';
        include 'assets/php/_add.php';
    } else {
        include 'assets/php/_login.php'; 
        include 'assets/php/_signup.php';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Browse | eDuka</title>
    <?php include 'assets/php/_css.php'; ?>
</head>

<body>
    <?php 
    include 'assets/php/_nav.php';
?>
    <div class="jumbotron-fluid bg-light" style='padding: 8px; padding-top:0px'>
        <div class="container-fluid d-flex">
            <button class="btn btn-outline-primary ml-auto mt-5 mb-3" data-toggle="collapse" data-target="#controls">
                <span class="spinner-grow spinner-grow-sm"></span> Show/Hide Controls</button>
        </div>

        <div id="controls" class="collapse show"><div class="container"><form action="$" method="post" class="form">
        <div class="form-group row">
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3"><input type="search" id='search' name='search' 
                        class="form-control-plaintext px-3" placeholder='Search Term'></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3"><select class="selectpicker" id='brand' name='brand' multiple='multiple'
                                data-live-search="true" title="Select a brand..." data-selected-text-format="count > 3" data-width="100%" 
                                data-size="5" data-actions-box="true"  data-header="Select a brand">
                                <?php for($i=0; $i<4; $i++) echo "<option>Brand $i</option>"; ?>
                        </select></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3 form-inline"><div class="d-flex">
                            <div class="mr-auto">
                                <input type="number" class="form-control-plaintext px-2.5" id='price_min' name='price_min' placeholder='Min Price' 
                                min='0' step='1000' style="width: 100%">
                            </div>
                            <div class="mx-auto align-middle"><p class="px-2">to</p></div>
                            <div class="ml-auto">
                                <input type="number" class="form-control-plaintext px-3" id='price_max' name='price_max' placeholder='Max Price' 
                                min='0' step='1000' style="width: 100%"></div>
                        </div></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3"><select class="selectpicker" id='category' name='category' multiple='multiple'
                                data-live-search="true" title="Select a category..." data-selected-text-format="count > 3" data-width="100%" 
                                data-size="5" data-actions-box="true"  data-header="Select a category">
                                <?php for($i=0; $i<4; $i++) echo "<option>Category $i</option>"; ?>
                        </select></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3"><select class="selectpicker" id='saletype' name='saletype' multiple='multiple'
                                data-live-search="true" title="Select a sale type..." data-selected-text-format="count > 3" data-width="100%" 
                                data-size="5" data-actions-box="true"  data-header="Select a sale type">
                                <?php for($i=0; $i<4; $i++) echo "<option>Sale Type $i</option>"; ?>
                        </select></div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mb-3"><select class="selectpicker" id='status' name='status' multiple='multiple'
                                data-live-search="true" title="Select a status..." data-selected-text-format="count > 3" data-width="100%" 
                                data-size="5" data-actions-box="true"  data-header="Select a status">
                                <?php for($i=0; $i<4; $i++) echo "<option>Status $i</option>"; ?>
                        </select></div>
                        <div class="col-xs-12 col-sm-6 col-md-6"><input type="reset" class="btn btn-outline-secondary btn-block"></div>
                        <div class="col-xs-12 col-sm-6 col-md-6"><input type="submit" class="btn btn-outline-primary btn-block"
                                id='filter' name='filter' value="Submit"></div>
    </div></form></div></div>

    <div class="album py-5 bg-light"><div class="container"><div class='row'>
            <?php
                while($set_row = mysqli_fetch_row($set_result)){
                $categories = explode(";", $set_row[7]);
                $product = $set_row[1];
                $wished_query = "SELECT * FROM wishlist WHERE user = '$user' AND product = '$product'";
                $wished_result = mysqli_query($db, $wished_query) or die(mysqli_error());
                $wished_count = mysqli_num_rows($wished_result);
                $wished = ($wished_count == 1)?"fa":"far";
                $wished_status = ($wished_count == 1)?"Added":"Add";
                include 'assets/php/product.php';
                include 'assets/php/details.php'; }?>
    </div></div></div>

    <ul class="pagination justify-content-center">
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul> 
    <?php include 'assets/php/footer.php'; ?>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>                 -->
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="../js/webfont.js"></script>
    <script src="assets/js/main.js"></script>
    <?php include 'assets/php/_error.php'; ?>
</body>

</html>