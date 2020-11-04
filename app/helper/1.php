<?php
class A
{
    // Thuộc tính
    protected $tt1 ;
    // var $mat = '';
    var $tt2 = '';

    // Phương Thức
    function pt()
    {
        echo 'vd pt 1';
    }
}

// Lớp Con Trâu
class B extends A
{
    function set($tt1)
    {
        $this->tt1 = $tt1;
    }

    function get()
    {
        return $this->tt1;
    }

    function gioi_thieu()
    {
        $this->tt1 = 'Đây là tt1';
        $this->tt2 = 'Đây là tt2';
        parent::pt();
    }
}
$dt1 = new B();
echo $dt1->gioi_thieu();
$dt1->set('Địt mẹ Nam');
echo $dt1->get();
?>
