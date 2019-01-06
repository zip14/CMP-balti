@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="section-header col-md-12">
                    <h2>Contacte</h2>
                    <span>Сum să ne contactați ?</span>
                </div> <!-- /.section-header -->
            </div> <!-- /.row -->
            <div class="contact-form">
                <div class="box-content col-md-12">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="contact-title">Trimite Email</h3>
                            <div class="contact-form-inner">
                                <form method="post" action="#" name="contactform" id="contactform">
                                    <p>
                                        <label for="name">Prenumele dvs:</label><br>
                                        <input name="name" type="text" id="name">
                                    </p>
                                    <p>
                                        <label for="email">Email Address:</label><br>
                                        <input name="email" type="text" id="email">
                                    </p>
                                    <p>
                                        <label for="comments">Mesag dvs:</label><br>
                                        <textarea name="comments" id="comments"></textarea>
                                    </p>
                                    <input type="submit" class="mainBtn" id="submit" value="Trimite" />
                                </form>
                            </div> <!-- /.contact-form-inner -->
                        </div> <!-- /.col-md-7 -->
                        <div class="col-md-5">
                            <div class="googlemap-wrapper">
                                <h3 class="contact-title">Intrarea la Academie</h3>
                                <img src="images/my_img/vhod.jpg" alt="">
                            </div>
                        </div> <!-- /.col-md-5 -->
                    </div> <!-- /.row -->
                    <div id="contact_info">
                        <ul>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <p>colegiul.muzical@mail.ru</p>
                            </li>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <p>colegiumuzical@gmail.com</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <p>0 (231) 20-5-69</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <p>0 (231) 25-2-89</p>
                            </li>
                        </ul>
                    </div>
                    <div id="map_contact">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2682.4822781073076!2d27.924836315635577!3d47.75269907919462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cb6728be3ee70b%3A0x81f800d868ddb255!2sStrada+Ciprian+Porumbescu+18%2C+B%C4%83l%C8%9Bi+3100!5e0!3m2!1sru!2s!4v1541869509756" ></iframe>
                        <ul>
                            <li>
                                <i class="fa fa-envelope"></i>
                                <p>colegiumuzical@gmail.com</p>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i>
                                <p>0 (231) 25-2-89</p>
                            </li>
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <p> Ciprian Porumbescu 18</p>
                            </li>
                        </ul>
                    </div>
                </div> <!-- /.box-content -->
            </div> <!-- /.contact-form -->
        </div> <!-- /.inner-content -->
    </div> <!-- /.content-wrapper -->

@endsection