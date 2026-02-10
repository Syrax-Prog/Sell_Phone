<?php

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function yo(){
        echo 'sxs';
    }
    public function index()
    {
        $this->load->view('Seller/test');
        // $varA = "Honor Gift";

        // echo 'Single Quotes: Xde Variable';
        // echo "<br>";
        // echo "Double Quotes: Xde Variable";

        // echo "<br><br>";

        // echo 'Single Quotes: Ada Variable = $varA';
        // echo "<br>";
        // echo "Double Quotes: Ada Variable = $varA";

        // echo "<br><br>";

        // echo 'Single Quotes: Escape = \'Test';
        // // echo 'Single Quotes: Tanpa Escape = 'Test';
        // echo 'Single Quotes: Tanpa Escape = Test';
        // echo "<br>";
        // echo "Double Quotes: Escape = \'Test";

        // echo "<br><br>";

        // // echo "Double Quotes: text rapat contoh $varAB and ${varA}B";
    }

    // public function prepareStatement()
    // {
    //     $this->load->view('Buyer/test');

    //     $test = $this->input->post('test');
    //     if (empty($test)) {
    //         $test = 1;
    //     }

    //     // without binding
    //     $sql = "SELECT * FROM user WHERE user_id=7 AND is_active = $test";
    //     $bleh = $this->db->query($sql);

    //     echo "<pre>-------------------------Without Binding-----------------------------<br>";
    //     print_r($this->input->post());
    //     echo $this->db->last_query();
    //     echo "<br>";
    //     print_r($bleh->result());
    //     echo "</pre>";


    //     // binding
    //     $sql = "SELECT * FROM user WHERE user_id=7 AND is_active = ?";
    //     $params = array($test);
    //     $bleh = $this->db->query($sql, $test);

    //     echo "<pre>-------------------------With Binding-----------------------------<br>";
    //     print_r($this->input->post());
    //     echo $this->db->last_query();
    //     echo "<br>";
    //     print_r($bleh->result());
    //     echo "</pre>";

    // $file = 1;

    // // ----------------------------------------------------------------------------------------------------
    // $normal = "1";
    // $quote = "'1";
    // $or = "' OR '1' = '1";
    // $drop = "'; DROP TABLE test;";
    // $long = str_repeat("a", 5000);
    // $backslah = "avsghd\avxvgasd";
    // // ----------------------------------------------------------------------------------------------------

    // $sql = "SELECT * FROM test WHERE id = ? AND file = ?";

    // //normal
    // $binds = array($normal, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>";

    // //quotes
    // $binds = array($quote, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>";

    // //quotes
    // $binds = array($or, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>";

    // //drop
    // $binds = array($drop, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>";

    // //long
    // $binds = array($long, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>";

    // //backslash
    // $binds = array($backslah, $file);
    // $this->db->query($sql, $binds);
    // echo "<pre>SQL: " . $this->db->last_query() . "</pre>"; }

    // Showcase how implode/explode can be combined to swap delimiters in an array.
    public function testing()
    {
        $a = array('test' => array(), 'test2' => array('test1' => "affan", 'test2' => "kelantan", "redflag"));
        $implode_a = str_replace(",", "<->", implode(",", $a['test2']));
        $explode_a = explode("<->", $implode_a);

        echo "<pre>";
        print_r($a);

        echo "<br>";
        print_r($implode_a);
        echo "<br>";

        echo "<br>";
        print_r($explode_a);
        echo "</pre>";
    }

    // function testarray()
    // {
    //     $orders = $this->db->get('orders')->result_array();
    //     $order_item = $this->db->get('order_item')->result_array();


    //     echo "<pre>";
    //     print_r($data);
    //     echo "</pre>";


    // }

    // Simple POST checker to demonstrate how checkbox selections can be read back.
    function testCheck()
    {
        if (!$this->input->post()) {
            $this->load->view('test/checkbox');

        } else {

            // foreach ($this->input->post('selected_items') as $cart_item_id) {
            //     print_r($this->input->post("quantities[{$cart_item_id}]"));
            // }
            if (!$this->input->post()) {
                echo "<pre>";
                foreach ($this->input->post('selected_items') as $test) {
                    print_r(array(
                        'name' => !$this->input->post('phone_name')[$test] ? $this->input->post('phone_name')[$test] : '',
                        'quantity' => !$this->input->post('quantities')[$test] ? $this->input->post('quantities')[$test] : ''
                    ));
                    echo "<br>";
                }
                echo "</pre>";
            }

        }
    }

    // Loads helper test_dynamic_variable() to show dynamic property creation on the controller.
    public function test_verify()
    {
        test_dynamic_variable();

        // Print the model to see what happened
        echo "<pre>";
        print_r($this->Bla);
        echo "</pre>";

        // Show how to access it in a view or anywhere
        echo "ID: " . $this->Bla->id . "<br>";
        echo "Name: " . $this->Bla->name;

        $this->load->view('test/variablee');
    }


    // Illustrates how array_merge behaves when merging multiple numeric arrays.
    public function test_array_merge()
    {
        $a = array(1, 2, 3);
        $b = array(4, 5, 6);
        $c = array(2, 5, 1);

        echo "<pre>";
        print_r(array_merge($a, $b));
        echo "<br>";

        print_r(array_merge($a, $b, $c));
        echo "</pre>";
    }

    // Demo for the curly brace syntax that lets PHP access properties with dynamic names.
    public function test_curly()
    {
        $a = "you";
        $b = 1;

        $this->{$a} = $a;
        $this->{$b} = $b;

        echo $this->you;
        echo $this->{$b};
    }


    // Runs a model query that expects an array parameter so the SQL IN (...) clause is populated safely.
    public function use_array_in_query()
    {
        $this->load->model('Dummy_m');

        echo "<pre>";
        print_r($this->Dummy_m->arrayQuery());
        echo "</pre>";
        exit;
    }

    // Stores sample cart data as a JSON blob to illustrate manual escaping and insert behaviour.
    public function upload_json()
    {
        $testCart = array(
            array(
                "product_id" => 101,
                "name" => "Apple",
                "quantity" => 3,
                "price" => 2.5
            ),
            array(
                "product_id" => 202,
                "name" => "Banana",
                "quantity" => 5,
                "price" => 1.2
            )
        );
        $sql = "INSERT INTO `user_cart` (user_id, cart_data) VALUES ('900'," . $this->db->escape(json_encode($testCart)) . ")";
        print_r($this->db->query($sql));
    }

    // Reads JSON cart data for a user, decodes it, and loops the result to show targeted inspection.
    public function show_blob_data($user_id = '')
    {
        $sql = "SELECT * FROM user_cart WHERE user_id = " . $this->db->escape($user_id) . "";
        $row = $this->db->query($sql)->row();
        $test = json_decode($row->cart_data);

        if (!empty($row)) {
            echo "<pre>";
            print_r(json_decode($row->cart_data));

            // json_decode($row->cart_data, TRUE) for array 
            // json_decode($row->cart_data) for object 

            foreach ($test as $a) {
                if ($a->product_id === 101) {
                    echo "anjayyy";
                }
            }
            echo "</pre>";
        }
    }

    public function testArray()
    {
        $i = 0;
        $test = array(
            'username' => "test $i",
            'password' => md5($i),
            'email' => "$i@gmail.com",
            'role' => 'User',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'update_at' => date('Y-m-d H:i:s')
        );

        foreach ($test as $field => $value) {
            $this->{$field} = $value;
        }

        echo $this->username;
        echo "<br>";

        echo $this->is_active;
        echo "<br>";

        echo $this->update_at;
        echo "<br>";
    }

    function cubaTryTest()
    {
        $students = [
            "student_001" => [
                "name" => "Alice",
                "age" => 16,
                "subjects" => [
                    "math" => ["score" => 95, "teacher" => "Mr. Tan"],
                    "english" => ["score" => 88, "teacher" => "Ms. Lim"],
                    "history" => ["score" => 92, "teacher" => "Mr. Ong"]
                ]
            ],
            "student_002" => [
                "name" => "Bob",
                "age" => 17,
                "subjects" => [
                    "math" => ["score" => 78, "teacher" => "Mr. Tan"],
                    "english" => ["score" => 85, "teacher" => "Ms. Lim"],
                    "history" => ["score" => 80, "teacher" => "Mr. Ong"]
                ]
            ],
            "student_003" => [
                "name" => "Charlie",
                "age" => 16,
                "subjects" => [
                    "math" => ["score" => 90, "teacher" => "Mr. Tan"],
                    "english" => ["score" => 92, "teacher" => "Ms. Lim"],
                    "history" => ["score" => 88, "teacher" => "Mr. Ong"]
                ]
            ]
        ];

        foreach ($students as $k => $v) {
            $this->{$k} = $v['subjects']['math'];
        }
        echo $this->student_001['teacher'];
        echo "<br>";
        echo "<br>";



        $students = (object) $students;

        foreach ($students as $k => $v) {
            $this->{$k} = (object) $v['subjects']['math'];
        }
        echo $this->student_001->teacher;
        echo "<br>";
    }

    public function base64()
    {
        $a = "test";
        $base_a = base64_encode($a);

        echo $a;
        echo "<br><br>";
        echo $base_a;
    }

    public function tttt()
    {
        $this->output->set_content_type('text/plain');
        $this->output->set_output("Nigayarou");
    }

    public function testGroup()
    {
        $data = array(
            array(
                'classid' => 01,
                'studentName' => 'Ali'
            ),
            array(
                'classid' => 01,
                'studentName' => 'Ahmad'
            ),
            array(
                'classid' => 06,
                'studentName' => 'Abu'
            ),
            array(
                'classid' => 03,
                'studentName' => 'Jali'
            )
        );

        foreach ($data as $t) {
            $classid = $t['classid'];

            $grouped[$classid][] = $t;
        }

        echo "<pre>";
        print_r($data);
        echo "<br>";
        echo "<br>";
        echo "<br>";
        print_r($grouped);
        echo "</pre>";

        foreach ($grouped as $classid => $students) {
            foreach ($students as $s) {
                echo $s['studentName'];
                echo "<br>";
            }
        }
    }

    public function test_method()
    {
        $data = $this->session->userdata('test_data');

        if ($data) {
            echo "<pre>";
            print_r($data);
            echo "</pre>";

            // Clear after use (optional)
            $this->session->unset_userdata('test_data');
        } else {
            echo "No data found";
        }
    }

    public function testSoundex(){
        $a = 'iphone';
        $b = 'iFone';

        $a_dex = soundex($a);
        $b_dex = soundex($b);

        echo '<pre>';
        print_r($a_dex);
        echo '</pre>';
        exit();
        
    }
}
