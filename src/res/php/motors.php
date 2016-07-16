		<div class="quitListMotors" onclick="showMotors();"></div>
		<div class="listMotors">
		<h4>Tous les moteurs de recherches disponibles</h4>
		<ul>
			<li onclick="setMotor('','','res/img/choose.png','');">
				<img src="res/img/choose.png" />
				<p>Demander plus tard</p>
			</li>
			
			<li onclick="setMotor('http://www.01net.com/recherche/recherche.php?searchstring=','','res/img/motors/01net.png','01net');">
				<img src="res/img/motors/01net.png" />
				<p>01net</p>
			</li>
			
			<li onclick="setMotor('http://www.750g.com/recettes_','.html','res/img/motors/new/750g.png','750 grammes');">
				<img src="res/img/motors/new/750g.png" />
				<p>750 grammes</p>
			</li>
			
			<li onclick="setMotor('http://www.allocine.fr/recherche/?q=','','res/img/motors/new/allocine.png','Allociné');">
				<img src="res/img/motors/new/allocine.png" />
				<p>Allociné</p>
			</li>
			
			<li onclick="setMotor('http://www.amazon.fr/s?field-keywords=','','res/img/motors/amazon.png','Amazon');">
				<img src="res/img/motors/amazon.png" />
				<p>Amazon</p>
			</li>
			
			<li onclick="setMotor('http://www.bing.com/search?q=','','res/img/motors/bing.png','Bing');">
				<img src="res/img/motors/bing.png" />
				<p>Bing</p>
			</li>
			
			<li onclick="setMotor('http://www.boulanger.com/resultats?tr=','','res/img/motors/new/boulanger.jpg','Boulanger');">
				<img src="res/img/motors/new/boulanger.jpg" />
				<p>Boulanger</p>
			</li>
			
			<li onclick="setMotor('http://www.commentcamarche.net/s/','','res/img/motors/new/ccm.png','Comment ça marche');">
				<img src="res/img/motors/new/ccm.png" />
				<p>Comment ça marche</p>
			</li>
			
			<li onclick="setMotor('http://dailymotion.com/relevance/search/','','res/img/motors/dailymotion.jpg','Dailymotion');">
				<img src="res/img/motors/dailymotion.jpg" />
				<p>Dailymotion</p>
			</li>
			
			<li onclick="setMotor('http://browse.deviantart.com/?q=','','res/img/motors/deviantart.png','DeviantArt');">
				<img src="res/img/motors/deviantart.png" />
				<p>DeviantArt</p>
			</li>
			
			<li onclick="setMotor('https://www.dropbox.com/search/personal?query_unnormalized=','&last_fq_path=','res/img/motors/new/dropbox.png','Dropbox');">
				<img src="res/img/motors/new/dropbox.png" />
				<p>Dropbox</p>
			</li>
			
			<li onclick="setMotor('https://duckduckgo.com/?q=','','res/img/motors/duckduckgo.png','DuckDuckGo');">
				<img src="res/img/motors/duckduckgo.png" />
				<p>DuckDuckGo</p>
			</li>
			
			<li onclick="setMotor('http://www.facebook.com/search/results?q=','','res/img/motors/facebook.png','Facebook');">
				<img src="res/img/motors/facebook.png" />
				<p>Facebook</p>
			</li>
			
			<li onclick="setMotor('https://www.flickr.com/search/?text=','','res/img/motors/flickr.png','Flickr');">
				<img src="res/img/motors/flickr.png" />
				<p>Flickr</p>
			</li>
			
			<li onclick="setMotor('https://github.com/search?q=','','res/img/motors/new/github.png','GitHub');">
				<img src="res/img/motors/new/github.png" />
				<p>GitHub</p>
			</li>
			
			<li onclick="setMotor('http://www.google.fr/search?q=','','res/img/motors/google.jpg','Google');">
				<img src="res/img/motors/google.jpg" />
				<p>Google</p>
			</li>
			
			<li onclick="setMotor('https://www.google.fr/maps/search/','','res/img/motors/new/google-maps.png','Google Maps');">
				<img src="res/img/motors/new/google-maps.png" />
				<p>Google Maps</p>
			</li>
			
			<li onclick="setMotor('https://www.here.com/search/','','res/img/motors/new/here.png','Here Maps');">
				<img src="res/img/motors/new/here.png" />
				<p>Here Maps</p>
			</li>
			
			<li onclick="setMotor('http://www.journaldugeek.com/?s=','','res/img/motors/journaldugeek.png','Journal du Geek');">
				<img src="res/img/motors/journaldugeek.png" />
				<p>Journal du Geek</p>
			</li>
			
			<li onclick="setMotor('http://recherche.lefigaro.fr/recherche/recherche.php?ecrivez=','','res/img/motors/figaro.png','Le Figaro');">
				<img src="res/img/motors/figaro.png" />
				<p>Le Figaro</p>
			</li>
			
			<li onclick="setMotor('http://www.lemonde.fr/recherche/?keywords=','','res/img/motors/lemonde.png','Le Monde');">
				<img src="res/img/motors/lemonde.png" />
				<p>Le Monde</p>
			</li>
			
			<li onclick="setMotor('http://www.lesnumeriques.com/recherche?q=','','res/img/motors/les-numeriques.png','Les Numériques');">
				<img src="res/img/motors/les-numeriques.png" />
				<p>Les Numériques</p>
			</li>
			
			<li onclick="setMotor('http://www.marmiton.org/recettes/recherche.aspx?aqt=','','res/img/motors/new/marmiton.png','Marmiton');">
				<img src="res/img/motors/new/marmiton.png" />
				<p>Marmiton</p>
			</li>
			
			<li onclick="showFolder('#OCR');" style="display: none;">
				<img src="res/img/motors/openclassrooms.PNG" />
				<p>Open Classrooms</p>
			</li>
			
			<span id="OCR">
				<li onclick="setMotor('https://openclassrooms.com/courses?q=','','res/img/motors/openclassrooms.PNG','O.C. - Cours');">
					<img src="res/img/motors/openclassrooms.PNG" />
					<p>O.C. (Cours)</p>
				</li>
				
				<li onclick="setMotor('https://openclassrooms.com/recherche/?search=','','res/img/motors/openclassrooms.PNG','O.C. - Forums');">
					<img src="res/img/motors/openclassrooms.PNG" />
					<p>O.C. (Forums)</p>
				</li>
			</span>
			
			<li onclick="setMotor('https://onedrive.live.com/?qt=search&q=','','res/img/motors/new/onedrive.png','OneDrive');">
				<img src="res/img/motors/new/onedrive.png" />
				<p>OneDrive</p>
			</li>
			
			<li onclick="setMotor('https://play.google.com/store/search?q=','','res/img/motors/playstore.png','Play Store');">
				<img src="res/img/motors/playstore.png" />
				<p>Play Store</p>
			</li>
			
			<li onclick="setMotor('http://pluzz.francetv.fr/recherche?recherche=','','res/img/motors/new/pluzz.png','Pluzz');">
				<img src="res/img/motors/new/pluzz.png" />
				<p>Pluzz</p>
			</li>
			
			<li onclick="setMotor('https://www.qwant.com/?q=','','res/img/motors/qwant.png','Qwant');">
				<img src="res/img/motors/qwant.png" />
				<p>Qwant</p>
			</li>
			
			<li onclick="setMotor('https://soundcloud.com/search?q=','','res/img/motors/soundcloud.jpg','SoundCloud');">
				<img src="res/img/motors/soundcloud.jpg" />
				<p>SoundCloud</p>
			</li>
			
			<li onclick="setMotor('http://sourceforge.net/directory/?q=','','res/img/motors/new/sourceforge.png','SourceForge');">
				<img src="res/img/motors/new/sourceforge.png" />
				<p>SourceForge</p>
			</li>
			
			<li onclick="setMotor('https://twitter.com/search?q=','','res/img/motors/twitter.png','Twitter');">
				<img src="res/img/motors/twitter.png" />
				<p>Twitter</p>
			</li>
			
			<li onclick="setMotor('https://vimeo.com/search?q=','','res/img/motors/vimeo.png','Vimeo');">
				<img src="res/img/motors/vimeo.png" />
				<p>Vimeo</p>
			</li>
			
			<li onclick="setMotor('http://fr.wikipedia.org/w/index.php?search=','','res/img/motors/wikipedia.png','Wikipedia');">
				<img src="res/img/motors/wikipedia.png" />
				<p>Wikipedia</p>
			</li>
			
			<li onclick="setMotor('https://www.microsoft.com/fr-fr/store/search/apps?q=','','res/img/motors/windowsstore.png','Windows Store');">
				<img src="res/img/motors/windowsstore.png" />
				<p>Windows Store</p>
			</li>
			
			<li onclick="setMotor('http://fr.search.yahoo.com/search?p=','','res/img/motors/yahoo.png','Yahoo');">
				<img src="res/img/motors/yahoo.png" />
				<p>Yahoo</p>
			</li>
			
			<li onclick="setMotor('http://www.youtube.com/results?q=','','res/img/motors/youtube.png','YouTube');">
				<img src="res/img/motors/youtube.png" />
				<p>YouTube</p>
			</li>
			
			<li onclick="setMotor('http://zestedesavoir.com/rechercher?q=','','res/img/motors/zestedesavoir.png','Zeste de Savoir');">
				<img src="res/img/motors/zestedesavoir.png" />
				<p>Zeste de Savoir</p>
			</li>
		</ul>
	</div>