<?php

namespace App\Http;

class Flash
{

	function create($title,$message,$level,$key = 'flash_message')
	{
		session()->flash($key,[
				"title"   => $title,
				"message" => $message,
				"level"   => $level
			]);
	}

	function message($title,$message)
	{
		$this->create($title,$message,'info');
	}

	function success($title,$message)
	{
		$this->create($title,$message,'success');
	}

	function error($title,$message)
	{
		$this->create($title,$message,'error');
	}

	function overlay($title,$message,$level = "success")
	{
		$this->create($title,$message,$level,$key = "flash_message_overlay");
	}
}
