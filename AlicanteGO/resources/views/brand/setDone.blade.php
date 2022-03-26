<html>
<head>
    <title>Brand set correct</title>
</head>

<body>

    <p href="{{ route('brand.setBrand', ['e_name' => $e_name, 'b_name' => $b_name]) }}">
    <?php echo "Now the establishment $e_name belongs to $b_name"; ?>
    </p>

</body>

</html>