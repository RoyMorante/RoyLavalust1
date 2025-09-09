<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model
{
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

        public function count_all_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];
        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }
        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_records_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NULL";
        $params = [];
        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }
        $sql .= " ORDER BY id ASC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count_deleted_records($search = null)
    {
        $sql = "SELECT COUNT(id) AS total FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];
        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }
        $row = $this->db->raw($sql, $params)->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['total'] : 0;
    }

    public function get_deleted_with_pagination($limit_clause, $search = null)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL";
        $params = [];
        if ($search) {
            $sql .= " AND (first_name LIKE ? OR last_name LIKE ? OR email LIKE ?)";
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }
        $sql .= " ORDER BY id DESC {$limit_clause}";
        return $this->db->raw($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_deleted_records()
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->soft_delete_column} IS NOT NULL ORDER BY id DESC";
        return $this->db->raw($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function soft_delete($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NOW() WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

    public function restore($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "UPDATE {$this->table} SET {$this->soft_delete_column} = NULL WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

    public function hard_delete($id): ?bool
    {
        if (empty($id)) return null;
        $sql = "DELETE FROM {$this->table} WHERE {$this->primary_key} = ?";
        $stmt = $this->db->raw($sql, [$id]);
        return $stmt->rowCount() > 0 ? true : null;
    }

        public function find_by_email($email) {
        $account = $this->db->table($this->table)->where('email', trim($email))->get();
        if (!$account) return null;
        return is_object($account) ? (array)$account : $account;
    }

    public function create_account($data) {
        return $this->db->table($this->table)->insert($data);
    }
}