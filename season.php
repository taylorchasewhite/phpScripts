<?php
 main();

function main() {
	setHeaders();
	$file = getImage();

	// get the size for content length
	$size= filesize($file);
	header("Content-Length: $size bytes");
	
	// output the file contents
	readfile($file);
}

function setHeaders() {
	// basic headers
	header("Content-type: image/png");
	header("Expires: Mon, 1 Jan 2099 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
}

function getImage() {
	return getRandomImage(getSeason());
}

/**
 * getSeason
 * 
 * Based on the current date, return the season the website should interpret.
 *
 * @return season
 */
function getSeason() {
	$today = strtotime(date("Y/M/D"));
	//$today = getFallStartDate(); // DEBUG: Testing new images
	// Spring 	= March 15 		- May 30
	// Summer 	= May 30 		- August 25
	// Fall		= August 26 	- December 1
	// Winter 	= December 2	- March 14
	switch (true) {
		case ($today>=getWinterStartDate() && $today<getSpringStartDate()):
			$season= "Winter";
			break;
		case ($today>=getSpringStartDate() && $today<getSummerStartDate()):
			$season= "Spring";
			break;
		case ($today>=getSummerStartDate() && $today<getFallStartDate()):
			$season= "Summer";
			break;
		case ($today>=getFallStartDate() && $today<getFallEndDate()):
			$season="Fall";
			break;
		default:
			$season="Winter";
	}

	return $season;
}

/**
 * getSpringStartDate
 * 
 * Gets the start day of Spring of the current year (March 15)
 *
 * @return void
 */
function getSpringStartDate() {
	return mktime(0,0,0,3,15);
}

/**
 * getSummerStartDate
 *
 * Gets the start day of Summer of the current year (May 30)
 * 
 * @return void
 */
function getSummerStartDate() {
	return mktime(0,0,0,5,30);
}

/**
 * getFallStartDate
 *
 * Gets the start day of Fall of the current year (August 26)
 * 
 * @return void
 */
function getFallStartDate() {
	return mktime(0,0,0,8,26);
}

/**
 * getFallEndDate
 *
 * Gets the end day of Fall of the current year (December 1)
 * 
 * @return void
 */
function getFallEndDate() {
	return mktime(0,0,0,12,1);
}

/**
 * getWinterStartDate
 * 
 * Gets the start day of Winter of the current year (January 1)
 *
 * @return void
 */
function getWinterStartDate() {
	return mktime(0,0,0,1,1);
}

function getRandomImage($imageType) {
	switch($imageType) {
		case "Spring":
			$images=getSpringImages();
			break;
		case "Summer":
			$images=getSummerImages();
			break;	
		case "Fall":
			$images=getFallImages();
			break;
		case "Winter":
			$images=getWinterImages();
			break;
		default:
			$images=getMiscellaneousImages();
			break;
	};

	// Choose a random image from the array
	srand(time());
	$image=$images[rand(0,count($images)-1)];
	return $image;
}

function getSpringImages() {
	$imagePrefix="./uploads/";
	$springImages = array(
		$imagePrefix."background-spring.jpg",
		$imagePrefix."landscape-summer.png", // actually is spring
		$imagePrefix."Spring-1-Meadow.png",
		$imagePrefix."Spring-2-Park.png",
		$imagePrefix."Spring-3-Grass.png"


	);
	return $springImages;
}

function getSummerImages() {
	$imagePrefix="./uploads/";
	$summerImages = array(
		$imagePrefix."landscape-desert.png",
		$imagePrefix."landscape-summer.png"
	);
	return $summerImages;
}

function getFallImages() {
	$imagePrefix="./uploads/";
	$fallImages = array(
		$imagePrefix."Fall-1-Pumpkins.png",
		$imagePrefix."Fall-2-Tree.png",
		$imagePrefix."Fall-3-Border.png",
		//$imagePrefix."Fall-4-Leaf.png",
		$imagePrefix."Fall-5-Brancb.png" // misspell on the webserver...

	);
	return $fallImages;
}

function getWinterImages() {
	$imagePrefix="./uploads/";
	$winterImages = array(
		"http://moziru.com/images/mountain-clipart-2.png",
		$imagePrefix."1330390.png",
		$imagePrefix."Snowy-Winter-Trees.png",
		$imagePrefix."Winter_Ground_with_Snow_PNG_Clipart_Image-1.png",
		$imagePrefix."Winter-1-Bottom.png",
		$imagePrefix."Winter-2-Ski.png"

	);
	return $winterImages;
}

function getMiscellaneousImages() {
	$imagePrefix="./uploads/";
	$images = array(
		$imagePrefix."Castle-Hills.png"
	);

	return $images;
}

function getFourthOfJulyImages() {
	$imagePrefix="./uploads/";
	$images=array(
		$imagePrefix."landscape-captol.png"
	);
	return $images;
}
 
?>	
// 	/wp-content/uploads/Castle-Hills.png
// 	background-size: 75%;*/

	
