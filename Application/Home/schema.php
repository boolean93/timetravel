<?php
/*//User Table
	Schema::dropIfExists("user");
	Schema::create('user', function($table){

	    $table->increments('id');

        $table->string("username");

	    $table->string("password");

	    $table->string("mail");

	    $table->string("contact");

	    $table->integer("last_login_time");

	    $table->integer("register_time");

	    $table->integer("status");
	});	

    //Article Table
	Schema::dropIfExists("article");
	Schema::create("article", function($table){

		$table->increments('id');

		//The line of traveling.
		// eg. 重邮 - 南坪 - 观音桥
		$table->text("travel_line");

		//Type of article
		//Related with the Type Table
		$table->integer("type_id");

		$table->text("title");

		//Filled with HTML content
		$table->longText("content");

		//Related with the User Table
		$table->integer("user_id");

		$table->integer("create_time");

		//Click Times
		$table->integer("click")->default(0);

		//The Sum of Hearts
		$table->integer("good")->default(0);
	});

	//article_type
	Schema::dropIfExists("type");
	Schema::create("type", function($table){
		$table->increments("id");
		$table->text("type_name");
	});

    //TODO
	Schema::dropIfExists("order"); 
	Schema::create("order", function($table){
		$table->increments("id");
		$table->integer("create_time");
		$table->boolean("is_preorder");
	});

	Schema::dropIfExists("admin");
	Schema::create("admin", function($table){
		$table->increments("id");
		$table->integer("user_id");
		$table->integer("role_id")->default(0);
	});

	Schema::dropIfExists("role");
	Schema::create("role", function($table){
		$table->increments("id");
		$table->string("role_name");
	});

	Schema::dropIfExists("auth");
	Schema::create("auth", function($table){
		$table->increments("id");
		$table->integer("role_id");
		$table->string("controller");
		$table->string("function");
	});

//游记
    Schema::dropIfExists("memory");
    Schema::create("memory", function($table){
        $table->increments("id");

        //Author id
        $table->integer("user_id");

        $table->string("title");

        $table->longText("content");

        //Click times
        $table->integer('click')->default(0);

        //The Sum of Hearts
        $table->integer('good')->default(0);

        //Url of Picture
        $table->string("pic_url");

        $table->string("create_time");

        //True is for 'Can be read'
        $table->boolean("readable");
    });

//Young探险
    Schema::dropIfExists("young");
    Schema::create("young", function($table){
        $table->increments("id");

        $table->string("title");

        $table->longText("content");

        //旅游线路
        $table->string("travel_line");

        $table->integer("price_list_id");

        $table->string("pic_url");

        $table->string("start_time");

        $table->string("end_time");

        $table->string("create_time");
    });

    Schema::dropIfExists("price");
    Schema::create("price", function($table){
        $table->increments("id");

        $table->integer("young_id");

        $table->float("price");

        //备注信息
        $table->string("other");
    });

//Time 页面的文章
    Schema::dropIfExists("time");
    Schema::create("time", function($table){
        $table->increments('id');

        $table->string('title');

        $table->longText("content");

        $table->string('img_url');

        $table->integer('author_id');

        $table->string("create_time");

        $table->integer("good");

        $table->integer("click");
    });

    Schema::dropIfExists("route_relation");
    Schema::create("route_relation",function($table){
        $table->increments('id');

        $table->integer("time_id");

        $table->integer('route_id');
    });

    Schema::dropIfExists("route");
    Schema::create("route", function($table){
        $table->increments('id');

        $table->string("title");

        $table->longText("content");
    });
*/

    $table = array(
        "user", "relation_article_route",
        "stuff", "slider", "order",
        "article", "route", "memory", "price"
    );
    for($i = 0; $i < count($table); $i++)
        Schema::dropIfExists($table[$i]);

    Schema::create("user", function($table){
        $table->increments("id");
        $table->string("username");//email
        $table->string("password");
        $table->string("tel");
        $table->boolean("status");
        $table->string("register_time");
        $table->string("last_login_time");
    });

    Schema::create("article", function($table){
        $table->increments('id');
        $table->string("title");
        $table->longText("content");
        $table->string("header_img");

        //time(时光之旅) extreme(极致探险)
        $table->string("type");

        $table->string("create_time");
        $table->integer("click")->default("0");
        $table->integer("good")->default("0");
        $table->integer("reply")->default("0");
        $table->boolean("status")->default("0");
    });

    Schema::create("route", function($table){
        $table->increments("id");
        $table->string("title");
        $table->string("travel_line");
        $table->longText("content");
        $table->string("create_time");
        $table->string("start_time");
        $table->string("end_time");
        $table->string("pic_url");

        //time(时光之旅)  extreme(极致活动) young(young活动)
        $table->string("type");
    });

    Schema::create("relation_article_route", function($table){
        $table->increments("id");
        $table->integer("article_id");
        $table->integer("route_id");
    });

    Schema::create("stuff", function($table){
        $table->increments("id");
        $table->string("title");
        $table->string("img_url");
        $table->string("other");
    });

    Schema::create("slider", function($table){
        $table->increments("id");
        $table->string("img_url");
    });

    Schema::create("order", function($table){
        $table->increments("id");
        $table->string("price");
        $table->integer("user_id");
        $table->longText("information");
        $table->integer("route_id");
    });

    Schema::create("memory",function($table){
        $table->increments("id");
        $table->string("title");
        $table->longText("content");
        $table->string("pic_url");
        $table->integer("user_id");
        $table->string("create_time");
        $table->integer("click");
        $table->integer("good");
        $table->boolean("readable");
    });

    Schema::create("price", function($table){
        $table->increments("id");
        $table->string("title");
        $table->string("price");
        $table->integer("route_id");
    });



/* FOR BACKEND*/
    Schema::create("admin", function($table){
        $table->increments("id");
        $table->string("username");
        $table->string("password");
    });

    Schema::create("nav", function($table){
        $table->increments("id");
        $table->string("name");
        $table->string("fid");
        $table->string("controller");
        $table->string("function");
    });