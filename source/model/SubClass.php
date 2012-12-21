<?php
/**
 * @author  ryan <cumt.xiaochi@gmail.com>
 */
class SubClass extends BasicModel
{
    public static function add($parent, $name)
    {
        $parentClass = get_class($parent);
        $refKey = camel2under($parentClass);
        $class = get_called_class();
        $arr = array($refKey => $parent->id, 'name' => $name);
        Pdb::insert($arr, $class::table());
        return new $class(Pdb::lastInsertId());
    }

    public static function read($parent = null)
    {
        $conds = array();
        if ($parent !== null) {
            $parentClass = get_class($parent);
            $conds[camel2under($parentClass) . ' = ?'] = $parent->id;
        }
        $arr = Pdb::fetchAll('*', self::table(), $conds, array('`index` ASC'));
        $class = get_called_class();
        return array_map(function ($info) use($class) {
            return new $class($info);
        }, $arr);
    }

    // read as key value pairs
    public static function readArray($parent = null)
    {
        $arr = static::read($parent);
        $ret = array();
        foreach ($arr as $o) {
            $ret[$o->id] = $o->name;
        }
        return $ret;
    }

    public static function jsonData($conds = array())
    {
        $kind = get_called_class();
        list($tables, $conds, $orderby) = $kind::buildDbArgs($conds);
        $items = Pdb::fetchAll('*', $tables, $conds, $orderby);
        $itemCount = count($items);
        $totalItems = $itemCount;
        return compact('kind', 'totalItems', 'itemCount', 'items');
    }

    public static function buildDbArgs($conds)
    {
        $tables = self::table();
        $retConds = array();
        foreach ($conds as $key => $value) {
            if (preg_match('/([a-z].+)Id/', $key, $matches)) {
                // for bigCategoryId
                $ref_key = camel2under($matches[1]); // camelCase to under_score
                $retConds["$ref_key = ?"] = $value;
            }
        }
        return array($tables, $retConds, array('`index` ASC'), '');
    }
}
