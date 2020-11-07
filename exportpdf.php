<?php
	//TechWorld3g - Please Support Us <3
	//Facebook : https://www.facebook.com/TechWorld3g 
	//Twitter : https://twitter.com/TechWorld3g 
	//Youtube : https://www.youtube.com/user/TechWorld3g 
	//Blog : https://tech-world3g.blogspot.com 
	//Donate : https://imraising.tv/u/techworld3g﻿
	
	require_once "assets/tools/mpdf/mpdf.php"; // MPDF library

	function exportPDF($text,$path)
	{	
		try 
		{	
			$pdf = new mPDF();
			$pdf->WriteHTML($text);
			$pdf->Output($path,'F'); //$pdf->Output('../files/example.pdf','F');
			
			return true;
		} 
		catch(Exception $e) 
		{
			return false;
		}
	}	
