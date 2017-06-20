<?php
// +--------------------------------------------------------------------------------------
// + AcPHP
// +--------------------------------------------------------------------------------------
// + 版权所有 2015年11月9日 贵州天岛在线科技有限公司，并保留所有权利。
// + 网站地址: http://www.acphp.com
// +--------------------------------------------------------------------------------------
// + 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
// + 授权协议：http://www.acphp.com/license.html
// +--------------------------------------------------------------------------------------
// + Author: AcPHP  http://www.jiangzg.com/ <2992265870@qq.com/jiangzg>
// + Release Date: 2015年11月9日 上午1:07:08
// +--------------------------------------------------------------------------------------
defined('C_CA') or exit('Server error does not pass validation test.');

abstract class CacheAbstract {

	protected static $instance=null;
	
	// +----------------------------------------------------------------------------------
	// + 设置缓存
	// +----------------------------------------------------------------------------------
	abstract public function set($key, $data ,$ttl);
	// +----------------------------------------------------------------------------------
	// + 获取缓存
	// +----------------------------------------------------------------------------------
	abstract public function get($key);
	// +----------------------------------------------------------------------------------
	// + 删除缓存
	// +----------------------------------------------------------------------------------
	abstract public function delete($key);
	// +----------------------------------------------------------------------------------
	// + 清空缓存
	// +----------------------------------------------------------------------------------
	abstract public function clear();
	
	
	static public function getInstance() {
		if (! (static::$instance instanceof static)) {
			static::$instance = new static ();
		}
		return static::$instance;
	}
	
}







