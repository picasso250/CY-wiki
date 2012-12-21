<?php
!defined('IN_APP') && exit('ILLEGAL EXECUTION');

$provinces = Province::readArray();
$cities = City::readArray();
$districts = District::readArray();
$bigCategories = BigCategory::readArray();

if (is_numeric($target)) {
    $shop = new Shop($target);

    $d = $shop->district();
    $district = $d->id;
    $c = $d->city();
    $city = $c->id;
    $p = $c->province();
    $province = $p->id;

    $cities = City::readArray($p);
    $districts = District::readArray($c);

    $c = $shop->category();
    $category = $c->id;
    $bc = $c->bigCategory();
    $bigCategory = $bc->id;
    $t = $shop->type();
    $type = $t->id;

    $categories = Category::readArray($bc);
    $types = Type::readArray($bc);
} else {

    $sorts = array(
    	'shop.id DESC' => '发布时间',
    	'shop.discount ASC' => '折扣');

    $name = _get('name');
    $cityId = $city = _get('city');
    $districtId = $district = _get('district');
    $sort = _get('sort');

    if ($cityId) {
        $districts = District::readArray(new City($cityId));
    }

    $conds = compact(
        'name',
        'cityId',
        'districtId',
        'sort');

    $shops = Shop::read($conds);

    $view = "$controller.list";
}

add_scripts(array('jquery.form', 'jquery.validate.min'));

render_view('master', array('view' => 'backend'));
