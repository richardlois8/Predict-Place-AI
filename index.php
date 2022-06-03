<?php require("algorithm.php"); 
reset($_GET);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Predict Place</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    </head>
<style>
    option{
        font-size:18px;
    }

    option span{
        padding:10px;
    }
</style>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#page-top">Predict Place</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Go safe with us</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Safe journey with our prediction</h2>
                    <a class="btn btn-primary" href="#searchPlace">Get Started</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Search Place Form-->
    <section class="about-section text-center" id="searchPlace">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Where do you want to go?</h2>
                    <p class="text-white-50">
                        Type a place do you want to go and we will predict whether the visited place is safe.
                    </p>
                    <form action="index.php" method="get" style="padding-bottom:50px;" id="formLoc">
                        <div class="mb-5 align-items-center">
                            <input type="text" name="place" class="form-control" aria-describedby="placeHelp" placeholder="Place name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>

                        <button hidden type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        id="btnSend">
                        </button>
                    </form>

                    <!-- Function PHP -->
                    <div class="flow-algo" class="text-white-50">
                        <p style="color:white;">
                    <?php  
                    if($_GET){
                        $data = getData();
                        echo "Curah hujan :  ".$data['curahHujan']." mm/hari<br>";
                        echo "Luas daerah resapan : ".$data['daerahResapan']." hektar<br>";
                        echo "Jumlah pohon : ".$data['jumlahPohon']." pohon<br>";
                        echo "Kecepatan angin :  ".$data['kecepatanAngin']." km/jam<br><br>";
                        
                        $facts = getFact($data);
                        $result = solve($facts); 
                        $textRes = "";
                        foreach ($result[0] as $key => $value){
                            $textRes .= $key." -> ".$value."<br>";
                        }
                        echo $textRes;
                        // echo '<script>alert("'.$result.'")</script>';
                        // echo '<script>alert("'.$result[1].'\n'.$result[2].'\n\nKesimpulan : '.$result[0].'")</script>';
                        reset($_GET);
                    }
                    ?>
                        </p>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLabel">Prediksi Daerah <?php if($_GET){echo ucfirst($_GET['place']);}  ?></h5>
                               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                               <h5><?php if(isset($result)){echo $result[1][1].'<br>'.$result[1][2].'<br><br>Kesimpulan : '.$result[1][0];}else{ echo "Welcome to our Prediction Website.";} ?></h5>
                                </h5>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           </div>
                           </div>
                       </div>
                    </div>
                    
                    <script>
                        function submit(){
                            document.getElementById('formLoc').submit();
                        }
                        document.getElementById('btnSend').click();
                        // if(checkData === true){
                        //     document.getElementById('btnSend').click();
                        //     checkData = false;
                        // }
                    </script>
                </div>
            </div>
            <!-- <img class="img-fluid" src="assets/img/ipad.png" alt="..." /> -->
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="about">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="assets/img/bg-masthead.jpg" alt="..." /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>Predict Place</h4>
                        <p class="text-black-50 mb-0">This website developed using <strong>Forward Chaining</strong> algorithm. We make this for educational purpose especially in Artificial Intelligence field.</p>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-01.jpg" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">71200582 - Maverick Mikolas</h4>
                                <h4 class="text-white">71200593 - Dedi Yanto</h4>
                                <!-- <p class="mb-0 text-white-50">An example of where you can put an image of a project, or anything else, along with a description.</p> -->
                                <hr class="d-none d-lg-block mb-0 ms-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/demo-image-02.jpg" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">71200594 - Richard Lois</h4>
                                <h4 class="text-white">71200642 - Richardo Chandra</h4>
                                <h4 class="text-white">71200660 - Haniif Ahmad</h4>
                                <!-- <p class="mb-0 text-white-50">Another example of a project with its respective description. These sections work well responsively as well, try this theme on a small screen!</p> -->
                                <hr class="d-none d-lg-block mb-0 me-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Your Website 2022</div></footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>
