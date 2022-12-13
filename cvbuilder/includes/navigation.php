<?php
include('includes/header.php');
include('config/db.php');

$currentuser = $_SESSION['user_name'];
$sql = "SELECT * FROM users WHERE user_name='$currentuser'";

$gotResults = mysqli_query($connection,$sql);

if($gotResults){
    if(mysqli_num_rows($gotResults)>0){
        while($row = mysqli_fetch_array($gotResults)){
            $id = $row['id'];
        }
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/cvbuilder">CVBuilder</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/cvbuilder">Home <span class="sr-only">(current)</span></a>
                </li>

                <?php
                    if(!isset($_SESSION['user_name'])){
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        <?php
                    }else{
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Resume
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="personalInfo.php">Personal Info</a>
                                <a class="dropdown-item" href="education.php?id=<?php echo $id; ?>">Education</a>
                                <a class="dropdown-item" href="skills.php?id=<?php echo $id; ?>">Skills</a>
                                <a class="dropdown-item" href="experience.php?id=<?php echo $id; ?>">Experience</a>
                                <a class="dropdown-item" href="certificates.php?id=<?php echo $id; ?>">Certificates</a>
                                <a class="dropdown-item" href="references.php?id=<?php echo $id; ?>">References</a>
                                <a class="dropdown-item" href="languages.php?id=<?php echo $id; ?>">Languages</a>
                                <a class="dropdown-item" href="interests.php?id=<?php echo $id; ?>">Interests</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="cv/template.php?id=<?php echo $id; ?>">Generate Resume</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="processes/logoutProcess.php">Logout</a>
                            </li>
                        <?php
                    }

                ?>
                </ul>
            </div>
        </nav>