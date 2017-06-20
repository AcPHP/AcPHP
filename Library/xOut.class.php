<?php 
// +--------------------------------------------------------------------------------------
// + AcPHP
// +--------------------------------------------------------------------------------------
// + 版权所有 2015年11月8日 贵州天岛在线科技有限公司，并保留所有权利。
// + 网站地址: http://www.acphp.com
// +--------------------------------------------------------------------------------------
// + 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
// + 授权协议：http://www.acphp.com/license.html
// +--------------------------------------------------------------------------------------
// + Author: AcPHP  http://www.jiangzg.com/ <2992265870@qq.com/jiangzg>
// + Release Date: 2015年11月8日 上午11:53:29
// +--------------------------------------------------------------------------------------

// +--------------------------------------------------------------------------------------
// + 数据输出类
// +--------------------------------------------------------------------------------------
class xOut {
	
	// +----------------------------------------------------------------------------------
	// + 输出json格式数据
	// +----------------------------------------------------------------------------------
	public static function ajax( $message_aray=array() ){
		!is_array($message_aray) or $message_aray = (array)$message_aray;
		echo json_encode($message_aray);
		exit;
	}
	
	// +----------------------------------------------------------------------------------
	// + 输出json格式数据
	// +----------------------------------------------------------------------------------
	public static function json( $message_aray=array() ){
		!is_array($message_aray) or $message_aray = (array)$message_aray;
		header('Content-type: application/json; charset=UTF-8');
		echo json_encode($message_aray);
		exit;
	}
	
	// +----------------------------------------------------------------------------------
	// + 输出字符串
	// +----------------------------------------------------------------------------------
	public static function string($string=''){
		echo $string;
	}
	// +----------------------------------------------------------------------------------
	// + 输出xml格式数据
	// +----------------------------------------------------------------------------------
	public static function xml() {
		;
	}
}






