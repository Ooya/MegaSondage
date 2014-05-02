function ironManTourne(){
	var layer = new collie.Layer({
		width: 60,
		height: 60
	});

	collie.ImageManager.add({
		logo: "./ironman.png"
	});

	var logo = new collie.DisplayObject({
		x: 12,
		y: 12,
		velocityRotate: 130,
		backgroundImage: "logo"
	}).addTo(layer);

	collie.Renderer.addLayer(layer);
	collie.Renderer.load(document.getElementById("ironMan"));
	collie.Renderer.start();
}