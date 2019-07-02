<template>
  <div class="col-12">
    <div class="text-right">
      <button class="btn btn-primary btn-link mb-3" @click="showModal">Agregar tercero</button>
    </div>
    <div class="card">
      <div class="card-body">
        <third-parties ref="thirdParties"></third-parties>
      </div>
    </div>
    <modal name="thirdPartyModal" :isLg="true" ref="modal">
      <template slot="title">Agregar nuevo tercero</template>
      <template slot="body">
        <third-party-form @success="reloadThirdParties"></third-party-form>
      </template>
    </modal>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import ThirdPartyForm from "./ThirdPartyForm";
import ThirdParties from "./ThirdParties";
export default {
  components: {
    Modal,
    ThirdPartyForm,
    ThirdParties
  },
  data() {
    return {};
  },

  methods: {
    showModal() {
      this.$refs.modal.showModal();
    },
    reloadThirdParties() {
      this.$refs.thirdParties.getThirdParties();
      modalEmitter.$emit("close");
    }
  }
};
</script>
