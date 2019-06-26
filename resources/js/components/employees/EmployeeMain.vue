<template>
  <div class="col-10 offset-1">
    <div class="text-right">
      <button class="btn btn-primary btn-link mb-3" @click="showModal">Agregar dependencia</button>
    </div>
    <div class="card">
      <div class="card-body">
        <employees ref="employees"></employees>
      </div>
    </div>
    <modal name="dependencyModal" :isLg="true" ref="modal">
      <template slot="title">Agregar nueva dependencia</template>
      <template slot="body">
        <employee-form @success="reloadEmployees" @dependencies="passDataToEmployees"></employee-form>
      </template>
    </modal>
  </div>
</template>

<script>
import Modal from "../utils/Modal";
import EmployeeForm from "./EmployeeForm";
import Employees from "./Employees";
export default {
  components: {
    Modal,
    EmployeeForm,
    Employees
  },
  data() {
    return {};
  },

  methods: {
    showModal() {
      this.$refs.modal.showModal();
    },
    reloadEmployees() {
      this.$refs.employees.getEmployees();
      modalEmitter.$emit("close");
    },
    passDataToEmployees(dependencies = []) {
      this.$refs.employees.dependencies = dependencies;
    }
  }
};
</script>
