<?php 
    if(isset($_SESSION['sesijaIdKorisnik'])){
    ?>
    <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="magacin.php"><i class="fas fa-warehouse"></i> Magacin</a>
                    </li>
                   <!-- <li>
                        <a href="ui-elements.html"><i class="fa fa-desktop"></i> UI Elements</a>
                    </li> -->

                    <li>
                        <a href="#"><i class="fas fa-cogs"></i> Upravljanje<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="proizvodi.php">Proizvodi</a>
                            </li>
                            <li>
                                <a href="dobavljaci.php">Dobavljaci</a>
                            </li>
						</ul>
					</li>
					 
					<li>
                        <a href="#"><i class="fas fa-exchange-alt"></i> Ulaz/Izlaz<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="ulazRobe.php">Ulaz robe</a>
                            </li>
                            <li>
                                <a href="izlazRobe.php">Izlaz robe</a>
                            </li>
						</ul>
					</li>	

                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Faktura<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="fakturaUlaz.php">Faktura ulaza robe</a>
                            </li>
                            <li>
                                <a href="fakturaIzlaz.php">Faktura izlaza robe</a>
                            </li>
                            <li>
                                <a href="fakturaDobavljaci.php">Faktura po dobavljacima</a>
                            </li>
                            <li>
                                <a href="fakturaUKategorije.php">Faktura po kategorijama(Ulaz)</a>
                            </li>
						</ul>
					</li>	
							
              


                  <!--  <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
                    </li>-->
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
<?php
    }

?>
