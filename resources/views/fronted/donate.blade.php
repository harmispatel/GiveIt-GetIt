@extends('fronted.layout')

@section('title', 'Give It & Get It - Donet')

@section('content')

    <div class="main">
        <section class="page-title">
            <div class="container">
                <h2>Give Donation</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="donate">Donate</a></li>
                    </ol>
                </nav>
            </div>
        </section>


        <section class="donation-main">
            <div class="sec-title">
                <h2>Give and Make Happy all.</h2>
                <p>Do a good deed by giving to those in need.</p>
                <p>Giving does not only precede receiving; it is the reason for it. It is in giving that we receive</p>
            </div>
            <div class="donation-info">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="donate-form">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Your First and Last Name</label>
                                                <input type="text" class="form-control" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Your Email Address</label>
                                                <input type="email" class="form-control" id="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone-number" class="form-label">Your Phone Number</label>
                                                <input type="text" class="form-control" id="phone-number">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="amount" class="form-label">Select Type</label>
                                                <select class="form-control">
                                                    <option>---Select Type---</option>
                                                    <option>GET IT</option>
                                                    <option>GIVE IT</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="note" class="form-label">Address</label>
                                                <textarea class="form-control" placeholder="Leave a message here" id="note" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="submit" class="btn donate-bt">Donate It</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
