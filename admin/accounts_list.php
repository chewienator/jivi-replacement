<?php
session_start();
//include session check
include('../session_check.php');
//include the autoloader class
include('../autoloader.php');

//let's query for all created bachelors
$account = new Account();
$accounts_list = $account->getAccounts();


$page_title = "Accounts list";
?>
        
<!DOCTYPE html>
<html>
    <?php include('../includes/head.php'); ?>
<body>
<link href="css/style.css" rel="stylesheet">
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <?php include 'includes/navbar.php'; ?>  
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
             <div class="container-fluid">
                <h2>Accounts List</h2>
                <p>Here you will find all Accounts created</p>
                <div class="row p-3 d-flex flex-row">
                    <a href="#menu-toggle" class="btn btn-secondary m-2 deco-none" id="menu-toggle">Toggle Menu</a>
                    <a href="account.php?a=n" class="btn btn-primary m-2 deco-none">Create New Account</a>
                    <div class="row m-3">
                        <input type="text" id="search" onkeyup="search()" placeholder="Search for account" name="search">
                        <button> <i class="fa fa-search"> </i> </button>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-6">
                    <div class="list-group w-100">
                        <?php foreach( $accounts_list AS $account){ ?>
                        <div class="list-group-item list-group-item-action flex-column align-items-start searchable" data-name="<?php echo $account['name'].' '.$account['surname'].' - '.$account['user_type']. ' - '.$account['id']; ?>" data-account-id="<?php echo $account['id']; ?>">
                            <div class="row">
                                <div class="col justify-content-between">
                                    <h6 class="mb-1"><?php echo $account['name'].' '.$account['surname'].' - '.$account['user_type']. ' - '.$account['id']; ?></h6>
                                </div>
                                <div class="col d-flex justify-content-end align-self-center">
                                    <div class="btn-group" role="group" aria-label="action buttons">
                                        <a href="account.php?a=e&id=<?php echo $account['id']; ?>" class="btn btn-secondary deco-none"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <?php 
                                        if($account['user_type'] == 'Student'){ ?>
                                            <a href="timetable.php?a=e&id=<?php echo $account['id']; ?>" class="btn btn-secondary deco-none"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- #page-content-wrapper -->

    </div>
    
    <!-- #wrapper -->
    <?php include 'includes/footer.php'; ?>
    <script type="text/javascript" src="/js/common.js"></script>
</body>

</html>