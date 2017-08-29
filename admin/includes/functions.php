<?php
include_once 'psl-config.php';

function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name 
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id();    // regenerated the session, delete the old one. 
}

function login($email, $password, $conn_mysql) {
    //verificando, a partir do e-mail, a conexão
    $stm = "SELECT id, username, password FROM member WHERE email='$email' LIMIT 1";
    $result = mysql_query($stm);
    if($result){
	$row = mysql_fetch_assoc($result);
	$user_id = $row["id"];
	$username = $row["username"];
	$db_password = $row["password"];
	if(mysql_num_rows($result) == 1){
		if(checkbrute($user_id, $conn_mysql) == true){
			return false;
		}else{
			if(password_verify($password, $db_password)){
				$user_browser = $_SERVER['HTTP_SER_AGENT'];
				$user_id = preg_replace("/[^0-9]+/", "",  $user_id);
				$_SESSION['user_id'] = $user_id;
				$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
				$_SESSION['username'] = $username;
				$_SESSION['login_string'] = hash('sha512',$db_password . $user_browser);
				return true;
			}else{
				$now = time();
				mysql_query("INSERT INTO login_attemps(user_id, time) VALUES ('$user_id', '$now')");
			}
		}
	}else{
		return false;
	}
    }

}

function checkbrute($user_id, $conn_mysql) {
    // Get timestamp of current time 
    $now = time();

    // All login attempts are counted from the past 2 hours. 
    $valid_attempts = $now - (2 * 60 * 60);

    $stmt = "SELECT time FROM login_attempts WHERE user_id = '$user_id' AND time > '$valid_attempts'";
    $resultt = mysql_query($stmt);
    if ($result) {
        // If there have been more than 5 failed logins 
        if (mysql_num_rows($resultt) > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($conn_mysql) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {

        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];

        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
	$stmt = "SELECT password FROM members WHERE id='$user_id' LIMIT 1";
	$result = mysql_query($stmt);
        if ($result) {
            if (mysql_num_rows($result) == 1) {
		$row = mysql_fetch_assoc($result);
                // If the user exists get variables from result.
		$password = $row["password"];1;
                $login_check = hash('sha512', $password . $user_browser);

                if (hash_equals($login_check, $login_string) ){
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
}

function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function esc_url($url) {

    if ('' == $url) {
        return $url;
    }

    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;

    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }

    $url = str_replace(';//', '://', $url);

    $url = htmlentities($url);

    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);

    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
