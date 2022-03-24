<html>
<head>
    <title>Brand View by ID</title>
</head>

<body>
    <h1>Hello, select a ID to know which brand is related to it</h1>

    <form action="{{url('brand')}}" method="POST">
        @csrf
        Brand id: <input type="number" name="brand_id">

        <button type="submit">Send</button>
    </form>

</body>

</html>