<?php
/**
 * Created by Engineer CuiLiwu.
 * Project: deal.
 * Date: 2018/6/6-9:10
 * License Hangzhou orce Technology Co., Ltd. Copyright © 2018
 */

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;

class CategoryController extends  BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * 分类列表
     * */
    public function index(){
        return view('Admin.Category.category');
    }
}