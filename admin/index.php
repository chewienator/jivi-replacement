<?php
session_start();
//include the autoloader class
include('../autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/
//https://bootstrapious.com/p/bootstrap-sidebar#2
$page_title = "Profile";
?>
<!doctype html>
<html>
    <?php include('../includes/head.php'); ?>
    <body>
        <?php include('../includes/navbar.php'); ?>
        <!-- container -->
        <div class="container-fluid">
            <div class="wrapper">
                <!-- Sidebar  -->
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <h3>TiM</h3>
                    </div>
            
                    <ul class="list-unstyled components">
                        <li class="active">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-home"></i>
                                Home
                            </a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li>
                                    <a href="#">Home 1</a>
                                </li>
                                <li>
                                    <a href="#">Home 2</a>
                                </li>
                                <li>
                                    <a href="#">Home 3</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                <i class="fas fa-home"></i>
                                Home 2
                            </a>
                            <ul class="collapse list-unstyled" id="homeSubmenu2">
                                <li>
                                    <a href="#">Home 1</a>
                                </li>
                                <li>
                                    <a href="#">Home 2</a>
                                </li>
                                <li>
                                    <a href="#">Home 3</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
            
                </nav>
            
                <!-- Page Content  -->
                <div id="content">
            
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
            
                            <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="fas fa-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>