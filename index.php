<!DOCTYPE html>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>

<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
    .error {
        color: #FF0000;
    }

    .table {
        table-layout: fixed !important;
    }

    .table tbody tr th td {
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<link rel="icon" href="favicon.ico" type="image/x-icon" />

<body>

    <a class="btn btn-primary btn-lg btn-block" href="addcode.php" role="button">Share Code</a>
    <br>

    <?php

    header("Content-Type:text/html;charset=utf-8");
    $conn = new mysqli("localhost", "root", "", "code");
    mysqli_query($conn, "set character set 'utf8'");
    mysqli_query($conn, "set names 'utf8'");

    $sql = "SELECT * FROM code_contents ORDER BY cid DESC LIMIT 10";

    $result = $conn->query($sql);

    echo "<table class='table table-hover table-bordered table-striped'>";
    echo "<tr>";
    echo "<th>Cid</th>";
    echo "<th>Title</th>";
    echo "<th>Author</th>";
    echo "<th>more</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_array($result)) {
        $author = $row["author"] == "" ? "undefined" : $row["author"];
        echo "<tr>";
        echo "<td>" . $row["cid"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $author . "</td>";
        echo "<td>" . "<a class=\"btn btn-default\" href=\"code.php?cid=" . $row["cid"] . "\" role=\"button\">view</a></td>";
        echo "</tr>";
        // echo "Title: " . $row["title"] . " author: " . $row["author"] . " text: " . $row["text"] . "<br>";
    }

    echo "</table>";

    ?>

</body>

</html>
