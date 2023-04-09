<?php
$__pdf_html="";
$__pdf_orientation="P";
$__pdf_title="";
$__pdf_subject="";
$__pdf_author="";
$__pdf_creator="";
$__pdf_keywords="";
$__pdf_wm_text="";
$__pdf_wm_talpha=0.2;
$__pdf_wm_font="garuda";
$__pdf_wm_img="";
$__pdf_wm_ialpha=0.2;
$__pdf_pgn_text="{PAGENO}";
$__pdf_pgn_fcolor="color:black;";
$__pdf_pgn_ftype="font-family:garuda;";
$__pdf_pgn_fsize="font-size:16px;";
$__pdf_pgn_fstyle="font-weight:normal;font-style:normal;";
$__pdf_pgn_pos="BOTTOM";
$__pdf_pgn_oalign="center";
$__pdf_pgn_ealign="center";
$__pdf_pgn_show=true;
$__pdf_pgn_lstyle="solid";
$__pdf_pgn_lwidth="1px";
$__pdf_pgn_lcolor="lightgray";
$__pdf_paper_size="A4";
$__pdf_default_font="garuda";
$__pdf_default_fontsize="12";
$__pdf_pgmargin_l=15;
$__pdf_pgmargin_r=15;
$__pdf_pgmargin_b=16;
$__pdf_pgmargin_t=16;
$__pdf_pgmargin_h=9;
$__pdf_pgmargin_f=9;
function pdf_orientation($orientation="P") {
	global $__pdf_orientation;
	$o=strtoupper($orientation);
	if($o!="L") {
		$o="P";
	}
	$__pdf_orientation=$o;
}
function pdf_margin($left=15,$right=15,$top=16, $bottom=16,$header=9,$footer=9) {
	global $__pdf_pgmargin_l,$__pdf_pgmargin_r,$__pdf_pgmargin_t,$__pdf_pgmargin_b,$__pdf_pgmargin_h,$__pdf_pgmargin_f;
	$__pdf_pgmargin_l=$left;
	$__pdf_pgmargin_r=$right;
	$__pdf_pgmargin_b=$bottom;
	$__pdf_pgmargin_t=$top;
	$__pdf_pgmargin_h=$header;
	$__pdf_pgmargin_f=$footer;
}
function pdf_watermark_text($text,$font="garuda",$alpha=0.2) {
	global $__pdf_wm_text,$__pdf_wm_talpha,$__pdf_wm_font;
	$__pdf_wm_text=trim($text);
	if($alpha<0||$alpha>1) {
		$alpha=0.2;
	}
	$__pdf_wm_talpha=$alpha;
	$__pdf_wm_font=$font;
}
function pdf_watermark_image($file,$alpha=0.2) {
	global $__pdf_wm_img;
	$__pdf_wm_img=$file;
	if($alpha<0||$alpha>1) {
		$alpha=0.2;
	}
	$__pdf_wm_ialpha=$alpha;
}
function pdf_title($title) {
	global $__pdf_title;
	$__pdf_title = $title;
}
function pdf_author($author) {
	global $__pdf_author;
	$__pdf_author = $author;
}
function pdf_subject($subject) {
	global $__pdf_subject;
	$__pdf_subject=$subject;
}
function pdf_creator($creator) {
	global $__pdf_creator;
	$__pdf_creator = $creator;
}
function pdf_keywords($keyword) {
	global $__pdf_keywords;
	$__pdf_keywords = $keyword;
}
function pdf_pagenum_show($true_or_false) {
	global $__pdf_pgn_show;
	$__pdf_pgn_show=($true_or_false)?true:false;
}
function pdf_pagenum_text($pgnum_prefix="", $pgnum_suffix="") {
	global $__pdf_pgn_text;
	$__pdf_pgn_text="$pgnum_prefix{PAGENO}$pgnum_suff";
}
function pdf_pagenum_font($color, $font_type, $font_size, $font_style) {
	global $__pdf_pgn_fcolor,$__pdf_pgn_ftype,$__pdf_pgn_fsize,$__pdf_pgn_fstyle;
	$__pdf_pgn_fcolor = "color:$color;";
	$__pdf_pgn_ftype = "font-family:$font_type;";
	$__pdf_pgn_fsize = "font-size:".intval($font_size)."px;";
	$font_style = strtoupper($font_style);
	if($font_style=="BOLD") {
		$__pdf_pgn_fstyle = "font-weight:bold;";
	}
	else if($font_style=="ITALIC") {
		$__pdf_pgn_fstyle = "font-style:italic;";
	}
	else if($font_style=="BOLD_ITALIC"||$font_style=="ITALIC_BOLD") {
		$__pdf_pgn_fstyle = "font-weight:bold;font-style:italic;";
	}
	else {
		$__pdf_pgn_fstyle = "font-weight:normal;font-style:normal;";
	}
}
function pdf_pagenum_position($position, $oddpg_align, $evenpg_align) {
	global $__pdf_pgn_pos,$__pdf_pgn_oalign,$__pdf_pgn_ealign;
	$__pdf_pgn_pos = (strtoupper($position)=="TOP")?"TOP":"BOTTOM";
	$a=array("LEFT","CENTER","RIGHT");
	$__pdf_pgn_oalign = strtolower(in_array(strtoupper($oddpg_align),$a)?$oddpg_align:"CENTER");
	$__pdf_pgn_ealign = strtolower(in_array(strtoupper($evenpg_align),$a)?$evenpg_align:"CENTER");
}
function pdf_pagenum_line($style="solid",$width=1,$color="lightgray") {
	global $__pdf_pgn_lstyle,$__pdf_pgn_lwidth,$__pdf_pgn_lcolor;
	$s=array("solid","dotted","dashed","double",true,false);
	if(!in_array(strtolower($style),$s)){
		$style=false;
	}
	if($style===false){
		$width = 0;
	}
	else if($style===true) {
		return;
	}
	$__pdf_pgn_lstyle=$style;
	$__pdf_pgn_lwidth=intval($width)."px";
	$__pdf_pgn_lcolor=$color;
}
function pdf_html($html) {
	global $__pdf_html;
	$__pdf_html=$html;
}
function pdf_echo($filename="") {
	global $__pdf_html,$__pdf_orientation,$__pdf_wm_text,$__pdf_wm_img,$__pdg_pgn_pos,$__pdf_title,$__pdf_subject,$__pdf_author,$__pdf_creator,$__pdf_keywords,$__pdf_wm_talpha,$__pdf_wm_font,$__pdf_wm_ialpha,$__pdf_pgn_text,$__pdf_pgn_pos,$__pdf_pgn_oalign,$__pdf_pgn_ealign,$__pdf_pgn_show,$__pdf_pgn_fcolor,$__pdf_pgn_ftype,$__pdf_pgn_fsize,$__pdf_pgn_fstyle,$__pdf_pgn_lstyle,$__pdf_pgn_lwidth,$__pdf_pgn_lcolor,$__pdf_pgmargin_l,$__pdf_pgmargin_r,$__pdf_pgmargin_t,$__pdf_pgmargin_b,$__pdf_pgmargin_h,$__pdf_pgmargin_f;
	require_once(dirname(__FILE__)."/__RES__/mpdf.php");
	$pdf = new mPDF("th");
	$pdf->useOddEven = 1;
	if($__pdf_pgn_show) {
		$dv1 = "<div style=\"$__pdf_pgn_fcolor;width:auto;text-align:";
		$dv2 = ";{$__pdf_pgn_ftype}{$__pdf_pgn_fsize}{$__pdf_pgn_fstyle}";
		$dv3 ="style:{$__pdf_pgn_lstyle};";
		$dv4 ="width:{$__pdf_pgn_lwidth};";
		$dv5 = "color:{$__pdf_pgn_lcolor};";
		$dv6 = "\">$__pdf_pgn_text</div>";
	if($__pdf_pgn_pos=="TOP") {
		$align = $__pdf_pgn_oalign;
		$border = "border-bottom-";
		$pgh_o = "$dv1$align$dv2$border$dv3$border$dv4$border$dv5$dv6";
		$pdf->DefHTMLHeaderByName("ho", $pgh_o);
		$align = $__pdf_pgn_ealign;
		$pgh_e = "$dv1$align$dv2$border$dv3$border$dv4$border$dv5$dv6";
		$pdf->DefHTMLHeaderByName("he", $pgh_e);
		$pdf->AddPage($__pdf_orientation,'','','','',$__pdf_pgmargin_l,$__pdf_pgmargin_r,$__pdf_pgmargin_t,$__pdf_pgmargin_b,$__pdf_pgmargin_h,$__pdf_pgmargin_f,'html_ho', 'html_he', '', '', 1, 1, 0, 0);
	}
	else if($__pdf_pgn_pos=="BOTTOM") {
		$align = $__pdf_pgn_oalign;
		$border = "border-top-";
		$pgf_o = "$dv1$align$dv2$border$dv3$border$dv4$border$dv5$dv6";
		$pdf->DefHTMLFooterByName("fo", $pgf_o);
		$align = $__pdf_pgn_ealign;
		$pgf_e = "$dv1$align$dv2$border$dv3$border$dv4$border$dv5$dv6";
		$pdf->DefHTMLFooterByName("fe", $pgf_e);
		$pdf->AddPage($__pdf_orientation,'','','','',$__pdf_pgmargin_l,$__pdf_pgmargin_r,$__pdf_pgmargin_t,$__pdf_pgmargin_b,$__pdf_pgmargin_h,$__pdf_pgmargin_f,'','','html_fo', 'html_fe', 0, 0, 1, 1);
	}
	}
	else {
		$pdf->AddPage($__pdf_orientation);
	}
	$pdf->SetTitle($__pdf_title);
	$pdf->SetAuthor($__pdf_author);
	$pdf->SetCreator($__pdf_creator);
	$pdf->SetSubject($__pdf_subject);
	$pdf->SetKeywords($__pdf_keywords);
	if($__pdf_wm_text!="") {
		$pdf->SetWatermarkText($__pdf_wm_text,$__pdf_wm_talpha);
		$pdf->showWatermarkText=true;
		if($__pdf_wm_font) {
			$pdf->watermark_font=$__pdf_wm_font;
		}
	}
	if(file_exists($__pdf_wm_img)) {
		$pdf->SetWatermarkImage($__pdf_wm_img,$__pdf_wm_ialpha);
		$pdf->showWatermarkImage=true;	
	}
	$pdf->WriteHTML($__pdf_html);
	$pdf->Output($filename, $dest);
}
?>