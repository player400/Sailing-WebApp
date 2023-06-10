Sailing Web Application
____________________________________________

This project was developed as part of a university assignment. 
Unfortunately running it on your machine is impossible, as it requires properly configured instance of MongoDB unrelative database.
At some point I may consider hosting it on GitHub Pages as part of my portfolio.


Frontend-only features:
____________________________

Darkmode (working on sessionStorage)

Adding boats from a list of boat types to favourites (running on localStorage, you may choose to view only favourite boats by clicking ,,Ulubione" (pl. ,,favourite") button in the ,,Klasy" (pl. ,,types") menu - the site will remember your choice and show you only favourite boats in the dropdown menu as well as in the entire tab, until you click ,,Wszystkie" (pl. ,,all"))

Contact form with client-side validation and preview of attached images. To see the preview, go to ,,Kontakt" tab and upload .jpg or .png into the file upload field. For no-image files a message ,,no preview availible" will be displayed.


Features requiring back end:
____________________________

Login system

Global photo gallery that users may upload to (logged-in users may flag their photos as private)

Watermark system (user provides watermark as text in the photo-upload form and it's then pasted onto the photo by the backend)

Auto-downscaling of image icons in the gallery (photos in the gallery are first downloaded from the server in low resolution and after clicking on the icon, the full-size photo is displayed in full-screen mode)

Adding photos to favourites (non-registered users may add photos to favourites as well and it will be saved in server-side session data, but after logging in those photos will be automatically added to user data) - this feature is supposed to emulate the ,,cart" functionality in online stores.

Search engine for photos in the gallery (searching based on photo titles, implemented with JQuery Ajax, search is ran automatically every time when user puts input into the search field)


Implementation details:
____________________________

Entire web-app is implemented basing on MVC design pattern. That makes the code more maintainable and scalable (though it's still php, so there's ony so much one can do to make it maintainable and scalable).


Final notes
____________________________

Since running this web app requires virtual machine with http server configured (not to mention properly configured MongoDB database instance), I attach a Frontend-only version of the site.
All functionalities relating to the photo gallery and user system are simply not present there. Instead of php there are simple HTML documents there.
This is intended to showcase the JavaStript used.


License
____________________________ 

Software is thereby released under MIT Licence. See opensource.org for details. Copy of the license below:

Copyright 2023 Mateusz Nurczyński

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

