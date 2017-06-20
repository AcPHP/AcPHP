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
// + Release Date: 2015年11月9日 上午12:59:44
// +--------------------------------------------------------------------------------------
defined('C_CA') or exit('Server error does not pass validation test.');

class CacheMemcache extends CacheAbstract{
	private $handle = null;
	private $cache_config = array();
	
	
	public function __construct() {
		$this->handle = new Memcache;
		$this->cache_config = & App::getConfig('Cache', 'Memcache');
		$server = $this->cache_config['server'];
		if(!is_array($server)){
			$server = array($server);
		}
		foreach($server as $v ){
			$v = explode(',', $v);
			$this->handle->addserver (isset($v[0])?$v[0]:'127.0.0.1',isset($v[1])?$v[1]:'11211',true, 1, isset($v[2])?$v[2]:3600 );
		}
		return true;
	}

	// +----------------------------------------------------------------------------------
	// + 设置缓存
	// +----------------------------------------------------------------------------------
	public function set($key, $data ,$ttl ) {
		$key = md5($key);
		if (get_class ( $this->handle ) == 'Memcached') {
			return $this->handle->set ( $key, array ($data,time (),$ttl ), $ttl );
		} else if (get_class ( $this->handle ) == 'Memcache') {
			return $this->handle->set ( $key, array ($data,time (),$ttl ), 0, $ttl );
		}
		return false;
	}
	// +----------------------------------------------------------------------------------
	// + 获取缓存
	// +----------------------------------------------------------------------------------
	public function get($key,$default=NULL) {
		$key = md5($key);
		$data = $this->handle->get ( $key );
		if(!is_array($data)){
			return $default;
		}
		if($data[1]+$data[2]<time()){
			//缓存过期
			$this->delete($key);
			return $default;
		}
		return $data [0];
	}
	// +----------------------------------------------------------------------------------
	// + 删除缓存
	// +----------------------------------------------------------------------------------
	public function delete($key) {
		$key = md5($key);
		return $this->handle->delete ( $key );
	}
	// +----------------------------------------------------------------------------------
	// + 清空缓存
	// +----------------------------------------------------------------------------------
	public function clear() {
		return $this->handle->flush ();
	}
}