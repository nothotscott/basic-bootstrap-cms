<?PHP
/*
	Bootstrap functions implemented in php
*/

const BOOTSTRAP_PRIMARY		= "primary";
const BOOTSTRAP_SECONDARY	= "secondary";
const BOOTSTRAP_SUCCESS		= "success";
const BOOTSTRAP_DANGER		= "danger";
const BOOTSTRAP_WARNING		= "warning";
const BOOTSTRAP_INFO		= "info";
const BOOTSTRAP_LIGHT		= "light";
const BOOTSTRAP_DARK		= "dark";
const BOOTSTRAP_DEFAULT		= BOOTSTRAP_PRIMARY;

// Utilites \\

function bootstrap_grid($contents, $rows, $columns){
	$ret = "";
	$finished = false;
	foreach(range(0, $rows-1) as $x){
		$ret .= '<div class="row">';
		foreach(range(0, $columns-1) as $y){
			$index = ($rows-1)*$x + $y;
			if($index >= count($contents)){
				$finished = true;
				break;
			}
			$ret .= '<div class="col">' . $contents[$index] . '</div>';
		}
		$ret .= '</div>';
		if($finished){
			break;
		}
	}
	return $ret;
}

// Components \\

function bootstrap_alert($content, $style=BOOTSTRAP_DEFAULT){
	return '<div class="alert alert-' . $style . '" role="alert">' . $content . '</div>';
}

function bootstrap_button($content, $link=null, $style=BOOTSTRAP_DEFAULT){
	if($link){
		return '<a class="btn btn-' . $style . '" href="#" role="button">' . $content . '</a>';
	}else{
		return '<button class="btn btn-' . $style . '" type="button">' . $content . '</button>';
	}
}

function bootstrap_card_list($title, $contents){
	$ret = '<div class="card">';
	if($title){
		$ret .= '<div class="card-header"><h5>' . $title . '</h5></div>';
	}
	$ret .= '<ul class="list-group list-group-flush">';
	foreach($contents as $content){
		$ret .= '<li class="list-group-item">' . $content . '</li>';
	}
	$ret .= '</ul>';
	$ret .= '</div>';
	return $ret;
}

?>