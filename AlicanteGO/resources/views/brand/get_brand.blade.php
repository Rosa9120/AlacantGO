<html>
<head>
    <title>Brand Name - Getter</title>
</head>

<body>

    <h1> The selected brand is: <h1>

    <p href="{{ route('brand.getBrand', ['name' => $name]) }}">
        <h1><?php echo $name; ?><h1>
    </p>

</body>

</html>