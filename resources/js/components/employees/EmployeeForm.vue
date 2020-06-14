<template>
  <form @submit.prevent="validateForm" class="form-layout form-layout-2">
    <div class="row no-gutters">
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Documento de identidad:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="identification"
            v-validate="'required|min:6'"
            data-vv-as="Documento"
            v-model="employee.identification"
            placeholder="Cédula de ciudadanía"
          >
           <small class="text-danger" v-if="errors.has('identification')">{{errors.first('identification')}}</small>

        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">
            Nombres:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="firstname"
            v-validate="'required|min:3'"
            data-vv-as="Nombres"
            v-model="employee.firstname"
            placeholder="Ingrese los nombres"
          >
           <small class="text-danger" v-if="errors.has('firstname')">{{errors.first('firstname')}}</small>

        </div>
      </div>
      <!-- col-4 -->
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Apellidos:
            <span class="tx-danger">*</span>
          </label>
          <input
            class="form-control"
            type="text"
            name="lastname"
            v-validate="'required|min:3'"
            data-vv-as="Apellidos"
            v-model="employee.lastname"
            placeholder="Ingrese los apellidos"
          >
           <small class="text-danger" v-if="errors.has('lastname')">{{errors.first('lastname')}}</small>

        </div>
      </div>
      <div class="col-md-4 mg-t--1 mg-md-t-0">
        <div class="form-group mg-md-l--1">
          <label class="form-control-label">
            Dependencia:
            <span class="tx-danger">*</span>
          </label>
          <multiselect
            name="dependency_id"
            v-validate="'required'"
            data-vv-as="Dependencia"
            :selectLabel="''"
            :deselectLabel="''"
            :maxHeight="400"
            v-model="employeeDependency"
            :options="dependencies"
            label="name"
            placeholder="Seleccione"
          ></multiselect>
           <small class="text-danger" v-if="errors.has('dependency_id')">{{errors.first('dependency_id')}}</small>
        </div>
      </div>
      <!-- col-4 -->
    </div>
    <!-- row -->
    <div class="form-layout-footer bd pd-20 bd-t-0 text-right">
      <button class="btn btn-info" type="submit">Registrar</button>
    </div>
    <!-- form-group -->
  </form>
</template>

<script>
export default {
  data() {
    return {
      employee: {
        identification: "",
        firstname: "",
        lastname: "",
        dependency_id: ""
      },
      dependencies: [],
      employeeDependency: ""
    };
  },
  created() {
    this.getDependencies();
  },
  methods: {
    getDependencies() {
      axios.get("/dependencies").then(dependencies => {
        this.dependencies = dependencies.data.data;
        this.employee.dependency_id = dependencies.data.data[0].id;
        this.$emit("dependencies", dependencies.data.data);
      });
    },
    async validateForm() {
      let valid = await this.$validator.validateAll();
      if (valid) {
        this.postEmployee();
        return;
      }
      this.$swal(
        "Error",
        "Debe corregir los errores antes de continuar",
        "error"
      );
     },
    postEmployee() {
      this.employee.dependency_id = this.employeeDependency.id
      axios.post("/employees", this.employee).then(response => {
        this.$emit("success");
        this.resetForm();
        this.$validator.reset()
      });
    },

    resetForm() {
      for (let prop in this.employee) {
        this.employee[prop] = "";
        this.employeeDependency = ""
      }
    }
  }
};
</script>
