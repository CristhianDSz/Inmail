<template>
  <div :id="name" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" :class="isLg === true ? 'mw-100 w-75' : ''" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">
            <slot name="title"></slot>
          </h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body pd-20">
          <slot name="body"></slot>
        </div>
        <!-- modal-body -->
      </div>
    </div>
    <!-- modal-dialog -->
  </div>
</template>

<script>
export default {
  props: ["name", "isLg"],
  data() {
    return {};
  },
  created() {
    modalEmitter.$on("close", name => {
      const modalName = name ? `#${name}` : `#${this.name}`;
      $(modalName).modal("hide");
    });
  },
  methods: {
    showModal() {
      const modalName = `#${this.name}`;

      $(modalName).modal({
        backdrop: "static",
        keyboard: false
      });
    }
  }
};
</script>

<style>
</style>
