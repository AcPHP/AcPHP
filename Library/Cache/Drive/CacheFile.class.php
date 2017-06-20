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

class CacheFile extends CacheAbstract{
	private $cache_path = null;
	private $cache_config = array();
	
	public function __construct() {
		$this->cache_config = & App::getConfig('Cache', 'File');
		$this->cache_path = dir_path($this->cache_config ['cachepath']);
		return true;
	}
	
	private function _getCacheFile($key){
		$key = md5($key);
		$file_path = $this->cache_path.strtolower(substr($key,-1)).C_DIR_FIX;
		//创建缓存目录
		is_dir($file_path) or dir_create($file_path);
		return $file_path.$key.'.php';
	}
	
	// +----------------------------------------------------------------------------------
	// + 设置缓存
	// +----------------------------------------------------------------------------------
	public function set($key, $data ,$expire ) {
		$cache_file = self::_getCacheFile($key);
		$data = '<?php //'.sprintf('%012d',$expire+time()).$data;
		$r = file_put_contents($cache_file,$data,LOCK_EX);
		clearstatcache();
		return $r;
	}
	// +----------------------------------------------------------------------------------
	// + 获取缓存
	// +----------------------------------------------------------------------------------
	public function get($key,$default=NULL) {
		$cache_file = self::_getCacheFile($key);
		if(!file_exists($cache_file) ){
			return $default;
		}
		$data = file_get_contents($cache_file);
		//缓存时间
		$expire = (int)(substr($data, 8,12));
		if( $expire < time() ){
			unlink($cache_file);
			return $default;
		}
		return substr($data, 8+12);
	}
	// +----------------------------------------------------------------------------------
	// + 删除缓存
	// +----------------------------------------------------------------------------------
	public function delete($key) {
		$cache_file = self::_getCacheFile($key);
		if(file_exists($cache_file)) unlink($cache_file);
		return true;
	}
	// +----------------------------------------------------------------------------------
	// + 清空缓存
	// +----------------------------------------------------------------------------------
	public function clear() {
		dir_delete($this->cache_path);
		return true;
	}
}