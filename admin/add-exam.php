<?php session_start();
if (!isset($_SESSION['admin_username'])) {
    header('Location:./');
}
?>
<?php include 'inc/header.php'?>
<main class="container">

    <div class="row">

        <form style=" margin:0 auto" class="col m6 l6 s12" id="addcategory">
            <h5 class="center">Add New Category</h5>

            <input type="text" name="category" placeholder="Add New Category" id="category">
            <input type="text" name="level" placeholder="Add Exam level" id="level">
            <input type="hidden" name="add_exam_cat" value="1">
            <textarea name="cat_description" class="materialize-textarea" placeholder="Category Description"
                id="category_description"></textarea>
            <div class="input-field file-field col s12 checkinput m12 l12">
                <div class="btn brown checkinput">
                    <span class="mdi mdi-upload" for="category_picture">Category Picture</span>
                    <input type="file" name="category_picture" id="category_picture" onchange="upload()">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div id="caterror" class="center-align"></div>

            <ul class="center-align" style="padding-bottom:3px; border-bottom: 1px solid #eee">
                <button type="submit" class="btn brown" id="addCat">Add Category</button>
            </ul>
        </form>

        <form class="col m6 l6 s12">
            <h5 class="center" style="margin-bottom:77px">Delete Exam Category</h5>

            <select id="categorydelete">
                <option value="0" disabled selected>Select Category to Delete</option>
                <?php
                  $selectcategory = mysqli_query($conn, "SELECT * FROM cbt_categories ORDER BY cbt_cat_name");
                  while ($row = mysqli_fetch_array($selectcategory)) {
                      $cat_id = $row['cbt_cat_id'];
                      $cat_name = $row['cbt_cat_name'];
                      echo "<option value='" . $cat_id . "'>" . ucwords($cat_name) . "</option>";
                  }
                  ?>
            </select>

            <div id="catdeleteerror" class="center-align"></div>

            <ul class="center-align" style="padding-bottom:3px; border-bottom: 1px solid #eee;margin-top:148px">
                <button type="submit" class="btn brown" id="deleteCat">Delete Category</button>
            </ul>
        </form>

    </div>

    <h5 class="center">Add Exam</h5>

    <form id="addexam">
        <input type="hidden" required name="registerexam" id="registerexam">
        <div class="input-field ">
            <input placeholder="Subject Name" type="text" required name="examname" id="examname">
        </div>

        <div class="input-field">
            <input type="text" required name="examtime" id="examtime" placeholder="Exam time in seconds">
        </div>

        <select id="examcategory" name="examcategory">
            <option value="" disabled selected>Select Exam Category</option>
            <?php
            $selectcategory = mysqli_query($conn, "SELECT * FROM cbt_categories ORDER BY cbt_cat_name");
            while ($row = mysqli_fetch_array($selectcategory)) {
                $cat_id = $row['cbt_cat_id'];
                $cat_name = $row['cbt_cat_name'];
                echo "<option value='" . $cat_name . "'>" . ucwords($cat_name) . "</option>";
            }
            ?>
        </select>

        <div class="input-field" style="margin-bottom: 50px">
            <textarea required id="examdescription" class="materialize-textarea" name="examdescription"
                placeholder="Describe The Course"></textarea>
        </div>

        <div class="input-field" style="margin-bottom: 50px">
            <textarea required id="examinstruction" name="examinstruction" class="materialize-textarea"
                placeholder="State Exam Instructions"></textarea>
        </div>

        <div class="input-field file-field">
            <div class="btn brown checkinput">
                <span class="mdi mdi-upload">Upload Questions in .csv format</span>
                <input type="file" name="exam" accept=".xlsx, .xls, .csv, .txt" required>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <!--displays the error messages here-->
        <div id="examuploaderror" class="center-align"></div>

        <ul class="center-align" style="margin-top: 12px;">
            <button type="submit" class="btn brown">Upload</button>
        </ul>
    </form>

</main>

<?php include 'inc/footer.php';?>
<script>
//get the form object
form = document.getElementById("addcategory");
//check if it was submitted
form.addEventListener('submit', function(e) {
    e.preventDefault();
    category = $("#category").val();
    level = $("#level").val();
    category_description = $("#category_description").val();
    //check if all the fields where filled and send itaccross as an ajax request
    if ((category != "") && (level != "") && (category_description != "")) {

        //create a new request object
        var ajax = new XMLHttpRequest();
        //open the file you are sending therequest to
        ajax.open("POST", "inc/add_process.php", true);

        //get me a response
        ajax.onload = function(e) {

            $("#caterror").html(ajax.responseText);
            location.href = 'add-exam.php';

        };

        //send the request as a form data
        ajax.send(new FormData(form));



    } else {

        $("#caterror").html("An error occured");
    }

}, false);



$("#deleteCat").click(function(e) {
    e.preventDefault();
    categorydelete = $("#categorydelete").val();
    if (categorydelete != "0") {
        $.post('inc/add_process.php', {
            delete_exam_cat: 1,
            categorydelete: categorydelete
        }, function(data) {
            $("#catdeleteerror").html(data);
            location.href = 'add-exam.php';
        });
    } else {
        $("#catdeleteerror").html("Either fields cannot be empty");
    }
})

//uploading of the exams in to its table
//get the form object by its ID
examform = document.getElementById("addexam");
//check if it was submitted
examform.addEventListener('submit', function(e) {
    e.preventDefault();

    examname = $("#examname").val();
    examtime = $("#examtime").val();
    examcategory = $("#examcategory").val();
    examinstruction = $("#examinstruction").val();
    examdescription = $("#examdescription").val();


    //check if all the fields where filled and send itaccross as an ajax request
    if ((examname != "") && (examtime != "") && (examcategory != "") && (examinstruction != "") && (
            examdescription != "")) {
        // alert(examname);};
        //create a new request object
        var ajax = new XMLHttpRequest();
        //open the file you are sending therequest to
        ajax.open("POST", "inc/add_process.php", true);
        //send the request as a form data
        ajax.send(new FormData(examform));


        //get me a response
        ajax.onload = function(e) {
            // alert('sent');
            $("#examuploaderror").html(ajax.responseText);
            delay(10000)
            //location.href = 'add-exam.php';

        };

    } else {

        $("#examuploaderror").html("Please fill all fields");
    }

}, false);
</script>