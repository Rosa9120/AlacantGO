<html>
<head>
    <title>Brand does not exist</title>
</head>

<body>

    <p href="{{ route('brand.setBrand', ['inexistent_name' => $inexistent_name]) }}">
    <?php "There is not any brand called  echo $inexistent_name"; ?>
    </p>

</body>

</html>