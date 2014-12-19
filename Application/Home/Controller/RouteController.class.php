<?php
/**
 * Created by PhpStorm.
 * User: Boolean93
 * Date: 14/11/26
 * Time: 17:20
 */

namespace Home\Controller;
use Think\Controller;

class RouteController extends Controller{
    /*
     * Shows the Detail
     */
    public function index($id)
    {
        $Route = M("Route");
        $result = $Route->find($id);

        $this->assign("detail", $result);

        $this->display("index");
    }


    public function detail($id)
    {
        $this->index($id);
    }
} 