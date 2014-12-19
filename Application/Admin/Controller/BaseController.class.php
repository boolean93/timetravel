<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public function _initialize()
    {
//        dump($this->getMenu());
        $this->assign("__MENU__", $this->getMenu());
    }

    public function getMenu(){
        $Nav = M("Nav");
        $father = $Nav->where("fid = 0")->select();
        for($i = 0; $i < count($father); $i++){
            $father[$i]["son"] = $Nav->where(array("fid" =>$father[$i]['id']))->select();
        }

        return $father;
    }
}