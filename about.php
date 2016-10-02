<?php
//Start Session.
session_start();
?>
<!DOCTYPE html>

<!--"About us" page of FlowerShop.
    Please refer back to this page for any comments on the main structure of the site
    Refer to order.html for comments on pages using forms
    All flower details and flower pictures are referenced in catalog.xml

    In addition to HTML5 changes, nav bar changes, and right side changes, this page as been further modified as such:
    - Removed dummy text and added a description-->

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Flower Shop</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>

    <div id="wrap">

        <header>

          <div class="logo">
              <a href="main.php">
                  <img src="images/logo.gif" style="border:0" />
              </a>
          </div>

            <nav>
                <ul>
                    <li><a href="main.php">Home</a></li>
                    <li class="selected"><a href="about.php">About Us</a></li>
                    <li><a href="category.php">Flowers</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="searchForm.php">Search</a></li>
                    <?php
                    include("php/nav.php");
                    /*-------------------------
                    Dynamic Nav bar.
                    --------------------------
                    if(isset($_SESSION["UserData"])){
                      echo "\n" . '<li><a href="myaccount.php">My Account</a></li>';
                      echo "\n" . '<li><a href="php/logout.php">Logout</a></li>';
                    }
                    else{
                      echo "\n" . '<li><a href="myaccount.php">Sign In</a></li>';
                      echo "\n" . '<li><a href="registerForm.php">Sign Up</a></li>';
                    }
                    */
                    ?>
                </ul>
            </nav>

        </header>

        <main>

            <div class="left_content">

                <div class="title">
                    <span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>About us
                </div>

                <div class="feat_prod_box_details">
                    <!--Added about us shop description - removed dummy text-->
                    <!--Adapted from Burpee 2016, available at http://www.burpee.com/gardenadvicecenter/about/about-us/about-us.html, accessed 13/08/2016-->
                    <p class="details">
                        <img src="images/about.gif" alt="" title="" class="right" />
                        For millions of Australians, weary of long winters, nothing signals spring like the arrival of their annual Flower Shop Catalog in the mailbox. Turning page after page and seeing the brilliant colors of plants, awakens the imagination as loyal customers begin to plan the contents of their garden each spring. And even though the catalog itself has been a personal favorite, the reader still does not know the ending story. This is because Flower Shop's highly recognized horticulturalists have been continuously bringing innovation to the seed market since 1881.
                    </p>

                    <p class="details">
                        Flower Shop seeds and plants are available for all growing zones and for all seasons and Flower Shop guarantees each and every product. In order to keep pace with the changing times, Flower Shop's highly recognized catalog can now be viewed online. Our site can be used as a one-stop-shop for gardening techniques, recipes, FAQs, etc.
                    </p>

                    <p class="details">
                        Through good times and bad, great depression and world wars, Flower Shop has been a beacon of hope for Australians for over a century. Despite the invention of the radio, television, cell phones and ipods, nothing is more amazing and powerful than the enchantment of planting a seed in soil and watching it grow. We, at Flower Shop, certainly did not invent it, but we have been dedicated to enabling you to share, in a very small but significant way, the astonishing magic of nature.
                    </p>

                    <p class="details">
                        Where else can you purchase such a breathtaking experience at such a reasonable price?
                    </p>

                </div>

                <div class="clear"></div>

            </div>
            <!--end of left content-->

            <div class="right_content">

                <div class="languages_box">
                    <span class="red">Languages:</span>
                    <a href="#">
                        <img src="images/au.gif" alt="" title="" style="border: 0; height:12px; width:15px;" />
                    </a>
                </div>

                <div class="currency">
                    <span class="red">Currency: </span>
                    <a href="#" class="selected">AUD</a>
                </div>
                <div>
                  <a href="myaccount.php" style="margin-left:50px" class="red">
                    <?php
                    /*-------------------------
                    Displays username by the cart on each page.
                    --------------------------*/
                    $seperator = "{||}";
                    $info = $_SESSION["UserData"];
                    $arr = array();
                    $arr = explode($seperator,$info);
                    $user = htmlentities($arr[1]);
                    echo "$user";
                    ?>
                  </a>
                </div>

                <!--CART-->
                <div class="cart">
                    <!--cart title-->
                    <div class="title">
                        <span class="title_icon">
                                <img src="images/cart.gif" alt="" title="" />
                        </span>My Cart
                    </div>
                    <!--end cart title-->
                    <!--cart content-->
                    <div class="home_cart_content">
                      <?php
                        if(isset($_SESSION["Plants"]) && $_SESSION["Plants"] != ""){
                          $numOfPlants = $_SESSION["CartNum"];
                          $$totalPrice = $_SESSION["CartPrice"];
                          echo "$numOfPlants x items | <span class='red'>TOTAL: $$totalPrice</span>";
                        }else{
                          echo "0 x items | <span class='red'>TOTAL: $0.00</span>";
                        }
                      ?>
                        <!--3 x items | <span class="red">TOTAL: 100$</span>-->
                    </div>
                    <!--end cart content-->
                    <!--cart links-->
                    <div class="cart_actions">
                        <a href="cart.php" class="view_cart">View Cart</a>
                        <a href="order.php" class="place_order">Place Order</a>
                    </div>
                    <!--end cart links-->
                </div>
                <!--END CART-->
                <!--TITLE-->
                <div class="title">
                    <span class="title_icon">
                            <img src="images/bullet3.gif" alt="" title="" />
                    </span>About Our Shop
                </div>
                <!--END TITLE-->
                <!--ABOUT-->
                <div class="about">
                    <p>
                        <img src="images/about.gif" alt="" title="" class="right" /> Flowershop has quickly become renowned
                        as one of Geelong's most prestigious and luxurious retail flower stores, and this has been successfully
                        translated to our online flower shop. The same service, quality and range we provide to our retail
                        shoppers is also extended to our online community.
                        <!-- reference: Flower Temple, availalbe at <http://www.flowertemple.com.au/aboutflowertemple.aspx>, accessed 09/07/2013)-->
                    </p>
                </div>
                <!--END ABOUT-->
                <!--BOTTOM RIGHT CONTENT-->
                <div class="right_box">
                    <div class="title">
                        <span class="title_icon">
                                <img src="images/bullet5.gif" alt="" title="" />
                        </span>Categories
                    </div>
                    <ul class="list">
                        <li><a href="category.php">Flowers</a></li>
                    </ul>
                </div>
                <!--END BOTTOM RIGHT CONTENT-->
            </div>
            <!--END RIGHT CONTENT-->
            <div class="clear"></div>
        </main>
        <!--END MAIN-->
        <!--FOOTER-->
        <footer>
            <div class="left_footer">
                <img src="images/footer_logo.gif" alt="" title="" /><br />
                <a href="http://csscreme.com/freecsstemplates/" title="free templates">
                    <img src="images/csscreme.gif" alt="free templates" title="free templates" style="border:0" />
                </a>
            </div>
            <div class="right_footer">
                <a href="main.php">Home</a>
                <a href="about.php">About Us</a>
                <a href="category.php">Flowers</a>
                <a href="contact.php">Contact Us</a>
            </div>
            <!--DEAKIN DISCLAIMER-->
            <aside id="deakinDisclaimer">
            ©Deakin University, School of Information Technology. This web page has been developed as a student assignment for the unit SIT203: Web Programming. Therefore it is not part of the University's authorised web site. DO NOT USE THE INFORMATION CONTAINED ON THIS WEB PAGE IN ANY WAY.
            </aside>
            <!--END DEAKIN DISCLAIMER-->
        </footer>
        <!--END FOOTER-->
    </div>
    <!--END CONTENT WRAPPER-->
</body>

</html>
