<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Необходимо войти в систему']);
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->begin_transaction();
    try {
        $sql = "SELECT SUM(products.price * cart.quantity) AS total_amount 
                FROM cart 
                JOIN products ON cart.product_id = products.id 
                WHERE cart.user_id = $user_id";
        $result = $conn->query($sql);
        $total_amount = $result->fetch_assoc()['total_amount'];

        $stmt = $conn->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
        $stmt->bind_param("id", $user_id, $total_amount);
        $stmt->execute();
        $order_id = $stmt->insert_id;

        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                SELECT $order_id, cart.product_id, cart.quantity, products.price 
                FROM cart 
                JOIN products ON cart.product_id = products.id 
                WHERE cart.user_id = $user_id";
        $conn->query($sql);

        $sql = "DELETE FROM cart WHERE user_id = $user_id";
        $conn->query($sql);

        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>