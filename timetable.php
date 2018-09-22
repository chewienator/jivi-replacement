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
                
                <!-- search  subjects column -->
                <div class="col-md-4 pt-3">
                    <h5>Subjects</h5>
                    <div class="container-fluid">
                        <!-- search subject -->
                        <div class="row">
                            <form action="/action_page.php"> <!-- action page? -->
                                <div class="d-flex">
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </div>
                            </form>
                        </div>
                        
                        <!--search results -->
                        <div class="row pt-3">
                            <div class="list-group w-100">
                                <div class="list-group-item flex-column align-items-start">
                                    <div class="row">
                                        <div class="col justify-content-between">
                                            <h6 class="mb-1">Subject 3</h6>
                                            <small class="mb-1">Monday 5-9</small>
                                        </div>
                                        <div class="col d-flex justify-content-end align-self-center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn">i</button>
                                                <button type="button" class="btn"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- second colomn TIMETABLE -->
                <div class="col-md-8 py-3">
                    <div class="row">
                        <div class="container-fluid">
                            <h5> My Timetable </h5>
                            <p> create your timetable before enrolling for your next term  </p>
                            <div class="table-responsive d-none d-lg-block">
                            <table class="table text-center">
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
                                    <tr class="8-10">
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
                            </div>
                            
                            <!-- Timetable shown as list of Days with name of subject and hours -->
                            <div class="container-fluid d-none d-sm-block d-md-block">
                                <p> </p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn">Enrol</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </body>
    <?php include('includes/footer.php'); ?>
</html>