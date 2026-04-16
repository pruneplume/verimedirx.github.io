<?php
header('Content-Type: application/json');
require_once 'connect.php';

$input_data = json_decode(file_get_contents('php://input'), true);
if (!$input_data) {
    echo json_encode(["success" => false, "error" => "Invalid JSON data"]);
    exit;
}

$user_number = $input_data['user_number'] ?? '';
$user_id = $input_data['user_id'] ?? '';
$cart = $input_data['cart'] ?? [];
$total = 0;


if ($user_id === '' || !is_array($cart) || count($cart) === 0) {
    echo json_encode(["success" => false, "error" => "Missing user or empty cart"]);
    exit;
}



$order_number = pg_query_params(
    $DB_connection,
    "INSERT INTO orders ( user_number) VALUES ( $1) RETURNING order_number",
    [ $user_number]
);

foreach ($cart as $item) {
    $total += ($item['product_price'] ?? 0);
    $product_number[] = ($item['product_number'] ?? '');
    $order_quantity[] = ($item['quantity'] ?? 0);
    $add_order[] = pg_query_params(
        $DB_connection,
        "INSERT INTO order_list ( order_number, user_number, product_number, order_quantity) VALUES ($1, $2, $3, $4) RETURNING order_number",
        [$order_number, $user_number, $product_number, $order_quantity]
        );
}

if (!$order_number ) {
    echo json_encode(["success" => false, "error" => "Database insert failed"]);
    exit;
}


$row = pg_fetch_assoc($add_order[0]);
$order_number = $row['order_number'];

echo json_encode(["success" => true, "order_number" => $order_number]);
