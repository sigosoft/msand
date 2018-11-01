/*

StackBlur - a fast almost Gaussian Blur For Canvas

Version: 	0.5
Author:		Mario Klingemann
Contact: 	mario@quasimondo.com
Website:	http://www.quasimondo.com/StackBlurForCanvas
Twitter:	@quasimondo

In case you find this class useful - especially in commercial projects -
I am not totally unhappy for a small donation to my PayPal account
mario@quasimondo.de

Or support me on flattr: 
https://flattr.com/thing/72791/StackBlur-a-fast-almost-Gaussian-Blur-Effect-for-CanvasJavascript

Copyright (c) 2010 Mario Klingemann

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

'use strict';

var mul_table = [
        512,512,456,512,328,456,335,512,405,328,271,456,388,335,292,512,
        454,405,364,328,298,271,496,456,420,388,360,335,312,292,273,512,
        482,454,428,405,383,364,345,328,312,298,284,271,259,496,475,456,
        437,420,404,388,374,360,347,335,323,312,302,292,282,273,265,512,
        497,482,468,454,441,428,417,405,394,383,373,364,354,345,337,328,
        320,312,305,298,291,284,278,271,265,259,507,496,485,475,465,456,
        446,437,428,420,412,404,396,388,381,374,367,360,354,347,341,335,
        329,323,318,312,307,302,297,292,287,282,278,273,269,265,261,512,
        505,497,489,482,475,468,461,454,447,441,435,428,422,417,411,405,
        399,394,389,383,378,373,368,364,359,354,350,345,341,337,332,328,
        324,320,316,312,309,305,301,298,294,291,287,284,281,278,274,271,
        268,265,262,259,257,507,501,496,491,485,480,475,470,465,460,456,
        451,446,442,437,433,428,424,420,416,412,408,404,400,396,392,388,
        385,381,377,374,370,367,363,360,357,354,350,347,344,341,338,335,
        332,329,326,323,320,318,315,312,310,307,304,302,299,297,294,292,
        289,287,285,282,280,278,275,273,271,269,267,265,263,261,259];
        
   
var shg_table = [
	     9, 11, 12, 13, 13, 14, 14, 15, 15, 15, 15, 16, 16, 16, 16, 17, 
		17, 17, 17, 17, 17, 17, 18, 18, 18, 18, 18, 18, 18, 18, 18, 19, 
		19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 19, 20, 20, 20,
		20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 21,
		21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 21,
		21, 21, 21, 21, 21, 21, 21, 21, 21, 21, 22, 22, 22, 22, 22, 22, 
		22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22,
		22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 23, 
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23,
		23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 23, 
		23, 23, 23, 23, 23, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24,
		24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24, 24 ];

function stackBlurImage( image, imageDim, canvas, radius, blurAlphaChannel, callback )
{
 	//var img = document.getElementById( imageID );
	var img = image;
	
	var w = imageDim.width;
    var h = imageDim.height;
	
	//var canvas = document.getElementById( canvasID );
	var canvas = canvas;
    /*  
    canvas.style.width  = w + "px";
    canvas.style.height = h + "px";
    canvas.width = w;
    canvas.height = h;
    */
    var context = canvas.getContext("2d");
    context.clearRect( 0, 0, w, h );
    context.drawImage( img, 0, 0, w, h );

	if ( isNaN(radius) || radius < 1 ) return;
	
	if ( blurAlphaChannel )
		stackBlurCanvasRGBA( canvas, 0, 0, w, h, radius, callback );
	else 
		stackBlurCanvasRGB( canvas, 0, 0, w, h, radius, callback );
}


function stackBlurCanvasRGBA( el, top_x, top_y, width, height, radius, callback )
{
	
	if ( isNaN(radius) || radius < 1 ) return;
	radius |= 0;
	
	//var canvas  = document.getElementById( el );
	var canvas  = el;
	var context = canvas.getContext("2d");
	var imageData;
	
	try {
	  try {
		imageData = context.getImageData( top_x, top_y, width, height );
	  } catch(e) {
	  
		// NOTE: this part is supposedly only needed if you want to work with local files
		// so it might be okay to remove the whole try/catch block and just use
		// imageData = context.getImageData( top_x, top_y, width, height );
		try {
			netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
			imageData = context.getImageData( top_x, top_y, width, height );
		} catch(e) {
			alert("Cannot access local image");
			throw new Error("unable to access local image data: " + e);
			return;
		}
	  }
	} catch(e) {
	  alert("Cannot access image");
	  throw new Error("unable to access image data: " + e);
	}
			
	var pixels = imageData.data;
			
	var x, y, i, p, yp, yi, yw, r_sum, g_sum, b_sum, a_sum, 
	r_out_sum, g_out_sum, b_out_sum, a_out_sum,
	r_in_sum, g_in_sum, b_in_sum, a_in_sum, 
	pr, pg, pb, pa, rbs;
			
	var div = radius + radius + 1;
	var w4 = width << 2;
	var widthMinus1  = width - 1;
	var heightMinus1 = height - 1;
	var radiusPlus1  = radius + 1;
	var sumFactor = radiusPlus1 * ( radiusPlus1 + 1 ) / 2;
	
	var stackStart = new BlurStack();
	var stack = stackStart;
	for ( i = 1; i < div; i++ )
	{
		stack = stack.next = new BlurStack();
		if ( i == radiusPlus1 ) var stackEnd = stack;
	}
	stack.next = stackStart;
	var stackIn = null;
	var stackOut = null;
	
	yw = yi = 0;
	
	var mul_sum = mul_table[radius];
	var shg_sum = shg_table[radius];
	
	for ( y = 0; y < height; y++ )
	{
		r_in_sum = g_in_sum = b_in_sum = a_in_sum = r_sum = g_sum = b_sum = a_sum = 0;
		
		r_out_sum = radiusPlus1 * ( pr = pixels[yi] );
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1] );
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2] );
		a_out_sum = radiusPlus1 * ( pa = pixels[yi+3] );
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		a_sum += sumFactor * pa;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack.a = pa;
			stack = stack.next;
		}
		
		for( i = 1; i < radiusPlus1; i++ )
		{
			p = yi + (( widthMinus1 < i ? widthMinus1 : i ) << 2 );
			r_sum += ( stack.r = ( pr = pixels[p])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[p+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[p+2])) * rbs;
			a_sum += ( stack.a = ( pa = pixels[p+3])) * rbs;
			
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			a_in_sum += pa;
			
			stack = stack.next;
		}
		
		
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( x = 0; x < width; x++ )
		{
			pixels[yi+3] = pa = (a_sum * mul_sum) >> shg_sum;
			if ( pa != 0 )
			{
				pa = 255 / pa;
				pixels[yi]   = ((r_sum * mul_sum) >> shg_sum) * pa;
				pixels[yi+1] = ((g_sum * mul_sum) >> shg_sum) * pa;
				pixels[yi+2] = ((b_sum * mul_sum) >> shg_sum) * pa;
			} else {
				pixels[yi] = pixels[yi+1] = pixels[yi+2] = 0;
			}
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			a_sum -= a_out_sum;
			
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			a_out_sum -= stackIn.a;
			
			p =  ( yw + ( ( p = x + radius + 1 ) < widthMinus1 ? p : widthMinus1 ) ) << 2;
			
			r_in_sum += ( stackIn.r = pixels[p]);
			g_in_sum += ( stackIn.g = pixels[p+1]);
			b_in_sum += ( stackIn.b = pixels[p+2]);
			a_in_sum += ( stackIn.a = pixels[p+3]);
			
			r_sum += r_in_sum;
			g_sum += g_in_sum;
			b_sum += b_in_sum;
			a_sum += a_in_sum;
			
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			a_out_sum += ( pa = stackOut.a );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			a_in_sum -= pa;
			
			stackOut = stackOut.next;

			yi += 4;
		}
		yw += width;
	}

	
	for ( x = 0; x < width; x++ )
	{
		g_in_sum = b_in_sum = a_in_sum = r_in_sum = g_sum = b_sum = a_sum = r_sum = 0;
		
		yi = x << 2;
		r_out_sum = radiusPlus1 * ( pr = pixels[yi]);
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1]);
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2]);
		a_out_sum = radiusPlus1 * ( pa = pixels[yi+3]);
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		a_sum += sumFactor * pa;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack.a = pa;
			stack = stack.next;
		}
		
		yp = width;
		
		for( i = 1; i <= radius; i++ )
		{
			yi = ( yp + x ) << 2;
			
			r_sum += ( stack.r = ( pr = pixels[yi])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[yi+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[yi+2])) * rbs;
			a_sum += ( stack.a = ( pa = pixels[yi+3])) * rbs;
		   
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			a_in_sum += pa;
			
			stack = stack.next;
		
			if( i < heightMinus1 )
			{
				yp += width;
			}
		}
		
		yi = x;
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( y = 0; y < height; y++ )
		{
			p = yi << 2;
			pixels[p+3] = pa = (a_sum * mul_sum) >> shg_sum;
			if ( pa > 0 )
			{
				pa = 255 / pa;
				pixels[p]   = ((r_sum * mul_sum) >> shg_sum ) * pa;
				pixels[p+1] = ((g_sum * mul_sum) >> shg_sum ) * pa;
				pixels[p+2] = ((b_sum * mul_sum) >> shg_sum ) * pa;
			} else {
				pixels[p] = pixels[p+1] = pixels[p+2] = 0;
			}
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			a_sum -= a_out_sum;
		   
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			a_out_sum -= stackIn.a;
			
			p = ( x + (( ( p = y + radiusPlus1) < heightMinus1 ? p : heightMinus1 ) * width )) << 2;
			
			r_sum += ( r_in_sum += ( stackIn.r = pixels[p]));
			g_sum += ( g_in_sum += ( stackIn.g = pixels[p+1]));
			b_sum += ( b_in_sum += ( stackIn.b = pixels[p+2]));
			a_sum += ( a_in_sum += ( stackIn.a = pixels[p+3]));
		   
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			a_out_sum += ( pa = stackOut.a );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			a_in_sum -= pa;
			
			stackOut = stackOut.next;
			
			yi += width;
		}
	}
	
	context.putImageData( imageData, top_x, top_y );
	
	callback.call();
	
}


function stackBlurCanvasRGB( el, top_x, top_y, width, height, radius, callback )
{	
	if ( isNaN(radius) || radius < 1 ) return;
	radius |= 0;
	
	//var canvas  = document.getElementById( el );
	var canvas  = el;
	var context = canvas.getContext("2d");
	var imageData;
	
	try {
	  try {
		imageData = context.getImageData( top_x, top_y, width, height );
	  } catch(e) {
	  
		// NOTE: this part is supposedly only needed if you want to work with local files
		// so it might be okay to remove the whole try/catch block and just use
		// imageData = context.getImageData( top_x, top_y, width, height );
		try {
			netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
			imageData = context.getImageData( top_x, top_y, width, height );
		} catch(e) {
			alert("Cannot access local image");
			throw new Error("unable to access local image data: " + e);
			return;
		}
	  }
	} catch(e) {
	  alert("Cannot access image");
	  throw new Error("unable to access image data: " + e);
	}
			
	var pixels = imageData.data;
			
	var x, y, i, p, yp, yi, yw, r_sum, g_sum, b_sum,
	r_out_sum, g_out_sum, b_out_sum,
	r_in_sum, g_in_sum, b_in_sum,
	pr, pg, pb, rbs;
			
	var div = radius + radius + 1;
	var w4 = width << 2;
	var widthMinus1  = width - 1;
	var heightMinus1 = height - 1;
	var radiusPlus1  = radius + 1;
	var sumFactor = radiusPlus1 * ( radiusPlus1 + 1 ) / 2;
	
	var stackStart = new BlurStack();
	var stack = stackStart;
	for ( i = 1; i < div; i++ )
	{
		stack = stack.next = new BlurStack();
		if ( i == radiusPlus1 ) var stackEnd = stack;
	}
	stack.next = stackStart;
	var stackIn = null;
	var stackOut = null;
	
	yw = yi = 0;
	
	var mul_sum = mul_table[radius];
	var shg_sum = shg_table[radius];
	
	for ( y = 0; y < height; y++ )
	{
		r_in_sum = g_in_sum = b_in_sum = r_sum = g_sum = b_sum = 0;
		
		r_out_sum = radiusPlus1 * ( pr = pixels[yi] );
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1] );
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2] );
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack = stack.next;
		}
		
		for( i = 1; i < radiusPlus1; i++ )
		{
			p = yi + (( widthMinus1 < i ? widthMinus1 : i ) << 2 );
			r_sum += ( stack.r = ( pr = pixels[p])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[p+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[p+2])) * rbs;
			
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			
			stack = stack.next;
		}
		
		
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( x = 0; x < width; x++ )
		{
			pixels[yi]   = (r_sum * mul_sum) >> shg_sum;
			pixels[yi+1] = (g_sum * mul_sum) >> shg_sum;
			pixels[yi+2] = (b_sum * mul_sum) >> shg_sum;
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			
			p =  ( yw + ( ( p = x + radius + 1 ) < widthMinus1 ? p : widthMinus1 ) ) << 2;
			
			r_in_sum += ( stackIn.r = pixels[p]);
			g_in_sum += ( stackIn.g = pixels[p+1]);
			b_in_sum += ( stackIn.b = pixels[p+2]);
			
			r_sum += r_in_sum;
			g_sum += g_in_sum;
			b_sum += b_in_sum;
			
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			
			stackOut = stackOut.next;

			yi += 4;
		}
		yw += width;
	}

	
	for ( x = 0; x < width; x++ )
	{
		g_in_sum = b_in_sum = r_in_sum = g_sum = b_sum = r_sum = 0;
		
		yi = x << 2;
		r_out_sum = radiusPlus1 * ( pr = pixels[yi]);
		g_out_sum = radiusPlus1 * ( pg = pixels[yi+1]);
		b_out_sum = radiusPlus1 * ( pb = pixels[yi+2]);
		
		r_sum += sumFactor * pr;
		g_sum += sumFactor * pg;
		b_sum += sumFactor * pb;
		
		stack = stackStart;
		
		for( i = 0; i < radiusPlus1; i++ )
		{
			stack.r = pr;
			stack.g = pg;
			stack.b = pb;
			stack = stack.next;
		}
		
		yp = width;
		
		for( i = 1; i <= radius; i++ )
		{
			yi = ( yp + x ) << 2;
			
			r_sum += ( stack.r = ( pr = pixels[yi])) * ( rbs = radiusPlus1 - i );
			g_sum += ( stack.g = ( pg = pixels[yi+1])) * rbs;
			b_sum += ( stack.b = ( pb = pixels[yi+2])) * rbs;
			
			r_in_sum += pr;
			g_in_sum += pg;
			b_in_sum += pb;
			
			stack = stack.next;
		
			if( i < heightMinus1 )
			{
				yp += width;
			}
		}
		
		yi = x;
		stackIn = stackStart;
		stackOut = stackEnd;
		for ( y = 0; y < height; y++ )
		{
			p = yi << 2;
			pixels[p]   = (r_sum * mul_sum) >> shg_sum;
			pixels[p+1] = (g_sum * mul_sum) >> shg_sum;
			pixels[p+2] = (b_sum * mul_sum) >> shg_sum;
			
			r_sum -= r_out_sum;
			g_sum -= g_out_sum;
			b_sum -= b_out_sum;
			
			r_out_sum -= stackIn.r;
			g_out_sum -= stackIn.g;
			b_out_sum -= stackIn.b;
			
			p = ( x + (( ( p = y + radiusPlus1) < heightMinus1 ? p : heightMinus1 ) * width )) << 2;
			
			r_sum += ( r_in_sum += ( stackIn.r = pixels[p]));
			g_sum += ( g_in_sum += ( stackIn.g = pixels[p+1]));
			b_sum += ( b_in_sum += ( stackIn.b = pixels[p+2]));
			
			stackIn = stackIn.next;
			
			r_out_sum += ( pr = stackOut.r );
			g_out_sum += ( pg = stackOut.g );
			b_out_sum += ( pb = stackOut.b );
			
			r_in_sum -= pr;
			g_in_sum -= pg;
			b_in_sum -= pb;
			
			stackOut = stackOut.next;
			
			yi += width;
		}
	}
	
	context.putImageData( imageData, top_x, top_y );
	
	callback.call();
	
}

function BlurStack()
{	
	this.r = 0;
	this.g = 0;
	this.b = 0;
	this.a = 0;
	this.next = null;
}

$(document).ready(function() {
		'use strict';
			
			var BlurBGImage	= (function() {
				
				var $bxWrapper			= $('#bx-wrapper'),
				// loading status to show while preloading images
				$bxLoading			= $bxWrapper.find('div.bx-loading'),
				// container for the bg images and respective canvas
				$bxContainer		= $bxWrapper.find('div.bx-container'),
				// the bg images we are gonna use
				$bxImgs				= $bxContainer.children('img'),
				// total number of bg images
				bxImgsCount			= $bxImgs.length,
				// the thumb elements
				$thumbs				= $bxWrapper.find('div.bx-thumbs > a').hide(),
				// the title for the current image
				$title				= $bxWrapper.find('h2:first'),
				// current image's index
				current				= 0,
				// variation to show the image:
				// (1) - blurs the current one, fades out and shows the next image
				// (2) - blurs the current one, fades out, shows the next one (but initially blurred)
				// speed is the speed of the animation
				// blur Factor is the factor used in the StackBlur script
				animOptions			= { speed : 900, variation : 2, blurFactor : 10, autoPlay: true, slideInterval: 5000 },
				// control if currently animating
				isAnim				= false,
				$bxPrev				= $bxWrapper.find('.bx-prev'),
				$bxNext				= $bxWrapper.find('.bx-next'),
				// check if canvas is supported
				supportCanvas 		= Modernizr.canvas,
				
				// init function
				init				= function() {
						
					// preload all images and respective canvas
					var loaded = 0;

					$bxImgs.each( function(i) {
							
						var $bximg	= $(this);
						
						// save the position of the image in data-pos load
						$('<img data-pos="' + $bximg.index() + '"/>').load(function() {
								
							var $img	= $(this),
							
							// size of image to be fullscreen and centered
							dim		= getImageDim( $img.attr('src') ),
							pos		= $img.data( 'pos' );
							
							// add the canvas to the DOM

							$.when( createCanvas( pos, dim ) ).done( function() {
										
								++loaded;
									
								if( loaded === bxImgsCount ) {
										
									 $thumbs.fadeIn();
										
									centerImageCanvas();
										
									$bxLoading.delay(1000).fadeOut(100,function(){
									initEvents();
									
									});
									
								}
									
							});
							
						}).attr( 'src', $bximg.attr('src') );
						
					});
					
					
				},
				// creates the blurred canvas image
				createCanvas		= function( pos, dim ) {
						
					return $.Deferred( function(dfd) {
							
						// if canvas not supported return
						if( !supportCanvas ) {
							dfd.resolve();
							return false;
						}	
							
						// create the canvas element:
						// size and position will be the same like the fullscreen image
						var $img	= $bxImgs.eq( pos ),
						imgW	= dim.width,
						imgH	= dim.height,
						imgL	= dim.left,
						imgT	= dim.top,
								
						canvas	= document.createElement('canvas');
							
						canvas.className	= 'bx-canvas';
						canvas.width 		= imgW;
						canvas.height 		= imgH;
						canvas.style.width  = imgW + 'px';
						canvas.style.height = imgH + 'px';
						canvas.style.left	= imgL + 'px';
						canvas.style.top	= imgT + 'px';
						canvas.style.visibility = 'hidden';
						// save position of canvas to know which image this is linked to
						canvas.setAttribute('data-pos', pos);
						// append the canvas to the same container where the images are
						$bxContainer.append( canvas );
						// blur it using the StackBlur script
						stackBlurImage( $img.get(0), dim, canvas, animOptions.blurFactor, false, dfd.resolve );
						
					}).promise();							
							
				},
				// gets the image size and position in order to make it fullscreen and centered.
				getImageDim			= function( img ) {
						
					var $img    = new Image();
						
					$img.src    = img;
						
					var $win	= $( window ),
					w_w		= $win.width(),
					w_h		= $win.height(),
					r_w		= w_h / w_w,
					i_w		= $img.width,
					i_h		= $img.height,
					r_i		= i_h / i_w,
					new_w, new_h, new_left, new_top;
								
					if( r_w > r_i ) {
							
						new_h	= w_h;
						new_w	= w_h / r_i;
						
					}
					else {
						
						new_h	= w_w * r_i;
						new_w	= w_w;
						
					}
								
					return {
						width	: new_w,
						height	: new_h,
						left	: ( w_w - new_w ) / 2,
						top		: ( w_h - new_h ) / 2
					};
					
				},
				timerslide=null,
				stopPlay	= function(timer){
					clearTimeout(timer);
				},
				autoPlay	=function(pos){

					if (bxImgsCount == 0) {
					// TODO: better solution!
					} else {

						$thumbs.removeClass('bx-thumbs-current');
						$($thumbs.get(pos)).addClass('bx-thumbs-current');
						
						isAnim = true;
						
						showImage( pos,animOptions.speed );
						pos++;
						if(pos >= bxImgsCount){
							pos=0;
						}
						
						timerslide= setTimeout(function(){autoPlay(pos)},animOptions.slideInterval);
					}
				},

				// initialize the events
				initEvents			= function() {
						
					$( window ).on('resize.BlurBGImage', function( event ) {
							
						// apply style for bg image and canvas
						centerImageCanvas();
						return false;
							
					});
					
					$bxPrev.click(function(e){
						e.stopPropagation();
						stopPlay(timerslide);
						$thumbs.removeClass('bx-thumbs-current');
						var pos=current;
						pos--;
						if(pos <  0 ){
								pos=(bxImgsCount-1);
						
						}
						
						$($thumbs.get(pos)).addClass('bx-thumbs-current');
						isAnim = true;
						showImage(pos,500);
						pos--;
						if(pos < 0){
								pos=(bxImgsCount - 1 );
						
						}
						timerslide= setTimeout(function(){autoPlay(pos)},animOptions.slideInterval);

					});
					
					$bxNext.click(function(e){
						e.stopPropagation();
						stopPlay(timerslide);
						$thumbs.removeClass('bx-thumbs-current');
						var pos=current;
						pos++;
						if(pos >= bxImgsCount){
								pos=0;
						
						}
						
						$($thumbs.get(pos)).addClass('bx-thumbs-current');
						isAnim = true;
						showImage(pos,500);
						pos++;
						if(pos >= bxImgsCount){
								pos=0;
						
						}
						timerslide= setTimeout(function(){autoPlay(pos)},animOptions.slideInterval);


					});
						
					if(animOptions.autoPlay){

						timerslide= setTimeout(function(){autoPlay(current+1)},animOptions.slideInterval);
					}

					// clicking on a thumb shows the respective bg image
					$thumbs.on('click.BlurBGImage', function( event ) {
						event.stopPropagation();
						stopPlay(timerslide);	
						var $thumb	= $(this),
						pos		= $thumb.index();
						
						if( pos !== current ) {
								
							$thumbs.removeClass('bx-thumbs-current');
							$thumb.addClass('bx-thumbs-current');
							isAnim = true;
							// show the bg image
							
							showImage( pos,200 );
							pos++;
							if(pos >= bxImgsCount){
								pos=0;
							}
							
							timerslide= setTimeout(function(){autoPlay(pos)},animOptions.slideInterval);
							
						}
							
						return false;
							
					});
					


				},
				// apply style for bg image and canvas
				centerImageCanvas	= function() {
						
					$bxImgs.each( function(i) {
							
						var $bximg	= $(this),
						dim			= getImageDim( $bximg.attr('src') ),
						$currCanvas	= $bxContainer.children('canvas[data-pos=' + $bximg.index() + ']'),
						styleCSS	= {
							width	: dim.width,
							height	: dim.height,
							left	: dim.left,
							top		: dim.top
						};	
							
						$bximg.css( styleCSS );
							
						if( supportCanvas )
							$currCanvas.css( styleCSS );
								
						if( i === current )	
							$bximg.show();
							
					});
						
				},
				// shows the image at position "pos"
				showImage			= function( pos,speed ) {
					
					// current image 
					var $bxImage		= $bxImgs.eq( current ),
					// current canvas
					$bxCanvas		= $bxContainer.children('canvas[data-pos=' + $bxImage.index() + ']'),
					// next image to show
					$bxNextImage	= $bxImgs.eq( pos ),
					// next canvas to show
					$bxNextCanvas	= $bxContainer.children('canvas[data-pos='+$bxNextImage.index()+']');
					
					// if canvas is supported
					if( supportCanvas ) {
						
						$.when( $title.fadeOut() ).done( function() {
							
							$title.text( $bxNextImage.attr('title') );
								
						});
						
						$bxCanvas.css( 'z-index', 100 ).css('visibility','visible');
							
						$.when( $bxImage.fadeOut( speed ) ).done( function() {
								
							switch( animOptions.variation ) {
								
								case 1 	:
									$title.fadeIn( animOptions.speed );
									$.when( $bxNextImage.fadeIn( speed ) ).done( function() {
									
										$bxCanvas.css( 'z-index', 1 ).css('visibility','hidden');
										current = pos;
										$bxNextCanvas.css('visibility','hidden');
										isAnim 	= false;
										
									});
									break;
								case 2	:
									$bxNextCanvas.css('visibility','visible');
										
									$.when( $bxCanvas.fadeOut( speed * 1.5 ) ).done( function() {
										
										$(this).css({
											'z-index' 		: 1,
											'visibility'	: 'hidden'
										}).show();
											
										$title.fadeIn( animOptions.speed );
											
										$.when( $bxNextImage.fadeIn( speed ) ).done( function() {
												
											current = pos;
											$bxNextCanvas.css('visibility','hidden');
											isAnim 	= false;
											
										});
											
									});

									break;
								
							};
							return true;
								
						});
						
					}
					// if canvas is not shown just work with the bg images
					else {
							
						$title.hide().text( $bxNextImage.attr('title') ).fadeIn( speed );
						$.when( $bxNextImage.css( 'z-index', 102 ).fadeIn( speed ) ).done( function() {
								
							current = pos;
							$bxImage.hide();
							$(this).css( 'z-index', 101 );
							isAnim = false;
							
						});
						
					}
					
				};
					
				return {
					init	: init
				};
			
			})();
			// call the init function
			BlurBGImage.init();
			
});