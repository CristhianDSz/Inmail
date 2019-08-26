<template>
  <div class="row row-sm">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="text-right">
            <small class="font-weight-bold">Crear nuevo tercero</small>
            <a
              href="#"
              class="btn btn-info btn-icon rounded-circle mg-r-5 mg-b-10 bd-4"
              @click.prevent="showModal"
            >
              <div>
                <i class="icon ion-plus"></i>
              </div>
            </a>
          </div>
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
