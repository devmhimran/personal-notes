/**
* convert2PDF - plugin.js
* Author: Raphael Weaver
* Email: quick_s0luti0ns@hotmail.com
* URL: http://www.ckeditor2pdf.com
* Version: 1.0
* Commercial Licensed
*
* Change setting array convert2PDF variable in this format i.e. {option name: option value}
* convert2PDF setting option: 
							  option name; output
							  option value;	NEWWINDOW - opens pdf in new window OR
*	 						  				WINDOW - opens pdf in same window OR
* 							  				SAVE - save pdf by the name entered in the window prompt
**/

var convert2PDFSetting = {output:'NEWWINDOW'}; 

CKEDITOR.plugins.add("convert2PDF",{init:function(a){var b=scriptPath();loadScript(b+"libs/jspdf.js");loadScript(b+"libs/jspdf.plugin.addhtml.js");loadScript(b+"libs/jspdf.plugin.addimage.js");loadScript(b+"libs/jspdf.plugin.cell.js");loadScript(b+"libs/jspdf.plugin.from_html.js");loadScript(b+"libs/jspdf.plugin.javascript.js");loadScript(b+"libs/jspdf.plugin.png_support.js");loadScript(b+"libs/jspdf.plugin.sillysvgrenderer.js");loadScript(b+"libs/jspdf.plugin.split_text_to_size.js");loadScript(b+"libs/jspdf.plugin.standard_fonts_metrics.js");loadScript(b+"libs/jspdf.plugin.total_pages.js");loadScript(b+"libs/jspdf.plugin.PLUGINTEMPLATE.js");loadScript(b+"libs/libs/FileSaver.js/FileSaver.js");a.addCommand("convert2PDF",{exec:function(d){var e=new jsPDF();var c={"#editor":function(g,h){return true}};e.fromHTML(d.getData(),15,15,{width:170,elementHandlers:c});if(convert2PDFSetting.output=="SAVE"){var f=prompt("Please enter filename:");if(f==null){e.save("fileName.pdf")}else{e.save(f+".pdf")}}else{if(convert2PDFSetting.output=="WINDOW"){e.output("datauri")}else{if(convert2PDFSetting.output=="NEWWINDOW"){e.output("dataurlnewwindow")}else{alert("Not a valid convert2PDF plugin setting")}}}}});a.ui.addButton("convert2PDF",{label:"Convert to PDF",command:"convert2PDF",icon:this.path+"icons/convert2PDF.png"})}});var loadScript=function(b){var c=document.getElementsByTagName("head")[0];var a=document.createElement("script");a.type="text/javascript";a.src=b;c.appendChild(a)};var scriptPath=function(){var a=document.querySelectorAll("script[src]");var c=a[a.length-1].src;var d=c.split("/");var b=d[d.length-1];return c.replace(b,"")};