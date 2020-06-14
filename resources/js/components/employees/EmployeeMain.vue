<template>
  <div class="row row-sm">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
           <div class="text-right">
            <small class="font-weight-bold">Nuevo funcionario</small>
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
          <employees ref="employees"></employees>
        </div>
      </div>
      <modal name="dependencyModal" :isLg="true" ref="modal">
        <template slot="title">Agregar nuevo funcionario</template>
        <template slot="body">
          <employee-form @success="reloadEmployees" @dependencies="passDataToEmployees"></employee-form>
        </template>
      </modal>
    </div>
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
