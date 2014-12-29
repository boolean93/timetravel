<?php
/**
 * Created by PhpStorm.
 * User: Boolean93
 * Date: 14/12/29
 * Time: 02:23
 */

namespace Home\Controller;
use Think\Controller;


//define("ROOT",__ROOT__."Application/Home/Connect/API/");
//define("CLASS_PATH",ROOT."class/");
//
//include_once(CLASS_PATH."QC.class.php");

class PublicController extends BaseController{
    public function oauth(){
        $qc = new \Org\QC\QC();
        $qc->qq_login();

        $this->display();
    }
}