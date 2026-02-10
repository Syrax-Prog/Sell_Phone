<?php
class Review_m extends CI_Model
{

    public function create_review($data = array(), $file = array())
    {
        if (!empty($file)) {
            foreach ($file['images']['name'] as $k => $v) {

                $details = "OI" . $data['order_id'] . "_OIID" . $data['order_item_id'];
                $test = array(
                    'name' => $file['images']['name'][$k],
                    'type' => $file['images']['type'][$k],
                    'tmp_name' => $file['images']['tmp_name'][$k],
                    'error' => $file['images']['error'][$k],
                    'size' => $file['images']['size'][$k]
                );

                $images[] = $this->new_image($test, $details, $k);
            }
        }


        $insert_data = array(
            'user_id' => $this->id,
            'product_id' => intval(trim($data['product_id'])),
            'order_id' => intval(trim($data['order_id'])),
            'rating' => intval(trim($data['rating'])),
            'comment' => $this->db->escape($data['comment']),
            'images' => $this->db->escape(json_encode($images)),
            'created_at' => $this->db->escape(date('Y-m-d H:i:s')),
            'updated_at' => $this->db->escape(date('Y-m-d H:i:s')),
            'status' => $this->db->escape('active'),
            'order_item_id' => intval(trim($data['order_item_id']))
        );

        $sql = "INSERT INTO `reviews` (" . implode(",", array_keys($insert_data)) . ") VALUES (" . implode(",", array_values($insert_data)) . ")";
        $this->db->query($sql);
    }

    private function new_image($new_image = "", $detail = "", $k = "")
    {
        if ($new_image && $new_image['error'] === 0) {
            $ext = pathinfo($new_image['name'], PATHINFO_EXTENSION);
            $uploadPath = "assets/images/$this->id/$detail/";

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $fileName = time() . '_' . $detail . '_' . $k . '.' . $ext;
            $targetPath = $uploadPath . $fileName;

            if (move_uploaded_file($new_image['tmp_name'], $targetPath)) {
                return $targetPath;
            }
        } else {
            return "";
        }
    }

    public function getReview($id = '', $limit = '')
    {
        if ($id == '') {
            return 'ID Cannot Be Null';
        }

        $sql = "SELECT `reviews`.*, `user`.`username`, `order_item`.`phone_name_at_order` FROM `reviews`
        JOIN `user` ON `user`.`user_id` = `reviews`.`user_id`
        JOIN `order_item` ON `order_item`.`order_item_id` = `reviews`.`order_item_id`
        WHERE `reviews`.`product_id` = " . $this->db->escape(trim($id)) . "
        $limit";
        return $this->db->query($sql)->result_array();
    }

    public function get_total_comment($id)
    {
        $sql = "SELECT COUNT(*) as `total` FROM `reviews` WHERE `product_id` = " . $this->db->escape($id);
        return $this->db->query($sql)->row()->total;
    }

    public function get_review_status()
    {
        $sql = "SELECT user_id, product_id, order_id FROM reviews";
        $query = $this->db->query($sql)->result();
        
        foreach ($query as $v) {
            $data[$v->order_id][$v->product_id] = TRUE;
        }
        return $data;
    }
}