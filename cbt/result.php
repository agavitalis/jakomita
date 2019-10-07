<?php session_start();

$conn = mysqli_connect("us-cdbr-iron-east-05.cleardb.net","be7502081e1fd6","6e9984ad","heroku_8c2e9da35585d79");
$username = $_SESSION['user_username'];
$sql = "SELECT * FROM scores WHERE `user_name`='$username'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);


?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Jakomita| Result</title>
    <link href="../css/shortcode.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../js/jquery.js"></script>
    <link href="../css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="../js/bootstrap.min.js"></script>

    <style type="text/css">
    .result-c {
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="jumbotron" style="text-align: center; margin-top:5em">
            <div class="row">
                <!-- Current avatar -->
                <div class="col col-md-12 col-sm-12 col-xs-12">
                    <img class="img-responsive login-img " src="../images/logo2.png" alt="Jakomita Logo" title="Logo">
                </div>
            </div>
            <h1>Awesome <?php echo ucwords($row['user_name']); ?></h1>
            <p>Thanks for taking
                <?php echo ucwords($row['category']). "Quiz" ; ?></p>
            <p>Your score is</p>
            <div class="col col-md-6 col-md-offset-3">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="result-c">No. Of Questions</th>
                                <th class="result-c">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="result-c"><?php echo $row['number_of_questions']; ?></td>
                                <td class="result-c"><?php echo $row['score']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="clearfix"></div>

            <p>Do you want to share with your friend?</p>
            <div class="btn-group ">
                <button type="button" class="btn btn-info"><a href="./">Back</a></button>
                <button type="button" class="btn btn-primary">Share</button>

            </div>

        </div>
    </div>


    <script type="text/javascript">
    $("#printer").click(function(e) {
        e.preventDefault();
        $(this).hide();
        $("footer").hide();
        window.print();
        $("footer").show();
        $(this).show();
    })
    </script>
</body>

</html>
<?php 
//session_destroy();
?>