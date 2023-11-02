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

    public function getAllCartsByUserId(int $userId): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM Cart WHERE userID = :userID");
        $statement->bindParam(':userID', $userId);
        $statement->execute();

        $carts = [];
        while ($cartData = $statement->fetch(PDO::FETCH_ASSOC)) {
            $cart = new Cart(
                $cartData['cartID'],
                $cartData['userID'],
                $cartData['productID'],
                $cartData['quantity'],
                $cartData['money'] // Lấy giá trị money từ cơ sở dữ liệu
            );
            $carts[] = $cart;
        }

        return $carts;
    }
    public function addToCart(int $userId, int $productId, int $quantity): bool
    {
        $statement = $this->pdo->prepare("INSERT INTO Cart (userID, productID, quantity) VALUES (:userID, :productID, :quantity)");

        $statement->bindParam(':userID', $userId);
        $statement->bindParam(':productID', $productId);
        $statement->bindParam(':quantity', $quantity);

        return $statement->execute();
    }
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
