<?php use Illuminate\Support\Facades\Session;?>
@extends('layoutTemplate.main')
@section('content')
<div id="Content">
    <div class="main">
        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="container-fluid">

                <!-- OVERVIEW -->
                @if (session('login'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-info-circle"></i> {{session('login')}}

                </div>
                @endif
                        <h3 class="panel-title">Welcome</h3>
                    </div>

                    </div>

                </div>
                <!-- END OVERVIEW -->

            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    </div>
@stop



