<?php
session_start();
//include the autoloader class
include('autoloader.php');
/*
$product_list = new Products;
$products = $product_list->getProducts();*/

$page_title = "Home Page";
?>
<!doctype html>
<html>
    <?php include('includes/head.php'); ?>
    <body>
        <?php include('includes/navbar.php'); ?>
        <!-- ABOUT -->
        <div id="#about" class="container-about d-flex align-items-center">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="../images/tam_bnr_img1.png" class="image-fluid">
                </div>
                <div class="col-md-8 d-flex justify-content-start">
                    <div class="container-fluid">
                        <h1 class="text-center"> HORA </h1>
                        <h3 class="text-center"> Timetable Management System</h3>
                        <h4 class="text-center"> The paper-free time-effective solution
                        to create and maintain academic schedules and data. It helps 
                        the administration of every institute providing ease of scheduling.</h4>
                    </div>
                </div>
            </div>
        </div>   
        <!-- SERVICES -->
        <div id="#services" class="parallax container-services text-center d-flex">
            <div class="container-fluid align-self-center">
                <h1 class="mb-5 mt-5" > SERVICES </h1>
                <div class="row">
                    <div class="col-md-4 bo">
                            <h3> COURSE MANAGEMENT </h3>
                            <p> Hora gives total freedom in bachelors and courses management. 
                            The administration will be able to create, edit, upgrade and delete 
                            any bachelors and/or related courses with ease. </p>
                        
                    </div>
                    <div class="col-md-4 bo">
                       
                            <h3> TIMETABLE <br> CREATION </h3>
                            <p> Hora helps align a proper schedue and allot faculty as per their availability. 
                            Whit Hora students can create their own schedule 
                            without the use of paper or intervention from students
                            service staff. </p>
                        
                    </div>
                    <div class="col-md-4 bo">
                        
                            <h3> STUDENTS MANAGEMENT </h3>
                            <p> The system consent to create, modify, delete and 
                            store data of students. The administration became easier thanks to the help of Hora.  </p>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTACT -->
        <div id="#contact" class="container-contact text-left" style="padding-left: 50px">
            <div class="row">
                <div class="col-md-4 offset-md-2">
                    <h1> CONTACT US</h1>
                    <h4> If you are interested in discovering
                    more about our services contact us</h4>
                </div>   
                <div class="col-md-5 cont-form-group">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="name" id="name" class="form-control" placeholder="Your name..">
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name</label>
                            <input type="lname" id="lname" class="form-control" placeholder="Your surname..">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="phone" id="phone" class="form-control" placeholder="Your phone number..">
                        </div>
                        <div class="form-group">
                            <label for="email">eMail</label>
                            <input type="email" id="email" class="form-control" placeholder="Your eMail address..">
                        </div>
                        <div class="form-group">
                            <label for="country"> Country</label>
                            <select class="form-control" id="country" name="country">
                                <option value="australia">Australia</option>
                                <option value="europe">Europe</option>
                                <option value="asia">Asia</option>
                                <option value="america">America</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
     </div>
        <!-- make scroll to #
        <script type="text/javascript">
        $(".navbar a").on('click', function(event) {
            var ash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            },900,function(){
                window, location.hash = hash;
            })
        })
        
        
        <i class="fa fa-home"></i>
        </script>  -->
    </body>
</html>