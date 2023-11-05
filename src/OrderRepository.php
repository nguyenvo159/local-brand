<?php

namespace CT275\Labs;

use Exception;
use PDO;

class OrderRepository
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getOrderById(int $orderId): ?Order
    {
        $statement = $this->pdo->prepare("SELECT * FROM Orders WHERE orderID = :orderID");
        $statement->bindParam(':orderID', $orderId);
        $statement->execute();

        $orderData = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$orderData) {
            return null;
        }

        $orderDetails = $this->getOrderDetailsByOrderId($orderId);

        return new Order(
            $orderData['orderID'],
            $orderData['userID'],
            $orderData['name'],
            $orderData['phone'],
            $orderData['email'],
            $orderData['orderDate'],
            $orderData['totalAmount'],
            $orderData['address'],
            $orderDetails
        );
    }
    public function getOrderDetailsByOrderId(int $orderId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM OrderDetail WHERE orderID = :orderID");
        $statement->bindParam(':orderID', $orderId);
        $statement->execute();

        $orderDetails = [];
        while ($orderDetailData = $statement->fetch(PDO::FETCH_ASSOC)) {
            $orderDetail = new OrderDetail(
                $orderDetailData['orderDetailID'],
                $orderDetailData['orderID'],
                $orderDetailData['productID'],
                $orderDetailData['quantity']
            );
            $orderDetails[] = $orderDetail;
        }

        return $orderDetails;
    }

    public function getAllOrders(int $userID): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM Orders WHERE userID = :userID ORDER BY orderID DESC");
        $statement->bindParam(':userID', $userID);
        $statement->execute();

        $orders = [];
        while ($orderData = $statement->fetch(PDO::FETCH_ASSOC)) {
            $orderDetails = $this->getOrderDetailsByOrderId($orderData['orderID']);

            $order = new Order(
                $orderData['orderID'],
                $orderData['userID'],
                $orderData['name'],
                $orderData['phone'],
                $orderData['email'],
                $orderData['orderDate'],
                $orderData['totalAmount'],
                $orderData['address'],
                $orderDetails
            );
            $orders[] = $order;
        }

        return $orders;
    }

    public function deleteOrder(int $orderId): bool
    {
        $this->deleteOrderDetails($orderId);

        $statement = $this->pdo->prepare("DELETE FROM Orders WHERE orderID = :orderID");
        $statement->bindParam(':orderID', $orderId);

        return $statement->execute();
    }

    protected function deleteOrderDetails(int $orderId): void
    {
        $statement = $this->pdo->prepare("DELETE FROM OrderDetail WHERE orderID = :orderID");
        $statement->bindParam(':orderID', $orderId);
        $statement->execute();
    }

    public function createOrder(int $userID, string $name, string $phone, string $email, float $totalAmount, string $address, array $orderDetails): bool
    {
        $this->pdo->beginTransaction();

        try {
            $statement = $this->pdo->prepare("
                INSERT INTO Orders (userID, name, phone, email, totalAmount, address)
                VALUES (:userID, :name, :phone, :email, :totalAmount, :address)
            ");

            $statement->bindParam(':userID', $userID);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':totalAmount', $totalAmount);
            $statement->bindParam(':address', $address);

            $statement->execute();

            // Lấy ID của đơn hàng mới được thêm
            $orderId = $this->pdo->lastInsertId();

            // Thêm các chi tiết đơn hàng vào bảng OrderDetail
            foreach ($orderDetails as $orderDetail) {
                $this->addOrderDetail($orderId, $orderDetail->getProductID(), $orderDetail->getQuantity());
            }

            // Commit giao dịch nếu mọi thứ diễn ra suôn sẻ
            $this->pdo->commit();

            return true;
        } catch (Exception $e) {
            // Nếu có lỗi xảy ra, rollback giao dịch để tránh dữ liệu không đồng nhất
            $this->pdo->rollBack();
            return false;
        }
    }

    protected function addOrderDetail(int $orderID, int $productID, int $quantity): void
    {
        $statement = $this->pdo->prepare("
            INSERT INTO OrderDetail (orderID, productID, quantity)
            VALUES (:orderID, :productID, :quantity)
        ");

        $statement->bindParam(':orderID', $orderID);
        $statement->bindParam(':productID', $productID);
        $statement->bindParam(':quantity', $quantity);

        $statement->execute();
    }

}

class Order
{
    protected $orderID;
    protected $userID;
    protected $name;
    protected $phone;
    protected $email;
    protected $orderDate;
    protected $totalAmount;
    protected $address;
    protected $orderDetails;

    public function __construct($orderID, $userID, $name, $phone, $email, $orderDate, $totalAmount, $address, $orderDetails = [])
    {
        $this->orderID = $orderID;
        $this->userID = $userID;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->orderDate = $orderDate;
        $this->totalAmount = $totalAmount;
        $this->address = $address;
        $this->orderDetails = $orderDetails;
    }

    // Getter 

    public function getOrderID()
    {
        return $this->orderID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }


    public function getAddress() 
    {
        return $this->address;
    }
    public function getOrderDetail()
    {
        return $this->orderDetails;
    }
    
}

class OrderDetail
{
    protected $orderDetailID;
    protected $orderID;
    protected $productID;
    protected $quantity;

    public function __construct($orderDetailID, $orderID, $productID, $quantity)
    {
        $this->orderDetailID = $orderDetailID;
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->quantity = $quantity;
    }

    // Getter 

    public function getOrderDetailID()
    {
        return $this->orderDetailID;
    }

    public function getOrderID()
    {
        return $this->orderID;
    }

    

    public function getProductID()
    {
        return $this->productID;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
}




