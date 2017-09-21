<?php 
	class Message{
		private $type = 'info';
		private $content = null;
		
		public function set($content = '', $type = 'info'){
			if ($this->content == null){
				$this->content = $content;
				$this->type = $type;
			}
		}
		
		public function forceSet($content = '', $type = 'info'){
			$this->content = $content;
			$this->type = $type;
		}
		
		public function getContent(){
			$temp = $this->content;
			$this->content = null;
			return $temp;
		}
		
		public function getType(){
			return $this->type;
		}
		
		public function hasMessage(){
			return $this->content !== null;
		}
	}
?>