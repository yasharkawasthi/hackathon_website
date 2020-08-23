
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You</title>
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body onload='popUp()'>
    <script>
        function popUp(){
            swal({
                title: "Thank You!",
                text: "Your response have been saved successfully!",
                icon: "success",
                button: "OK",
                });  
        }
    </script>
</body>
</html> 