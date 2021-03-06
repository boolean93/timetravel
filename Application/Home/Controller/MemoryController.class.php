<?php
namespace Home\Controller;
use Think\Controller;
class MemoryController extends BaseController {
    public function _before_submit(){
        if(!is_login()){
//            $this->error("您还没有登陆呢~请先登陆", U("Home/Index/login"));
        }
    }

    /**
     * @param int $pid PageId
     */
    public function index($pid = 1){
        $info = page($pid, D("Memory"), "memory.readable = 1");

        $article = M("Memory")
            ->where("memory.readable = 1")
            ->limit("$info[start], $info[limit]")
            ->select();

//        dump($article);

        $this->assign("page", $info['pageArray']);
        $this->assign("pid", $pid);
        $this->assign("article", $article);
        $this->display();
    }

    /**
     * 发布游记
     */
    public function submit(){
        if(!is_login()){
            $this->error("请先登录!");
            return ;
        }

        $userInfo = session("userinfo");

//        $userId = $userInfo['id'];
        $userId = ( is_numeric($userInfo['id']) )? $userInfo['id'] : $userInfo['username'];

        $data = array(
            "user_id"   =>  $userId,
            "title"     =>  I("post.title"),
            "content"   =>  I('post.content'),
            "create_time"   =>  time(),
            "click"     => 0,
            "good"      => 0,
            "pic_url"   => I("post.pic_url"),
            "readable"  => 0,
        );

        $Memory = M("Memory");

        if($Memory->data($data)->add()){
            $this->success("发表成功, 感谢您的使用.如果您的文章文采够好, 我们会第一时间放在本栏目上.");
        }else{
//            $this->error("啊哦, 好像出了点小问题");
//            $this->error($Memory->getError());
            dump($Memory);
        }
    }

    /**
     * @description 游记的详细页面渲染
     * @param $id
     * @assign('memory', array(
     *      "id" => ?,
     *      "title" => ?,
     *      "content" => ?,
     *      "click" => ?,
     *      "good"  => ?,
     *      "pic_url" => ?,
     *      "create_time" => ?,
     *      "readable" => ?,
     * ))
     */
    public function detail($id){
        //增加点击数
        M("Memory")->where("id=$id")->setInc("click");

        //如果可读, 就显示出来
        $result = M("Memory")->order('id DESC')->where("readable = 1")->find($id);
//        dump($result);
        $this->assign("memory", $result);
        $this->display("Memory:detail");
    }

    public function good($id){
        M("Memory")->where("id=$id")->setInc("good");
        $this->redirect(U("Memory/detail",array("id"=>$id)));
    }

    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }

    /**
     * @description 用于预览
     * @param $id
     */
    public function preview($id)
    {
        $result = M("Memory")->find($id);

        $this->assign("memory", $result);
        $this->display("Memory:detail");
    }
}