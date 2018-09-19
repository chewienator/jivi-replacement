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
        <div id="#about" class="parallax containerabout"> <!-- WANTED TO CREATE PARALLAX BUT DOESN'T WORK --->
            <h3 class="text-center"> ABOUT US </h3>
            <p class="text-center" style="color: blue; font-size:20px;"> Lorem Ipsum ver since the 1500s,ype and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>   
        <!-- SERVICES -->
        <div id="#services" class="container-services text-center">
            <div class="container">
                <h3> SERVICES </h3>
                <div class="row">
                    <div class="col-4" "colo" > <!-- WANTED TO CREATE "CARDS" WITH WHITE BACKGROUND BUT DOESN'T WORK AS CLASS --->
                    <h5> THIS </h5>
                        <p> baasjhfsdhadsh dsfajhasda l</p>
                    </div>
                    <div class="col-4">
                        <h5> THIS </h5>
                        <p> baasjhfsdhadsh dsfajhasda l</p>
                    </div>
                    <div class="col-4">
                        <h5> THIS </h5>
                        <p><i class="fa fa-check-circle"></i> baasjhfsdhadsh dsfajhasda l</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTACT -->
        <div id="#contact" class="container-contact text-left" style="padding-left: 50px">
            <div class="row">
                <div class="col-3 offset-3">
                    <h3> CONTACT US</h3>
                    <p style="color: blue; text-position:center"> If you are interested in discovering more about services, 
                    drop us a line and we will answer back to you</p>
                </div>   
                <div class="col-3 cont-form-group"> <!-- WANTED TO CREATE OPACITY WHITE BACKGROUND ON PARALLAX IMAGE BUT DOESN'T WORK -->
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
                            <label for="school"> Institute </label>
                            <select class="form-control" id="school" name="school">
                                <option value="Academy">Academy</option>
                                <option value="University">University</option>
                                <option value="bla">dfdsf</option>
                                <option value="bla">fsdasn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
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