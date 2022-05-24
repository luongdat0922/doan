<?php
    class Products extends Connect {

        public function getAllProducts() {
            $sql = "select * from products";
            $stmt = $this->getConnect()->query($sql);
            $products = $stmt->fetchAll();
            return $products;
        }

        public function getProduct($id) {
            $sql = "select * from products where id=".$id;
            $stmt = $this->getConnect()->query($sql);
            $products = $stmt->fetch();
            return $products;
        }

        public function getAllImages($id) {
            $sql = "select * from images where products_id=".$id;
            $stmt = $this->getConnect()->query($sql);
            $products = $stmt->fetchAll();
            return $products;
        }

        public function searchProducts($groupID) {
            $sql = "select * from products where id in (" .$groupID.")";
            $stmt = $this->getConnect()->query($sql);
            $products = $stmt->fetchAll();
            return $products;
        }

        public function createOrder($users_id, $total) {
            $sql = "insert into orders(users_id, total, description) values('$users_id', '$total', 'success')";
            $this->getConnect()->exec($sql);            
            return 1;
        }

        public function createDetail($insertString) {
            $sql = "insert into orders_details(id, orders_id, products_id, quantity, price) values " . $insertString . ";";
            $this->getConnect()->exec($sql);
        }
    }
?>