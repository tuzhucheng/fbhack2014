<?
	$expression = str_replace(" ", "", $_get['expr']);
	$answer = shell_exec("expression.exe $expression");
	echo $answer."</br>"; 
?>