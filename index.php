<?php
if( @$_GET['pdf_url'] )
{
	$pdf_url = $_GET['pdf_url'];
#minutes.susu.org/files/edwel_minutes_20-1-2005.pdf
	#if( !preg_match( '/^http:\/\/minutes\.susu\.org\/[a-zA-Z0-9-_.]*$/', $pdf_url ) )
	if( !preg_match( '/^http:\/\/minutes\.susu\.org\/[-\/\._A-Za-z0-9]*$/', $pdf_url ) )
	{
		print "Sorry, ".htmlspecialchars( $pdf_url )." does not match a nice URL on minutes.susu.org.";
		exit;
	}
	$hash = md5( $pdf_url );
	$cache = "rdf/$hash.rdf";
	if( !file_exists( $cache ) )
	{
		exec( "./processSUSUMinutes $pdf_url > $cache" );
	}
	header( "Location: http://lemur.ecs.soton.ac.uk/~cjg/TheyWorkForSUSU/$cache" );
	exit;
}

?>
<p>This is an experiment. Please don't use the data for anything serious yet. Get in touch with me at <a href='mailto:cjg@ecs.soton.ac.uk?subject=TheyWorkForSUSU'>cjg@ecs.soton.ac.uk</a>

<form>SUSU PDF URL: <input style='width:99%' name='pdf_url'  />
<input value='process!' type='submit' />
</form>
<p>This takes the PDFs of minutes from SUSU and does its best to make them into data. It gets it wrong but it proves the concept. If all minutes were produced using a set template it could work smoothly.</p>
<p>All the code <a href='https://github.com/cgutteridge/TheyWorkForSUSU'>is on github</a>. I've not put a license on it yet, but it'll be something open.</p>
<p>Here's some examples to play with to get started. Find more on <a href='http://minutes.susu.org/'>http://minutes.susu.org/</a> -- the more recent ones work better as that was mostly what I was playing with.</p>
<ul>
<li><a href='?pdf_url=http://minutes.susu.org/files/enveth_minutes_27-10-2011.pdf'>http://minutes.susu.org/files/enveth_minutes_27-10-2011.pdf</a></li>
<li><a href='?pdf_url=http://minutes.susu.org/files/mdacom_minutes_16-12-2011.pdf'>http://minutes.susu.org/files/mdacom_minutes_16-12-2011.pdf</a></li>
<li><a href='?pdf_url=http://minutes.susu.org/files/edwel_minutes_20-1-2005.pdf'>http://minutes.susu.org/files/edwel_minutes_20-1-2005.pdf</a></li>
<li><a href='?pdf_url=http://minutes.susu.org/files/umb_minutes_9-2-2011.pdf'>http://minutes.susu.org/files/umb_minutes_9-2-2011.pdf</a></li>
</ul>
<p>You can take the RDF URL those forward to 
