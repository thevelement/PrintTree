<?php

class PrintTree {
	public function output($data, $echo = false) {
		// capture the output of print_r
    	$out = print_r($data, true);
		
		// replace something like '[element] => <newline> (' with <a href="javascript:toggleDisplay('...');">...</a><div id="..." style="display: none;">
    	/*
		$out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe', "'\\1<a href=\"javascript:toggleDisplay(\''.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\">\\2</a>" . $this->break_tag() . '<div id="' . $id . '" style="display: none;">', $out);
		*/
		
		
		$out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe', "'\\1<a href=\"javascript:toggleDisplay(\'pt_'.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\">\\2</a><div id=\"pt_'.\$id.'\" style=\"display: none;\">'", $out);
		
		// replace ')' on its own on a new line (surrounded by whitespace is ok) with '</div>
    	$out = preg_replace('/^\s*\)\s+$/m', '</div>', $out);

		// need to fix the last occurrence of '</div>'
		$last_div_position = strripos($out, '</div>');
		$out = substr_replace($out, "\n)", $last_div_position, 6);	
		
		$output = '<script type="text/javascript">function toggleDisplay(id) { document.getElementById(id).style.display = (document.getElementById(id).style.display == "block") ? "none" : "block"; }</script>' . "\n<pre>" . $out . '</pre>';						
		
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}	
}