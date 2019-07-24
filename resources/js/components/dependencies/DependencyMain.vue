<template>
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="text-right">
          <small class="font-weight-bold">Crear nueva dependencia</small>
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
        <dependencies ref="dependencies"></dependencies>
      </div>
    </div>
    <modal name="dependencyModal" :isLg="true" ref="modal">
      <template slot="title">Agregar nueva dependencia</template>
      <template slot="body">
        <dependency-form @success="reloadDependencies"></dependency-form>
      </template>
    </modal>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import DependencyForm from "./DependencyForm";
import Dependencies from "./Dependencies";
export default {
  components: {
    Modal,
    DependencyForm,
    Dependencies
  },
  data() {
    return {};
  },

  methods: {
    showModal() {
      this.$refs.modal.showModal();
    },
    reloadDependencies() {
      this.$refs.dependencies.getDependencies();
      modalEmitter.$emit("close");
    }
  }
};
</script>

<style scoped>
.action-icon {
  color: #00b297;
}
</style>
