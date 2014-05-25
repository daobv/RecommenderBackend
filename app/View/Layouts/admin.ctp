<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>Administrator | <?php echo $title_for_layout; ?></title>
    <?php
            echo $this->fetch('meta');
            echo $this->Html->css(array('admin'));
            echo $this->fetch('css');
            echo $this->Html->script('jquery-1.7.2.min');
            echo $this->fetch('script');
    ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="logo"></div>
            <div class="clear"></div>
        </div>
        <div id="content-wrapper">
            <div class="wrap">
            <div id="header">
                <div id="top">
                    <div class="left">
                        <p>Welcome, <strong>Paweł B.</strong> [ <a href="">logout</a> ]</p>
                    </div>
                    <div class="right">
                        <div class="align-right">
                            <p>Last login: <strong>23-04-2012 23:12</strong></p>
                        </div>
                    </div>
                </div>
                <div id="nav">
                    <ul>
                        <li class="upp"><a href="#">Main control</a>
                            <ul>
                                <li>&#8250; <a href="">Visit site</a></li>
                                <li>&#8250; <a href="">Reports</a></li>
                                <li>&#8250; <a href="">Add new page</a></li>
                                <li>&#8250; <a href="">Site config</a></li>
                            </ul>
                        </li>
                        <li class="upp"><a href="#">Manage content</a>
                            <ul>
                                <li>&#8250; <a href="">Show all pages</a></li>
                                <li>&#8250; <a href="">Add new page</a></li>
                                <li>&#8250; <a href="">Add new gallery</a></li>
                                <li>&#8250; <a href="">Categories</a></li>
                            </ul>
                        </li>
                        <li class="upp"><a href="#">Users</a>
                            <ul>
                                <li>&#8250; <a href="">Show all uses</a></li>
                                <li>&#8250; <a href="">Add new user</a></li>
                                <li>&#8250; <a href="">Lock users</a></li>
                            </ul>
                        </li>
                        <li class="upp"><a href="#">Settings</a>
                            <ul>
                                <li>&#8250; <a href="">Site configuration</a></li>
                                <li>&#8250; <a href="">Contact Form</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="content">
            <div id="sidebar">
                <div class="box">
                    <div class="h_title">&#8250; Main control</div>
                    <ul id="home">
                        <li class="b1"><a class="icon view_page" href="">Visit site</a></li>
                        <li class="b2"><a class="icon report" href="">Reports</a></li>
                        <li class="b1"><a class="icon add_page" href="">Add new page</a></li>
                        <li class="b2"><a class="icon config" href="">Site config</a></li>
                    </ul>
                </div>

                <div class="box">
                    <div class="h_title">&#8250; Manage content</div>
                    <ul>
                        <li class="b1"><a class="icon page" href="">Show all pages</a></li>
                        <li class="b2"><a class="icon add_page" href="">Add new page</a></li>
                        <li class="b1"><a class="icon photo" href="">Add new gallery</a></li>
                        <li class="b2"><a class="icon category" href="">Categories</a></li>
                    </ul>
                </div>
                <div class="box">
                    <div class="h_title">&#8250; Users</div>
                    <ul>
                        <li class="b1"><a class="icon users" href="">Show all users</a></li>
                        <li class="b2"><a class="icon add_user" href="">Add new user</a></li>
                        <li class="b1"><a class="icon block_users" href="">Lock users</a></li>
                    </ul>
                </div>
                <div class="box">
                    <div class="h_title">&#8250; Settings</div>
                    <ul>
                        <li class="b1"><a class="icon config" href="">Site configuration</a></li>
                        <li class="b2"><a class="icon contact" href="">Contact Form</a></li>
                    </ul>
                </div>
            </div>
            <?php echo $this->fetch('content'); ?>
            <div class="clear"></div>
            </div>

            <div id="footer">
                <div class="left">
                    <p>Design: <a href="http://kilab.pl">Paweł Balicki</a> | Admin Panel: <a href="">YourSite.com</a></p>
                </div>
                <div class="right">
                    <p><a href="">Example link 1</a> | <a href="">Example link 2</a></p>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>