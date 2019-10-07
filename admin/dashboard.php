<?php session_start();
if (!isset($_SESSION['admin_username'])) {
 header('Location:./');
}
 ?>
<?php include 'inc/header.php'; ?>

<main>
  <div class="row">
    <div class="col s12 m6 l3">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-account-multiple"></i>&nbsp;Users</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l3">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-forum "></i>&nbsp;Forum Posts</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l3">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-comment-question-outline "></i>&nbsp;Materials</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l3">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-book-open-page-variant "></i>&nbsp;Added Courses</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l4">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-certificate "></i>&nbsp;CBT Courses</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l4">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-responsive "></i>&nbsp;Blog Posts</h5>
        <p class="center">500</p>
      </div>
    </div>
    <div class="col s12 m6 l4">
      <div class="card-panel">
        <h5 class="center"><i class="mdi mdi-bullhorn "></i>&nbsp;CBT Requests</h5>
        <p class="center">500</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 l6 m6">
      <ul class="collection">
        <h5 class="center">Messages</h5>
        <li class="collection-item dismissable">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
      </ul>
    </div>
    <div class="col s12 l6 m6">
      <ul class="collection">
        <h5 class="center">Notifications</h5>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
        <li class="collection-item">
          Hello, this is a message
        </li>
      </ul>
    </div>
  </div>
</main>
<?php include 'inc/footer.php'; ?>
