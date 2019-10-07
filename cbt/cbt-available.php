<?php include 'inc/header.php'; ?>
<?php 
$category = $_GET['cat'];
$categoryformatted = strtoupper($category);
 ?>
  <!-- PageBanner -->
  <div class="container-fluid no-padding pagebanner">
    <div class="container">
      <div class="pagebanner-content">
        <h3><?php echo($categoryformatted); ?></h3>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li><?php echo($categoryformatted); ?></li>
        </ol>
      </div>
    </div>
  </div><!-- PageBanner /- -->
  <div class="section-padding"></div>
    <div class="section-header">
      <h3>Select An <span>Exam</span></h3>
      <p>Select an examination to write, the mode you wish to write and click on TAKE TEST</p>
    </div>
<div class="col col-md-6 col-md-offset-3">
  <form class="signin" method="get" action="test-instructions">
    <div class="form-group">
          <input type="hidden" name="cat" value="<?php echo $category ?>">
      <select class="form-control "  name="subject" required="true">
          <option  disabled>Select Test</option>
          <?php           
            $getcategory = mysqli_query($conn,"SELECT cbt_categories.*, cbt_subjects.* FROM cbt_categories INNER JOIN cbt_subjects where cbt_categories.cbt_cat_name = '$categoryformatted' AND cbt_categories.cbt_cat_name = cbt_subjects.sub_cat");
          

            while ($row = mysqli_fetch_array($getcategory)) {
              $subject_name = $row['sub_name'];
              $subject_id = $row['sub_id'];
            
          ?>
          <option value="<?php echo($subject_name) ?>"><?php echo ucwords($subject_name) ?></option>
          <?php } ?>
      </select>
    </div>
        <div class="form-group" style="text-align: center;">
          <label class="d-block">Select Exam Mode</label>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="mode" value="exam" checked required>Exam
            </label>
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="mode" value="game"  disabled>Game Mode
            </label>
          </div>
        </div>
        <div class="form-group">
        <div class="row">
          <div class="col-md-4 col-sm-d-none"></div>
          <div class="col-md-4 col-sm-12">
            <input class="btn btn-block btn-l" type="submit" id="submit" value="TAKE TEST">
          </div>
          <div class="col-dm-4 col-sm-d-none"></div>
        </div>
      </div>  
  </form>
</div>
<div class="clearfix"></div>
<?php include 'inc/footer.php'; ?>


