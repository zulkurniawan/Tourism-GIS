<?php

// echo '<pre>';
// print_r($data);
// exit;

	$dom 		= new DOMDocument('1.0', 'UTF-8');
	// Creates the root KML element and appends it to the root document.
	$node 		= $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
	$parNode 	= $dom->appendChild($node);

	// Creates a KML Document element and append it to the KML element.
	$dnode = $dom->createElement('Document');
	$docNode = $parNode->appendChild($dnode);

	foreach($kategori as $key => $c)
	{
		// Creates the Style elements
		$restStyleNode 		= $dom->createElement('Style');
		$restStyleNode->setAttribute('id', 'kat' . $c->kategori_id . 'Style');

		if(!empty($c->marker_path))
		{
			$icon = base_url('uploads/' . $c->marker_path);
		}
		else
		{
			$icon = 'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png';
		}

		$restIconstyleNode 	= $dom->createElement('IconStyle');
		$restIconstyleNode->setAttribute('id', 'kat' . $c->kategori_id . 'Icon');
		$restIconNode 		= $dom->createElement('Icon');
		$restHref 			= $dom->createElement('href', $icon);

		$restIconNode->appendChild($restHref);
		$restIconstyleNode->appendChild($restIconNode);
		$restStyleNode->appendChild($restIconstyleNode);
		$docNode->appendChild($restStyleNode);	
	}

	// Iterates through the MySQL results, creating one Placemark for each row.
	foreach($data as $key => $c)
	{
	  	// Creates a Placemark and append it to the Document.
	  	$node 		= $dom->createElement('Placemark');
	  	$placeNode 	= $docNode->appendChild($node);

	  	// Creates an id attribute and assign it the value of id column.
	  	$placeNode->setAttribute('id', 'placemark' . $c->objek_id);

	  	// Create name, and description elements and assigns them the values of the name and address columns from the results.
	  	$nameNode 	= $dom->createElement('name', htmlspecialchars($c->nama));
	  	$placeNode->appendChild($nameNode);
	  	$descNode 	= $dom->createElement('description', htmlspecialchars($c->info_deskripsi));
	  	$placeNode->appendChild($descNode);
	  	$styleUrl 	= $dom->createElement('styleUrl', '#' . 'kat' . $c->kategori_id . 'Style');
	  	$placeNode->appendChild($styleUrl);


	  	// Creates a Point element.
	  	$pointNode 	= $dom->createElement('Point');
	  	$placeNode->appendChild($pointNode);
	  	// Creates a coordinates element and gives it the value of the lng and lat columns from the results.
	  	$coorStr 	= str_replace(array('{lat:', 'lng:', '}'), '', $c->lokasi_koordinat);
	  	$explode_coor = explode(',', $coorStr);

	  	$coorNode 	= $dom->createElement('coordinates', $explode_coor[1] . ',' . $explode_coor[0]);
	  	$pointNode->appendChild($coorNode);

	  	// Create Extended Data
	  	$extendedData 	= $dom->createElement('ExtendedData');
	  	$placeNode->appendChild($extendedData);

	  	// Desa
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Desa');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->lokasi_desa));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kecamatan
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kecamatan');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->lokasi_kecamatan));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kabupaten
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kabupaten / Kota');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->lokasi_kabupaten_kota));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Tiket
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Tiket');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->info_tiket));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Tempat Ibadah
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Tempat Ibadah');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->info_tempat_ibadah));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Penginapan
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Penginapan');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->info_penginapan));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Toilet
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Toilet');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->info_toilet));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Akses Jalan
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Akses Jalan');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->info_akses_jalan));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Handphone
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Handphone');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_handphone));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Facebook
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Facebook');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_facebook));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Twitter
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Twitter');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_twitter));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Instagram
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Instagram');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_instagram));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Website
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Website');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_website));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontak Email
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontak Email');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->kontak_email));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kategori
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kategori');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->nama_kategori));
	  	$extendedInfNode->appendChild($valueNode);

	  	// Kontributor
	  	$extendedInfNode 		= $dom->createElement('Data');
	  	$extendedInfNode->setAttribute('id', 'Kontributor');
	  	$extendedData->appendChild($extendedInfNode);
	  	$valueNode 		= $dom->createElement('value', htmlspecialchars($c->nama_kontributor));
	  	$extendedInfNode->appendChild($valueNode);
	}	

	$kmlOutput = $dom->saveXML();
	header('Content-type: application/vnd.google-earth.kml+xml');
	header('Content-Disposition: attachment; filename="export_objek.kml"');

	echo $kmlOutput;
?>