<?php
  
namespace MQUtil\View\Helper;  

use Zend\View\Helper\AbstractHelper;   

class DateFormat extends AbstractHelper
{  	
	private $timestamp;
	
	public function __invoke($date) {
		
		if(is_object($date) && get_class($date) == 'DateTime')
			$date = $date->getTimestamp();
			 
		$this->timestamp = $date;
		
		return $this;	
	}
	
	public function forumDate()
	{		
		if($this->timestamp > strtotime(date('Y-m-d')))
			return date('H:i', $this->timestamp);
		else if(date('Y',$this->timestamp) == date('Y'))
			return date('d-m H:i', $this->timestamp);
		else 
			return date('d-m-y H:i', $this->timestamp);
	}
	
	public function ago($afterDayDate = false)
	{		
		$time = time() - $this->timestamp;
		$translate = $this->view->plugin('translate');

		if($time < 10) {
			$agoString = $translate('nu');
		} else if($time < 60) {
			$agoTime = $time;
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('second ago') : $translate('seconds ago'));
		} else if($time < 3600) {
			$agoTime = round($time / 60);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('minute ago') : $translate('minutes ago'));
		} else if($time < 86400) {
			$agoTime = round(($time / 60) / 60);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('hour ago') : $translate('hours ago'));
		} else if($time < 604800 && $afterDayDate == false) {
			$agoTime = round($time / 86400);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('day ago') : $translate('days ago'));
		} else if($time < 2592000 && $afterDayDate == false) {
			$agoTime = round($time / 604800);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('week ago') : $translate('weeks ago'));
		} else if($time < 31536000 && $afterDayDate == false) {
			$agoTime = round($time / 2592000);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('month ago') : $translate('months ago'));
		} else if($time < 157680000 && $afterDayDate == false) {
			$agoTime = round($time / 31536000);
			$agoString = $agoTime . ' ' . sprintf(($agoTime == 1) ? $translate('year ago') : $translate('years ago'));
		} else {
			$agoString = date('d M y H:i', $this->timestamp); 			
		}
		
		return $agoString;
	}
	
	public function dayName($short = false)
	{		
		$format = ($short === true) ? '%a' : '%A';
		
		return strftime($format, $this->timestamp);
	}
	
	public function monthName()
	{		
		return strftime('%B', $this->timestamp);
	}
}