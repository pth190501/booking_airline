<?php
//function cua web
function locdata($var)
    {
        $data = trim(addslashes(htmlspecialchars($var)));
        return $data;
    } // anti sql injection
    
function mget($name) {
    if (isset($_GET[$name])) {
        return locdata($_GET[$name]);
    } else {
        return "";
    }
}

//get data from post method
function mpost($name) {
    if (isset($_POST[$name])) {
        return locdata($_POST[$name]);
    } else {
        return "";
    }
}

function error($text) {
    echo '<script>window.addEventListener("load", (event) => {
                swal("Lỗi","' . $text . '","error"); 
            });
    </script>';
}

function success($text) {
    echo '<script>window.addEventListener("load", (event) => {
                swal("Thành Công","' . $text . '","success"); 
            });
    </script>';
}
?>