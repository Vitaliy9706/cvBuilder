<?php
include('includes/header.php');
include('../config/db.php');
$id=$_GET['id'];

$sql = "SELECT * FROM users WHERE id='$id'";

$gotResults = mysqli_query($connection,$sql) or die(mysqli_error($connection));

    if($gotResults){
        if(mysqli_num_rows($gotResults)>0){
        while($row = mysqli_fetch_array($gotResults)){
            $userFirstName = $row['f_name'];
            $userLastName = $row['l_name'];
            $userJobTitle = $row['job_title'];
            $userEmail = $row['email'];
            $userPhoneNum = $row['p_number'];
            $userCity = $row['city'];
            $userAddress = $row['u_address'];
            $userLink = $row['linkedin'];
            $userFace = $row['facebook'];
            $userInst = $row['instagram'];
            $userProfDesc = $row['p_desc'];
            $userImage = $row['user_image'];

        }
    }
}

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="css/styles.css">

        <title>Responsive resume cv</title>
    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="l-header" id="header">
            <nav class="nav bd-container">
                <a href="#" class="nav__logo"><?php echo $userFirstName; ?></a>

                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="#home" class="nav__link active-link">
                                <i class="bx bx-home nav__icon"></i>Home
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#profile" class="nav__link">
                                <i class="bx bx-user nav__icon"></i>Profile
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#education" class="nav__link">
                                <i class="bx bx-book nav__icon"></i>Education
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#skills" class="nav__link">
                                <i class="bx bx-receipt nav__icon"></i>Skills
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#experience" class="nav__link">
                                <i class="bx bx-briefcase-alt nav__icon"></i>Experience
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#certificates" class="nav__link">
                                <i class="bx bx-award nav__icon"></i>Certificates
                            </a>
                        </li>

                        <li class="nav__item">
                            <a href="#references" class="nav__link">
                                <i class="bx bx-link-external nav__icon"></i>References
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class="bx bx-grid-alt"></i>
                </div>
            </nav>
        </header>

        <main class="l-main bd-container">
            <!-- All elements within this div, is generated in PDF -->
            <div class="resume" id="area-cv">
                <div class="resume__left">
                    <!--========== HOME ==========-->
                    <section class="home" id="home">
                        <div class="home__container section bd-grid">
                            <div class="home__data bd-grid">
                                <img src="../public/userImages/<?php echo $userImage; ?>" alt="" class="home__img">

                                <h1 class="home__title"><?php echo $userFirstName; ?> <b><?php echo $userLastName; ?></b></h1>
                                <h3 class="home__profession"><?php echo $userJobTitle; ?></h3>

                                <div>
                                    <a download="" href="pdf/ResumeCv.pdf" class="home__button-movil">Download</a>
                                </div>
                            </div>

                            <div class="home__address bd-grid">
                                <span class="home__information">
                                    <i class='bx bx-map home__icon'></i> <?php echo $userAddress; ?> - <?php echo $userCity; ?>
                                </span>
                                <span class="home__information">
                                    <i class='bx bx-envelope home__icon'></i> <?php echo $userEmail; ?>
                                </span>
                                <span class="home__information">
                                    <i class='bx bx-phone home__icon'></i> <?php echo $userPhoneNum; ?>
                                </span>
                            </div>
                        </div>
                        <!-- Theme change button -->
                        <i class='bx bx-moon change-theme' title="Theme" id="theme-button" ></i>
    
                        <!-- Button to generate and download the pdf. Available for desktop. -->
                        <i class='bx bx-download generate-pdf' title="Generate PDF" id="resume-button"></i>
                    </section>          
                    
                    <!--========== SOCIAL ==========-->
                    <section class="social section">
                        <h2 class="section-title">SOCIAL</h2>

                        <div class="social__container bd-grid">
                            <?php
                                if($userLink == ""){

                                }else{
                                    ?>
                                        <a href="https://www.linkedin.com/in/<?php echo $userLink; ?>" target="_blank" class="social__link">
                                            <i class='bx bxl-linkedin-square social__icon'></i> @<?php echo $userLink; ?>
                                        </a>
                                    <?php
                                }                            
                            ?>
                            <?php
                            if($userFace == ""){

                            }else{
                                ?>
                                    <a href="https://www.facebook.com/<?php echo $userFace; ?>" target="_blank" class="social__link">
                                        <i class='bx bxl-facebook social__icon'></i> @<?php echo $userFace; ?>
                                    </a>
                                <?php
                            }
                            ?>
                            <?php
                            if($userInst == ""){

                            }else{
                                ?>
                                    <a href="https://www.instagram.com/<?php echo $userInst; ?>" target="_blank" class="social__link">
                                        <i class='bx bxl-instagram social__icon'></i> @<?php echo $userInst; ?>
                                    </a>
                                <?php
                            }

                            ?>
                        </div>
                    </section>

                    <!--========== PROFILE ==========-->
                    <section class="profile section" id="profile">
                        <h2 class="section-title">Profile</h2>

                        <p class="profile__description">
                        <?php echo $userProfDesc; ?>
                        </p>
                    </section>
                    
                    <!--========== EDUCATION ==========-->
                    <section class="education section" id="education">
                        <h2 class="section-title">Education</h2>

                        <div class="education__container bd-grid">
                            <?php 
                                $query = "SELECT * FROM education WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result => $value){
                                        $class = ($result === count($results)+1) ? "last" : "not-last";
                                            ?>
                                            <div class="education__content">
                                                <div class="education__time">
                                                    <span class="education__rounder"></span>
                                                    <span class="education__line <?php echo $class; ?>"></span>
                                                </div>

                                                <div class="education__data bd-grid">
                                                    <h3 class="education__title"><?php echo $value['subject']; ?></h3>
                                                    <span class="education__studies"><?php echo $value['university']; ?></span>
                                                    <span class="education__year"><?php echo $value['year_from']; ?> - <?php echo $value['year_to'] ?></span>
                                                </div>
                                            </div>
                                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>


                    <!--========== SKILLS  ==========-->
                    <section class="skills section" id="skills">
                        <h2 class="section-title">Skills</h2>

                        <div class="skills__content bd-grid">
                            <ul class="skills__data">
                            <?php 
                                $query = "SELECT * FROM skills WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result){
                                        ?>
                                            <li class="skills__name">
                                                <span class="skills__circle"></span> <?php echo $result['skill_name']; ?>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                    </section>

                </div>

                <div class="resume__right">
                    <!--========== EXPERIENCE ==========-->
                    <section class="experience section" id="experience">
                        <h2 class="section-title">Experience</h2>

                        <div class="experience__container bd-grid">
                            <?php 
                                $query = "SELECT * FROM experience WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result => $value){
                                        $class = ($result === count($results)+1) ? "last" : "not-last";
                                            ?>
                                            <div class="experience__content">
                                                <div class="experience__time">
                                                    <span class="experience__rounder"></span>
                                                    <span class="experience__line <?php echo $class; ?>"></span>
                                                </div>

                                                <div class="experience__data bd-grid">
                                                    <h3 class="experience__title"><?php echo $value['position']; ?></h3>
                                                    <span class="experience__company">From <?php echo $value['year_from']; ?> to <?php echo $value['year_to']; ?> | <?php echo $value['company']; ?></span>
                                                    <p class="experience__description">
                                                    <?php echo $value['ex_desc']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <!---->
                                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>

                    <!--========== CERTIFICATES ==========-->
                    <section class="certificate section" id="certificates">
                        <h2 class="section-title">Certificates</h2>

                        <div class="certificete__conatainer bd-grid">
                            <?php 
                                $query = "SELECT * FROM certificates WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result){
                                        ?>
                                            <div class="certificate__content">
                                                <h3 class="certificate__title"><?php echo $result['cert_title']; ?></h3>
                                                <p class="certificate__decription">
                                                <?php echo $result['cert_desc']; ?>
                                                </p>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>

                    <!--========== REFERENCES ==========-->
                    <section class="references section" id="references">
                        <h2 class="section-title">References</h2>

                        <div class="references__container bd-grid">
                            <?php 
                                $query = "SELECT * FROM u_references WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result){
                                        ?>
                                            <div class="references__content bd-grid">
                                                <span class="references__subtitle"><?php echo $result['ref_position']; ?></span>
                                                <h3 class="refrences__title"><?php echo $result['ref_name']; ?></h3>
                                                <ul class="references__contact">
                                                    <li>Phone: <?php echo $result['ref_phone']; ?></li>
                                                    <li>Email: <?php echo $result['ref_email']; ?></li>
                                                </ul>
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>

                    <!--========== LANGUAGES ==========-->
                    <section class="languages section">
                        <h2 class="section-title">Languages</h2>

                        <div class="languages__container">
                            <ul class="languages__content bd-grid">
                            <?php 
                                $query = "SELECT * FROM languages WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result){
                                        ?>
                                            <li class="languages__name">
                                                <span class="languages__circle"></span> <?php echo $result['lang_name']; ?>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                            </ul>
                        </div>
                    </section>
                    
                    <!--========== INTERESTS ==========-->
                    <section class="interests section">
                        <h2 class="section-title">Interests</h2>

                        <div class="interests__container bd-grid">
                            <?php 
                                $query = "SELECT * FROM interests AS a INNER JOIN icons AS b ON (a.icon_id = b.id) WHERE uid='$id'";
                                $results = mysqli_query($connection, $query);
                                if(mysqli_num_rows($results) > 0){
                                    foreach($results as $result){
                                        ?>
                                            <div class="interests__content">
                                                <i class='bx <?php echo $result['icon_name']; ?> interests__icon'></i> 
                                                <span class="interest__name"><?php echo $result['interest_name']; ?></span> 
                                            </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </section>
                </div>
            </div>        
        </main>

        <!--========== SCROLL TOP ==========-->
        <a href="#" class="scrolltop" id="scroll-top">
            <i class='bx bxs-up-arrow-alt scrolltop__icon'></i>
        </a>

        <!--========== HTML2PDF ==========-->
        <script src="js/html2pdf.bundle.min.js"></script>

        <!--========== MAIN JS ==========-->
        <script src="js/main.js"></script>
    </body>
</html>