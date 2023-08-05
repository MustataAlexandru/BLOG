<?php include 'includes/admin_header.php' ?>

<div id="wrapper">




    <?php include 'includes/admin_navigation.php' ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">

                <div class="col-lg-12">

                    <h1 class="page-header">

                         ADMIN
                        <small><?php echo $_SESSION['username'];?></small>

                    </h1>
                   <div class="col-xs-6">

                       <?php

                       insert_categories();

                       ?>


                    <form action="" method="post">
                      <div class="form-group">
                          <label for="cat-title"> Adauga Categorie</label>
                          <input type="text" class="form-control" name="cat_title">

                      </div>
                      <div class="form-group">
                          <input class="btn btn-primary" type="submit" name="submit" value="Adauga Categorie">

                      </div>
                    </form>
                   </div>


                    <?php

                    if(isset($_GET['post'])) {

                        $cat_id = $_GET['post'];
                        include "includes/update_categories.php";

                    }

                    ?>



                </div>

                    <div class="col-xs-6">





                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titlul Categoriei</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                            </tr>
                            </tbody>

                            <?php

                            findAllCategories();

                            ?>

                            <?php

                            deleteCategories();

                            ?>


                        </table>
                    </div>


                </div>

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include 'includes/admin_footer.php'?>
