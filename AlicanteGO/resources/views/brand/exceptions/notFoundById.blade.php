<html>
<head>
    <title>ID does not belong to any brand</title>
</head>

<body>

    <p href="{{ route('brand.getBrand', ['wrong_id' => $wrong_id]) }}">
        <?php echo "There is not any brand with the following ID: $wrong_id"; ?>
    </p>

</body>

</html>