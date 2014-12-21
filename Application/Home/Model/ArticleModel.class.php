<?php
namespace Home\Model;
use Think\Model\RelationModel;
Class ArticleModel extends RelationModel{

    protected $_link = array(
        'Route'=>array(
            'mapping_type'  =>  self::MANY_TO_MANY,
            'class_name'    =>  "Route",
            "mapping_name"  =>  "route",
            "foreign_key"   =>  "article_id",
            "relation_foreign_key"  =>  "route_id",
            "relation_table"    =>  "relation_article_route",
        ),
    );

}