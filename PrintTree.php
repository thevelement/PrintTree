<?php

class PrintTree {
	protected $jquery;
	
	public function __construct($jquery = false) {
		$this->jquery = $jquery;	
	}
	
	public function output($data, $echo = false) {
		// capture the output of print_r
    	$out = print_r($data, true);
		
		if ($this->jquery) {
			// instead of using javascript in the 'href' attribute, we'll simply add a class to the A and DIV tags and let jQuery do the rest
			$out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe', "'\\1<a class=\"content_anchor\" href=\"#\">\\2</a><div class=\"content\" style=\"display: none;\">'", $out);
		} else {		
			// replace something like '[element] => <newline> (' with <a href="javascript:toggleDisplay('...');">...</a><div id="..." style="display: none;">
			$out = preg_replace('/([ \t]*)(\[[^\]]+\][ \t]*\=\>[ \t]*[a-z0-9 \t_]+)\n[ \t]*\(/iUe', "'\\1<a href=\"javascript:toggleDisplay(\'pt_'.(\$id = substr(md5(rand().'\\0'), 0, 7)).'\');\">\\2</a><div id=\"pt_'.\$id.'\" style=\"display: none;\">'", $out);
		}
		
		// replace ')' on its own on a new line (surrounded by whitespace is ok) with '</div>
    	$out = preg_replace('/^\s*\)\s+$/m', '</div>', $out);

		// need to fix the last occurrence of '</div>'
		$last_div_position = strripos($out, '</div>');
		$out = substr_replace($out, "\n)", $last_div_position, 6);	
		
		if ($this->jquery) {
			// we'll create the immediately invoked function and bind an event listener to the BODY tag. In order to cancel the click event on the A tag, we'll return FALSE in the jQuery event handler
			$output = '<script type="text/javascript">(function($) { $(this).next("div.content").toggle(); return false; }); }(jQuery));</script>' . "\n<pre>" . $out . '</pre>';
		} else {
			$output = '<script type="text/javascript">function toggleDisplay(id) { document.getElementById(id).style.display = (document.getElementById(id).style.display == "block") ? "none" : "block"; }</script>' . "\n<pre>" . $out . '</pre>';						
		}
		if ($echo) {
			echo $output;
		} else {
			return $output;
		}
	}	
}