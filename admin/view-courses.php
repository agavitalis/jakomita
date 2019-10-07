<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>

<main>
  <table class="responsive-table striped bordered" >
    <h5 class="center">All Registered Users</h5>
 <thead>
   <tr>
    <th>Fullname</th>
    <th>Email</th>
    <th>Joined</th>
    <th>Delete</th>
    <th>Ban</th>
   </tr>
 </thead>
 <tbody>
  <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
    <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
    <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
    <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
    <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
    <tr>
    <td contenteditable>Apeh Ikechukwu</td>
    <td contenteditable>ikechukwuapeh@gmail.com</td>
    <td contenteditable>25th September, 2017</td>
    <td><a href="#"><i class="mdi mdi-24px mdi-delete-variant"></i></a></td>
    <td><a href="#"><i class="mdi mdi-24px mdi-account-off"></i></a></td>
  </tr>
 </tbody>
 </table>
 <ul class="pagination center-align">
          <li class="waves-effect brown" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-left"></i></a></li>
          <li class="waves-effect brown"><a href="#!" class="white-text">1</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">2</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">3</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">4</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text">5</a></li>
          <li class="waves-effect brown" ><a href="#!" class="white-text"><i class="mdi mdi-chevron-right"></i></a></li>
        </ul>
</main>
<?php include 'inc/footer.php'; ?>
