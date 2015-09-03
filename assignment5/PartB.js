function AddEmployee()
    {
        $name   =   $_POST['name'];
        $hourly =   $_POST['num'];
        // Don't add if the hours are not numbers
        // You could return either an error or false here
        // then make an error message if not added
        if(!is_numeric($_POST['num']))
            return;
        // Since you don't have any more than two scenarios,
        // you can just check for one, the other is default
        $tmp    =   ($hourly <= 40)? $hourly * 15 : (($hourly-40)*(27.5)+(40*15));
        // Assign the values here
        // You can store the name as the key, or make this a numbered array
        // And store name in a new key/value pair
        $_SESSION[$name]['num']     =   $hourly;
        $_SESSION[$name]['earn']    =   $tmp;

    }

/* =================================
 ===  MODAL LOGIC            ====
 =================================== 
$('#myModal').on('click', function () {
    $('#myInput').focus()
})*/