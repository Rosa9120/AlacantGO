<html>
<head>
    <title>ID does not belong to any brand</title>
</head>

<body>

    <p href="{{ route('brand.getBrand', ['wrong_id' => $wrong_id]) }}">
    There is not any brand with the following ID: <?php echo $wrong_id; ?>
    </p>

</body>

</html>