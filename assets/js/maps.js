window.addEventListener("DOMContentLoaded", event => {
	function initialize() {
		var map;
		var bounds = new google.maps.LatLngBounds();
		var mapOptions = {
			mapTypeId: "roadmap",
			streetViewControl: true
		};

		const mapCanvas = document.getElementById("map_canvas");

		// Display a map on the page
		map = new google.maps.Map(mapCanvas, mapOptions);
		map.setTilt(45);

		// Multiple Markers
		var markers = [
			["Kielce, Staszica 14a", 50.8700225, 20.6250674],
			[" Kielce, Plac Moniuszki 5", 50.8678061, 20.6372697]
		];

		// Info Window Content
		var infoWindowContent = [
			[
				'<div class="info_content">' +
					'<img width="200" height="71" src="https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo.png" class="custom-logo" alt="Venus Hurtownia Fryzjersko – Kosmetyczna" srcset="https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo.png 200w, https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo-64x23.png 64w" sizes="(max-width: 200px) 100vw, 200px">' +
					"<h3>Venus, Kielce, Staszica 14a</h3>" +
					"</div>"
			],
			[
				'<div class="info_content">' +
					'<img width="200" height="71" src="https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo.png" class="custom-logo" alt="Venus Hurtownia Fryzjersko – Kosmetyczna" srcset="https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo.png 200w, https://blossomitdev.usermd.net/wp-content/uploads/2020/11/cropped-venus-logo-64x23.png 64w" sizes="(max-width: 200px) 100vw, 200px">' +
					"<h3>Venus, Kielce, Plac Moniuszki 5</h3>" +
					"</div>"
			]
		];

		// Display multiple markers on a map
		var infoWindow = new google.maps.InfoWindow(),
			marker,
			i;

		// Loop through our array of markers & place each one on the map
		for (i = 0; i < markers.length; i++) {
			var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
			bounds.extend(position);
			marker = new google.maps.Marker({
				position: position,
				map: map,
				title: markers[i][0]
			});

			// Allow each marker to have an info window
			google.maps.event.addListener(
				marker,
				"click",
				(function(marker, i) {
					return function() {
						infoWindow.setContent(infoWindowContent[i][0]);
						infoWindow.open(map, marker);
					};
				})(marker, i)
			);

			// Automatically center the map fitting all markers on the screen
			map.fitBounds(bounds);
		}

		// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
		var boundsListener = google.maps.event.addListener(
			map,
			"bounds_changed",
			function(event) {
				this.setZoom(14);
				google.maps.event.removeListener(boundsListener);
			}
		);
	}

	initialize();
});
