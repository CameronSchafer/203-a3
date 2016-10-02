<?php
//Start Session.
session_start();
?>

<!DOCTYPE html>

<!--"Search" page of FlowerShop.
    Please refer back to this page for any comments on the main structure of the site
    Refer to order.html for comments on pages using forms
    All flower details and flower pictures are referenced in catalog.xml

    This page was created in accordance to specifications. It contains all of the changes done to the main template.-->

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Flower Shop</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <!--Call the JQUERY library-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://www.deakin.edu.au/~cschafer/ass2/js/search.js"></script>
</head>

<body>
    <!--CONTENT WRAPPER-->
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
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="category.php">Flowers</a></li>
                  <li><a href="contact.php">Contact</a></li>
                  <li class="selected"><a href="searchForm.php">Search</a></li>
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
        <!--MAIN-->
        <main>
          <!--LEFT CONTENT-->
            <div class="left_content">
                <div class="title" >
                    <span class="title_icon">
                        <img src="images/bullet1.gif" alt="" title="" />
                    </span>Search
                </div>
                <div class="feat_prod_box_details">
                    <p class="details">
                      <strong>Look for your favourite flowers here!</strong><br/>
                    </p>
                    <!--SEARCH FORM-->
                    <form name="search" action="#">
                        <fieldset class="form_box">
                            <legend class="form_subtitle"><strong>Start Looking</strong></legend>
                                <div class="form_row">
                                    <label class="form_field" for="searchKeywords"><strong>Keywords</strong></label>
                                    <input type="text" class="form_field_input" id="searchKeywords" required/>
                                </div>
                                <div class="form_row">
                                    <label class="form_field" for="searchLightLevel" ><strong>Light level</strong></label>
                                    <input type="text" class="form_field_input" id="searchLightLevel"/>
                                </div>
                                <div class="form_row">
                                    <label class="form_field inline_width" for="searchMinPrice">
                                        <strong>Minimum price</strong>
                                        <span class="searchPriceSymbol">$</span>
                                    </label>
                                    <input type="number" class="form_field_input" step="0.01" id="searchMinPrice" placeholder="0.00"/>
                                </div>
                                <div class="form_row">
                                    <label class="form_field inline_width" for="searchMaxPrice">
                                        <strong>Maximum price</strong>
                                        <span class="searchPriceSymbol">$</span>
                                    </label>
                                    <input type="number" class="form_field_input" step="0.01" id="searchMaxPrice" placeholder="0.00"/>
                                </div>
                                <div class="form_row">
                                    <input type="submit" class="form_submit" value="search" />
                                </div>
                        </fieldset>
                    </form>
                    <!--END SEARCH FORM-->
                </div>
                <div class="clear"></div>
            </div>
            <!--END LEFT CONTENT-->
            <!--RIGHT CONTENT-->
            <div class="right_content">
              <!--LANGUAGES-->
                <div class="languages_box">
                    <span class="red">Languages:</span>
                    <a href="#">
                        <img src="images/au.gif" alt="" title="" style="border: 0; height:12px; width:15px;" />
                    </a>
                </div>
                <!--END LANGUAGES-->
                <!--CURRENCY-->
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
                <!--END CURRENCY-->
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
