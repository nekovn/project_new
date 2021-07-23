<?php
return
    [
        'url' => [
            'prefix_admin' => 'admin',
            'prefix_new'   => ''
        ],
        'format' => [
            'long_time'  => 'H:m:s Y/m/d',
            'short_time' => 'Y/m/d',
        ],
        'template' => [
            'formInput'=>[
              'class' => 'form-control col-md-6 col-xs-12'
            ],
            'form_ckeditor'=>[
                'class'             => 'form-control col-md-6 col-xs-12 ckeditor'
            ],
            'formLabel'=>[
                'class'             => 'control-label col-md-3 col-sm-3 col-xs-12'
            ],
            'form_label_edit'=>[
                'class'             => 'control-label col-md-5 col-sm-3 col-xs-12'
            ],
            'status' => [
                'all'               => ['name' => 'Tất cả', 'class' => 'btn-success'],
                'active'            => ['name' => 'Kích hoạt', 'class' => 'btn-success'],
                'inactive'          => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
                'default'           => ['name' => 'Chưa xác định', 'class' => 'btn-info'],
            ],
            'is_home' => [
                '1'                 => ['name' => 'Hiển thị', 'class' => 'btn-primary'],
                '0'                 => ['name' => 'Không hiển thị', 'class' => 'btn-warning'],
            ],
            'display' => [
                'list'              => ['name' => 'Danh sách', 'class' => 'btn-primary'],
                'grid'              => ['name' => 'Kiểu lưới', 'class' => 'btn-warning'],
            ],
            'level' => [
                'admin'              => ['name' => 'Quản trị hệ thống'],
                'member'             => ['name' => 'User'],
            ],

            'type' => [
                'feature'           => ['name' => 'Nỗi bật', 'class' => 'btn-primary'],
                'normal'            => ['name' => 'Thường', 'class' => 'btn-warning'],
            ],
            'search' => [
                'all'               => ['name' => 'Search by All'],
                'id'                => ['name' => 'Search by ID'],
                'name'              => ['name' => 'Search by Name'],
                'username'          => ['name' => 'Search by UserName'],
                'fullname'          => ['name' => 'Search by FullName'],
                'email'             => ['name' => 'Search by Email'],
                'description'       => ['name' => 'Search by Description'],
                'link'              => ['name' => 'Search by Link'],
                'content'           => ['name' => 'Search by Content'],
                'subtitle'          => ['name' => 'Search by Content'],
                'title'             => ['name' => 'Search by Title'],


            ],
            'button' => [
                'edit'   => ['class' => 'btn-success', 'title' => 'Edit', 'icon' => 'fa-pencil', 'route-name' => '/form'],
                'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash', 'route-name' => '/delete'],
                'info  ' => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' =>  '/info'],
            ],
            'titleInAreaTable' => [
                '#'        => ['name' => '#'],
                'info'     => ['name' => 'Slider Info'],
                'name'     => ['name' => 'Name'],
                'article'  => ['name' => 'Article Info'],
                'thumb'    => ['name' => 'Thumb'],
                'category' => ['name' => 'Category'],
                'status'   => ['name' => 'Trạng thái'],
                'type'     => ['name' => 'Kiểu bài viết'],
                'isHome'   => ['name' => 'Hiển thị Home'],
                'display'  => ['name' => 'Kiểu hiển thị'],
                'created'  => ['name' => 'Tạo mới'],
                'modified' => ['name' => 'Chỉnh sửa'],
                'action'   => ['name' => 'Hành động'],
                'sale_off' => ['name' => 'Giảm giá'],
                'subtitle' => ['name' => 'Nội dung'],
                'username' => ['name' => 'Username'],
                'email'    => ['name' => 'Email'],
                'fullname' => ['name' => 'Fullname'],
                'level'    => ['name' => 'Level'],
                'avatar'   => ['name' => 'Avatar'],
                'copyright'=> ['name' => 'Bản quyền'],
                'social'   => ['name' => 'Mạng xã hội'],
            ]
        ],
        'config'=>[
            'search' => [
                'default'   => ['all','id','fullname'],
                'slider'    => ['all','id','name','description','link'],
                'category'  => ['all','id','name'],
                'article'   => ['all','content','name'],
                'extra'     => ['all','subtitle','name'],
                'user'      => ['all','email','username','fullname'],
                'company'   => ['all','title','content'],
                'contact'   => ['all','title','content'],
            ],
            'button' => [
                'default'   => ['edit', 'delete'],
                'slider'    => ['edit', 'delete'],
                'category'  => ['edit', 'delete'],
                'article'   => ['edit', 'delete'],
                'extra'     => ['edit', 'delete'],
                'user'      => ['edit', 'delete'],
                'company'   => ['edit', 'delete'],
                'contact'   => ['edit', 'delete'],
            ],
            'titleInAreaTable'=>[
                'default'  => ['#', 'info', 'status', 'created', 'modified', 'action'],
                'slider'   => ['#', 'info', 'status', 'created', 'modified', 'action'],
                'category' => ['#', 'name', 'status', 'isHome','display','created', 'modified', 'action'],
                'article'  => ['#', 'article', 'thumb','category','type','status', 'action'],
                'extra'    => ['#', 'name', 'subtitle','thumb','status','sale_off', 'action'],
                'user'     => ['#', 'username', 'email','fullname','level','avatar','status','created', 'modified','action'],
                'company'  => ['#', 'name', 'thumb','subtitle','created', 'modified', 'action'],
                'contact'  => ['#', 'name','subtitle','copyright','social','status','created', 'modified', 'action'],
            ]
        ]
    ];
