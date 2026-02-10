<?php
class Brand_m extends CI_Model
{
    public function get_brand()
    {
        $sql = "SELECT b.*, COUNT(p.phone_id) AS total_products
                    FROM brand b
                    JOIN phone p ON p.brand = b.brand
                    GROUP BY b.brand
                    ORDER BY total_products DESC
                    LIMIT 6
                ";
        return $this->db->query($sql)->result();
    }
    public function get_all()
    {
        $sql = "SELECT * FROM `brand`";
        return $this->db->query($sql)->result();
    }

    public function create_brand($data = array(), $file = array())
    {
        $image = $this->new_image($file['brand_image'], $data['brand_name']);

        $data_insert = array(
            'brand' => $this->db->escape(trim($data['brand_name'])),
            'brand_img' => $this->db->escape(trim($image))
        );

        $sql = "INSERT INTO `brand` (`" . implode("`, `", array_keys($data_insert)) . "`) VALUES (" . implode(",", array_values($data_insert)) . ")";
        if ($this->db->query($sql)) {
            return TRUE;
        }

        return FALSE;
    }

    //move image to the designated location... return full path + image name
    private function new_image($new_image = "", $brand = "")
    {
        if ($new_image && $new_image['error'] === 0) {
            $ext = pathinfo($new_image['name'], PATHINFO_EXTENSION);
            $uploadPath = 'assets/images/brand-logo/';
            $fileName = time() . '_' . $brand . '.' . $ext;
            $targetPath = $uploadPath . $fileName;

            if (move_uploaded_file($new_image['tmp_name'], $targetPath)) {
                return $targetPath;
            }
        } else {
            return "";
        }
    }

    public function update_brand($data)
    {
        $new_image = '';
        if (!empty($data['brand_image'])) {
            $new_image = ", brand_img = " . $this->db->escape($this->new_image($data['brand_image'], $data['brand_name'])) . "";
        }

        $sql = "UPDATE brand SET brand = " . $this->db->escape(trim($data['brand_name'])) . " $new_image WHERE id = " . $this->db->escape(trim($data['brand_id'])) . "";
        $query = $this->db->query($sql);

        if ($query) {
            return TRUE;
        }

        return FALSE;
    }

    
}