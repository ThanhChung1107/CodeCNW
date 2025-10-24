<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>thông tin chi tiết của sinh viên</h2>
    <?php
    echo "<p>Name: <b>" . $student->name . "</b></p>";
    echo "<p>Age: <b>" . $student->age . "</b></p>";
    echo "<p>University: <b>" . $student->university . "</b></p>";

    ?>
    <p><a href="javascript:history.back()">back</a></p>
</body>
</html>