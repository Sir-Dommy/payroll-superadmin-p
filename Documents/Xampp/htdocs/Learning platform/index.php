<html>
    <head>
        <title>Welocome to limitless learning platform</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="Dan.css">
        <link rel="stylesheet" href="mercy.css">
        <link href="eddah/eddah.css" rel="stylesheet">
        <link href="Davi\Davi.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <meta name="viewport" content="width=device-width,initial-scale=1"> -->
        
    </head>
    <body>

    <app-davi></app-davi>

        <div class="category">
            <div class="categoriesList">
            <ul>
                <a href="#">Mathematics</a>
                <a href="#">English</a>
                <a href="#">Kiswahili</a>
                <a href="#">History</a>
                <a href="#">Computer Studies</a>
                <a href="#">Agriculture</a>
            </ul>
            </div>

            <div class="description">
            <span><p class="desc">Below are some of the topics we recomend you to study about Mathematics</p></span>
            <div class="selectedCategory">
                
                <div>
                    <img src="WhatsApp Image 2022-07-04 at 10.09.30 AM.jpeg" class="lesson1" alt="lesson1">
                    <p>Enhance your knowledge on probability and statistics. Many people who have taken this course
                        have rated it highly. <br>
                        <b>Rating </b> <!-- &#9733;&#9733;&#9733;&#9733;&#9733; -->
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span> <br>
                        ksh: 1200.00
                    </p>
                </div>
                <div>
                    <img src="WhatsApp Image 2022-07-04 at 10.09.31 AM.jpeg" class="lesson1"  alt="lesson1">
                    <p>Enhance your knowledge on probability and statistics. Many people who have taken this course
                        have rated it highly. <br>
                        <b>Rating </b><app-rating></app-rating> <br>
                        ksh: 1200.00
                    </p>
                </div>
                <div>
                    <img src="WhatsApp Image 2022-07-04 at 10.09.32 AM.jpeg" class="lesson1" alt="lesson1">
                    <p>Enhance your knowledge on probability and statistics. Many people who have taken this course
                        have rated it highly. <br>
                        <b>Rating </b><app-rating></app-rating> <br>
                        ksh: 1200.00
                    </p>
                </div>
                <div class="more"><a href="#"><b> More</b>&#8594;</a></div>
            </div>
            </div>
            
        </div>

        <div class="desc2">
        <p><b>People are viewing</b></p>
        <div class="peopleAreViewing">
            <div class="images">
                <img src="WhatsApp Image 2022-07-04 at 10.09.32 AM.jpeg" class="lesson1" alt="Top category 1 image">
                <p>You can check some of our top courses other people have viewed on our platform <br>
                <b>Rating </b><app-rating></app-rating> <br>
                        ksh: 1200.00
                    </p>
            </div>
            <div class="images">
                <img src="WhatsApp Image 2022-07-04 at 10.09.31 AM.jpeg" class="lesson1"" alt="Top category 1 image">
                <p>You can check some of our top courses other people have viewed on our platform  <br>
                <b>Rating </b><app-rating></app-rating> <br>
                        ksh: 1200.00 
                </p>
            </div>
            <div class="images">
                <img src="WhatsApp Image 2022-07-04 at 10.09.30 AM.jpeg" class="lesson1" alt="Top category 1 image" height="100%"
                width="100%">
                <p>You can check some of our top courses other people have viewed on our platform <br>
                <b>Rating </b><app-rating></app-rating> <br>
                        ksh: 1200.00
                    </p>
            </div>
        </div>

        </div>

        <app-eddah></app-eddah>
        
        <!-- Mercy design component for body-->
        <app-mercy></app-mercy>

        <br>
        <br><br>
        <br>
        <br>

        <!-- Dan design component for footer -->
        <app-footer></app-footer>
        
        <script src="components.js"></script>
    </body>
</html>