<?php

namespace CT275\Labs;

use PDO;

class Product
{
    private ?PDO $db;

    private int $id = -1;
    public $productName;
    public $description;
    public $price;
    public $categoryID;
    public $productIMG;
    public $created_at;
    public $updated_at;
    private array $errors = [];

    public function getId(): int
    {
        return $this->id;
    }

    public function __construct(?PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function fill(array $data): Product
    {
        $this->productName = $data['productName'] ?? '';
        $this->description = $data['description'] ?? '';
        $this->price = $data['price'] ?? 0;
        $this->categoryID = $data['categoryID'] ?? 0;
        $this->productIMG = $data['productIMG'] ?? '';
        return $this;
    }


    public function getValidationErrors(): array
    {
        return $this->errors;
    }

    public function validate(): bool
    {
        $productName = trim($this->productName);
        if (!$productName) {
            $this->errors['productName'] = 'Tên sản phẩm không hợp lệ.';
        }

        if (!is_numeric($this->price) || $this->price < 0) {
            $this->errors['price'] = 'Giá không hợp lệ.';
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($this->productIMG, PATHINFO_EXTENSION));
        if (!filter_var($this->productIMG, FILTER_VALIDATE_URL) || !in_array($fileExtension, $allowedExtensions)) {
            $this->errors['productIMG'] = 'Link ảnh không hợp lệ.';
        }

        return empty($this->errors);
    }
    protected function fillFromDB(array $row): Product
    {
        [
            'id' => $this->id,
            'productName' => $this->productName,
            'description' => $this->description,
            'price' => $this->price,
            'categoryID' => $this->categoryID,
            'productIMG' => $this->productIMG,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ] = $row;
        return $this;
    }
    public function all(): array
    {
        $products = [];
        $statement = $this->db->prepare('SELECT * FROM products');
        $statement->execute();

        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }
    public function count(): int
    {
        $statement = $this->db->prepare('SELECT COUNT(*) FROM products');
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function paginate(int $offset = 0, int $limit = 10): array
    {
        $products = [];
        $statement = $this->db->prepare('SELECT * FROM products LIMIT :offset, :limit');
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $product = new Product($this->db);
            $product->fillFromDB($row);
            $products[] = $product;
        }

        return $products;
    }
    public function save(): bool
    {
        $result = false;

        if ($this->id >= 0) {
            $statement = $this->db->prepare(
                'UPDATE products SET productName = :productName, description = :description, price = :price, categoryID = :categoryID, productIMG = :productIMG, updated_at = NOW() WHERE id = :id'
            );

            $result = $statement->execute([
                'productName' => $this->productName,
                'description' => $this->description,
                'price' => $this->price,
                'categoryID' => $this->categoryID,
                'productIMG' => $this->productIMG,
                'id' => $this->id
            ]);
        } else {
            $statement = $this->db->prepare(
                'INSERT INTO products (productName, description, price, categoryID, productIMG, created_at, updated_at) VALUES (:productName, :description, :price, :categoryID, :productIMG, NOW(), NOW())'
            );

            $result = $statement->execute([
                'productName' => $this->productName,
                'description' => $this->description,
                'price' => $this->price,
                'categoryID' => $this->categoryID,
                'productIMG' => $this->productIMG
            ]);

            if ($result) {
                $this->id = $this->db->lastInsertId();
            }
        }
        return $result;
    }

    public function find(int $id): ?Product
    {
        $statement = $this->db->prepare('SELECT * FROM products WHERE id = :id');
        $statement->execute(['id' => $id]);

        if ($row = $statement->fetch()) {
            $this->fillFromDB($row);
            return $this;
        }

        return null;
    }
    public function update(array $data): bool
    {
        $this->fill($data);

        if ($this->validate()) {
            return $this->save();
        }
        return false;
    }
    public function delete(): bool
    {
        $statement = $this->db->prepare('DELETE FROM products WHERE id = :id');
        return $statement->execute(['id' => $this->id]);
    }
}
