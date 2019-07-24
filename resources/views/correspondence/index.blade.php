@extends('layouts.master')

@section('pageTitle')
   Correspondencia
@endsection


@section('content')
    <div class="col-sm-6 col-xl-3">
      <div class="bg-teal rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Entrada</p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">1,975,224</p>
            <span class="tx-11 tx-roboto tx-white-6">24% higher yesterday</span>
          </div>
        </div>
      </div>
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
      <div class="bg-danger rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10"> Salida</p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">$329,291</p>
            <span class="tx-11 tx-roboto tx-white-6">$390,212 before tax</span>
          </div>
        </div>
      </div>
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="bg-primary rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-monitor tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">
                Sin registrar
            </p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">54.45%</p>
            <span class="tx-11 tx-roboto tx-white-6">23% average</span>
          </div>
        </div>
      </div>
    </div><!-- col-3 -->
    <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
      <div class="bg-br-primary rounded overflow-hidden">
        <div class="pd-25 d-flex align-items-center">
          <i class="ion ion-clock tx-60 lh-0 tx-white op-7"></i>
          <div class="mg-l-20">
            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Hoy</p>
            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">32.16%</p>
            <span class="tx-11 tx-roboto tx-white-6">65.45% on average</span>
          </div>
        </div>
      </div>
    </div><!-- col-3 -->
  <record-main></record-main>
@endsection