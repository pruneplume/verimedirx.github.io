

_SESSION[ 'user_id']
$_SESSION[ 'user_number']
$_SESSION[ 'valid']


function get_id($user_id) {
    $user_id = trim( $_POST[ 'user_id']);
    return $user_id;
}