<template>
  <div class="col-12">
    <div class="text-right">
      <button class="btn btn-primary btn-link mb-3" @click="showModal">Agregar dependencia</button>
    </div>
    <div class="card">
      <div class="card-body">
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
