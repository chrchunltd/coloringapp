COLORING APP
PLEASE READ AND FOLLOW ALL INSTRUCTIONS FOR PROPER FUNCTIONALITY




-------------------------------------------------------------------------------------------

--- HOW TO INSTALL ---

Load the entire project into a single directory on your server. Ensure all files are included.


-------------------------------------------------------------------------------------------





-------------------------------------------------------------------------------------------

--- HOW TO ADD PAGES ---

This program requires a transparent image containing ONLY outlines for each coloring page. Areas that can be colored should be completely transparent. A size of 1200x1580 pixels in PNG format is recommended for these files. A matching downloadable and printable PDF for each page is optional.

All transparent PNGs should be loaded into the /transparent folder.

All downloadable PDFs should be loaded into the /pdf folder.

The top PHP portion of code is what you will be modifying.

When adding a new page, increase the $max variable by the total number of pages you are adding. The $max variable should always match the total number of coloring pages you have loaded.

Add the following code to the commented // IF/ELSE LIST OF PAGES section. Each "if else" statement is an individual page. Increase the $which value to match the page number. It is recommended to have these numbered in order.

-------------
-------------
-------------

else if($which == 10) {
    		$page = "transparent/TRANSPARENT_FILE_NAME.png";
     		$download = "pdf/DOWNLOADABLE_PDF_FILE_NAME.pdf"; // EXCLUDE THIS LINE TO REMOVE DOWNLOADABLE PDF OPTION FROM THIS SPECIFIC PAGE
}

-------------
-------------
-------------

Next, the variable definitions in the commented // DEFAULT COLORING PAGE section should always match the last page added.


-------------------------------------------------------------------------------------------





-------------------------------------------------------------------------------------------

--- HOW TO ADD AND MODIFY COLORS ---

Scroll to the commented // DEFINE COLORS BELOW section in the code. 

To add a color, add the following code under the last DIV with a "color-tool" class. The hex code of the data-color variable and background-color specifically should be modified to change colors.

-------------
-------------
-------------

<div class="option color-tool color-switch" data-color="#f4dfc7" style="background-color: #f4dfc7;"></div>

-------------
-------------
-------------

Any exisiting DIV elements with the "color-tool" class can have their colors modified. Remove a DIV element here to remove a color.


-------------------------------------------------------------------------------------------

