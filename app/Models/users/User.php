<?php
    namespace app\Models\users;

    use app\Models\Database;

    class User {

        private $database;

        public function __construct(Database $database)
        {
            $this->database = $database;
        }

        public function getAllUsers() {
            return $this->database->executeQuery("SELECT *, u.id AS user_id, r.title AS role FROM users u INNER JOIN roles r ON u.id_role = r.id ORDER BY u.id_role ASC");
        }

        public function getSingleUser($userId) {
            return $this->database->executeWithParamsAndFetch("SELECT * FROM users WHERE id = ?", [$userId]);
        }

        public function insertUser($data) {
            return $this->database->executeWithParams("INSERT INTO users(id, first_name, last_name, email, username, password, is_active, id_role) VALUES (null,?,?,?,?,?,0,2)", $data);
        }

        public function deleteUser($userId) {
            return $this->database->executeWithParams("DELETE FROM users WHERE id = ?", [$userId]);
        }

        public function selectUser($username, $password) {
            $query = "SELECT u.id AS user_id, u.first_name, u.last_name, r.title AS role FROM users u INNER JOIN roles r ON u.id_role = r.id WHERE u.username = ? AND u.password= ?";
            $result = $this->database->executeWithParams($query, [$username, $password]);
            return $result;
        }

        public function getRole($id) {
            return $this->database->executeWithParamsAndFetch("SELECT r.title AS role FROM users u INNER JOIN roles r ON u.id_role = r.id WHERE u.id = ?", [$id]);
        }

        public function updateUser($data) {
            return $this->database->executeWithParams("UPDATE users SET first_name = ?, last_name = ?, email = ?, username = ?, password = ? WHERE id = ?", $data);
        }

        public function online($id_user){
            return $this->database->executeWithParams("UPDATE users SET is_active = 1 WHERE id = ?", [$id_user]);
        }

        public function offline($id_user){
            return $this->database->executeWithParams("UPDATE users SET is_active = 0 WHERE id = ?", [$id_user]);

        }

        public function checkUsername($username) {
            return $this->database->executeWithParamsAndRowCount("SELECT * FROM `users` WHERE username LIKE ?", [$username]);
        }

        public function checkEmail($email) {
            return $this->database->executeWithParamsAndRowCount("SELECT * FROM `users` WHERE email LIKE ?", [$email]);
        }
    }