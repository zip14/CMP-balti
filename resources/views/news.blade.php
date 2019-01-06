@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="section-header col-md-12">
                    <h2>Noutăți</h2>
                    <span>de la academia noastră</span>
                </div> <!-- /.section-header -->
            </div> <!-- /.row -->
            <div class="projects-holder-3">

                <div class="filter-categories">
                    <ul class="project-filter">
                        <li class="filter" data-filter="all"><span>All</span></li>
                        <li class="filter" data-filter="buildings"><span>Categorie</span></li>
                        <li class="filter" data-filter="design"><span>Categorie</span></li>
                        <li class="filter" data-filter="architecture"><span>Categorie</span></li>
                        <li class="filter" data-filter="nature"><span>Categorie</span></li>
                    </ul>
                </div>

                <div class="projects-holder">
                    <div class="row">
                        <div class="col-md-4 project-item mix design">
                            <div class="project-thumb">
                                <img src="images/projects/project_1.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_1.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam iure, temporibus repellendus?</p>
                            </div>
                        </div> <!-- /.project-item -->
                        <div class="col-md-4 project-item mix nature">
                            <div class="project-thumb">
                                <img src="images/projects/project_2.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_2.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere error, at earum.</p>
                            </div>
                        </div> <!-- /.project-item -->
                        <div class="col-md-4 project-item mix architecture">
                            <div class="project-thumb">
                                <img src="images/projects/project_3.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_3.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem distinctio veritatis adipisci!</p>
                            </div>
                        </div> <!-- /.project-item -->
                        <div class="col-md-4 project-item mix buildings">
                            <div class="project-thumb">
                                <img src="images/projects/project_4.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_4.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore vitae, dolorum reprehenderit.</p>
                            </div>
                        </div> <!-- /.project-item -->
                        <div class="col-md-4 project-item mix design">
                            <div class="project-thumb">
                                <img src="images/projects/project_5.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_5.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat beatae, dignissimos laborum.</p>
                            </div>
                        </div> <!-- /.project-item -->
                        <div class="col-md-4 project-item mix buildings architecture">
                            <div class="project-thumb">
                                <img src="images/projects/project_6.jpg" alt="">
                                <div class="overlay-b">
                                    <div class="overlay-inner">
                                        <a href="images/projects/project_6.jpg" class="fancybox fa fa-expand" title="Project Title Here"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-content project-detail">
                                <h2><a href="post_single.html">Title post</a></h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi natus non beatae.</p>
                            </div>
                        </div> <!-- /.project-item -->
                    </div> <!-- /.row -->


                    <div class="row">
                        <div class="col-md-12">
                            <div class="pagination text-center">
                                <ul>
                                    <li><a href="javascript:void(0)">1</a></li>
                                    <li><a href="javascript:void(0)" class="active">2</a></li>
                                    <li><a href="javascript:void(0)">3</a></li>
                                    <li><a href="javascript:void(0)">4</a></li>
                                    <li><a href="javascript:void(0)">...</a></li>
                                    <li><a href="javascript:void(0)">11</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection