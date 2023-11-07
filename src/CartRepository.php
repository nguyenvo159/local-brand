<?php
namespace CT275\Labs;

use PDO;

class CartRepository
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Lấy sản phẩm theo ID
    public function getCartById(int $userId, int $cartId): ?Cart
    {
        $statement = $this->pdo->prepare("SELECT * FROM Cart WHERE userID = :userID AND cartID = :cartID");
        $statement->bindParam(':userID', $userId);
        $statement->bindParam(':cartID', $cartId);
        $statement->execute();

        $cartData = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$cartData) {
            return null; 
        }

        return new Cart(
            $cartData['cartID'],
            $cartData['userID'],
            $cartData['productID'],
            $cartData['quantity'],
            $cartData['money']
        );
    }
    // Lấy cart theo userID 
    public function getAllCartsByUserId(int $userId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM Cart WHERE userID = :userID ORDER BY cartID DESC");
        $statement->bindParam(':userID', $userId);
        $statement->execute();

        $carts = [];
        while ($cartData = $statement->fetch(PDO::FETCH_ASSOC)) {
            $cart = new Cart(
                $cartData['cartID'],
                $cartData['userID'],
                $cartData['productID'],
                $cartData['quantity'],
                $cartData['money'] 
            );
            $carts[] = $cart;
        }

        return $carts;
    }
    // Lấy quantity theo userID, productID
    public function getQuantityByProductId(int $userId, int $productId): int
    {
        $statement = $this->pdo->prepare("SELECT quantity FROM Cart WHERE userID = :userID AND productID = :productID");
        $statement->bindParam(':userID', $userId);
        $statement->bindParam(':productID', $productId);
        $statement->execute();

        return (int)$statement->fetchColumn();
    }

    // Thêm sản phẩm
    public function addToCart(int $userId, int $productId, int $quantity): bool
    {
        // $quantity =1;
        if ($this->getQuantityByProductId($userId, $productId)) {
            $currentQuantity = $this->getQuantityByProductId($userId, $productId);
            $newQuantity = $currentQuantity + $quantity;
            return $this->updateQuantity($userId, $productId, $newQuantity);


        } else {
            // Nếu chưa tồn tại, thêm mới
            $statement = $this->pdo->prepare("INSERT INTO Cart (userID, productID, quantity) VALUES (:userID, :productID, 1)");
        
            $statement->bindParam(':userID', $userId);
            $statement->bindParam(':productID', $productId);
            // $statement->bindParam(':quantity', $quantity);
        
            return $statement->execute();
        }
    }


    // Cập nhật số lượng sản phẩm
    public function updateQuantity(int $userId, int $productId, int $newQuantity): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE Cart SET quantity = :newQuantity 
            WHERE userID = :userID AND productID = :productID"
        );

        $statement->bindParam(':newQuantity', $newQuantity);
        $statement->bindParam(':userID', $userId);
        $statement->bindParam(':productID', $productId);

        return $statement->execute();
    }

    // Xóa 1 sản phẩm trong Cart
    public function removeFromCart(int $userId, int $productId): bool
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM Cart 
            WHERE userID = :userID AND productID = :productID"
        );

        $statement->bindParam(':userID', $userId);
        $statement->bindParam(':productID', $productId);

        return $statement->execute();
    }

    // Xóa cart 
    public function removeAll(int $userId): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM Cart WHERE userID = :userID");
        $statement->bindParam(':userID', $userId);

        return $statement->execute();
    }


    public function getTotalMoney(int $userId): float
    {
        $statement = $this->pdo->prepare("SELECT SUM(money) FROM Cart WHERE userID = :userID");
        $statement->bindParam(':userID', $userId);
        $statement->execute();

        $totalMoney = (float)$statement->fetchColumn();

        return $totalMoney;
    }
    public function isCartEmpty(int $userId): bool
    {
        $statement = $this->pdo->prepare("SELECT COUNT(*) FROM Cart WHERE userID = :userID");
        $statement->bindParam(':userID', $userId);
        $statement->execute();

        $rowCount = $statement->fetchColumn();

        return $rowCount === 0;
    }
}

class Cart
{
    protected $cartId;
    protected $userId;
    protected $productId;
    protected $quantity;
    protected $money; 

    public function __construct($cartId, $userId, $productId, $quantity, $money)
    {
        $this->cartId = $cartId;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->money = $money; 
    }

    // Getter 

    public function getCartId()
    {
        return $this->cartId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getMoney()
    {
        return $this->money;
    }
}
