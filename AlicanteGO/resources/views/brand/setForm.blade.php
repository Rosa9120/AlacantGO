<html>
<head>
    <title>Brand setter</title>
</head>

<style>
      div {
        margin-bottom: 10px;
      }
      label {
        display: inline-block;
        width: 150px;
        text-align: right;
      }
      button {
        display: inline-block;
        text-align: right;
      }
</style>

<body>
    <h1>Hello, introduce the name of a valid establishment and the brand to which it belongs</h1>

    <form action="{{url('brand_set')}}" method="POST">
        @csrf

        <label>Establishment: </label><input type="text" name="establishment_name">
        <div>

        <label>Brand: </label> <input type="text" name="brand_name">
        <div>
            
        <button type="submit">Send</button>
    </form>

</body>

</html>