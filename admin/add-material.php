<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>
<main>
<h5 class="center">Upload Material</h5>
    <form class="signin">
       <div class="input-field ">
      <input placeholder="Material Name" type="text" required name="materialname">
    </div>
    <div class="input-field">
      <select>
        <option value="" disabled selected>Select School</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field">
      <select>
        <option value="" disabled selected>Select Faculty</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field">
      <select>
        <option value="" disabled selected>Select Year (Level)</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
      </select>
    </div>
    <div class="input-field file-field">
      <div class="btn brown checkinput">
        <span class="mdi mdi-upload">Choose Material</span>
        <input type="file" name="material">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="input-field" style="margin-bottom: 50px">
      <textarea id="textarea" class="materialize-textarea" placeholder="Describe The Material"></textarea>
    </div>
    <ul class="center-align" style="margin-top: 12px;">
      <button type="submit" class="btn brown">Upload</button>
    </ul>
    </form>
</main>
<?php include 'inc/footer.php'; ?>