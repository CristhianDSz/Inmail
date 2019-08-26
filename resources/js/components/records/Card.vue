<template>
  <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
    <div class="rounded overflow-hidden" :class="`bg-${color}`">
      <div class="pd-25 d-flex align-items-center">
        <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
        <div class="mg-l-20">
          <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">{{title}}</p>
          <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{text}}</p>
          <span class="tx-10 tx-roboto tx-white-6">Del total de registros</span>
        </div>
      </div>
    </div>
  </div>
  <!-- col-3 -->
</template>
<script>
export default {
  props: ["title", "text", "color"]
};
</script>
