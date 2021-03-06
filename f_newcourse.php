<?php
    include 'mod/header.php';
    session_start();
    extract($_POST);
    $dao = new DataAccessObject(INI_FILE_PATH); // Data Access Object - Creates conx with DB
    
    $courses = $dao->getCourses();
    
    if(isset($btnSubmit)){
        unset($_SESSION['errCheck']); // errCheck should be empty if no errors are found
        $alertVar = ""; // alerVar is used to display confirmation message after submitting
        $sfldCourseName         = val_newCourse('Course Name', 'fldCourseName'); // Validate fields values and returns error message
        $sfldCourseKey          = val_newCourse('Course Code', 'fldCourseKey');
        $sfldCourseLevel        = val_newCourse('Course Level', 'fldCourseLevel');
        $sfldPassingGrade       = val_newCourse('Passing Grade', 'fldPassingGrade');

        if(empty($_SESSION['errCheck'])){ // No errors found, adds user to db
            $_SESSION['ses_fldCourseName'] = ""; // Clears form values
            $_SESSION['ses_fldCourseKey'] = "";
            $_SESSION['ses_fldCourseLevel'] = "";
            $_SESSION['ses_fldPassingGrade'] = "";
            $dao->saveNewCourse($fldCourseName, $fldCourseKey, $fldCourseLevel, $fldPassingGrade, $dependencies); // Adds new course to the database
            $alertVar = "User: <strong>$fldUsername</strong> Course added succesfully, redirecting you to the courses page.";
            echo "<script type='text/javascript'>setTimeout(function() {document.location.href='/eCoordinator/f_courses.php'}, 2500);</script>"; // Redirects user to login after 5 secs
        }
    }
?>

<div class="row">
    <div class="offset-sm-2 col-sm-7">
        <form id="new_course" method="post">
            <h3><center>Add New Course</center></h3>
            <br>
            <?php
            func_alertBuilder($alertVar, 'Success');
            func_fieldBuilder("TEXTFIELD", "Course Name", "fldCourseName", "", $fldCourseName, "", "text", "col-sm-4", "col-sm-8", "", "", "", $sfldCourseName);
            func_fieldBuilder("TEXTFIELD", "Course Code", "fldCourseKey", "", $fldCourseKey, "", "text", "col-sm-4", "col-sm-8", "", "", "", $sfldCourseKey);
            func_fieldBuilder("TEXTFIELD", "Course Level", "fldCourseLevel", "", $fldCourseLevel, "", "text", "col-sm-4", "col-sm-8", "", "", "", $sfldCourseLevel);
            func_fieldBuilder("TEXTFIELD", "Passing Grade", "fldPassingGrade", "", $fldPassingGrade, "", "text", "col-sm-4", "col-sm-8", "", "", "", $sfldPassingGrade);
            ?>

            <div class="row vcenter">
                <label class="form-control-label formLabel col-sm-4">Dependencies?</label>
                <div class="col-sm-8">
                    <select name="dependencies[]" size="5" multiple="multiple" tabindex="1" class="form-control">
                         <?php 
                            foreach($courses as $course){
                                echo "<option value='{$course->getKey()}'>$course</option>";
                            }
                          ?>
                    </select>
                </div>
            </div>
            
            <div class="row vcenter">
                <div class="offset-sm-2 col-sm-7">
                    <?php
                    echo '<br>';
                    func_btnBuilder("Submit", "btnSubmit", "btnGrey", "col-sm-2", "offset-sm-5");
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
    include 'mod/footer.php';
?>

