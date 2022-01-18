<!DOCTYPE html>
<html>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>

<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<style>
    .error {
        color: #FF0000;
    }
</style>

<body>


    <?php
    header("Content-Type:text/html;charset=utf-8");

    $title = $author = $text = "";
    $titleErr = $authorErr = $textErr = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $flag = 1;

        if (empty($_POST["title"])) {
            $flag = 0;
            $titleErr = "请填入";
        } else {
            $titleErr = "";
            // $title = $_POST["title"];
            $title = test_input($_POST["title"]);
        }

        if (empty($_POST["author"])) {
            $author = "";
        } else {
            // $author = $_POST["author"];
            $author = test_input($_POST["author"]);
        }

        if (empty($_POST["text"])) {
            $flag = 0;
            $textErr = "请填入";
        } else {
            $textErr = "";
            $text = $_POST["text"];
            $text =  str_replace("\\", "\\\\", $text);
            $text =  str_replace("'", "\'", $text);
            // $text =  str_replace("\n", "<br>", $text);
            // $text = test_input($_POST["text"]);
        }

        if ($flag == 1) data_insert($title, $author, $text);
    }

    function data_insert($title, $author, $text)
    {
        $conn = new mysqli("localhost", "root", "", "code");
        mysqli_query($conn, "set character set 'utf8'");
        mysqli_query($conn, "set names 'utf8'");

        $sql = "insert into code_contents value(0, '$title', '$author', '$text', curdate())";

        if (mysqli_query($conn, $sql)) {
            $sql   = "select max(cid) from code_contents";

            $result = $conn->query($sql);

            $cid =   mysqli_fetch_array($result)['0'];

            $title = $author = $text = "";
            $titleErr = $authorErr = $textErr = "";

            header("refresh:0.1;url=code.php?cid=$cid");
        } else {
            echo $sql;
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-group">
                <label for="formTitle">
                    <span class="error">* <?php echo $titleErr; ?></span>Title
                </label>
                <input type="text" class="form-control" id="formTitle" name="title" value="<?php echo $title ?>" placeholder="2021 ICPC-final A">
            </div>

            <div class="form-group">
                <label for="formAuthor">Author</label>
                <input type="text" class="form-control" id="formAuthor" name="author" value="<?php echo $author ?>" placeholder="Fahaxiki">
            </div>

            <div class="form-group">
                <label for="formText">
                    <span class="error">* <?php echo $textErr; ?></span> Code
                </label>
                <textarea class="form-control" id="formText" name="text" rows="20"><?php echo $text; ?></textarea>
            </div>

            <button type="submit" value="Submit" class="btn btn-default">Submit</button>
        </form>
    </div>


</body>

</html>
