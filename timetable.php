<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Timetable";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="row">
                <!-- search  subjects colomn -->
                <div class="col-lg-4 pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <h4>Subjects</h4>
                            <div class="search-container"> 
                                <form action="/action_page.php"> <!-- action page? -->
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </form>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1">Subject 3</h6>
                                            <p class="mb-1">Monday 5-9</p>
                                        </div>
                                        <div class="col d-flex justify-content-end align-self-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-secondary">i</button>
                                                <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-lg-8 pt-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h4> My Timetable </h4>
                            <p class> here you can see your timetable before enrolling for the next term </p>
                            <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">time / day</th>
                                        <th scope="col">Monday</th>
                                        <th scope="col">Tuesday</th>
                                        <th scope="col">Wednesday</th>
                                        <th scope="col">Thursday</th>
                                        <th scope="col">Friday</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="8-10" "d-flex" "justify-content-between">
                                        <th scope="row">8am - 10am</th>
                                        <td class="block-1"></td>
                                        <td class="block-2"></td>
                                        <td class="block-3"></td>
                                        <td class="block-4"></td>
                                        <td class="block-5"></td>
                                    </tr>
                                    <tr class="10-12">
                                        <th scope="row ">10am - 12am</th>
                                        <td class="block-1"></td>
                                        <td class="block-2"></td>
                                        <td class="block-3"></td>
                                        <td class="block-4"></td>
                                        <td class="block-5"></td>
                                    </tr>
                                    <tr class="12.30-2.30">
                                        <th scope="row">12.30am - 2.30pm</th>
                                        <td class="block-1"></td>
                                        <td class="block-2"></td>
                                        <td class="block-3"></td>
                                        <td class="block-4"></td>
                                        <td class="block-5"></td>
                                    </tr>
                                    <tr class="2.30-4.30">
                                        <th scope="row">2.30pm - 4.30pm</th>
                                        <td class="block-1"></td>
                                        <td class="block-2"></td>
                                        <td class="block-3"></td>
                                        <td class="block-4"></td>
                                        <td class="block-5"></td>
                                    </tr>
                                    <tr class="4.30-6.30">
                                        <th scope="row">4.30pm - 6.30pm</th>
                                        <td class="block-1"></td>
                                        <td class="block-2"></td>
                                        <td class="block-3"></td>
                                        <td class="block-4"></td>
                                        <td class="block-5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div></div>
                    </div>
                </div>
        </div>
        <footer>
            <?php include('includes/footer.php'); ?>
        </footer>
    </body>
</html>