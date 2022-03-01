<!DOCTYPE html>
<html>

<body>

    <!-- jQuery -->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>

    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/style.css">


    <?php
    header("Content-Type:text/html;charset=utf-8");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $conn = new mysqli("localhost", "root", "", "code");
        mysqli_query($conn, "set character set 'utf8'");
        mysqli_query($conn, "set names 'utf8'");

        $cid = $_GET["cid"];

        $sql = "select text from code_contents where cid='$cid'";
        $result = $conn->query($sql);
        $text = mysqli_fetch_array($result)['0'];
        // $text = preg_replace("/\r\n/", "<br/>", $text);
    } else {
        $text = "sth error";
    }
    ?>

    <div class="container">
        <a class="btn btn-primary btn-lg btn-block" href="index.php" role="button">Home</a>
        <a class="btn btn-primary btn-lg btn-block" onclick="copy()" role=" button">Copy</a>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-group">
                <textarea class="form-control" id="Text" name="text" rows="25" readonly><?php echo $text; ?></textarea>
            </div>

        </form>
    </div>

    <script>
        function copy() {
            console.log("copy3");
            var text = document.getElementById("Text");
            text.select();
            document.execCommand("Copy");
        }
    </script>

</body>

</html>
