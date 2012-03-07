<?php

abstract class API {
	
	final public function __call($name, $arguments) {
		$caller=get_called_class();
		$reflection=new ReflectionClass($caller);
		$methods=$reflection->getMethods();
		
		$found=FALSE;
		foreach ($methods as $method)
			if ($method->name==$name && $method->class==$caller)
				$found=TRUE;
				
		if ($found)
			return $this->$name ($arguments[0]);
		else
			throw new Exception("Invalid Method",400);
	}
}
