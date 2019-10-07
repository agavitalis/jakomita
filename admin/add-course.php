<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>
<main>
<div class="row signin">
  <h5 class="center">Add a Course</h5>
  <form>
    <div class="input-field col s12">
      <input placeholder="Course code E.g. ECE461" type="text" required name="coursecode">
    </div>
    <div class="input-field col s12">
      <input placeholder="Course title E.g. Introduction to digital instrumentation" type="text" required name="coursetitle">
    </div>
    <div class="input-field col s12 checkinput m12 l6">
      <select name="school">
        <option value="" disabled selected>Select School</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field col s12 checkinput m12 l6">
      <select name="faculty">
        <option value="" disabled selected>Select Faculty</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field col s12 checkinput m12 l12">
      <select name="year">
        <option value="" disabled selected>Select Year (Level)</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field col s12 checkinput m12 l12" style="margin-bottom: 50px">
      <textarea id="textarea" class="materialize-textarea" placeholder="Describe The Course"></textarea>
    </div>
    <ul class="pagination center-align">
      <li class="waves-effect brown" ><button type="submit" class="brown btn">Add Course</button></li>
    </ul>
    </div>
  </form>
</main>
<?php include 'inc/footer.php'; ?>