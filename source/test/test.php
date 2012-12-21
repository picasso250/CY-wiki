<?php
!(defined('IN_APP') && defined('ON_TEST')) && exit('ILLEGAL EXECUTION');

$dbConfig = array_merge($config['db'], array('force' => 'master'));
Pdb::setConfig($dbConfig);

// clear side effects for all
// unset all session
if (1) {
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
}

// clear db entries that was insert by test
include 'clear_db.php';

$all_pass = true;

require CORE_ROOT . 'BasicModel.php';
$user_lib_file = APP_ROOT . 'lib' . DS . 'function.php';
if (file_exists($user_lib_file))
    require_once $user_lib_file;

// test for user

begin_test();
$user = User::add('test', 'password');
test($user->name, 'test', 'add User');

// test for add

begin_test();
$bigCategory = BigCategory::add('餐饮美食');
$bigCategory2 = BigCategory::add('休闲娱乐');
test(BigCategory::count(), 2, array('name' => 'add BigCategory'));

begin_test();
$category = Category::add($bigCategory, '民族清真');
Category::add($bigCategory, '西餐');
Category::add($bigCategory2, 'KTV');
test(Category::count(), 3, array('name' => 'add Category'));

begin_test();
Type::add($bigCategory, '中餐馆');
test(Type::count(), 1, array('name' => 'add Type'));

begin_test();
$province = Province::add('广东省');
test(Province::count(), 1, array('name' => 'add Province'));

begin_test();
$city = City::add($province, '深圳');
test(City::count(), 1, array('name' => 'add City'));

begin_test();
$district = District::add($city, '福田区');
test(District::count(), 1, array('name' => 'add District'));

begin_test();
$info = array(
    'name' => '兰州拉面',
    'category' => $category->id,
    'district' => $district->id,
    'phone' => '18664386054',
    'latilongi' => '22.546692,114.065162', // 真的有这家兰州拉面 广东省深圳市福田区福中一路
    'images' => array('/test/static/img/lzlm.jpg'));
$shop = Shop::add($info);
$info['name'] = '星巴克咖啡';
$info['latilongi'] = '22.545451,114.086379';
Shop::add($info);
test(Shop::count(), 2, array('name' => 'add Shop'));

// test for read

begin_test();
$query = array('kind' => 'BigCategory');
$url = build_url($query);
$data = query($url);
$bc = reset($data->items);
$name = query_name('get BigCategory', $query);
test($bc->name, '餐饮美食', compact('name'));

begin_test();
$query = array('kind' => 'Category', 'bigCategoryId' => $bigCategory->id);
$url = build_url($query);
$data = query($url);
$i = reset($data->items);
$name = query_name('get Category', $query);
test($i->big_category, $bigCategory->id, compact('name'));

begin_test();
$query = array('kind' => 'Province');
$url = build_url($query);
$data = query($url);
$bc = reset($data->items);
$name = query_name('get Province', $query);
test($bc->name, '广东省', compact('name'));

begin_test();
$query = array('kind' => 'City', 'provinceId' => $province->id);
$url = build_url($query);
$data = query($url);
$bc = reset($data->items);
$name = query_name('get City', $query);
test($bc->name, '深圳', compact('name'));

begin_test();
$query = array('kind' => 'District', 'cityId' => $city->id);
$url = build_url($query);
$data = query($url);
$bc = reset($data->items);
$name = query_name('get District', $query);
test($bc->name, '福田区', compact('name'));

begin_test();
$query = array(
    'kind' => 'ShopList', 
    'distance' => 1000, 
    'latilongi' => '22.548867,114.072197', // 兰州拉面1000米以内
    'districtId' => $district->id);
$url = build_url($query);
$data = query($url);
$i = reset($data->items);
$name = query_name('get ShopList(within distance)', $query);
test($i->name, '兰州拉面', compact('name'));

begin_test();
$query['latilongi'] = '22.566305,114.09138'; // 1000米以外
$url = build_url($query);
$data = query($url);
$ic = $data->itemCount;
$name = query_name('get ShopList(out of distance)', $query);
test($ic, 0, compact('name'));

begin_test();
$query = array('kind' => 'Shop', 'id' => 1);
$url = build_url($query);
$data = query($url);
$name = query_name('get Shop', $query);
test($data->name, '兰州拉面', compact('name'));
