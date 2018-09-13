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
                <div class="col-lg-4">
                    <div class="row">
                        <div class="container-fluid">
                            <h4> Courses </h4>
                            <div class="search-container">
                                <form action="/action_page.php">
                                    <input type="text" placeholder="Search course" name="search">
                                    <button type="submit"> <i class="fa fa-search"> </i> </button>
                                </form>
                                <form class="form-inline" method="get" action="search.php">
                                    <input class="form-control" type="text" name="search" placeholder="Search"/>
                                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                            </form>
                            </div> 
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                 <div class="d-flex justify-content-between">
                                     <h6 class="mb-1">Subject 1</h6>
                                </div>
                                <p class="mb-1">Monday 5-9</p>
                             </a>
                             <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                 <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">Subject 2</h6>
                                    </div>
                                    <p class="mb-1">Wednesday 8-12</p>
                                </div>
                                <div class="col-6 d-flex justify-content-end align-items-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <button type="button" class="btn btn-secondary">Info</button>
                                      <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                </div>
                             </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- second colomn -->
                <div class="col-lg-8">
                    <!-- Subject Detail row -->
                    <div class="row" >
                        <h4 class="col-12"> My Timetable </h4>
                        <p> here you can see your timetable before enrolling for the next term  </p>
                        <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">time / date</th>
                                  <th scope="col">Monday</th>
                                  <th scope="col">Tuesday</th>
                                  <th scope="col">Wednesday</th>
                                  <th scope="col">Thursday</th>
                                  <th scope="col">Friday</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr class="8-10">
                                  <th scope="row">8 am - 10am</th> <!--first time block -->
                                  <td class="block-1">8-10</td>
                                  <td class="block-2">Otto</td>
                                  <td class="block-3">@mdo</td>
                                  <td class="block-4">@mdo</td>
                                  <td class="block-5">@mdo</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td>Jacob</td>
                                  <td>Thornton</td>
                                  <td>@fat</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td>Larry</td>
                                  <td>the Bird</td>
                                  <td>@twitter</td>
                                </tr>
                              </tbody>
                            </table>
                    </div>
            </div>
        </div>
    </body>
</html>