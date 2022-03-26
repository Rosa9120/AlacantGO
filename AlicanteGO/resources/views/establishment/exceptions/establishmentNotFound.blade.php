<html>
<head>
    <title>Establishment does not exist</title>
</head>

<body>

    <p href="{{ route('brand.setBrand', ['inexistent_name' => $inexistent_name]) }}">
    <?php echo "There is not any establishment called  $inexistent_name"; ?>
    </p>

</body>

</html>